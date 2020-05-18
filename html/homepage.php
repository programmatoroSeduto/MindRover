<?php
session_start();
$ganesh = "HOMEPAGE";
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>

    <!-- CSS -->
    <link type="text/css" rel="stylesheet" href="../css/utils/clearsheet.css">
    <link type="text/css" rel="stylesheet" href="../css/utils/bg.css">
    <link type="text/css" rel="stylesheet" href="../css/splash.css">
    <link type="text/css" rel="stylesheet" href="../css/nav.css">
    <link type="text/css" rel="stylesheet" href="../css/fonts.css">
    <link type="text/css" rel="stylesheet" href="../css/containers.css">
    <link type="text/css" rel="stylesheet" href="../css/footer2.css">
    <link type="text/css" rel="stylesheet" href="../css/text-container.css">
    <link type="text/css" rel="stylesheet" href="../css/board.css">
    <link type="text/css" rel="stylesheet" href="../css/splash-carousel-style.css">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/f61875768d.js" crossorigin="anonymous"></script>

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="../js/carousel.js"></script>

</head>

<!-- Sfondo generico della pagina -->
<body class="bg--fixed" style="background-color: black;">

    <!-- Carosello iniziale con link alle pagine del sito -->
    <div class="splash-carousel">
        <div class="splash-carousel-content">

        <!-- sezione 1 -->
            <div class="splash-container splash-bg-main" style="background-image: url('../assets/img/home-splash1.jpg');">
                <div class="splash-body">
                    
                    <h1 class="splash-body-heading">
                        Frog Studios
                    </h1>

                    <p class="splash-body-paragraph text-content text">
                        Benvenuti nel nostro croccantissimo sito. <i>Cra Cra</i>.
                        
                    </p>

                </div>
            </div>

            <!-- sezione 2 -->
            <div class="splash-container splash-bg-main" style="background-image: url('../assets/img/home-splash2.jpg');display: none">
                <div class="splash-body">
                    
                    <h1 class="splash-body-heading">
                        Scopri mindROVER 
                    </h1>

                    <p class="splash-body-paragraph text-content">
                        mindROVER è il nostro progetto più ambizioso, la realtà virtuale più... reale che abbiate mai visto. Un comodo sistema composto unicamente da un casco ergonomico, in totale sicurezza.
                        <a href="../HTML/mindrover.php"><i class="d">Scopri di più</i></a>
                    </p>

                </div>
            </div>

            <!-- sezione 3 -->
            <div class="splash-container splash-bg-main" style="background-image: url('../assets/img/home-splash3.jpg'); display: none">
                <div class="splash-body">
                    
                    <h1 class="splash-body-heading">
                        I nostri altri progetti
                    </h1>

                    <p class="splash-body-paragraph text-content">
                        Scopri i nostri incredibili titoli!
                        <a href="../HTML/mindrover.php"><i class="d">Scopri di più</i></a>
                    </p>

                </div>
            </div>

            <!-- sezione 4 -->
            <div class="splash-container splash-bg-main" style="background-image: url('../assets/img/home-splash4.jpg');display: none">
                <div class="splash-body">
                    
                    <h1 class="splash-body-heading">
                        Rimani aggiornato
                    </h1>

                    <p class="splash-body-paragraph text-content">
                        Visita la nostra sezione notizie per tutte le novità!
                        <a href="../HTML/mindrover.php"><i class="d">Scopri di più</i></a>
                    </p>

                </div>
            </div>

        </div>
        
        <div class="dot-position">
            <span class="dot dot-active" onclick="carouselImage(1); $('.dot-position').children().removeClass('dot-active'); $(this).addClass('dot-active');"></span>
            <span class="dot" onclick="carouselImage(2); $('.dot-position').children().removeClass('dot-active'); $(this).addClass('dot-active');"></span>
            <span class="dot" onclick="carouselImage(3); $('.dot-position').children().removeClass('dot-active'); $(this).addClass('dot-active');"></span>
            <span class="dot" onclick="carouselImage(4); $('.dot-position').children().removeClass('dot-active'); $(this).addClass('dot-active');"></span>
        </div>
    </div>

<!-- Navbar -->
<?php

require_once('../php/modules/navbar.php');

if(isset($_SESSION['user_id']))
{
    get_private_navbar($ganesh);
}
else
{
    get_public_navbar($ganesh);
}

?>

    <!-- Bacheca notizie -->
    <div class="text-container" style="background-image: url('../assets/img/home-sfondo.jpg');">
        <h1 class="news">In Evidenza</h1>

        <div class="board-container text-content" style="margin: 60px; grid-column-gap: 80px;">

            <!-- Notizia 1 -->
            <div class="card news" style="background-image: url('../assets/img/home-notizia1.jpg');">
                <div class="card-content">
                    Può il mindROVER essere nocivo per i più giovani?
                </div>
            </div>

            <!-- Notizia 2 -->
            <div class="card news" style="background-image: url('../assets/img/home-notizia2.jpg');">
                <div class="card-content">
                    Il free roaming e mindROVER
                </div>
            </div>

            <!-- Notizia 3 -->
            <div class="card news" style="background-image: url('../assets/img/home-notizia3.jpg');">
                <div class="card-content">
                    Aggiornamenti su Golarion© e Toad of Duty©
                </div>
            </div>

        </div>

    </div>

    <!-- Striscia tra schede -->
    <div class="split">
        <i>Hai dato un'occhiata alle ultime notizie uscite? No? ...Beh, fallo...</i>
    </div>

    <!-- Scheda -->
    <div class="text-container" style="background-image: linear-gradient(to right,rgba(255, 174, 0, 0.30),rgba(255, 0, 0, 0.20)),url('../assets/img/home-supportaci.jpg'); grid-template-columns: 5fr 5fr">
        
        <h1 class="title">
            Supportaci! 
        </h1>

        <div class="text-content">
            Frog Studios è una famiglia, e anche voi da casa potete far parte del nostro team. 
            Supportaci oggi stesso, ottenendo una vasta gamma di vantaggi e accessi anticipati ed esclusivi a mindROVER! 
            <a href="../HTML/crowdfunding.php"><i class="d">Scopri di più</i></a>
        </div>
    </div>

    <!-- Striscia tra schede -->
    <div class="split">
        <i>Vuoi provare mindROVER prima di tutti i tuoi amici e vantarti con loro? Bene, ma tutto ha un prezzo. Anche la tua vanità.</i>
    </div>

    <!-- Scheda -->
    <div class="text-container" style="background-image: linear-gradient(to left,rgba(255, 174, 0, 0.3),rgba(255, 0, 0, 0.20)),url('../assets/img/home-unisciti.jpg'); grid-template-columns: 5fr 5fr"> 
        
        <div class="text-content">
            Pensi di avere quel che serve per portare grosse novità nel team Frog Studios? Facci subito sapere le tue abilità! 
            Frog Studios è sempre alla ricerca di nuove menti per i suoi ranghi! 
            <a href="../HTML/frogstudios.php"><i class="d">Scopri di più</i></a>
        </div>

        <h1 class="title">
            Unisciti a Noi!
        </h1>

    </div>


    <!-- Striscia tra schede -->
    <div class="split">
        <i>Vuoi davvero unirti a noi? Sei davvero sicuro? Ok, ma occhio che abbiamo standard alti. Ti piacciono le rane?</i>
    </div>

    <!-- Footer -->
    <!-- <div class="footer-container footer-bg"> 
        <div class="footer-content">

            <img src="../assets/img/logo.png" style="height: 11vh;">   
            <img src="../assets/img/unige.png" alt="Unige" style="height: 10vh;">
            <i class="fab fa-facebook-square d"></i>
            <i class="fab fa-youtube d"></i>
            <i class="fab fa-instagram d"></i>
            <i class="fas fa-envelope d"></i>
            <br>
            <span style="font-size: 0.8rem; letter-spacing: normal;">©2020 Frog Studios, Inc. Tutti i diritti riservati. mindROVER©, 
            Golarion©, Toad of Duty© sono proprietà intelletuali di Frog Studios, Inc.</span>
            
        </div>
    </div> -->

    <?php require_once('../php/modules/footer.php'); ?>

</body>

</html>