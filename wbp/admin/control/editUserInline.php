<?php
include('../../core/functions.php'); // Uključivanje funkcije za konekciju sa bazom

// Uspostavljanje konekcije sa bazom
$conn = db_connect();
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Preuzimanje podataka sa AJAX-a
    $id = $_POST['id'];
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $username = $_POST['username'];
    $role = $_POST['role'];

    // Upit za ažuriranje podataka u bazi
    $query = "UPDATE korisnik SET ime = ?, prezime = ?, username = ?, role = ? WHERE ID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssssi', $ime, $prezime, $username, $role, $id);

    // Izvršenje upita
    if ($stmt->execute()) {
        echo 'Podaci su uspešno ažurirani!';
    } else {
        echo 'Došlo je do greške prilikom ažuriranja podataka.';
    }

    $stmt->close();
    $conn->close();
}
?>
