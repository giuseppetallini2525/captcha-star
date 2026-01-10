<?php
/**
 * Importa vettori GloVe 100d nel database
 * Esegui da CLI: php dict_100.php
 */
set_time_limit(0);
ini_set('memory_limit', '1G');

require_once(__DIR__ . "/../config.php");

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("unable to connect\n");
if(!$conn) {
    echo "connessione fallita\n";
    exit(1);
}
echo "Connessione al database effettuata\n";

// Carica stopwords
$stopwords = array();
$search = array('/','\\',':',';','!','@','#','$','%','^','*','(',')','_','+','=','|','{','}','[',']','"',"'",'<','>',',','?','~','`','&',' ','.','&amp','&amp;','--');
$stopw = fopen(__DIR__ . "/../data/stopwords.txt",'r') or die("unable to open stopwords.txt\n");
while(!feof($stopw)){
    $linee = fgets($stopw);
    $ar = explode(PHP_EOL,$linee);
    $s = trim($ar[0]);
    if(!empty($s)) array_push($stopwords, $s);
}
fclose($stopw);
array_push($stopwords, ',', '.', '-', '=', "'", '"');

echo "Stopwords caricate: " . count($stopwords) . "\n";

$file = fopen(__DIR__ . "/../data/embeddings/100d/wiki_giga_2024_100_MFT20_vectors_seed_2024_alpha_0.75_eta_0.05.050_combined.txt",'r') or die("unable to open GloVe file\n");

// Prepara statement
$stmt = $conn->prepare("INSERT INTO dizionario_100(parola, vettore, idf) VALUES(?, ?, 0)");
$stmt->bind_param("ss", $word, $d);

$j = 0;
$inserted = 0;
$skipped = 0;
$start_time = time();

$conn->begin_transaction();

while(!feof($file)){
    $line = fgets($file);
    if(empty(trim($line))) continue;

    $arr = explode(' ', $line);
    $word = $arr[0];

    // Salta parole troppo lunghe o stopwords
    if(strlen($word) > 100 || in_array($word, $stopwords, TRUE) || in_array($word, $search, TRUE)){
        $skipped++;
        $j++;
        continue;
    }

    $d = serialize($arr);

    if($stmt->execute()){
        $inserted++;
    } else {
        $skipped++;
    }

    $j++;

    // Progress ogni 10000 righe
    if($j % 10000 == 0){
        $conn->commit();
        $conn->begin_transaction();
        $elapsed = time() - $start_time;
        $rate = $elapsed > 0 ? round($j / $elapsed) : 0;
        echo "\rProcessate: $j | Inserite: $inserted | Saltate: $skipped | $rate righe/sec   ";
    }
}

$conn->commit();
fclose($file);
$stmt->close();

$elapsed = time() - $start_time;
echo "\n\nCompletato!\n";
echo "Totale processate: $j\n";
echo "Inserite: $inserted\n";
echo "Saltate: $skipped\n";
echo "Tempo: {$elapsed}s\n";

$conn->close();
?>