<?php
// Provera da li je korisnik prijavljen
session_start(); // Početak sesije
if (isset($_SESSION['user_id'])) {
    // Ako jeste, unsetujemo sve sesijske promenljive
    session_unset();
    // Zatim uništavamo sesiju
    session_destroy();
}

// Preusmeravanje korisnika na početnu stranicu
header("Location: http://localhost/Pocetna");
exit;
?>
