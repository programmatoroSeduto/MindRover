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

    <!-- METADATI -->
    <link rel="icon" href="../assets/img/frog-icon.png">
    <meta name="author" content="Francesco Ganci, Lorenzo Terranova">
    <meta name="description" content="Bentornato amico mio! Fai subito qui il login!">

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
        <h1 style="line-height: 5rem; font-family: ganesh">Login</h1><br>
        <form action="../php/login.php" method="POST">
            <div class="loginform-body">
                <?php
                    if(isset($_GET['target']))
                        echo '<input name="target" style="display: none;" value="' . $_GET['target'] . '">';
                ?>
                <!-- <label for="email">Email: </label><input type="email" name="email"> -->
                <div class="form-container">
                    <input type="email" name="email" placeholder="Email" class="form">
                    <i class="fas fa-envelope" style="top: 2.2vh"></i>
                </div>
                <!-- <label for="pass">Password: </label><input type="password" name="pass"> -->
                <div class="form-container">
                    <input type="password" name="pass" placeholder="Password" class="form">
                    <i class="fas fa-key" style="top: 2.2vh"></i>
                </div>
            </div>
            <div class="loginform-submit">
                <!-- <input class="submin-button" type="submit" value="Accedi"> -->
                <input class="d text-content modifica" type="submit" value="Accedi" style="background-color: transparent; border-style: none;"></input>
                
                <span class="auth-error">
                    <?php
                        if(isset($_GET['error']))
                        {
                            echo '<p><b>ERRORE:</b> ';
                            switch($_GET['error'])
                            {
                                case 'no_email':
                                    echo 'non hai inserito la tua mail!';
                                break;
                                case 'invalid_email':
                                    echo 'mail non valida.';
                                break;
                                case 'no_password':
                                    echo 'non hai immesso la tua password!';
                                break;
                                case 'invalid_data':
                                    echo 'questo profilo non esiste.';
                                break;
                                default:
                                    echo 'errore tecnico. Torna più tardi ... se pensi ci sia un errore, contattaci!';
                            }
                            echo '<p>';
                        }
                        elseif(isset($_GET['info']))
                        {
                            switch($_GET['info'])
                            {
                                case 'crowdfunding_no_login':
                                    echo '<p><b>Attenzione:</b> ';
                                    echo 'devi essere loggato per poter fare una donazione.';
                                    echo '<p>';
                                break;
                            }
                        }
                        else
                        {
                            echo '';
                        }
                    ?>
                </span>

            </div>
        </form>
        
        <p class="register-here">Non ancora registrato? <a href="./registrazione.php" class="d text-content modifica"><i>Provvedi subito!</i></a></p>
    </div>

    <img src="../assets/img/logo.png" class="frog">
</body>
</html>