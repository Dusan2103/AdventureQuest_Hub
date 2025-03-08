 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pretraga destinacija</title>
    <link rel="stylesheet" href="wbp/public/css/styles.css">
 <section class="destination">   
        <h3>Najpopularnije destinacije</h3>
        <div class="destination-cards">
            <?php
            
            // Destinacije podaci
            $destinations = array(
                array(
                    'name' => 'Tara - Banjska stena',
                    'description' => 'Banjska stena je jedan od najpoznatijih i najlepših vidikovaca u Srbiji.',
                    'image' =>'public/images/Dren.jpg',
                    'rating' => 4.5
                ),
                array(
                    'name' => 'Vidikovac "Molitva"',
                    'description' => 'Sam vrh Molitva je na visini od 1.247 metara nadmorske visine. Rezervat prirode Uvac.',
                    'image' =>'public/images/VidikovacMolitva.jpg',
                    'rating' => 4.2
                ),
                array(
                    'name' => 'Ljuti Krš',
                    'description' => 'Ova pešačka staza je i dobila naziv po vrhu koji se zove Ljuti krš. Pogled sa ovog vrha je fascinantan.',
                    'image' =>'public/images/LjutiKrs.jpg',
                    'rating' => 4.7
                ),
                array(
                    'name' => 'Trem',
                    'description' => 'Trem je sa svojom visinom od 1810 metara najviši vrh Suve planine, na njenom zapadnom kraku.',
                    'image' =>'public/images/trem.jpg',
                    'rating' => 4.0
                ),
               
                
            );
   // Generisanje destinacija-kartice
   foreach ($destinations as $destination) {
    echo '<article class="card">';
    echo '<img class="card__background" src="' . $destination['image'] . '" alt="' . $destination['name'] . '">';
    echo '<div class="card__content | flow">';
    echo '<div class="card__content--container | flow">';
    echo '<h2 class="card__title">' . $destination['name'] . '</h2>';
    echo '<p class="card__description">' . $destination['description'] . '</p>';
    echo '</div>';
    echo '<div class="card__ratings">Rating: ' . $destination['rating'] . '</div>'; 
    echo '<a href="http://localhost/Destinacije" target="_self" class="card__button">Detalji</a>'; // Promenjen target u _self
    echo '</div>';
    echo '</article>';
}


?>
</div>
</section>
<main>
    <section class="destination-news">
        <h2 class="section-title">Najpopularnije aktuelnosti i vesti sa okolnih planina samo za vas</h2>
        <div class="timeline">
            <?php
            // Destinacije podaci
            $news = array(
                "Nišlija deli sa sugrađanima iskustvo o osvajanju najvećih vrhova Južne Amerike" => "https://www.juznevesti.com/Sport/Nislija-deli-sa-sugradjanima-iskustvo-o-osvajanju-najvece-vrhove-Juzne-Amerike.sr.html",
                "Gorska služba spasila planinara zaglavljenog u steni u blizini Trema" => "https://www.juznevesti.com/Drushtvo/Gorska-sluzba-spasila-planinara-zaglavljenog-u-steni-u-blizini-Trema.sr.html",
                "Prvi ovogodišnji uspon na Suvu planinu" => "https://www.juznevesti.com/Drushtvo/Prvi-ovogodisnji-uspon-na-Suvu-planinu.sr.html",
                "Pirotski kraj - vodič za ljubitelje prirode Pirota i okoline" => "https://www.juznevesti.com/Drushtvo/Pirotski-kraj-vodic-za-ljubitelje-prirode-Pirota-i-okoline.sr.html",
                "Prvi jesenji uspon do vidikovca Suve planine u nedelju" => "https://www.juznevesti.com/Drushtvo/Prvi-jesenji-uspon-do-vidikovca-Suve-planine-u-nedelju.sr.html",
                "Planinarski dan na Evropskom pešačkom putu koji prolazi kroz Niš" => "https://www.juznevesti.com/Drushtvo/Planinarski-dan-na-Evropskom-pesackom-putu-koji-prolazi-kroz-Nis.sr.html",
                "Dan pešačenja - Nišlije šetaju korak bliže zdravlju" => "https://www.juznevesti.com/Drushtvo/Dan-pesacenja-Nislije-setaju-korak-blize-zdravlju.sr.html",
                "Planinari iz Prokuplja, Niša i Predejana osvojili najviši vrh Turske" => "https://www.juznevesti.com/Sport/Planinari-iz-Prokuplja-Nisa-i-Predejana-osvojili-najvisi-vrh-Turske.sr.html",
                "Gorska služba spasila teško povređenog planinara sa Greben planine" => "https://www.juznevesti.com/Hronika/Gorska-sluzba-spasila-tesko-povredjenog-planinara-sa-Greben-planine.sr.html",
                "Šestorica Nišlija nakon nedelju dana penjanja osvojili najviši vrh Afrike" => "https://www.juznevesti.com/Sport/Sestorica-Nislija-nakon-nedelju-dana-penjanja-osvojili-najvisi-vrh-Afrike.sr.html"
            );

            // Generisanje timeline-a sa vestima
            $dotPosition = 10; // Početna pozicija prve tačke
            foreach ($news as $item => $link) {
                echo '<div class="timeline-dot" style="left: ' . $dotPosition . '%" onclick="window.location.href=\'' . $link . '\';"></div>';
                echo '<div class="timeline-content" style="left: ' . ($dotPosition - 10) . '%;">';
                echo '<a href="' . $link . '" target="_blank">' . $item . '</a>';
                echo '</div>';
                $dotPosition += 10; // Povećavamo poziciju za narednu tačku
            }
            ?>
        </div>
    </section>
</main>