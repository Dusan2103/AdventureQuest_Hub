<?php
// Provera da li funkcija db_connect() već postoji
if (!function_exists('db_connect')) {
    // Funkcija za povezivanje sa bazom podataka
    function db_connect() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "adventure_db";

        // Kreiranje konekcije
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Provera konekcije
        if ($conn->connect_error) {
            die("Neuspesna konekcija: " . $conn->connect_error);
        }

        return $conn;
    }
}
?>
