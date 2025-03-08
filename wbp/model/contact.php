<?php
$errors = array();
$success_message = "";

// Provera da li je korisnik prijavljen
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // Korisnik je prijavljen
    if ($_SESSION['user_role'] == 'admin') {
        // Dodatne opcije ili funkcionalnosti za admina
    } else {
        // Funkcionalnosti za običnog korisnika
    }
} else {
    // Korisnik nije prijavljen, možda prikažete opciju za prijavu ili preusmerite na stranicu za prijavu
}

// Uključivanje funkcija.php koji sadrži db_connect() funkciju
include_once '../core/functions.php';

// Povezivanje sa bazom podataka
$conn = db_connect();

// Validacija imena
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["name"])) {
        $errors[] = "Ime je obavezno.";
    } else {
        $name = text_input($_POST["name"]);

        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $errors[] = "U imenu su dozvoljena samo slova.";
        }
    }

    // Validacija emaila
    if (empty($_POST["email"])) {
        $errors[] = "Email je obavezan.";
    } else {
        $email = text_input($_POST["email"]);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Neispravan format email adrese.";
        }
    }

    // Validacija poruke
    if (empty($_POST["message"])) {
        $errors[] = "Poruka je obavezna.";
    } else {
        $message = text_input($_POST["message"]);
    }

    if (empty($errors)) {
        // Kreiranje SQL upita za unos podataka
        $sql = "INSERT INTO kontakt (ime, email, message) VALUES ('$name', '$email', '$message')";

        // Izvršavanje SQL upita
        $result = $conn->query($sql);
        if ($result === TRUE) {
            $success_message = "Hvala Vam što ste nas kontaktirali. Odgovorićemo Vam u roku od 24 časa!";
        } else {
            $errors[] = "Greška prilikom unosa podataka: " . $conn->error; 
        }
    }
}

function text_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontaktirajte nas</title>
    <link rel="stylesheet" href="../public/css/styles.css">
</head>

<body>
    <?php include '../template/page-header.php'; ?>
    <?php if (empty($success_message)) : ?>
        <section class="contact-form">
            <h2>Kontaktirajte nas</h2>
            <p>Imate pitanje ili komentar? Napišite nam poruku:</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <label for="name">Ime:</label>
                <input type="text" id="name" name="name" placeholder="Unesi svoje ime" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Unesi email" required>

                <label for="message">Poruka:</label>
                <textarea id="message" name="message" placeholder="Unesi poruku" required></textarea>

                <?php if (!empty($errors)) : ?>
                    <section class="error-messages">
                        <?php foreach ($errors as $error) : ?>
                            <div class='error-message'><?php echo $error; ?></div>
                        <?php endforeach; ?>
                    </section>
                <?php endif; ?>

                <button type="submit">Pošalji poruku</button>
            </form>
        </section>
    <?php else : ?>
        <section class="success-message">
            <div><?php echo $success_message; ?></div>
            <button onclick="location.href='/Kontakt'">Nazad</button>
        </section>
    <?php endif; ?>

    <?php include '../template/page-footer.php'; ?>
</body>

</html>
