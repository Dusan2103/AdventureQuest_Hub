<?php
// Provera da li je sesija već aktivna
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Provera da li je dugme "Odjavi se" pritisnuto
if (isset($_POST['logout'])) {
    // Ako jeste, unsetujemo sve sesijske promenljive
    session_unset();
    // Zatim uništavamo sesiju
    session_destroy();

    // Preusmeravanje korisnika na početnu stranicu
    header("Location: http://localhost/Pocetna");
    exit;
}
?>
<header>
    <h1 class="h1">AdventureQuest Hub</h1>
    <link rel="stylesheet" href="wbp/public/css/styles.css">
    <img class="logo" src="/wbp/public/images/logo.png" alt="logo">
    <nav>
        <ul class="nav_links">  
            <li><a href="/Pocetna">Početna</a></li>
            <li><a href="/Destinacije">Destinacije</a></li>
            <li><a href="/Nalog">Nalog</a></li>
            <li><a href="/Kontakt">Kontakt</a></li>
<!-- Ako je korisnik administrator, prikazuje se link ka admin panelu -->
                <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'): ?>
                    <li><a href="/AdminDashboard">Dashboard</a></li>
                <?php endif; ?>
            <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) : ?>
                <!-- Ako je korisnik prijavljen, prikazuje se dugme "Odjavi se" -->
                <li>
                    <form method="post" class="nav_logout">
                        <button type="submit" name="logout">Odjavi se</button>
                    </form>
                </li>

                
            <?php else: ?>
                <!-- Ako korisnik nije prijavljen, prikazuje se dugme "Prijavi se" -->
                <li><a href="/Nalog">Prijavi se</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
