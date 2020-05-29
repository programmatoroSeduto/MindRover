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

    <!-- METADATI -->
    <link rel="icon" href="../assets/img/frog-icon.png">
    <meta name="author" content="Francesco Ganci, Lorenzo Terranova">
    <meta name="description" content="Non sei ancora registrato? Provvedi subito ed entra nella grande e calorosa famiglia di Frog Studios!">

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
                <div class="form-container">
                    <input type="text" name="firstname" placeholder="Nome" class="form">
                    <i class="fas fa-signature"></i>
                </div>
                <div class="form-container">
                    <input type="text" name="lastname" placeholder="Cognome" class="form">
                    <i class="fas fa-signature"></i>
                </div>
                <div class="form-container">
                    <input type="email" name="email" placeholder="Email" class="form">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="form-container">
                    <input type="password" name="pass" placeholder="Password" class="form">
                    <i class="fas fa-key"></i>
                </div>
                <div class="form-container">
                    <input type="password" name="confirm" placeholder="Conferma password" class="form">
                    <i class="fas fa-key"></i>
                </div>
            </div>

            <div class="loginform-submit">
                <input class="d text-content modifica" type="submit" value="Registrati!" style="background-color: transparent; border-style: none;"></input>
                
                <span class="auth-error"><p>
                    <?php
                        if(isset($_GET['error']))
                        {
                            echo '<b>Errore: </b>';
                            switch($_GET['error'])
                            {
                                case 'no_email':
                                    echo 'nessuna mail inserita!';
                                break;
                                case 'no_firstname':
                                    echo 'non hai inserito il tuo nome.';
                                break;
                                case 'no_lastname':
                                    echo 'non hai inserito il tuo cognome';
                                break;
                                case 'no_password':
                                    echo 'nessuna password inserita';
                                break;
                                case 'no_password_confirm':
                                    echo 'manca la conferma della password.';
                                break;
                                case 'invalid_confirm':
                                    echo 'hai inserito due password non uguali, conferma fallita. Spiace? Spiace.';
                                break;
                                case 'invalid_email':
                                    echo 'Questa mail è già stata presa. How about <i>dangerous.avocado@mango.kek</i> ?';
                                break;
                                case 'invalid_credentials':
                                    echo 'impossibile creare i tuoi dati di profilo. Riprova, oppure contattaci se hai problemi.';
                                break;
                                case 'zampata_di_ganesh_il_dio_burlone':
                                    echo 'impossibile creare le tue credenziali. Riprova, oppure contattaci!';
                                break;
                                case 'il_garbato_distruttore_colpisce_ancora':
                                    echo 'impossibile generare il tuo profilo. Riprova, oppure contattaci!';
                                break;
                                default: 
                                    echo 'c\'è stato un problema tecnico. Se pensi che ci sia un bug, contattaci!';
                            }
                        }
                        else
                        {
                            echo '';
                        }
                    ?>
                </p></span>

            </div>
        </form>
        <p class="register-here">Hai già un account? <a href="./login.php" class="d text-content modifica"><i>Accedi subito!</i></a></p>
    </div>

    <img src="../assets/img/logo.png" class="frog">
</body>
</html>