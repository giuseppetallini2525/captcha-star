<?php
/**
 * TF-IDF - Calcola i valori IDF per il dizionario
 */
require_once(__DIR__ . '/../config.php');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("unable to connect");
if(!$conn) {
    echo "connessione fallita";
}
else {
    echo "connessione al database effettuata";
}

$mydir = PATH_DESCRIPTIONS . '/file_old';
$myfiles = array_diff(scandir($mydir), array('.', '..')); 
$tot_doc = count($myfiles);
/*$documento = fopen("documento.txt",'w') or die("unable to open file");
foreach($myfiles as $f){
    $file = fopen($cur_dir.'/files/'.$f,'r') or die("unable to open file");
    while(!feof($file)){
        $line = fgets($file);
        fwrite($documento,$line);
    }
}
fclose($documento);
echo $documento;*/
$a = array('.',',','..');
$r = array(' ',' ',' ');
$td_files= array();
foreach($myfiles as $f){
    $td_idf = array();
    $file = fopen($mydir.'/'.$f,'r') or die("unable to open file");
    while(!feof($file)){
        $line = fgets($file);
        $temp = removeCommonWords($line);
        $line_1 = str_replace($a,$r,$temp);
        $arrr = explode(' ',$line_1);
        $arrrr = array_diff($arrr, array("",0,null));
        $len = count($arrrr);
        $conta_parola = array_count_values($arrrr);
        arsort($conta_parola);
        //print_r($conta_parola);
        foreach($conta_parola as $key => $value){
            $td = $value/$len;
            $td_idf[$key] = $td;
            }
        }
        //print_r($td_idf);
        $td_files[$f] = $td_idf;
    }
//print_r($td_files);

$idf = array();
foreach($myfiles as $f){
    $filee = fopen($mydir.'/'.$f,'r') or die("unable to open file");
    while(!feof($filee)){
        $linee = fgets($filee);
        $tempp = removeCommonWords($linee);
        $linee_1 = str_replace($a,$r,$tempp);
        $arrrs = explode(' ',$linee_1);
        $arrrrs = array_diff($arrrs, array("",0,null));
        $len = count($arrrrs);
        $conta_parolaa = array_count_values($arrrrs);
        //print_r($conta_parolaa);
        foreach($conta_parolaa as $keyy=>$valuee){
                $idf[$keyy] = 0;
        }
    }
}
echo count($idf);
//print_r($idf);

foreach($myfiles as $f){
    $filee = fopen($mydir.'/'.$f,'r') or die("unable to open file");
    while(!feof($filee)){
        $linee = fgets($filee);
        $tempp = removeCommonWords($linee);
        $linee_1 = str_replace($a,$r,$tempp);
        $arrrs = explode(' ',$linee_1);
        $arrrrs = array_diff($arrrs, array("",0,null));
        $len = count($arrrrs);
        $conta_parolaa = array_count_values($arrrrs);
        //print_r($conta_parolaa);
        foreach($conta_parolaa as $keyy=>$valuee){
                $idf[$keyy] += 1;
        }
    }
}
//arsort($idf);
//print_r($idf);
foreach($idf as $key=>$value){
    $idf[$key] = log10($tot_doc-1/$value);
    $temp = $idf[$key];
    $query = "update dizionario_100 set idf = '$temp' where parola ='$key'";
    if($risultato = mysqli_query($conn,$query)){
        echo "query idf giusta";
    }
}
//arsort($idf);
//print_r($idf);

foreach($idf as $key=> $value){
    foreach($td_files as $keyy=>$values){
        if(isset($td_files[$keyy][$key])){
            $td_files[$keyy][$key] = $td_files[$keyy][$key]*$idf[$key];
        }
        /*foreach($td_idf as $keyyy=>$valuess){
            $td_files[$keyy][$keyyy] = $td_files[$keyy][$keyyy] * $idf[$key];
        }*/
    }
}
//arsort($td_files);
foreach($td_files as $key=>$list){
    echo $key.'<br>';
    arsort($list);
    $keywords = array_slice($list,0,30);
    print_r($keywords);
    echo '<br>';
    foreach($keywords as $keyy=>$value){
        $query="select parola from dizionario_100 where parola='$keyy'";
        if($risultato=mysqli_query($conn,$query)){
            if($row=mysqli_fetch_array($risultato)){
                echo $row['parola'];
                echo '<br>';
                unset($keywords['&amp;']);
                unset($keywords[':']);
                if(is_numeric($keyy)){
                    unset($keywords[$keyy]);
                }
            }
            else{
             echo $keyy.'<br>';
             echo "parola sconosciuta".'<br>';
             unset($keywords[$keyy]);
             }
        }
        else{
            unset($keywords[$keyy]);
        }
    }
    echo "LISTA FINALE: ".'<br>';
    print_r($keywords);
    $keywordss= array_slice($keywords,0,10);
    print_r($keywordss);
    $sss = implode(",",array_keys($keywordss));
    $ff = substr($key,0,strlen($key)-4);
    $query_1 = "update scrape set keywords ='$sss' where nome = '$ff' ";
    echo $query_1;
    if($result = mysqli_query($conn,$query_1)){
        echo "query con successo".'<br>';
    }
    else{
        echo "errore";
    }


}






function removeCommonWords($input){
 
    // EEEEEEK Stop words
    $input = strtolower($input);
   $commonWords = array('a','able','about','above','abroad','according','accordingly','across','actually','adj','after','afterwards','again','against','ago','ahead','ain\'t','all','allow','allows','almost','alone','along','alongside','already','also','although','always','am','amid','amidst','among','amongst','an','and','another','any','anybody','anyhow','anyone','anything','anyway','anyways','anywhere','apart','appear','appreciate','appropriate','are','aren\'t','around','as','a\'s','aside','ask','asking','associated','at','available','away','awfully','b','back','backward','backwards','be','became','because','become','becomes','becoming','been','before','beforehand','begin','behind','being','believe','below','beside','besides','best','better','between','beyond','both','brief','but','by','c','came','can','cannot','cant','can\'t','caption','cause','causes','certain','certainly','changes','clearly','c\'mon','co','co.','com','come','comes','concerning','consequently','consider','considering','contain','containing','contains','corresponding','could','couldn\'t','course','c\'s','currently','d','dare','daren\'t','definitely','described','despite','did','didn\'t','different','directly','do','does','doesn\'t','doing','done','don\'t','down','downwards','during','e','each','edu','eg','eight','eighty','either','else','elsewhere','end','ending','enough','entirely','especially','et','etc','even','ever','evermore','every','everybody','everyone','everything','everywhere','ex','exactly','example','except','f','fairly','far','farther','few','fewer','fifth','first','five','followed','following','follows','for','forever','former','formerly','forth','forward','found','four','from','further','furthermore','g','get','gets','getting','given','gives','go','goes','going','gone','got','gotten','greetings','h','had','hadn\'t','half','happens','hardly','has','hasn\'t','have','haven\'t','having','he','he\'d','he\'ll','hello','help','hence','her','here','hereafter','hereby','herein','here\'s','hereupon','hers','herself','he\'s','hi','him','himself','his','hither','hopefully','how','howbeit','however','hundred','i','i\'d','ie','if','ignored','i\'ll','i\'m','immediate','in','inasmuch','inc','inc.','indeed','indicate','indicated','indicates','inner','inside','insofar','instead','into','inward','is','isn\'t','it','it\'d','it\'ll','its','it\'s','itself','i\'ve','j','just','k','keep','keeps','kept','know','known','knows','l','last','lately','later','latter','latterly','least','less','lest','let','let\'s','like','liked','likely','likewise','little','look','looking','looks','low','lower','ltd','m','made','mainly','make','makes','many','may','maybe','mayn\'t','me','mean','meantime','meanwhile','merely','might','mightn\'t','mine','minus','miss','more','moreover','most','mostly','mr','mrs','much','must','mustn\'t','my','myself','n','name','namely','nd','near','nearly','necessary','need','needn\'t','needs','neither','never','neverf','neverless','nevertheless','new','next','nine','ninety','no','nobody','non','none','nonetheless','noone','no-one','nor','normally','not','nothing','notwithstanding','novel','now','nowhere','o','obviously','of','off','often','oh','ok','okay','old','on','once','one','ones','one\'s','only','onto','opposite','or','other','others','otherwise','ought','oughtn\'t','our','ours','ourselves','out','outside','over','overall','own','p','particular','particularly','past','per','perhaps','placed','please','plus','possible','presumably','probably','provided','provides','q','que','quite','qv','r','rather','rd','re','really','reasonably','recent','recently','regarding','regardless','regards','relatively','respectively','right','round','s','said','same','saw','say','saying','says','second','secondly','see','seeing','seem','seemed','seeming','seems','seen','self','selves','sensible','sent','serious','seriously','seven','several','shall','shan\'t','she','she\'d','she\'ll','she\'s','should','shouldn\'t','since','six','so','some','somebody','someday','somehow','someone','something','sometime','sometimes','somewhat','somewhere','soon','sorry','specified','specify','specifying','still','sub','such','sup','sure','t','take','taken','taking','tell','tends','th','than','thank','thanks','thanx','that','that\'ll','thats','that\'s','that\'ve','the','their','theirs','them','themselves','then','thence','there','thereafter','thereby','there\'d','therefore','therein','there\'ll','there\'re','theres','there\'s','thereupon','there\'ve','these','they','they\'d','they\'ll','they\'re','they\'ve','thing','things','think','third','thirty','this','thorough','thoroughly','those','though','three','through','throughout','thru','thus','till','to','together','too','took','toward','towards','tried','tries','truly','try','trying','t\'s','twice','two','u','un','under','underneath','undoing','unfortunately','unless','unlike','unlikely','until','unto','up','upon','upwards','us','use','used','useful','uses','using','usually','v','value','various','versus','very','via','viz','vs','w','want','wants','was','wasn\'t','way','we','we\'d','welcome','well','we\'ll','went','were','we\'re','weren\'t','we\'ve','what','whatever','what\'ll','what\'s','what\'ve','when','whence','whenever','where','whereafter','whereas','whereby','wherein','where\'s','whereupon','wherever','whether','which','whichever','while','whilst','whither','who','who\'d','whoever','whole','who\'ll','whom','whomever','who\'s','whose','why','will','willing','wish','with','within','without','wonder','won\'t','would','wouldn\'t','x','y','yes','yet','you','you\'d','you\'ll','your','you\'re','yours','yourself','yourselves','you\'ve','z','zero');

   return preg_replace('/\b('.implode('|',$commonWords).')\b/','',$input);
}