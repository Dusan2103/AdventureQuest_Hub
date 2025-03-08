<?php
include '../core/functions.php'; // Uključivanje funkcije za konekciju sa bazom

// Uspostavljanje konekcije sa bazom
$conn = db_connect();

// Dohvatanje podataka za reakcije
$query_reports = "
    SELECT d.naziv, 
           SUM(CASE WHEN r.reaction_type = 'like' THEN 1 ELSE 0 END) AS total_likes,
           SUM(CASE WHEN r.reaction_type = 'dislike' THEN 1 ELSE 0 END) AS total_dislikes
    FROM destinacije d
    LEFT JOIN reactions r ON d.ID = r.destinacija_id
    GROUP BY d.naziv";

$result_reports = $conn->query($query_reports);

// Provera da li je upit uspešno izvršen
if (!$result_reports) {
    die("Greška u SQL upitu za reakcije: " . $conn->error);
}

$reports = [];
if ($result_reports->num_rows > 0) {
    while ($row = $result_reports->fetch_assoc()) {
        $reports[] = $row;
    }
}

// Dohvatanje podataka za broj komentara po destinaciji
$query_comments = "
    SELECT d.naziv, COUNT(c.id) AS total_comments
    FROM destinacije d
    LEFT JOIN komentari c ON d.ID = c.destinacija_ID
    GROUP BY d.naziv";

$result_comments = $conn->query($query_comments);

$comments_data = [];
if ($result_comments && $result_comments->num_rows > 0) {
    while ($row = $result_comments->fetch_assoc()) {
        $comments_data[] = $row;
    }
}

// Dohvatanje podataka za prosečan rejting destinacija
$query_ratings = "
    SELECT naziv, rejting AS avg_rating
    FROM destinacije";

$result_ratings = $conn->query($query_ratings);

$ratings_data = [];
if ($result_ratings && $result_ratings->num_rows > 0) {
    while ($row = $result_ratings->fetch_assoc()) {
        $ratings_data[] = $row;
    }
}

// Dohvatanje podataka za najpopularnije destinacije (koristeći reakcije kao osnov za popularnost)
$query_popular_dest =              
"SELECT d.naziv, COUNT(r.id) AS reaction_count
FROM destinacije d
LEFT JOIN reactions r ON d.ID = r.destinacija_id
GROUP BY d.naziv
ORDER BY reaction_count DESC";

$result_popular_dest = $conn->query($query_popular_dest);

$popular_dest_data = [];
if ($result_popular_dest && $result_popular_dest->num_rows > 0) {
    while ($row = $result_popular_dest->fetch_assoc()) {
        $popular_dest_data[] = $row;
    }
}

// Vraćanje podataka kao JSON
header('Content-Type: application/json');
echo json_encode([
    'reports' => $reports,
    'comments' => $comments_data,
    'ratings' => $ratings_data,
    'popular_destinations' => $popular_dest_data
]);

// Zatvaranje konekcije
$conn->close();
?>
