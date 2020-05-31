<?php
session_start();
$ganesh = "COMINGSOON";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coming Soon</title>
 
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

    <style>

    .title404{
        text-shadow: -1px 1px 2px #000, 
        1px 1px 2px #000, 
        1px -1px 0 #000, 
        -1px -1px 0 #000;"
    }

    </style>

</head>

<body style="background-color: lightgray;">
    <!-- Immagine iniziale pagina -->
    <div class="splash-container splash-bg-main" style="background-image: url('../assets/img/stanco.jpg'); 
    opacity: 0.9; background-size: auto; background-repeat: repeat; background-position: 65px 65px;">
       
        <div class="splash-body">
            <h1 class="splash-body-heading title404">
                Ops! C'è stato un errore
            </h1>

            <p class="splash-body-paragraph title404">
                EHM ... Sopresa! 
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

    <div style="min-height: 25vh; text-align: center; font-size: 1.5rem; margin-top: 4rem">
        <?php
        if(isset($_GET['error']))
        {
            echo '<p>';
            switch($_GET['error'])
            {
                case 'crowdfunding_denied_payment':
                    echo 'Ti ringraziamo di aver pensato a supportarci. C\'è stato però un problema col servizio di pagamento.<br>Ti invitiamo a provare più tardi. <i>Grazie mille!</i>';
                break;
                case 'quattrocentoquattro':
                    echo 'Ci sono 404 motivi per cui questa pagina non esiste. <br> (eh già, hai capito bene)';
                break;
                case 'no_article':
                    echo 'L\'articolo che tanto volevi leggere ... l\'ho cancellato, spiace? spiace.';
                break;
                case 'profilo_anonimo':
                    echo 'TU NON PUOI PASSARE! Questo profilo è anonimo...';
                break;

            }
            echo '</p>';
        }
        else
        {
            echo '<p title="Se hai riconosciuto questa citazione, sei pronto per diventare una rana come noi.">Immagina la più bella pagina che tu abbia mai visto. Tu la sogni, noi la creiamo. <br> A meno che non abbia troppe dita, in quel caso è dura.<br><i>KungKurth</i></p>';
        }
        ?>
    </div>

    <!-- Footer -->
    <?php require_once('../php/modules/footer.php'); ?>

</body>

</html>