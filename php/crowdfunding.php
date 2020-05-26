<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transazione in corso ...</title>

    <link type="text/css" rel="stylesheet" href="../css/fonts.css">

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../js/carousel.js"></script>

    <style>
    .loader{
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #da4112;
        width: 120px;
        height: 120px;
        -webkit-animation: spin 2s linear infinite; /* Safari */
        animation: spin 2s linear infinite;
        margin-left: 15rem;
    }

    /* Safari */
    @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .cfContainer{
        position: absolute; 
        top: 50%; 
        left: 50%; 
        transform: translate(-50%, -50%); 
        text-align: center; 
        border: 5px solid #da4112; 
        border-radius: 1%; 
        background-color: rgb(173, 216, 230, 0.7); 
        padding: 0 3rem;
    }

    .cfTitle{
        font-size: 2rem; 
        font-family: 'ganesh', Cambria, Cochin, Georgia, 
        Times, 'Times New Roman', serif; 
        margin: 1rem;
    }

    </style>

</head>
<body style="background-image: url('../assets/img/space.jpg');">
    
    <div class="cfContainer">
    <p class="cfTitle">Attendi mentre processiamo la tua transazione!</p>
        <div class="loader"><img src="../assets/img/money.png" style="margin: auto; max-width: 6rem;"></div>
        <img src="../assets/img/payPal_logo.png" style="margin: auto; max-width: 20vw; ">
    </div>

    <!-- <script>
        $(document).ready(function(){
            setTimeout(function(){
                window.location.href = end_url;
            }, 1500);
        });
    </script> -->

</body>
</html>

<?php

// //var_dump($_GET);
        
// //controlla che sia stato effettuato l'accesso
// session_start();
// if(!isset($_SESSION['user_id']))
// {
//     //echo "nessuna sessione aperta! chiusura...";
//     header('location: ../html/login.php');
//     die();
// }

// require_once('./db/mysql_credentials.php');
// require_once('./db/Donazioni.php');
// require_once('./db/ProfiliUtenti.php');
// require_once('./db/payment_system.php');
// require_once('./utils/sanitize_input.php');
// $dbms = connect();
// $table_profili = new ProfiliUtenti($dbms);
// $table_donazioni = new Donazioni($dbms);

// if(!isset($_GET['amount']))
// {
//     //echo 'Non mi hai detto quanto vuoi donare...';
//     header('location: ../html/donation.php?error=no_amount');
//     die();
// }

// $_GET['amount'] = sanitize($_GET['amount']);
// //echo 'amount = ' . $_GET['amount'] . ' ';

// //effettua il pagamento con qualche servizio di pagamento ...
// if(pay())
// {
//     //registra la donazione
//     //var_dump($_SESSION);
//     $table_profili->setSupporter($_SESSION['user_id'], true);
//     $table_donazioni->recordDonation($_SESSION['user_id'], $_GET['amount']);
// }
// else
// {
//     //echo 'Impossibile procedere con la donazione. Errore durante il pagamento.';
//     header('location: ../html/comingsoon.php?error=crowdfunding_denied_payment');
//     die();
// }

// $_SESSION['crowdfunding_donation_list'] = $table_donazioni->getDonationListFrom($_SESSION['user_id']);
// //header('location: ../html/profiloprivato.php');
// echo '<script>';
//     echo 'var end_url = "../html/profiloprivato.php";';
// echo '</script>';

?>