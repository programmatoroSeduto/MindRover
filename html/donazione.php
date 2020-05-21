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
    <link type="text/css" rel="stylesheet" href="../css/nav.css">
    <link type="text/css" rel="stylesheet" href="../css/utils/clearsheet.css">
    <link type="text/css" rel="stylesheet" href="../css/text-container.css">
    <link type="text/css" rel="stylesheet" href="../css/modal.css">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <title>Accedi</title>
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
    <!-- <div class="box">
        <h1 style="line-height: 5rem; font-family: ganesh">Dona subito a Frog Studios!</h1><br>
        <form action="../php/login.php" method="POST">
            <div class="loginform-body">
                <?php
                    if(isset($_GET['target']))
                        echo '<input name="target" style="display: none;" value="' . $_GET['target'] . '">';
                ?>
                <div class="form-container">
                    <input type="number" name="pass" placeholder="Inserisci la somma che vuoi donarci!" class="form" min="1" max="1000">
                    <i class="fas fa-coins" style="top: 2.2vh"></i>
                </div>
            </div>
            <input class="d text-content modifica" type="submit" value="CONFERMA DONAZIONE" style="background-color: transparent; border-style: none;"></input>
            <div class="loginform-submit">
                
                <input class="d text-content modifica" type="submit" value="Accedi" style="background-color: transparent; border-style: none;"></input>
                
                <span class="auth-error">
                    <?php

                    if(isset($_GET['error_email']) and isset($_GET['error_pass']))
                        echo '<b>Attenzione!</b> Nessun dato inserito...';
                    elseif(isset($_GET['error_pass']))
                        echo '<b>Attenzione!</b> Manca la password...';
                    elseif(isset($_GET['error_email']))
                        echo '<b>Attenzione!</b> Manca la mail...';
                    elseif(isset($_GET['error']))
                        echo "<b>Attenzione!</b> Credenziali errate.";
                    else
                        echo "";

                    ?>
                </span>

            </div>
        </form>
        
        <p class="register-here">Non ancora registrato? <a href="./registrazione.php" class="d text-content modifica"><i>Provvedi subito!</i></a></p>
    </div> -->
    <div style="display: grid; grid-template-columns: 4fr 4fr; padding: 2rem"> 

        <div class="text-content">
            Abbiamo pensato ad un metodo di crowdfunding funzionale sia per noi che per voi, i donatori. Questo nostro programma di 
            supporto prevede tre grosse categorie di donatori, ognuna con i relativi bonus: Tier III, Tier II e Tier I. 
            <br><br>Pare subito chiaro che chi donerà di più avrà di conseguenza più privilegi e premi, per ringraziarlo del suo supporto, passando daivantaggi più "blandi" del Tier III alle vere e proprie esclusive del Tier I.        
        </div>

        <h1 class="title">
            Un programma per tutti!
            <div class="form-container" style="margin: 1rem 1rem;">
            <input type="number" name="pass" placeholder="Inserisci la somma che vuoi donarci!" class="form" min="1" max="1000">
            <i class="fas fa-coins" style="top: 3.8vh; font-size: 3vh"></i>
        </div>
        </h1>

    </div>
        
    <img src="<?php echo (isset($_GET['target']) ? '../assets/img/logo.png&target=' . $_GET['target'] : '../assets/img/money.png'); ?>" class="frog">
</body>
</html>