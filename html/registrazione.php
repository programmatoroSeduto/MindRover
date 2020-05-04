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
                        if(isset($_GET['error_no_first'])) echo '<b>Attenzione!</b> Manca il nome...';
                        elseif(isset($_GET['error_no_last'])) echo '<b>Attenzione!</b> Manca il cognome...';
                        elseif(isset($_GET['error_no_email'])) echo '<b>Attenzione!</b> mail non inserita...';
                        elseif(isset($_GET['error_email'])) echo '<b>Attenzione!</b> Questa mail esiste già. Accedi! <br> <a href="./login.php"><i>Login qui</i></a>';
                        elseif(isset($_GET['error_no_pass'])) echo '<b>Attenzione!</b> Manca la password...';
                        elseif(isset($_GET['error_no_confirm'])) echo '<b>Attenzione!</b> Manca la conferma della password...';
                        elseif(isset($_GET['error_pass_confirm'])) echo '<b>Attenzione!</b> Occhio alla conferma della password!';
                        elseif(isset($_GET['il_garbato_distruttore_colpisce_ancora'])) echo 'Errore tecnico.';
                        else echo "";
                    ?>
                </span>

            </div>
        </form>
    </div>

    <img src="../assets/img/logo.png" class="frog">
</body>
</html>