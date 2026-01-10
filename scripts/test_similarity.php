<?php
/**
 * Test di confronto tra embeddings 50d e 100d
 */
set_time_limit(0);
error_reporting(E_ERROR | E_PARSE);

require_once(__DIR__ . "/../lib/similarity.php");

// Array di URL di test per diverse categorie (50 esempi)
$test_urls = [
    // Sport (10)
    "https://en.wikipedia.org/wiki/Nike,_Inc.",
    "https://en.wikipedia.org/wiki/Adidas",
    "https://en.wikipedia.org/wiki/Football",
    "https://en.wikipedia.org/wiki/Basketball",
    "https://en.wikipedia.org/wiki/Running",
    "https://en.wikipedia.org/wiki/Tennis",
    "https://en.wikipedia.org/wiki/Olympic_Games",
    "https://en.wikipedia.org/wiki/Marathon",
    "https://en.wikipedia.org/wiki/Swimming_(sport)",
    "https://en.wikipedia.org/wiki/Cycling",

    // Auto e moto (10)
    "https://en.wikipedia.org/wiki/Ferrari",
    "https://en.wikipedia.org/wiki/Toyota",
    "https://en.wikipedia.org/wiki/Motorcycle",
    "https://en.wikipedia.org/wiki/Formula_One",
    "https://en.wikipedia.org/wiki/Harley-Davidson",
    "https://en.wikipedia.org/wiki/BMW",
    "https://en.wikipedia.org/wiki/Volkswagen",
    "https://en.wikipedia.org/wiki/Electric_vehicle",
    "https://en.wikipedia.org/wiki/Racing",
    "https://en.wikipedia.org/wiki/Automobile",

    // Tecnologia/Gaming (10)
    "https://en.wikipedia.org/wiki/PlayStation",
    "https://en.wikipedia.org/wiki/Xbox",
    "https://en.wikipedia.org/wiki/Video_game",
    "https://en.wikipedia.org/wiki/Minecraft",
    "https://en.wikipedia.org/wiki/Fortnite",
    "https://en.wikipedia.org/wiki/Nintendo",
    "https://en.wikipedia.org/wiki/Esports",
    "https://en.wikipedia.org/wiki/Streaming_media",
    "https://en.wikipedia.org/wiki/Mobile_game",
    "https://en.wikipedia.org/wiki/Virtual_reality",

    // Musica (10)
    "https://en.wikipedia.org/wiki/Rock_music",
    "https://en.wikipedia.org/wiki/Heavy_metal_music",
    "https://en.wikipedia.org/wiki/Spotify",
    "https://en.wikipedia.org/wiki/The_Beatles",
    "https://en.wikipedia.org/wiki/Electric_guitar",
    "https://en.wikipedia.org/wiki/Hip_hop_music",
    "https://en.wikipedia.org/wiki/Jazz",
    "https://en.wikipedia.org/wiki/Concert",
    "https://en.wikipedia.org/wiki/Music_festival",
    "https://en.wikipedia.org/wiki/Drum_kit",

    // Food & Drinks (5)
    "https://en.wikipedia.org/wiki/Coca-Cola",
    "https://en.wikipedia.org/wiki/Fast_food",
    "https://en.wikipedia.org/wiki/Coffee",
    "https://en.wikipedia.org/wiki/Beer",
    "https://en.wikipedia.org/wiki/McDonald%27s",

    // Fashion/Beauty (5)
    "https://en.wikipedia.org/wiki/Fashion",
    "https://en.wikipedia.org/wiki/Luxury_goods",
    "https://en.wikipedia.org/wiki/Cosmetics",
    "https://en.wikipedia.org/wiki/Perfume",
    "https://en.wikipedia.org/wiki/Sneakers",
];

echo "=== TEST SIMILARITY: 50d vs 100d ===\n\n";
echo str_pad("URL", 50) . " | " . str_pad("50d Result", 35) . " | " . str_pad("100d Result", 35) . "\n";
echo str_repeat("-", 125) . "\n";

$results = [];

foreach ($test_urls as $i => $url) {
    $short_url = substr(basename($url), 0, 45);

    // Delay between requests to avoid rate limiting
    if ($i > 0) {
        usleep(300000); // 0.3 sec delay
    }

    // Suppress output from sim function
    ob_start();
    $result_50 = sim(50, 0, $url);
    ob_end_clean();

    ob_start();
    $result_100 = sim(100, 0, $url);
    ob_end_clean();

    $result_50 = $result_50 ?: "N/A";
    $result_100 = $result_100 ?: "N/A";

    echo str_pad(($i+1) . ". " . $short_url, 50) . " | " . str_pad($result_50, 35) . " | " . str_pad($result_100, 35) . "\n";

    $results[] = [
        'url' => $url,
        '50d' => $result_50,
        '100d' => $result_100,
        'match' => ($result_50 === $result_100) ? 'YES' : 'NO'
    ];
}

echo "\n=== RIEPILOGO ===\n";
$matches = array_filter($results, fn($r) => $r['match'] === 'YES');
$na_50 = array_filter($results, fn($r) => $r['50d'] === 'N/A');
$na_100 = array_filter($results, fn($r) => $r['100d'] === 'N/A');
echo "Risultati identici: " . count($matches) . "/" . count($results) . "\n";
echo "N/A (50d): " . count($na_50) . "/" . count($results) . "\n";
echo "N/A (100d): " . count($na_100) . "/" . count($results) . "\n";
?>
