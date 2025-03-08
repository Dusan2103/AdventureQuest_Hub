<?php
// Provera da li sesija već postoji pre nego što je ponovo pokrenemo
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Provera korisnikove uloge
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // Korisnik je prijavljen
    if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
        $korisnik_je_admin = true; // Postavljamo da je korisnik admin
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

// Provera da li je forma za dodavanje destinacija poslata
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_destination'])) {
    // Provera da li su svi potrebni podaci prisutni
    if (isset($_POST['naziv_destinacije']) && isset($_POST['opis_destinacije']) && isset($_POST['rejting_destinacije']) && isset($_POST['duzina_putanje']) && isset($_FILES['slika_iz_racunara'])) {
        // Priprema podataka za unos u bazu
        $naziv = $_POST['naziv_destinacije'];
        $opis = $_POST['opis_destinacije'];
        $rejting = $_POST['rejting_destinacije'];
        $duzina_putanje = $_POST['duzina_putanje'];
        $slika_ime = $_FILES['slika_iz_racunara']['name']; // Čuvamo ime slike

        // Definišemo apsolutnu putanju do foldera sa slikama
        $slika_putanja = "../public/images/" . $slika_ime;

        // Upload slike na server
        move_uploaded_file($_FILES['slika_iz_racunara']['tmp_name'], $slika_putanja);

        // Umetanje podataka u bazu
        $query_insert_destination = "INSERT INTO destinacije (naziv, opis, rejting, duzina_putanje, slika) VALUES ('$naziv', '$opis', '$rejting', '$duzina_putanje', '$slika_putanja')";
        $result_insert_destination = $connection->query($query_insert_destination);

        // Provera da li je unos uspešno izvršen
        if ($result_insert_destination) {
            // Pronalaženje ID-a upravo dodate destinacije
            $id_nove_destinacije = $connection->insert_id;
            // Preusmeravanje korisnika na stranicu sa detaljima te destinacije
            header("Location: http://localhost/Destinacije?id=" . $id_nove_destinacije);
            exit; // Ovo osigurava da se kod ispod ne izvršava nakon preusmeravanja
        } else {
            echo "Greška prilikom dodavanja destinacije: " . $connection->error;
        }
    } else {
        echo "Nisu svi potrebni podaci poslati iz forme.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodavanje destinacije</title>
    <link rel="stylesheet" href="../public/css/styles.css">
</head>
<body>
    <!-- Forma za dodavanje destinacija (samo za administratore) -->
    <?php if ($korisnik_je_admin): ?>
        <div class="add-destination-form-container">
            <form class="add-destination-form" action="" method="post" enctype="multipart/form-data">
                <input type="text" name="naziv_destinacije" placeholder="Naziv destinacije" required>
                <textarea name="opis_destinacije" placeholder="Opis destinacije" required></textarea>
                <input type="text" name="rejting_destinacije" placeholder="Rejting (0.0 - 5.0)" pattern="\d+(\.\d{1,2})?" title="Unesite broj između 0.0 i 10." required>
                <input type="text" name="duzina_putanje" placeholder="Dužina putanje (npr. 5.8 km)" pattern="\d+(\.|\,)?\d*\s?km?" title="Unesite broj sa tačkom ili zarezom koji označava kilometre" required>
                <input type="file" name="slika_iz_racunara" accept="image/*" required>
                <button type="submit" name="submit_destination">Dodaj destinaciju</button>
            </form>
       
            </div>
    <?php endif; ?>

</body>
</html>
