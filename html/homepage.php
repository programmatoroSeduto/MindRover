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

    <!-- METADATI -->
    <link rel="icon" href="../assets/img/frog-icon.png">
    <meta name="author" content="Francesco Ganci, Lorenzo Terranova">
    <meta name="description" content="Benvenuto nella Homepage della start-up Frog Studios, giovane casa produttrice di videogiochi e della console a realtà virtuale mindROVER. Prego, fai come se fossi a casa tua!">
    <meta name="keywords" content="ROVER, mindROVER, mind ROVER, frog, frogs, frogstudios, frog studios, videogames, videogame, vr, virtual, virtualreality, virtual reality, programming, golarion, toad of duty, tod, videogiochi, pc gaming, pc, gaming, console">

    <style>

    .newsLink:link, .newsLink:visited{
        color: whitesmoke;
    }

    .newsLink:hover{
        color: #da4112;
    }

    </style>

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
                        mindROVER è il nostro progetto più ambizioso, la realtà virtuale più... reale che abbiate mai visto.
                        <a href="../HTML/mindrover.php"><i class="d">Scopri di più</i></a>
                    </p>

                </div>
            </div>

            <!-- sezione 3 -->
            <div class="splash-container splash-bg-main" style="background-image: url('../assets/img/home-splash3.jpg'); display: none">
                <div class="splash-body">
                    
                    <h1 class="splash-body-heading">
                        Supportaci oggi
                    </h1>

                    <p class="splash-body-paragraph text-content">
                        Se credi in noi e nei nostri progetti, fai oggi una donazione.
                        <a href="../HTML/donation.php"><i class="d">Scopri di più</i></a>
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
                        <a href="../HTML/search.php"><i class="d">Scopri di più</i></a>
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
            <div class="card news" style="background-image: url('../assets/img/home-notizia1.jpg'); text-align: center;">
                <div class="card-content" style="position: relative;">
                    <p style="font-size: 1.33rem">Può il mindROVER essere nocivo per i più giovani?</p>
                    <div style="position: absolute; bottom: 5px; text-align: center; width: 100%; background-color: rgba(211, 211, 211, 0.548); border-radius: 3%; line-height: 2rem">
                        <a class="newsLink" href="./articolo.php?code=7" style="font-size: large">Leggi</a>
                    </div>
                </div>
            </div>

            <!-- Notizia 2 -->
            <div class="card news" style="background-image: url('../assets/img/home-notizia2.jpg'); text-align: center;">
                <div class="card-content" style="position: relative;">
                <p style="font-size: 1.33rem">Il free roaming e mindROVER</p>
                    <div style="position: absolute; bottom: 5px; text-align: center; width: 100%; background-color: rgba(211, 211, 211, 0.548); border-radius: 3%; line-height: 2rem">
                        <a class="newsLink" href="./articolo.php?code=5" style="font-size: large">Leggi</a>
                    </div>
                </div>
            </div>

            <!-- Notizia 3 -->
            <div class="card news" style="background-image: url('../assets/img/jhin.jpg'); text-align: center;">
                <div class="card-content" style="position: relative;">
                <p style="font-size: 1.33rem">Intervista ai due CEO!</p>
                    <div style="position: absolute; bottom: 5px; text-align: center; width: 100%; background-color: rgba(211, 211, 211, 0.548); border-radius: 3%; line-height: 2rem">
                        <a class="newsLink" href="./articolo.php?code=15" style="font-size: large">Leggi</a>
                    </div>
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
            <p><b>Frog Studios è una famiglia</b>, e anche voi da casa potete far parte del nostro team. 
            <b>Supportaci oggi stesso</b>, ottenendo una vasta gamma di vantaggi e accessi anticipati ed esclusivi a mindROVER! 
            <a href="../HTML/crowdfunding.php"><i class="d">Scopri di più</i></a></p>
        </div>
    </div>

    <!-- Striscia tra schede -->
    <div class="split">
        <i>Vuoi provare mindROVER prima di tutti i tuoi amici e vantarti con loro? Bene, ma tutto ha un prezzo. Anche la tua vanità.</i>
    </div>

    <!-- Scheda -->
    <div class="text-container" style="background-image: linear-gradient(to left,rgba(255, 174, 0, 0.3),rgba(255, 0, 0, 0.20)),url('../assets/img/home-unisciti.jpg'); grid-template-columns: 5fr 5fr"> 
        
        <div class="text-content">
            <p>Pensi di avere quel che serve per portare grosse novità nel team Frog Studios? <b>Facci subito sapere le tue abilità!</b>
            Frog Studios è sempre alla ricerca di nuove menti per i suoi ranghi! 
            <a href="../HTML/frogstudios.php"><i class="d">Scopri di più</i></a></p>
        </div>

        <h1 class="title">
            Unisciti a Noi!
        </h1>

    </div>


    <!-- Striscia tra schede -->
    <div class="split">
        <i>Vuoi davvero unirti a noi? Sei davvero sicuro? Ok, ma occhio che abbiamo standard alti. Ti piacciono le rane?</i>
    </div>

    <?php require_once('../php/modules/footer.php'); ?>

</body>

</html>