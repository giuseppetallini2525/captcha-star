<?php
/**
 * Similarity - Calcola la similarità semantica tra pagine web e loghi
 * VERSIONE OTTIMIZZATA - usa query batch invece di singole query
 */

// Carica configurazione
require_once(__DIR__ . '/../config.php');
require_once(__DIR__ . '/simple_html_dom.php');

// Cache per i vettori dei loghi (calcolati una sola volta)
$GLOBALS['logo_vectors_cache'] = null;

function getLogoVectorsCache($conn, $dimension) {
    if ($GLOBALS['logo_vectors_cache'] !== null) {
        return $GLOBALS['logo_vectors_cache'];
    }

    // Carica tutti i loghi con le loro keywords
    $logos = [];
    $query = "SELECT DISTINCT nome, keywords, categoria FROM scrape WHERE keywords != ''";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result)) {
        $logos[] = $row;
    }

    // Raccogli tutte le keywords uniche di tutti i loghi
    $allKeywords = [];
    foreach ($logos as $logo) {
        $words = explode(",", $logo['keywords']);
        foreach ($words as $w) {
            $w = trim($w);
            if (!empty($w)) {
                $allKeywords[$w] = true;
            }
        }
    }

    // Carica tutti i vettori in una sola query
    $keywordList = array_keys($allKeywords);
    $placeholders = "'" . implode("','", array_map('mysqli_real_escape_string', array_fill(0, count($keywordList), $conn), $keywordList)) . "'";
    $query = "SELECT parola, vettore FROM dizionario_$dimension WHERE parola IN ($placeholders)";
    $result = mysqli_query($conn, $query);

    $vectors = [];
    while ($row = mysqli_fetch_array($result)) {
        $vectors[$row['parola']] = unserialize($row['vettore']);
    }

    // Pre-calcola il vettore medio per ogni logo
    $logoVectors = [];
    foreach ($logos as $logo) {
        $sum = array_fill(1, $dimension, 0);
        $words = explode(",", $logo['keywords']);
        $count = 0;
        foreach ($words as $w) {
            $w = trim($w);
            if (isset($vectors[$w])) {
                $vec = $vectors[$w];
                unset($vec[0]);
                $i = 1;
                foreach ($vec as $elem) {
                    $sum[$i] += (double)$elem;
                    $i++;
                }
                $count++;
            }
        }
        if ($count > 0) {
            for ($i = 1; $i <= $dimension; $i++) {
                $sum[$i] /= $count;
            }
        }
        $logoVectors[$logo['categoria'] . '/' . $logo['nome']] = $sum;
    }

    $GLOBALS['logo_vectors_cache'] = $logoVectors;
    return $logoVectors;
}

//funzione che calcola la similarità fra la pagina web e i loghi
function sim($dimension, $method, $page) {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("unable to connect");

    // Se è una pagina locale (demo), leggi direttamente il file
    $html_content = null;
    if (strpos($page, 'localhost') !== false || strpos($page, '127.0.0.1') !== false) {
        // Estrai il path dal URL
        $parsed = parse_url($page);
        $path = isset($parsed['path']) ? $parsed['path'] : '';
        $localFile = __DIR__ . '/..' . $path;
        if (file_exists($localFile)) {
            $html_content = file_get_contents($localFile);
        }
    }

    // Se non è locale o il file non esiste, usa cURL
    if (empty($html_content)) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $page);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $html_content = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($http_code != 200 || empty($html_content)) {
            return null;
        }
    }

    $dom = new simple_html_dom();
    $dom->load($html_content);
    $text = $dom->plaintext;

    // Rimozione caratteri inutili
    $c = array('.',',','..','=','-');
    $r = array(' ',' ',' ',' ',' ');
    $b = removeCommonWords($text);
    $a = str_replace($c, $r, $b);

    $arr = explode(" ", $a);
    $arrr = array_diff($arr, array("", 0, null));
    $len = count($arrr);
    if ($len == 0) return null;

    $conta_parola = array_count_values($arrr);
    arsort($conta_parola);

    // Prendi le top 50 parole più frequenti per la query batch
    $topWords = array_slice(array_keys($conta_parola), 0, 50);

    // Query batch per IDF
    $escaped = array_map(function($w) use ($conn) {
        return "'" . mysqli_real_escape_string($conn, $w) . "'";
    }, $topWords);
    $wordList = implode(",", $escaped);
    $query = "SELECT parola, idf, vettore FROM dizionario_$dimension WHERE parola IN ($wordList)";
    $result = mysqli_query($conn, $query);

    $idfData = [];
    $vectorData = [];
    while ($row = mysqli_fetch_array($result)) {
        $idfData[$row['parola']] = $row['idf'];
        $vectorData[$row['parola']] = unserialize($row['vettore']);
    }

    // Calcola TF-IDF
    $td_idf = [];
    foreach ($conta_parola as $key => $value) {
        if (isset($idfData[$key]) && !is_numeric($key)) {
            $td = $value / $len;
            $td_idf[$key] = $td * $idfData[$key];
        }
    }
    arsort($td_idf);

    // Seleziona le prime 10 keywords
    $keywords = array_slice($td_idf, 0, 10, true);

    // Calcola il vettore della pagina
    $summ = array_fill(1, $dimension, 0);
    $count = 0;
    foreach ($keywords as $key => $value) {
        if (isset($vectorData[$key])) {
            $vector = $vectorData[$key];
            unset($vector[0]);
            $i = 1;
            foreach ($vector as $elem) {
                $summ[$i] += (double)$elem;
                $i++;
            }
            $count++;
        }
    }

    if ($count == 0) return null;

    // Normalizza
    $pageVector = [];
    for ($i = 1; $i <= $dimension; $i++) {
        $pageVector[$i] = $summ[$i] / $count;
    }

    // Ottieni i vettori pre-calcolati dei loghi
    $logoVectors = getLogoVectorsCache($conn, $dimension);

    // Calcola similarità
    $similarity = [];
    foreach ($logoVectors as $logoName => $logoVector) {
        $dist = cosine_similarity($pageVector, $logoVector, $dimension);
        $similarity[$logoName] = $dist;
    }

    arsort($similarity);

    // Prendi i top 5 loghi più simili
    $topLogos = array_slice(array_keys($similarity), 0, 5);

    // Se non ci sono loghi, ritorna null
    if (empty($topLogos)) {
        return null;
    }

    // Scegli casualmente uno dei top 5
    $randomIndex = array_rand($topLogos);
    $valore = $topLogos[$randomIndex];

    return $valore;
}





function removeCommonWords($input){

    // EEEEEEK Stop words
    $input = strtolower($input);
   $commonWords = array('a','able','about','above','abroad','according','accordingly','across','actually','adj','after','afterwards','again','against','ago','ahead','ain\'t','all','allow','allows','almost','alone','along','alongside','already','also','although','always','am','amid','amidst','among','amongst','an','and','another','any','anybody','anyhow','anyone','anything','anyway','anyways','anywhere','apart','appear','appreciate','appropriate','are','aren\'t','around','as','a\'s','aside','ask','asking','associated','at','available','away','awfully','b','back','backward','backwards','be','became','because','become','becomes','becoming','been','before','beforehand','begin','behind','being','believe','below','beside','besides','best','better','between','beyond','both','brief','but','by','c','came','can','cannot','cant','can\'t','caption','cause','causes','certain','certainly','changes','clearly','c\'mon','co','co.','com','come','comes','concerning','consequently','consider','considering','contain','containing','contains','corresponding','could','couldn\'t','course','c\'s','currently','d','dare','daren\'t','definitely','described','despite','did','didn\'t','different','directly','do','does','doesn\'t','doing','done','don\'t','down','downwards','during','e','each','edu','eg','eight','eighty','either','else','elsewhere','end','ending','enough','entirely','especially','et','etc','even','ever','evermore','every','everybody','everyone','everything','everywhere','ex','exactly','example','except','f','fairly','far','farther','few','fewer','fifth','first','five','followed','following','follows','for','forever','former','formerly','forth','forward','found','four','from','further','furthermore','g','get','gets','getting','given','gives','go','goes','going','gone','got','gotten','greetings','h','had','hadn\'t','half','happens','hardly','has','hasn\'t','have','haven\'t','having','he','he\'d','he\'ll','hello','help','hence','her','here','hereafter','hereby','herein','here\'s','hereupon','hers','herself','he\'s','hi','him','himself','his','hither','hopefully','how','howbeit','however','hundred','i','i\'d','ie','if','ignored','i\'ll','i\'m','immediate','in','inasmuch','inc','inc.','indeed','indicate','indicated','indicates','inner','inside','insofar','instead','into','inward','is','isn\'t','it','it\'d','it\'ll','its','it\'s','itself','i\'ve','j','just','k','keep','keeps','kept','know','known','knows','l','last','lately','later','latter','latterly','least','less','lest','let','let\'s','like','liked','likely','likewise','little','look','looking','looks','low','lower','ltd','m','made','mainly','make','makes','many','may','maybe','mayn\'t','me','mean','meantime','meanwhile','merely','might','mightn\'t','mine','minus','miss','more','moreover','most','mostly','mr','mrs','much','must','mustn\'t','my','myself','n','name','namely','nd','near','nearly','necessary','need','needn\'t','needs','neither','never','neverf','neverless','nevertheless','new','next','nine','ninety','no','nobody','non','none','nonetheless','noone','no-one','nor','normally','not','nothing','notwithstanding','novel','now','nowhere','o','obviously','of','off','often','oh','ok','okay','old','on','once','one','ones','one\'s','only','onto','opposite','or','other','others','otherwise','ought','oughtn\'t','our','ours','ourselves','out','outside','over','overall','own','p','particular','particularly','past','per','perhaps','placed','please','plus','possible','presumably','probably','provided','provides','q','que','quite','qv','r','rather','rd','re','really','reasonably','recent','recently','regarding','regardless','regards','relatively','respectively','right','round','s','said','same','saw','say','saying','says','second','secondly','see','seeing','seem','seemed','seeming','seems','seen','self','selves','sensible','sent','serious','seriously','seven','several','shall','shan\'t','she','she\'d','she\'ll','she\'s','should','shouldn\'t','since','six','so','some','somebody','someday','somehow','someone','something','sometime','sometimes','somewhat','somewhere','soon','sorry','specified','specify','specifying','still','sub','such','sup','sure','t','take','taken','taking','tell','tends','th','than','thank','thanks','thanx','that','that\'ll','thats','that\'s','that\'ve','the','their','theirs','them','themselves','then','thence','there','thereafter','thereby','there\'d','therefore','therein','there\'ll','there\'re','theres','there\'s','thereupon','there\'ve','these','they','they\'d','they\'ll','they\'re','they\'ve','thing','things','think','third','thirty','this','thorough','thoroughly','those','though','three','through','throughout','thru','thus','till','to','together','too','took','toward','towards','tried','tries','truly','try','trying','t\'s','twice','two','u','un','under','underneath','undoing','unfortunately','unless','unlike','unlikely','until','unto','up','upon','upwards','us','use','used','useful','uses','using','usually','v','value','various','versus','very','via','viz','vs','w','want','wants','was','wasn\'t','way','we','we\'d','welcome','well','we\'ll','went','were','we\'re','weren\'t','we\'ve','what','whatever','what\'ll','what\'s','what\'ve','when','whence','whenever','where','whereafter','whereas','whereby','wherein','where\'s','whereupon','wherever','whether','which','whichever','while','whilst','whither','who','who\'d','whoever','whole','who\'ll','whom','whomever','who\'s','whose','why','will','willing','wish','with','within','without','wonder','won\'t','would','wouldn\'t','x','y','yes','yet','you','you\'d','you\'ll','your','you\'re','yours','yourself','yourselves','you\'ve','z','zero',
   // Wikipedia-specific stopwords (months, dates, citation terms)
   'january','february','march','april','june','july','august','september','october','november','december',
   'retrieved','archived','original','accessed','cite','edit','references','external','links','isbn','wayback',
   'wikipedia','article','page','citation','source','http','https','www','org','pdf','doi','pmid','issn',
   'year','years','also','list','united','states','world','time','number','part','called','known','based');

   return preg_replace('/\b('.implode('|',$commonWords).')\b/','',$input);
}

function sum_arrays($array1, $array2) {
    $array = array();
    foreach($array1 as $index => $value) {
        $array[$index] = isset($array2[$index]) ? $array2[$index] + $value : $value;
    }
    return $array;
}

function cosine_similarity($document,$logo,$dim){
    $num = 0;
    $d = 0;
    $l = 0;
    for($i =1 ; $i < $dim+1;$i++){
        $num = $num + ($document[$i]*$logo[$i]);
        $d = $d + ($document[$i]**2);
        $l = $l + ($logo[$i]**2);
    }
    $cos = $num/(sqrt($d)*sqrt($l));
    return $cos;
}

function euclidean_distance($document,$logo,$dim){
    $temp = 0;
    for($i = 1; $i < $dim+1; $i++){
        $temp = $temp + ($document[$i]-$logo[$i])**2;
    }
    echo $temp;
    $eu = sqrt($temp);
    return $eu;
}