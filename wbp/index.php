<?php
// Osnovne konstante za URL-ove i putanje do modela i šablona
define('BASE_URL', '/N/');
define('MODEL_PATH', 'model/');
define('TEMPLATE_PATH', 'template/');

// Funkcija koja izvlači putanju iz zahteva
function parse_path() {
    $path = $_SERVER['REQUEST_URI'];
    $path = str_replace(BASE_URL, '', $path); 
    $path = trim($path, '/');
    return $path;
}

// Odgovarajući modela na osnovu putanje
function load_model($path) {
    switch ($path) {
        case '':
            include MODEL_PATH . 'index.php';
            break;
        case 'D':
            include MODEL_PATH . 'Destiancije';
            break;
        case 'N':
            include MODEL_PATH . 'Nalog';
            break;
        case 'K':
            include MODEL_PATH . 'Kontakt';
            break;
        
    }
}
$path = parse_path();
load_model($path);
?>
<!DOCTYPE html> 
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AdventureQuest Hub - online put ka uzbudljivim avanturama</title>
        <link rel="stylesheet" href="public/css/styles.css">
    </head>
    <body>
        <?php include 'template/page-header.php'; ?>

        <?php include 'template/page-body.php'; ?>

        <?php include 'template/page-footer.php'; ?>
    
    </body>
</html>
