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
 
    <link type="text/css" rel="stylesheet" href="../css/utils/clearsheet.css">
    <link type="text/css" rel="stylesheet" href="../css/utils/bg.css">
    <link type="text/css" rel="stylesheet" href="../css/splash.css">
    <link type="text/css" rel="stylesheet" href="../css/fonts.css">
    <link type="text/css" rel="stylesheet" href="../css/nav.css">
    <link type="text/css" rel="stylesheet" href="../css/containers.css">
    <link type="text/css" rel="stylesheet" href="../css/footer.css">
    <link type="text/css" rel="stylesheet" href="../css/text-container.css">
    <link type="text/css" rel="stylesheet" href="../css/board.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
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
            Cos'è mindROVER? 
        </h1>

        <div class="text-content">
            Il progetto più folle e ambizioso di Frog Studios: il mindROVER. Se cogliete la citazione “link: start!”, allora siete già 
            sulla buona strada per capire come funziona. Quello che propone è qualcosa senza precedenti: basta sensori supplementari, 
            basta pedane per il movimento. 
            <br><br>La nostra idea prevede solamente l’uso del nostro casco e, a quel punto, sarà letteralmente 
            come un sogno. Solo che, questa volta, sarete voi e solo voi a scegliere il Mondo dove catapultarvi!
        </div>
        
    </div>

    <!-- Striscia tra schede -->
    <div class="split">
    <i>Davvero non hai capito la citazione? E saremmo noi quelli strani?</i>
    </div>

    <!-- Scheda -->
    <div class="text-container" style="background-image: linear-gradient(to left,rgba(255, 0, 0, 0.30),rgba(0, 4, 255, 0.20)),url('../assets/img/mr-sistema.jpg'); grid-template-columns: 3fr 5fr;">
        <div class="text-content">
            Il mindROVER, tramite una raffinata e rivoluzionaria tecnologia di transricevitori, prenderà contatto con il 
            vostro cervello per reindirizzare, in tutta sicurezza, gli impulsi cerebrali dal casco e verso il casco. 
            <br><br>Cosa vuol dire? 
            Vuol dire che mentre vedrete le immagini in realtà virtuale del casco, potrete interagire con il Mondo che vi si presenterà 
            a 360 gradi e in completa libertà, come se steste sognando. E rimanendo fedeli al paragone appena fatto, il vostro corpo 
            rimarrà in realtà fermo, in totale sicurezza.         
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
            Ovviamente sappiamo quanto sia delicata e pericolosa una tale tecnologia, difatti il nostro crescente team si avvale anche 
            di altri esperti in materie differenti, non solo di programmatori. Un progetto così ambizioso deve essere raffinato quanto 
            sicuro, l’esperienza che vogliamo offrire vuole essere indimenticabile quanto sicura. 
            <br><br>Quello che vogliamo ottenere è un prodotto che possa catapultare, nella maniera più realistica possibile, 
            chiunque nel più vasto numero di Mondi immaginari possibili: qualsiasi cosa tu sogni di poter vivere che trascende 
            l’ordinaria e comune realtà, mindRover potrà realizzarla. 
        </div>
        
    </div>

    <!-- Striscia tra schede -->
    <div class="split">
        <i>Sì, certo che ci sarà un mondo con sole rane. Serviva proprio chiederlo?</i>
    </div>

    <!-- Scheda -->
    <div class="text-container" style="background-image: linear-gradient(to left,rgba(255, 0, 0, 0.30),rgba(0, 4, 255, 0.20)),url('../assets/img/mr-pertutti.jpg'); grid-template-columns: 3fr 5fr"> 
        <div class="text-content">
            Noi di Frog Studios abbiamo in mente anche altre applicazioni per il mindROVER.
            Per esempio, siamo fieri di riferirci anche a quelle persone con gravi handicap e difficoltà motorie: lavoriamo per fornire 
            uno strumento che possa anche ridare la possibilità di camminare, anche se solo virtualmente, a chi non può più, 
            o anche aiutare nella riabilitazione motoria. 
            <br><br>Vogliamo che il nostro mindRover possa regalare emozioni forti anche e 
            soprattutto a coloro che hanno avuto delle grosse sfortune nella loro vita, e saremo fieri e decisi a dare anima e corpo 
            perché questa particolare implicazione del nostro progetto sia una parte rilevante e ben strutturata, una volta che sarà in 
            commecio.        
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
   <div class="footer-container footer-bg"> 
        <div class="footer-content">

            <img src="../assets/img/logo.png" style="width: 6%;">   
            <img src="../assets/img/unige.png" alt="Unige" style="width: 4%;">
            <i class="fab fa-facebook-square d"></i>
            <i class="fab fa-youtube d"></i>
            <i class="fab fa-instagram d"></i>
            <i class="fas fa-envelope d"></i>
            <br>
            <span style="font-size: 12px; letter-spacing: normal;">©2020 Frog Studios, Inc. Tutti i diritti riservati. mindROVER©, 
            Golarion©, Toad of Duty© sono proprietà intelletuali di Frog Studios, Inc.</span>
        
        </div>
    </div>

</body>

</html>