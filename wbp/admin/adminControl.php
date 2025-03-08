<?php
// Funkcija za povezivanje sa bazom podataka
include_once '../core/functions.php';

// Dohvatanje svih korisnika iz baze
$conn = db_connect();
$query = "SELECT * FROM korisnik";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Prikupljamo korisnike
    $users = $result->fetch_all(MYSQLI_ASSOC);
} else {
    // Ako nema korisnika, postavljamo prazan niz
    $users = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Control</title>
    <link href="wbp/public/css/dashboard.css" rel="stylesheet">
</head>
<body>

<header>
<?php include 'dashTemp/dash-header.php'; ?>
</header>

<div class="container">
    <h1>Admin Control</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ime</th>
                <th>Prezime</th>
                <th>Username</th>
                <th>Role</th>
                <th>Akcija</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($users)) {
                foreach ($users as $userData): ?>
                    <tr id="user-<?php echo $userData['ID']; ?>">
                        <td><?php echo $userData['ID']; ?></td>
                        <td id="ime-<?php echo $userData['ID']; ?>" class="editable" data-column="ime">
                            <input type="text" value="<?php echo $userData['Ime']; ?>" disabled>
                        </td>
                        <td id="prezime-<?php echo $userData['ID']; ?>" class="editable" data-column="prezime">
                            <input type="text" value="<?php echo $userData['Prezime']; ?>" disabled>
                        </td>
                        <td id="username-<?php echo $userData['ID']; ?>" class="editable" data-column="username">
                            <input type="text" value="<?php echo $userData['username']; ?>" disabled>
                        </td>
                        <td id="role-<?php echo $userData['ID']; ?>" class="editable" data-column="role">
                            <select disabled>
                                <option value="user" <?php echo ($userData['role'] == 'user') ? 'selected' : ''; ?>>User</option>
                                <option value="admin" <?php echo ($userData['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                            </select>
                        </td>
                        <td>
                        <button class="btn btn-warning btn-sm" data-id="<?php echo $userData['ID']; ?>" onclick="toggleEdit(<?php echo $userData['ID']; ?>)">Uredi</button>
                        <button class="btn-save btn btn-success btn-sm" data-id="<?php echo $userData['ID']; ?>" onclick="saveChanges(<?php echo $userData['ID']; ?>)" style="display:none;">Sačuvaj promene</button>
                        <!-- Dugme za brisanje korisnika -->
                        <button class="btn btn-danger btn-sm" data-id="<?php echo $userData['ID']; ?>">Obriši</button>


                        </td>
                    </tr>
                <?php endforeach;
            } else {
                echo "<tr><td colspan='6'>Nema korisnika</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="wbp/public/js/adminControl.js"></script>

</body>  
</html>