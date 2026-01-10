<?php
/**
 * Configurazione centrale del progetto Captcha Star
 *
 * ISTRUZIONI:
 * 1. Copia questo file come 'config.php'
 * 2. Modifica le credenziali del database
 * 3. Il file config.php è escluso dal repository (.gitignore)
 */

// Root del progetto (directory dove si trova questo file)
define('PROJECT_ROOT', __DIR__);

// Path delle varie cartelle
define('PATH_LOGOS', PROJECT_ROOT . '/logos');
define('PATH_DATA', PROJECT_ROOT . '/data');
define('PATH_DESCRIPTIONS', PROJECT_ROOT . '/data/descriptions');
define('PATH_EMBEDDINGS', PROJECT_ROOT . '/data/embeddings');
define('PATH_LIB', PROJECT_ROOT . '/lib');
define('PATH_SCRIPTS', PROJECT_ROOT . '/scripts');
define('PATH_APP', PROJECT_ROOT . '/app');

// Configurazione database - MODIFICA QUESTI VALORI
define('DB_HOST', 'localhost');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');
define('DB_NAME', 'captcha_star');

// Categorie di loghi disponibili
define('LOGO_CATEGORIES', [
    'advertising', 'architecture', 'arts-and-design', 'auto-and-moto',
    'beauty-and-cosmetics', 'business', 'communication', 'construction',
    'engineering', 'environment', 'fashion', 'food-and-drinks',
    'game', 'music', 'sports'
]);
?>
