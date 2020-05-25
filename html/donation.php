<?php
session_start();

require_once('../php/modules/navbar.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <link type="text/css" rel="stylesheet" href="../css/fonts.css">
    <link type="text/css" rel="stylesheet" href="../css/text-container.css">
    <link type="text/css" rel="stylesheet" href="../css/nav.css">
    <link type="text/css" rel="stylesheet" href="../css/utils/clearsheet.css">
    <link type="text/css" rel="stylesheet" href="../css/modal.css">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <style>

    .h2Donation{
        font-family: ganesh; 
        line-height: 2rem; 
        padding: 1vh 0; 
        font-size: medium;
    }


    </style>

    <title>Donazione</title>
</head>
<body class="login-bg">
    <?php
        if(isset($_SESSION['user_id']))
        {
            header('location: ./profiloprivato.php');
        }
        else
        {
            get_public_navbar('LOGIN');
        }
    ?>
    <div class="box">
        <h1 style="font-family: ganesh">Dona a Frog Studios!</h1><br>
        <h2 class="h2Donation" >Donaci subito con il nostro sistema di transazione sicura. Puoi anche usare Paypal, in totale sicurezza!</h1>
        <form action="../php/login.php" method="POST">
            <div class="loginform-body">
                <!-- <label for="email">Email: </label><input type="email" name="email"> -->
                <div class="form-container">
                    <input type="number" name="donation" id="amount" placeholder="Inserisci la somma che vuoi donare!" min="1.00" max="1000.00"class="form">
                    <i class="fas fa-coins" style="top: 2.2vh;"></i>
                </div>
            </div>
        </form>
        
        <div style="display: flex; flex-direction: row;">
        <img src="../assets/img/payPal_logo.png" style="flex: 1; max-width: 10rem; margin-left: 4rem"></img>
        <div class="d text-content modifica" style="flex: 1; margin: auto; text-align: center; font-size: larger"><i onclick="window.location.href='../php/crowdfunding.php?amount='+ $('#amount').val();">Conferma donazione!</i></div>
        </div>
    </div>

    <img src="<?php echo (isset($_GET['target']) ? '../assets/img/logo.png&target=' . $_GET['target'] : '../assets/img/money.png'); ?>" class="frog">
</body>
</html>