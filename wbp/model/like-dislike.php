<?php
session_start();
include_once '../core/functions.php';

// Povezivanje sa bazom podataka
$connection = db_connect();

// Provera da li su prosleđeni podaci
if (isset($_POST['destination_id']) && isset($_POST['reaction_type'])) {
    $destination_id = $_POST['destination_id'];
    $reaction_type = $_POST['reaction_type'];

    // Umetanje reakcije u bazu, bez provere duplikata
    $insert_query = "INSERT IGNORE INTO reactions (destinacija_id, korisnicko_ime, reaction_type) VALUES (?, ?, ?)";
    $insert_statement = $connection->prepare($insert_query);
    $insert_statement->bind_param("iss", $destination_id, $username, $reaction_type);
    $insert_statement->execute();

    // Dohvatanje novog broja lajkova
    $like_query = "SELECT COUNT(*) AS total_likes FROM reactions WHERE destinacija_id = ? AND reaction_type = 'like'";
    $like_statement = $connection->prepare($like_query);
    $like_statement->bind_param("i", $destination_id);
    $like_statement->execute();
    $like_result = $like_statement->get_result();
    $like_row = $like_result->fetch_assoc();
    $new_like_count = $like_row['total_likes'];

    // Dohvatanje novog broja dislajkova
    $dislike_query = "SELECT COUNT(*) AS total_dislikes FROM reactions WHERE destinacija_id = ? AND reaction_type = 'dislike'";
    $dislike_statement = $connection->prepare($dislike_query);
    $dislike_statement->bind_param("i", $destination_id);
    $dislike_statement->execute();
    $dislike_result = $dislike_statement->get_result();
    $dislike_row = $dislike_result->fetch_assoc();
    $new_dislike_count = $dislike_row['total_dislikes'];

    // Vraćanje novog broja lajkova i dislajkova kao JSON
    echo json_encode(array(
        'success' => true,
        'new_like_count' => $new_like_count,
        'new_dislike_count' => $new_dislike_count
    ));

    // Zatvaranje konekcije sa bazom
    $connection->close();
    exit;
}
?>
