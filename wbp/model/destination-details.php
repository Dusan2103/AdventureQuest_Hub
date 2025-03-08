<?php
session_start();

include_once '../core/functions.php';

function getDestinationDetails($destination_id)
{
    $connection = db_connect();
    $query = "SELECT * FROM destinacije WHERE ID = $destination_id";
    $result = $connection->query($query);

    if ($result && $result->num_rows > 0) {
        $destination_details = $result->fetch_assoc();
        $connection->close();

        return $destination_details;
    } else {
        $connection->close();
        return array();
    }
}

if (isset($_GET['id'])) {
    $destination_id = $_GET['id'];
    if (!is_numeric($destination_id)) {
        echo "Nevalidan ID destinacije.";
        exit;
    }
    $destination_details = getDestinationDetails($destination_id);
    if (empty($destination_details)) {
        echo "Detalji o destinaciji nisu dostupni.";
        exit;
    }
} else {
    echo "Nije odabrana destinacija.";
    exit;
}
$is_admin = false;
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['user_role'] == 'admin') {
    $is_admin = true;
}

function getUserDetails()
{
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $connection = db_connect();

        $query = "SELECT id, username FROM korisnik WHERE username = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($user_id, $user_username);
        $stmt->fetch();
        $stmt->close();
        $connection->close();

        return ['id' => $user_id, 'username' => $user_username];
    } else {
        return null; // Ako nije prijavljen, nema ID
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["comment"])) {
    $comment_content = $_POST["comment"];
    $destination_id = $destination_details['ID'];
    $user_details = getUserDetails();
    if ($user_details === null) {
        die("Morate biti prijavljeni da biste ostavili komentar.");
    }
    $user_id = $user_details['id'];
    $user_username = $user_details['username'];
    $connection = db_connect();
    $query = "INSERT INTO komentari (destinacija_id, user_id, korisnicko_ime, sadrzaj) VALUES (?, ?, ?, ?)";
    $statement = $connection->prepare($query);
    $statement->bind_param("iiss", $destination_id, $user_id, $user_username, $comment_content);
    if ($statement->execute()) {
        $_SESSION['success_message'] = "Uspešno ste dodali komentar!";
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit;
    } else {
        $_SESSION['error_message'] = "Došlo je do greške prilikom dodavanja komentara.";
    }

    $statement->close();
    $connection->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_comment"])) {
    $comment_id = $_POST["comment_id"];
    $connection = db_connect();
    $query = "DELETE FROM komentari WHERE ID = ?";
    $statement = $connection->prepare($query);
    $statement->bind_param("i", $comment_id);
    if ($statement->execute()) {
    } else {
        // Greška prilikom brisanja komentara
    }
    $statement->close();
    $connection->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destination Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/wbp/public/css/styles.css">
    <link rel="stylesheet" href="/wbp/public/css/like.css">
    <link rel="stylesheet" href="/wbp/public/css/comment.css">
    <link rel="stylesheet" href="/wbp/public/css/destinacije.css">
</head>

<body>

    <?php include '../template/page-header.php'; ?>
    <!-- Prikaz detalja o destinaciji -->
    <div class="destination-details">
        <img class="destination-details__image" src="<?php echo $destination_details['slika']; ?>"
            alt="<?php echo $destination_details['naziv']; ?>">
        <div class="text-area">
            <h2 class="destination-details__title"><?php echo $destination_details['naziv']; ?></h2>
            <p class="destination-details__rating">Rejting: <?php echo $destination_details['rejting']; ?></p>
            <p class="destination-details__distance">Dužina putanje:
                <?php echo $destination_details['duzina_putanje']; ?> km</p>
            <p class="destination-details__description"><?php echo $destination_details['opis']; ?></p>
        </div>
    </div>
    <?php
    // Pretpostavljamo da su varijable $like_count i $dislike_count dobijene iz baze
    $destination_id = $destination_details['ID'];
    $connection = db_connect();
    // Dohvatanje broja lajkova
    $like_query = "SELECT COUNT(*) AS total_likes FROM reactions WHERE destinacija_id = ? AND reaction_type = 'like'";
    $like_statement = $connection->prepare($like_query);
    $like_statement->bind_param("i", $destination_id);
    $like_statement->execute();
    $like_result = $like_statement->get_result();
    $like_row = $like_result->fetch_assoc();
    $like_count = $like_row['total_likes'];
    // Dohvatanje broja dislajkova
    $dislike_query = "SELECT COUNT(*) AS total_dislikes FROM reactions WHERE destinacija_id = ? AND reaction_type = 'dislike'";
    $dislike_statement = $connection->prepare($dislike_query);
    $dislike_statement->bind_param("i", $destination_id);
    $dislike_statement->execute();
    $dislike_result = $dislike_statement->get_result();
    $dislike_row = $dislike_result->fetch_assoc();
    $dislike_count = $dislike_row['total_dislikes'];

    $connection->close();
    ?>
    <div class="comments-area">
        <section class="comments-section">
            <div class="comments-header">
                <h3>Komentari:</h3>
                <div class="reaction-buttons">

                    <button class="reaction-btn" id="like-btn" data-id="<?php echo $destination_id; ?>"
                        onclick="updateReaction('like', <?php echo $destination_id; ?>)">
                        <i class="fas fa-thumbs-up"></i>
                        <span id="like-count-<?php echo $destination_id; ?>"><?php echo $like_count; ?></span>
                    </button>

                    <button class="reaction-btn" id="dislike-btn" data-id="<?php echo $destination_id; ?>"
                        onclick="updateReaction('dislike', <?php echo $destination_id; ?>)">
                        <i class="fas fa-thumbs-down"></i>
                        <span id="dislike-count-<?php echo $destination_id; ?>"><?php echo $dislike_count; ?></span>
                    </button>
                </div>
            </div>
            <script src="/wbp/model/like-dislike.php"></script>
            <script src="/wbp/public/js/like-dislike.js"></script>
            <?php
            // Dohvatanje komentara iz baze podataka za trenutnu destinaciju
            $connection = db_connect();
            $comments_query = "SELECT * FROM komentari WHERE destinacija_id = ?";
            $comments_statement = $connection->prepare($comments_query);
            $comments_statement->bind_param("i", $destination_id);
            $comments_statement->execute();
            $result = $comments_statement->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="comment">';
                    echo '<p><strong>' . htmlspecialchars($row['korisnicko_ime']) . '</strong>: ' . htmlspecialchars($row['sadrzaj']) . '</p>';
                    echo '<p class="comment-time">Objavljeno: ' . htmlspecialchars($row['vreme']) . '</p>';  // Prikazivanje vremena
                    if ($is_admin) {
                        echo '<form method="POST" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $destination_id . '">';
                        echo '<input type="hidden" name="comment_id" value="' . $row['ID'] . '">';
                        echo '<button type="submit" name="delete_comment" class="delete-button">Obriši</button>';
                        echo '</form>';
                    }
                    echo '</div>';
                }
            } else {
                echo '<p>Još uvek nema komentara.</p>';
            }
            $comments_statement->close();
            $connection->close();
            ?>
            <!-- Forma za dodavanje komentara (samo prijavljeni korisnici mogu ostavljati komentare) -->
            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $destination_id; ?>"
                    method="POST" class="comment-form">
                    <textarea name="comment" rows="4" cols="50" required></textarea><br>
                    <button type="submit">Dodaj komentar</button>
                </form>
            <?php else: ?>
                <p>Morate biti prijavljeni da biste ostavili komentar.</p>
            <?php endif; ?>
        </section>
    </div>
</body>

</html>