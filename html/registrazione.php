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
    <link type="text/css" rel="stylesheet" href="../css/text-container.css">
    <link type="text/css" rel="stylesheet" href="../css/modal.css">
    <link type="text/css" rel="stylesheet" href="../css/utils/clearsheet.css">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

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
        <h1 style="line-height: 5rem; font-family: ganesh">Registrazione</h1><br>
        <form action="../php/registration.php" method="POST">
            
            <div class="registrationform-body">
                <?php
                    if(isset($_GET['target']))
                        echo '<input name="target" style="display: none;" value="' . $_GET['target'] . '">';
                ?>
                <label for="firstname">Nome:</label><input type="text" name="firstname">
                <label for="lastname">Cognome:</label><input type="text" name="lastname">
                <label for="email">Email:</label><input type="email" name="email">
                <label for="pass">Password:</label><input type="password" name="pass">
                <label for="confirm">Conferma password:</label><input type="password" name="confirm">
            </div>

            <div class="loginform-submit">
                <!-- <input class="submin-button" type="submit" value="Registrati!"> -->
                <input class="d text-content modifica" type="submit" value="Registrati!" style="background-color: transparent; border-style: none;"></input>
                
                <span class="auth-error">
                    <?php
                        //nessun nome inserito
                        if(isset($_GET['error_no_first'])) echo '';

                        //nessun cognome inserito
                        elseif(isset($_GET['error_no_last'])) echo '';

                        //manca la mail
                        elseif(isset($_GET['error_no_email'])) echo '';

                        //la mail esiste già nel database
                        elseif(isset($_GET['error_email'])) echo '';

                        //nessuna password inserita
                        elseif(isset($_GET['error_no_pass'])) echo '';

                        //nessuna conferma password inserita
                        elseif(isset($_GET['error_no_confirm'])) echo '';

                        //la password e la conferma non coincidono
                        elseif(isset($_GET['error_pass_confirm'])) echo '';

                        //errore SQL
                        elseif(isset($_GET['il_garbato_distruttore_colpisce_ancora'])) echo 'Errore tecnico.';

                        //nessun errore
                        else echo "";
                    ?>
                </span>

            </div>
        </form>
    </div>

    <img src="../assets/img/logo.png" class="frog">
</body>
</html>