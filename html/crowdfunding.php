<?php
session_start();
$ganesh = "CROWDFUNDING";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crowdfunding</title>
 
    <!-- CSS -->
    <link type="text/css" rel="stylesheet" href="../css/utils/clearsheet.css">
    <link type="text/css" rel="stylesheet" href="../css/utils/bg.css">
    <link type="text/css" rel="stylesheet" href="../css/splash.css">
    <link type="text/css" rel="stylesheet" href="../css/containers.css">
    <link type="text/css" rel="stylesheet" href="../css/footer2.css">
    <link type="text/css" rel="stylesheet" href="../css/fonts.css">
    <link type="text/css" rel="stylesheet" href="../css/nav.css">
    <link type="text/css" rel="stylesheet" href="../css/text-container.css">
    <link type="text/css" rel="stylesheet" href="../css/board.css">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <style>
    
    .sas:hover{

        background-color: whitesmoke;
        transition: 0.5s
    }

    </style>


</head>

<body>

    <!-- Immagine iniziale pagina -->
    <div class="splash-container splash-bg-main" style="background-image: url('../assets/img/crowd-splash.jpg'); opacity: 0.9">
        <div class="splash-body">

            <h1 class="splash-body-heading">
                Sostieni mindROVER 
            </h1>

            <p class="splash-body-paragraph">
                Il vostro aiuto ci sostiene e ci motiva.
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
    <div class="text-container" style="background-image: linear-gradient(to left,rgba(163, 22, 22, 0.40),rgba(255, 0, 0, 0.2)),url('../assets/img/crowd-supportaci.jpg'); grid-template-columns: 4fr 4fr">

        <h1 class="title">
            Supportaci oggi!
        </h1>

        <div class="text-content">
            Un progetto ambizioso e dispendioso come quello del mindRover ha bisogno di più supporto possibile.
            Ed è anche per questo che chiunque, anche tu, puoi aiutarci con una donazione! Non devi essere necessariamente un grosso 
            imprenditore, accettiamo ed apprezziamo anche un semplice ragazzo che crede in noi e ci offre virtualmente un caffè donandoci 
            qualche euro.
            <br><br>Se invece fossi interessato a supportarci in maniera più decisiva, continua a leggere per scoprire cosa propone il 
            nostro programma di crowdfunding! 
        </div>

        <!-- Bottone donazioni -->
        <div>
            <div class="d text-content modifica" style="transform: skewX(-15deg);"><b onclick="location.href='../HTML/donation.php'" style="cursor: pointer; font-size: xxx-large; border: 0.4vh solid #8f281d;;" class="sas">Fai subito una donazione!</b></div>
        </div>
        
    </div>

    <!-- Striscia tra schede -->
    <div class="split">
    <i>A noi veterani dell'azienda piace da sempre il mocaccino. Non chiedeteci il perchè.</i>
    </div>

    <!-- Scheda -->
    <div class="text-container" style="background-image: linear-gradient(to right,rgba(163, 22, 22, 0.40),rgba(255, 0, 0, 0.2)),url('../assets/img/crowd-pertutti.jpg'); grid-template-columns: 4fr 4fr"> 

        <div class="text-content">
            Abbiamo pensato ad un metodo di crowdfunding funzionale sia per noi che per voi, i donatori. Questo nostro programma di 
            supporto prevede tre grosse categorie di donatori, ognuna con i relativi bonus: Tier III, Tier II e Tier I. 
            <br><br>Pare subito chiaro che chi donerà di più avrà di conseguenza più privilegi e premi, per ringraziarlo del suo supporto, passando daivantaggi più "blandi" del Tier III alle vere e proprie esclusive del Tier I.        
        </div>

        <h1 class="title">
            Un programma per tutti!
        </h1>

    </div>

    <!-- Striscia tra schede -->
    <div class="split">
        <i>Indovinate un po' con che immagini saranno mostrati i tre Tier?</i>
    </div>

    <!-- Scheda -->
    <div class="text-container" style="background-image: linear-gradient(to left,rgba(163, 22, 22, 0.40),rgba(255, 0, 0, 0.2)),url('../assets/img/crowd-tier.jpg');">

        <h1 class="title" style="text-align: left;">
            I tre Tier!
        </h1>

        <!-- Carte Tier -->
        <div class="board-container text-content" style="margin: 50px;">

            <!-- Carta 3 -->
            <div class="card tier" style="background-image: url('../assets/img/scambio.png'); background-size: auto;">
                    
                <h1 class="splash-body-heading" style="padding: 0; margin-top: 15px; text-align: center;">TIER III</h1>
                <div class="card-content ganesh" style=" min-height: 350px; text-align: center;">
                    <div>Il tuo sguardo è come quello della Rana Scambio: non hai idea di quello che stia succedendo.</div>
                    <div style="font-size: larger;"><br>1 - 99 €<br></div>
                    <ul style="list-style-type: square; text-align: left;">
                        <li>Sconti speciali per l’intera collezione videoludica del mindRover</li>
                        <li>Contenuti extra in-game per l’intera collezione videoludica del mindRover</li>
                    </ul>  
                </div>

            </div>

            <!-- Carta 2 -->
            <div class="card tier" style=" background-image: url('../assets/img/imbrogliona.png'); background-size: 65% 65%;">
                   
                <h1 class="splash-body-heading" style="padding: 0; margin-top: 15px; text-align: center;">TIER II</h1>
                <div class="card-content ganesh" style="min-height: 355px; text-align: center;">
                    <div>Come la Rana Imbrogliona, vuoi fare quel passo in più.</div>
                    <div style="font-size: larger;"><br>100 - 199 €<br></div>
                    <ul style="list-style-type: square; text-align: left;">
                        <li>Accesso all’intera collezione di demo in early access</li>
                        <li>Sconti speciali per l’intera collezione del mindRover</li>
                        <li>Contenuti extra per l’intera collezione del mindRover</li>
                    </ul>  
                </div>

            </div>

            <!-- Carta 1 -->
            <div class="card tier" style=" background-image: url('../assets/img/logo.png'); background-size: 70% 65%;">
                    
                <h1 class="splash-body-heading" style="padding: 0; margin-top: 15px; text-align: center;">TIER I</h1>
                <div class="card-content ganesh" style="text-align: center;">
                    <div>Sei Davvero Rospotente!</div>
                    <div style="font-size: larger;"><br>200€ ed oltre<br></div>
                    <ul style="list-style-type: square; text-align: left;">
                        <li>Accesso all’intera collezione di demo in early access</li>
                        <li>Sconti speciali per l’intera collezione del mindRover</li>
                        <li>Contenuti extra per l’intera collezione del mindRover</li>
                        <li>Accesso all’intera collezione videoludica del mindRover in maniera totalmente gratuita</li>
                        <li>Possibilità di preordinare il mindRover e riceverlo in early access fino ad un mese prima dell’effettiva uscita sul mercato</li>
                    </ul>  
                </div>

            </div>

        </div>
        
    </div>

    <!-- Striscia tra schede -->
    <div class="split">
        <i>Ovviamente tutti gli accessi anticipati avranno a disposizione una vastissima gamma di bug di sistema ed errori elementari. 
            Non c'è di che.</i>
    </div>

    <!-- Scheda -->
    <div class="text-container" style="background-image: linear-gradient(to right,rgba(163, 22, 22, 0.40),rgba(255, 0, 0, 0.2)),url('../assets/img/crowd-precisazioni.jpg'); grid-template-columns: 4fr 4fr"> 
        
        <div class="text-content">
            Con "collezione" ci riferiamo ai contenuti disponibili all’uscita del mindRover, escluse quindi le pubblicazioni future. 
            Per consultare la lista dei progetti che saranno commercializzati assieme all’uscita del mindRover, passa da <i>qui</i>.
            <br><br>Quando parliamo di early access a contenuti come le demo, intendiamo la possibilità di utilizzare i prodotti che 
            usciranno per mindRover, in anteprima, sul vostro computer. In questo modo, potrete provare in anteprima giochi e applicazioni 
            in corso di sviluppo, anche per iniziare a farvi un’idea di dove il mindRover andrà a parare. E tutto questo già da adesso!
         </div>

         <h1 class="title">
            Qualche precisazione!
        </h1>

    </div>

    <!-- Striscia tra schede -->
    <div class="split">
        <i>Non sarà come provare il gioco in realtà virtuale, ma perlomeno ne avrete un assaggino.</i>
    </div>

    <!-- Scheda -->
    <div class="text-container" style="background-image: linear-gradient(to left,rgba(163, 22, 22, 0.40),rgba(255, 0, 0, 0.2)),url('../assets/img/crowd-top.jpg'); grid-template-columns: 4fr 4fr">

        <h1 class="title">
            Top Donators!
        </h1>

        <div class="text-content">
            La ciliegina sulla torta è il progetto Top Donators: si tratta di premiare quei donatori che più hanno creduto in noi. 
            I Tier I con le donazioni più alte, non solo saranno ben visibili qui sul sito, ma avranno anche dei riconoscimenti nelle 
            nostre opere! Queste persone potrebbero scoprire che il proprio nome (o nickname) è lo stesso di quel Boss del Dungeon Segreto 
            di Golarion, o lo stesso del sergente maggiore di Toad of Duty!
            <br><br>
            Questo è l'ennesimo modo per ringraziarvi e dimostrarvi quanto il vostro supporto è importante per noi.
        </div>

        <!-- Bottone donazioni -->
        <div>
            <div class="d text-content modifica" style="transform: skewX(-15deg);"><b onclick="location.href='../HTML/donation.php'" style="cursor: pointer; font-size: xxx-large; border: 0.4vh solid #8f281d;;" class="sas">Fai subito una donazione!</b></div>
        </div>
        
    </div>

    <!-- Striscia tra schede -->
    <div class="split">
    <i>Vedete di scegliervi nomi decenti. Non vogliamo un drago che si chiami "XXXSexyMarmottaXXX".</i>
    </div>

    <!-- Footer -->
    <?php require_once('../php/modules/footer.php'); ?>

</body>

</html>