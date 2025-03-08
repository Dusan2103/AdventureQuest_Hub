<?php
if (!isset($_SESSION)) {
    session_start();
}

// Funkcija za zaštitu od XSS
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Provera da li je korisnik prijavljen
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // Ako je korisnik prijavljen i uloga je admin, preusmeriti ga na admin panel
    if (isset($_SESSION['user_role'])) {
        if ($_SESSION['user_role'] == 'admin') {
            // Preusmeri admina na svoj panel
            header("Location: /Pocetna");
            exit;
            }
        }
}    

// Preusmeravanje administratora na admin panel
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['user_role'] == 'admin') {
    header("Location: /Pocetna");
    exit;
}

define('BASE_URL', '/Nalog');
define('MODEL_PATH', '../model/');
define('TEMPLATE_PATH', '../template/');

$errors = [];
$success_message = "";

// Uključivanje funkcija.php
include_once '../core/functions.php';

// Funkcija za prijavljivanje
function login() {
    global $errors;

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
        if (empty($_POST['username']) || empty($_POST['password'])) {
            $_SESSION['error_message'] = "Molimo unesite korisničko ime i lozinku.";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        $conn = db_connect();

        // Izmena: koristi password_hash() i password_verify()
        $query = "SELECT * FROM korisnik WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Ako je lozinka tačna
                $_SESSION['user_role'] = $user['role'];
                $_SESSION['logged_in'] = true;
                $_SESSION['username'] = $username; // Dodavanje korisničkog imena u sesiju
                $_SESSION['success_message'] = "Uspešno ste se prijavili!";
                header('Location: /Pocetna');
                exit;
            } else {
                $_SESSION['error_message'] = "Pogrešno korisničko ime ili lozinka.";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }
        } else {
            $_SESSION['error_message'] = "Pogrešno korisničko ime ili lozinka.";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }
}

// Funkcija za registraciju
function register() {
    global $errors, $success_message;

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
        $ime = htmlspecialchars($_POST['ime']);
        $prezime = htmlspecialchars($_POST['prezime']);
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        // Prvo proveri da li korisničko ime već postoji
        $conn = db_connect();

        $query = "SELECT * FROM korisnik WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['error_message'] = "Korisničko ime već postoji.";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        } else {
            // Koristi password_hash() za šifrovanje lozinke
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO korisnik (ime, prezime, username, password, role) VALUES (?, ?, ?, ?, 'user')";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssss", $ime, $prezime, $username, $hashed_password);

            if ($stmt->execute()) {
                $_SESSION['success_message'] = "Uspešno ste se registrovali!";
                header('Location: ' . BASE_URL);
                exit;
            } else {
                $_SESSION['error_message'] = "Došlo je do greške prilikom registracije.";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }
        }
    }
}

login();
register();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Client Account</title>
    <link rel="stylesheet" href="wbp/public/css/styles.css">
</head>
<body>
    <?php include TEMPLATE_PATH . 'page-header.php'; ?>
    <div class="Account">
        <div class="form-container" id="loginRegisterForm">
            <div class="form-content" id="loginForm">
                <h1>Prijava</h1>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <input type="text" placeholder="Korisničko ime" name="username" required autocomplete="username"/>
                    <input type="password" placeholder="Šifra" name="password" required autocomplete="current-password"/>
                    <?php if (isset($_SESSION['error_message'])): ?>
                        <div class="error-message"><?php echo $_SESSION['error_message']; ?></div>
                        <?php unset($_SESSION['error_message']); ?>
                    <?php endif; ?>
                    <input type="submit" value="Prijavi se" name="login"/>
                </form>
                <a class="flipbutton" id="flipButton" href="javascript:void(0);">Napravi svoj nalog →</a>
            </div>
            <div class="form-content" id="registerForm" style="display: none;">
                <h1>Registracija</h1>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <input type="text" placeholder="Ime" name="ime" required/>
                    <input type="text" placeholder="Prezime" name="prezime" required/>
                    <input type="text" placeholder="Korisničko ime" name="username" required/>
                    <input type="password" placeholder="Šifra" name="password" required/>
                    <?php if (isset($_SESSION['error_message'])): ?>
                        <div class="error-message"><?php echo $_SESSION['error_message']; ?></div>
                        <?php unset($_SESSION['error_message']); ?>
                    <?php endif; ?>
                    <input type="submit" value="Registruj se" name="register"/>
                </form>
                <a class="flipbutton" id="flipButtonBack" href="javascript:void(0);">Uloguj se na svoj nalog →</a>
            </div>
        </div>
    </div>
    <script src="/wbp/public/js/flip.js"></script>
    <?php include '../template/page-footer.php'; ?>
</body>
</html>
