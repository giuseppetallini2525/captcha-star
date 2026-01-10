<?php
// Lista delle pagine demo disponibili
$pages = [
    'sports.php',
    'auto.php',
    'gaming.php',
    'music.php',
    'food.php',
    'fashion.php',
    'tech.php',
    'beauty.php',
    'environment.php',
    'entertainment.php'
];

// Seleziona una pagina casuale
$randomPage = $pages[array_rand($pages)];

// Redirect alla pagina selezionata
header("Location: " . $randomPage);
exit;
?>
