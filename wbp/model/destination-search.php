<?php
// Provera da li sesija već postoji pre nego što je ponovo pokrenemo
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Provera korisnikove uloge
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // Korisnik je prijavljen
    if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
        $korisnik_je_admin = true; // Korisnik je admin
    } else {
        $korisnik_je_admin = false; // Korisnik nije admin
    }    
} else {
    $korisnik_je_admin = false; // Korisnik nije prijavljen
}

// Uključivanje funkcija za rad sa bazom podataka
include '../core/functions.php';

// Povezivanje sa bazom podataka
$connection = db_connect();

// Provera konekcije
if ($connection->connect_error) {
    die('Greška prilikom konekcije sa bazom podataka: ' . $connection->connect_error);
}

// Dobavljanje svih destinacija iz baze podataka
$query_sve_destinacije = "SELECT * FROM destinacije";
$result_sve_destinacije = $connection->query($query_sve_destinacije);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pretraga destinacija</title>
    <link rel="stylesheet" href="wbp/public/css/styles.css">
    <link rel="stylesheet" href="wbp/public/css/destinacije.css">
</head>
<body>
    <?php include '../template/page-header.php'; ?>
    <?php include '../model/add-destination.php'; ?>
    <div class="destination-cards">
        <?php
        // Provera da li postoji rezultat upita i da li sadrži barem jednu destinaciju
        if ($result_sve_destinacije && $result_sve_destinacije->num_rows > 0) {
            // Iteriranje kroz sve destinacije i prikaz kartica za svaku od njih
            while($row = $result_sve_destinacije->fetch_assoc()) {
                echo '<div class="card">';
                echo '<img class="card__background" src="' . $row['slika'] . '" alt="' . $row['naziv'] . '">';
                echo '<div class="card__content">';
                echo '<h2 class="card__title" style="color: white;">' . $row['naziv'] . '</h2>';
                echo '<p class="card__description">' . $row['opis'] . '</p>';
                echo '<p class="rating" style="color: white;">Rejting: ' . $row['rejting'] . '</p>';
                echo '<p class="distance" style="color: white;">Dužina putanje: ' . $row['duzina_putanje'] . ' km</p>';
                // Provera da li postoji polje "ID" pre prikaza dugmeta
                if (isset($row['ID'])) {
                    // Link ka detaljima destinacije
                    echo '<a href="/Detalji?id=' . $row['ID'] . '" class="card__button">Detalji</a>';
                } else {
                    // Ukoliko ne postoji, prikaži poruku o grešci
                    echo '<p class="error">Greška: ID destinacije nije pronađen.</p>';
                }
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo 'Nema dostupnih destinacija.';
        }
        ?>
    </div>

    <?php
    // Zatvaranje konekcije
    $connection->close();
    ?>
</body>
</html>
