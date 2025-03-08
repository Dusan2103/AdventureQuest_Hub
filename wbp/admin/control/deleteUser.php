<?php
include('../../core/functions.php');

// Uspostavljanje konekcije sa bazom
$conn = db_connect();

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Brisanje korisnika iz baze
    $query = "DELETE FROM korisnik WHERE ID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $userId);

    if ($stmt->execute()) {
        echo 'success';  // Ako je brisanje uspešno
    } else {
        echo 'error';  // Ako je došlo do greške
    }

    $stmt->close();
    $conn->close();
} else {
    echo 'error';  // Ako nije prosleđen ID
}
?>
