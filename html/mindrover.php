<?php
session_start();
$ganesh = "MINDROVER";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mindROVER</title>

    <!-- CSS -->
    <link type="text/css" rel="stylesheet" href="../css/utils/clearsheet.css">
    <link type="text/css" rel="stylesheet" href="../css/utils/bg.css">
    <link type="text/css" rel="stylesheet" href="../css/splash.css">
    <link type="text/css" rel="stylesheet" href="../css/fonts.css">
    <link type="text/css" rel="stylesheet" href="../css/nav.css">
    <link type="text/css" rel="stylesheet" href="../css/containers.css">
    <link type="text/css" rel="stylesheet" href="../css/footer2.css">
    <link type="text/css" rel="stylesheet" href="../css/text-container.css">
    <link type="text/css" rel="stylesheet" href="../css/board.css">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <!-- METADATI -->
    <link rel="icon" href="../assets/img/frog-icon.png">
    <meta name="author" content="Francesco Ganci, Lorenzo Terranova">
    <meta name="description" content="In questa pagina potrete scoprire tutto quanto sul mindROVER, il rivoluzionario ed eccezionale sistema di intrattenimento in realtà virtuale firmato Frog Studios!">
    <meta name="keywords" content="ROVER, mindROVER, mind ROVER, frog, frogs, frogstudios, frog studios, videogames, videogame, vr, virtual, virtualreality, virtual reality, programming, golarion, toad of duty, tod, videogiochi, pc gaming, pc, gaming, console, vr gaming, vr console, vr games">

</head>

<body>

    <!-- Immagine iniziale pagina -->
    <div class="splash-container splash-bg-main" style="background-image: url('../assets/img/mr-splash.jpg'); opacity: 0.9;">
        <div class="splash-body">
            <h1 class="splash-body-heading">
                mindROVER 
            </h1>

            <p class="splash-body-paragraph">
                Frog Studios vi presenta il suo progetto di punta, il motivo stesso della sua nascita: il mindROVER.
            </p>

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

    <!-- Scheda -->
    <div class="text-container" style="background-image: linear-gradient(to right,rgba(255, 0, 0, 0.30),rgba(0, 4, 255, 0.20)),url('../assets/img/mr-cos.png'); grid-template-columns: 5fr 4fr">
        
        <h1 class="title" style="text-align: right;">
            <img src="../assets/img/mindROVER.png" style="width: 666px">
        </h1>

        <div class="text-content">
            <p>Il progetto più folle e ambizioso di Frog Studios: il mindROVER. Se cogliete la citazione “link: start!”, allora siete già 
            sulla buona strada per capire come funziona. Quello che propone è qualcosa senza precedenti: <b>basta sensori supplementari</b>, 
            <b>basta pedane per il movimento</b>. 
            <br><br>La nostra idea prevede <b>solamente l’uso del nostro casco</b> e, a quel punto, sarà letteralmente 
            come un sogno. Solo che, questa volta, sarete voi e solo voi a scegliere il Mondo dove catapultarvi!</p>
        </div>
        
    </div>

    <!-- Striscia tra schede -->
    <div class="split">
    <i>Davvero non hai capito la citazione? E saremmo noi quelli strani?</i>
    </div>

    <!-- Scheda -->
    <div class="text-container" style="background-image: linear-gradient(to left,rgba(255, 0, 0, 0.30),rgba(0, 4, 255, 0.20)),url('../assets/img/mr-sistema.jpg'); grid-template-columns: 3fr 5fr;">
        <div class="text-content">
            <p>Il mindROVER, tramite una raffinata e rivoluzionaria tecnologia di transricevitori, prenderà contatto con il 
            vostro cervello per reindirizzare gli impulsi cerebrali dal casco e verso il casco, <b>in tutta sicurezza</b>. 
            <br><br><i>Cosa vuol dire? </i>
            Vuol dire che mentre vedrete le immagini in realtà virtuale del casco, potrete interagire con il Mondo che vi si presenterà 
            a 360 gradi e <b>in completa libertà</b>, come se steste sognando. E rimanendo fedeli al paragone appena fatto, il vostro corpo 
            rimarrà in realtà fermo, senza nessun pericolo.</p>         
        </div>

        <h1 class="title" style="text-align: right;">
            Un incredibile sistema...
        </h1>
    </div>

    <!-- Striscia tra schede -->
    <div class="split">
        <i>Sarà come controllare i sogni, non vi sentite già onnipotenti?</i>
    </div>

    <!-- Scheda -->
    <div class="text-container" style="background-image: linear-gradient(to right,rgba(255, 0, 0, 0.30),rgba(0, 4, 255, 0.20)), url('../assets/img/mr-legale.jpg'); grid-template-columns: 5fr 4fr">
        
        <h1 class="title" style="text-align: right;">
            ...totalmente sicuro!
        </h1>

        <div class="text-content">
            <p>Ovviamente sappiamo quanto sia delicata e pericolosa una tale tecnologia, difatti il nostro crescente team si avvale anche 
            di esperti in materie differenti, non solo di programmatori. Un progetto così ambizioso deve essere <b>raffinato quanto 
            sicuro</b>, l’esperienza che vogliamo offrire vuole essere <b>indimenticabile quanto sicura</b>. 
            <br><br>Quello che vogliamo ottenere è un prodotto che possa catapultare, nella maniera più realistica possibile, 
            chiunque nel più vasto numero di Mondi immaginari possibili: qualsiasi cosa tu sogni di poter vivere che trascende 
            l’ordinaria e comune realtà, mindROVER potrà realizzarla.</p>
        </div>
        
    </div>

    <!-- Striscia tra schede -->
    <div class="split">
        <i>Sì, certo che ci sarà un mondo con sole rane. Serviva proprio chiederlo?</i>
    </div>

    <!-- Scheda -->
    <div class="text-container" style="background-image: linear-gradient(to left,rgba(255, 0, 0, 0.30),rgba(0, 4, 255, 0.20)),url('../assets/img/mr-pertutti.jpg'); grid-template-columns: 3fr 5fr"> 
        <div class="text-content">
            <p>Noi di Frog Studios abbiamo in mente anche altre applicazioni per il mindROVER.
            Per esempio, siamo fieri di riferirci anche a quelle persone con gravi handicap e difficoltà motorie: lavoriamo per fornire 
            uno strumento che possa anche <b>ridare la possibilità di camminare</b>, anche se solo virtualmente, a chi non può più, 
            o anche <b>aiutare nella riabilitazione motoria</b>. 
            <br><br>Vogliamo che il nostro mindROVER possa regalare emozioni forti anche e 
            soprattutto a coloro che hanno avuto delle grosse sfortune nella loro vita, e siamo fieri e decisi a dare anima e corpo 
            perché questa particolare implicazione del nostro progetto sia una parte rilevante e ben strutturata, una volta che sarà in 
            commecio.</p>        
        </div>

        <h1 class="title" style="text-align: right;">
            Ed è per tutti!
        </h1>
    </div>

    <!-- Striscia tra schede -->
    <div class="split">
        <i>mindROVER offrirà mondi totalmente democratici, uguali per tutti.</i>
    </div>

   <!-- Footer -->
   <?php require_once('../php/modules/footer.php'); ?>

</body>

</html>