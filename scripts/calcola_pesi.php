<?php
/**
 * Calcola i pesi per categoria per ogni parola nel dizionario
 *
 * Il peso è inversamente proporzionale al numero di categorie in cui la parola appare.
 * Parole che appaiono in molte categorie = peso basso (poco distintive)
 * Parole che appaiono in poche categorie = peso alto (molto distintive)
 */

set_time_limit(0);
require_once(__DIR__ . '/../config.php');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error . "\n");
}
$conn->set_charset("utf8mb4");

echo "=== CALCOLO PESI PER CATEGORIA ===\n\n";

// Step 1: Estrai tutte le keywords con le loro categorie dalla tabella scrape
echo "Step 1: Estrazione keywords dalla tabella scrape...\n";

$query = "SELECT categoria, keywords FROM scrape WHERE keywords IS NOT NULL AND keywords != ''";
$result = $conn->query($query);

// Array: parola => array di categorie in cui appare
$parola_categorie = [];

// Conta il numero totale di categorie
$tutte_categorie = [];

while ($row = $result->fetch_assoc()) {
    $categoria = $row['categoria'];
    $keywords = explode(',', $row['keywords']);

    $tutte_categorie[$categoria] = true;

    foreach ($keywords as $keyword) {
        $keyword = trim(strtolower($keyword));
        if (empty($keyword)) continue;

        if (!isset($parola_categorie[$keyword])) {
            $parola_categorie[$keyword] = [];
        }
        $parola_categorie[$keyword][$categoria] = true;
    }
}

$num_categorie_totali = count($tutte_categorie);
echo "Categorie totali: $num_categorie_totali\n";
echo "Parole uniche trovate: " . count($parola_categorie) . "\n\n";

// Step 2: Calcola il peso per ogni parola (scala logaritmica + floor)
echo "Step 2: Calcolo pesi (log + floor)...\n";

$floor = 0.2; // Peso minimo per evitare penalizzazione eccessiva

$pesi = [];
foreach ($parola_categorie as $parola => $categorie) {
    $num_cat = count($categorie);
    // Formula: peso = max(floor, 1 / log2(n_categorie + 1))
    $peso_log = 1.0 / log($num_cat + 1, 2);
    $peso = max($floor, $peso_log);
    $pesi[$parola] = $peso;
}

// Mostra alcuni esempi
echo "\nEsempi di pesi calcolati:\n";
echo str_pad("Parola", 20) . " | " . str_pad("N. Categorie", 15) . " | Peso\n";
echo str_repeat("-", 50) . "\n";

// Ordina per peso (dal più alto al più basso)
arsort($pesi);
$count = 0;
foreach ($pesi as $parola => $peso) {
    if ($count++ >= 10) break;
    $num_cat = count($parola_categorie[$parola]);
    echo str_pad($parola, 20) . " | " . str_pad($num_cat, 15) . " | " . round($peso, 4) . "\n";
}

echo "\n... (parole con peso basso) ...\n";
// Mostra anche le parole con peso più basso
asort($pesi);
$count = 0;
foreach ($pesi as $parola => $peso) {
    if ($count++ >= 10) break;
    $num_cat = count($parola_categorie[$parola]);
    echo str_pad($parola, 20) . " | " . str_pad($num_cat, 15) . " | " . round($peso, 4) . "\n";
}

// Step 3: Aggiorna le tabelle dizionario_100 e dizionario_50
echo "\nStep 3: Aggiornamento tabelle dizionario...\n";

// Prepara lo statement per update
$stmt_100 = $conn->prepare("UPDATE dizionario_100 SET peso_categoria = ? WHERE parola = ?");
$stmt_50 = $conn->prepare("UPDATE dizionario_50 SET peso_categoria = ? WHERE parola = ?");

$updated_100 = 0;
$updated_50 = 0;

foreach ($pesi as $parola => $peso) {
    $stmt_100->bind_param("ds", $peso, $parola);
    if ($stmt_100->execute() && $stmt_100->affected_rows > 0) {
        $updated_100++;
    }

    $stmt_50->bind_param("ds", $peso, $parola);
    if ($stmt_50->execute() && $stmt_50->affected_rows > 0) {
        $updated_50++;
    }
}

$stmt_100->close();
$stmt_50->close();

echo "Aggiornate $updated_100 parole in dizionario_100\n";
echo "Aggiornate $updated_50 parole in dizionario_50\n";

// Step 4: Verifica
echo "\nStep 4: Verifica risultati...\n";

$query = "SELECT parola, peso_categoria FROM dizionario_100 WHERE peso_categoria != 1.0 ORDER BY peso_categoria ASC LIMIT 5";
$result = $conn->query($query);
echo "\nParole con peso più basso (meno distintive):\n";
while ($row = $result->fetch_assoc()) {
    echo "  " . $row['parola'] . " => " . round($row['peso_categoria'], 4) . "\n";
}

$query = "SELECT parola, peso_categoria FROM dizionario_100 WHERE peso_categoria != 1.0 ORDER BY peso_categoria DESC LIMIT 5";
$result = $conn->query($query);
echo "\nParole con peso più alto (più distintive):\n";
while ($row = $result->fetch_assoc()) {
    echo "  " . $row['parola'] . " => " . round($row['peso_categoria'], 4) . "\n";
}

$conn->close();
echo "\n=== COMPLETATO ===\n";
?>
