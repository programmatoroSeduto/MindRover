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

    <title>Registrazione</title>
</head>
<body  class="login-bg">

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

    <div class="reg-box">
        <h1 style="line-height: 5rem;">Registrazione</h1><br>
        <form action="../php/registration.php" method="POST">
            
            <div class="registrationform-body">
                <?php
                    if(isset($_GET['target']))
                        echo '<input name="target" style="display: none;" value="' . $_GET['target'] . '">';
                ?>
                <label for="firstname">Nome:</label><input type="text" name="firstname">
                <label for="lastname">Cognome:</label><input type="text" name="lastname">
                <label for="email">E-mail</label><input type="email" name="email">
                <label for="pass">Password</label><input type="password" name="pass">
                <label for="confirm">Conferma Password</label><input type="password" name="confirm">
            </div>

            <div class="loginform-submit">
                <input class="submin-button" type="submit" value="Registrati!">
                
                <span class="auth-error">
                    <?php
                        //handling errori...
                    ?>
                </span>

            </div>
        </form>
    </div>

    <img src="../assets/img/logo.png" class="frog">
</body>
</html>