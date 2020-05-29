<?php
session_start();
$ganesh = "CHI SIAMO";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frog Studios</title>
 
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

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <!-- METADATI -->
    <link rel="icon" href="../assets/img/frog-icon.png">
    <meta name="author" content="Francesco Ganci, Lorenzo Terranova">
    <meta name="description" content="Vuoi sapere di più su di noi? Questa è la pagina giusta!">
    <meta name="keywords" content="ROVER, mindROVER, mind ROVER, frog, frogs, frogstudios, frog studios, videogames, videogame, vr, virtual, virtualreality, virtual reality, programming, golarion, toad of duty, tod, videogiochi, pc gaming, pc, gaming, console, chi siamo, la società">

    <style>

        /* Bottone donazione */
        .btn{
            cursor: pointer; 
            font-size: xxx-large; 
            border: 0.4vh solid #8f281d;
            font-family: "ganesh", sans-serif;
        }

        /* Hover per bottone donazione */
        .btn:hover{
            background-color: whitesmoke;
            transition: 0.5s;
            color: #8f281d;
        }

    </style>

</head>

<body>

    <!-- Immagine iniziale pagina -->
    <div class="splash-container splash-bg-main" style="background-image: url('../assets/img/fs-splash.jpg'); opacity: 0.9;">
        <div class="splash-body">
            <h1 class="splash-body-heading">
                Frog Studios 
            </h1>

            <p class="splash-body-paragraph">
                Scopri chi siamo e cosa facciamo.
            </p>
        
        </div>
    </div>

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

    <!-- Scheda -->
    <div class="text-container" style="background-image: linear-gradient(to right,rgba(255, 0, 0, 0.20),rgba(187, 15, 15, 0.30)),url('../assets/img/fs-chisiamo.jpg'); grid-template-columns: 4fr 4fr">
        
        <h1 class="title" style="text-align: right;">
            Chi Siamo?
        </h1>

        <div class="text-content">
            <p>Frog Studios nasce da due semplici ragazzi che da sempre volevano portare al livello successivo la loro passione per i 
            videogiochi: giocarci è un conto, programmarli è ben altra storia. 
            <br><br>Sono anni che lavoriamo a progetti come <b>Toad of Duty</b> e 
            <b>Golarion</b>, in tutta segretezza, mostrandoci al Mondo solamente da qualche anno e in pompa magna, con l’annuncio del nostro 
            ambizioso e rivoluzionario progetto, il <b>mindROVER</b>. Se non sai ancora di cosa stiamo parlando, clicca <a href="../HTML/mindrover.php"><i class="d">qui</i></a>.</p>
        </div>
        
    </div>

    <!-- Striscia tra schede -->
    <div class="split">
        <i>Sì, bella la pubblicità del mindROVER pure qua, eh?</i>
    </div>

    <!-- Scheda -->
    <div class="text-container" style="background-image: linear-gradient(to left,rgba(255, 0, 0, 0.20),rgba(187, 15, 15, 0.30)),url('../assets/img/fs-qualita.jpg'); grid-template-columns: 4fr 4fr"> 
        
        <div class="text-content">
            <p>Quello che abbiamo sempre voluto era di sfornare prodotti che in primis avrebbero soddisfatto noi, dei giocatori, e con questa convinzione tuttora proseguiamo, anche se non siamo più solamente in due nel nostro team. 
            <br><br>Siamo dell’idea che un prodotto non vada pensato in vista del ricavo, ma invece concentrandosi a sfornare qualcosa di sicuramente <b>piacevole</b> e <b>divertente</b>. Così il risultato sarà sicuramente migliore, e per forza di cose anche i guadagni ne 
            gioveranno!</p>                
        </div>

        <h1 class="title" style="text-align: right;">
            Qualità prima di tutto!
        </h1>

    </div>

    <!-- Striscia tra schede -->
    <div class="split">
        <i>Se vi state chiedendo se è una mossa di mercato vincente, sappiate che se lo stanno chiedendo anche i nostri commercialisti.</i>
    </div>

    <!-- Scheda -->
    <div class="text-container" style="background-image: linear-gradient(to right,rgba(255, 0, 0, 0.20),rgba(187, 15, 15, 0.30)),url('../assets/img/fs-voi.jpg'); grid-template-columns: 4fr 4fr">
        
        <h1 class="title" style="text-align: right;">
            Frog Studios siete voi!
        </h1>

        <div class="text-content">
            <p>Insomma, amiamo definirci <i>giocatori con qualche skill in più</i>, piuttosto che dei programmatori rigorosi e distanti da voi. 
            La nostra passione arde ancora in noi, e siamo sempre alla ricerca di qualcuno con i nostri stessi ideali: <b>forse stiamo cercando proprio te</b>!
            <br><br>Questo è quello che siamo, quello a cui puntiamo e quello che non vogliamo mai perdere di vista.</p>
        </div>

        <!-- Bottone contatti -->
        <div>
            <div class="text-content modifica" style="transform: skewX(-15deg);"><b onclick="location.href='../HTML/comingsoon.php'" class="btn">Contattaci per un posto!</b></div>
        </div>
        
    </div>

    <!-- Striscia tra schede -->
    <div class="split">
        <i>Se non si fosse ancora capito, ci piacciono le rane. E se non hai risposto "anche a me", puoi benissimo chiudere la pagina.</i>
    </div>

    <!-- Footer -->
    <?php require_once('../php/modules/footer.php'); ?>

</body>

</html>