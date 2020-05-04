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
    <div class="box">
        <h1 style="line-height: 5rem;">Login!</h1><br>
        <form action="../php/login.php" method="POST">
            <div class="loginform-body">
                <?php
                    if(isset($_GET['target']))
                        echo '<input name="target" style="display: none;" value="' . $_GET['target'] . '">';
                ?>
                <label for="email">Email: </label><input type="email" name="email">
                <label for="pass">Password: </label><input type="password" name="pass">
            </div>
            <div class="loginform-submit">
                <input class="submin-button" type="submit" value="Accedi">
                
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
        
        <p class="register-here">Non ancora registrato? <a href="./registrazione.php"><i>clicca qui!</i></a></p>
    </div>

    <img src="<?php echo (isset($_GET['target']) ? '../assets/img/logo.png&target=' . $_GET['target'] : '../assets/img/logo.png'); ?>" class="frog">
</body>
</html>