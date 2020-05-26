<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transazione in corso ...</title>
</head>
<body style="background-color:rgb(224, 224, 224)">
    
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; border: 10px solid rgb(87, 87, 221); border-radius: 1%; background-color: lightblue; padding: 5rem;">
        <p style="font-size: 2rem; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; margin: 1rem;">Powered by</p>
        <img src="../assets/img/payPal_logo.jpg" style="margin: auto; max-width: 40vw;">
        <p style="font-size: 3rem; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; margin: 1rem;">Transazione in corso ...</p>
    </div>

</body>
</html>

<?php

var_dump($_GET);
        
//controlla che sia stato effettuato l'accesso
session_start();
if(!isset($_SESSION['user_id']))
{
    //echo "nessuna sessione aperta! chiusura...";
    header('location: ../html/login.php');
    die();
}

require_once('./db/mysql_credentials.php');
require_once('./db/Donazioni.php');
require_once('./db/ProfiliUtenti.php');
require_once('./db/payment_system.php');
require_once('./utils/sanitize_input.php');
$dbms = connect();
$table_profili = new ProfiliUtenti($dbms);
$table_donazioni = new Donazioni($dbms);

if(!isset($_GET['amount']))
{
    //echo 'Non mi hai detto quanto vuoi donare...';
    header('location: ../html/donation.php?error=no_amount');
    die();
}

$_GET['amount'] = sanitize($_GET['amount']);
//echo 'amount = ' . $_GET['amount'] . ' ';

//effettua il pagamento con qualche servizio di pagamento ...
if(pay())
{
    //registra la donazione
    //var_dump($_SESSION);
    echo 'ritorna ' . $table_profili->setSupporter($_SESSION['user_id'], true);
    echo 'ritorna ' . $table_donazioni->recordDonation($_SESSION['user_id'], $_GET['amount']);
}
else
{
    //echo 'Impossibile procedere con la donazione. Errore durante il pagamento.';
    header('location: ../html/comingsoon.php?error=crowdfunding_denied_payment');
    die();
}

$_SESSION['crowdfunding_donation_list'] = $table_donazioni->getDonationListFrom($_SESSION['user_id']);
//header('location: ../html/profiloprivato.php');
echo '<script>';

echo '</script>';

?>