<?php
session_start();

//importazione funzioni di libreria
require_once('./db/mysql_credentials.php');
require_once('./db/CredenzialiUtenti.php');
require_once('./db/ProfiliUtenti.php');
require_once('./db/Donazioni.php');
require_once('./db/ImgProfilo.php');

require_once('./utils/hashMethods.php');
require_once('./utils/sanitize_input.php');
require_once('./utils/sessionsUtils.php');

//ricavare e sanificare le informazioni dal client
$email = "";
$password = "";

function verify_data($data)
{
    if(isset($_POST[$data]))
    {
        if(strcmp('', $_POST[$data]) == 0)
            return null;
        else
            return sanitize($_POST[$data]);
    }
    else
    {
        return null;
    }
}

if(!($email = verify_data("email")))
{
    //echo "ERRORE: dato mancante. -> " . "email";
    header('location: ../html/login.php?error=no_email');
    die();
}

//verifica che la mail sia effettivamente una mail
if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) 
{
    header('location: ../html/login.php?error=invalid_email');
    die();
}

if(!($password = verify_data("pass")))
{
    //echo "ERRORE: dato mancante. -> " . "pass";
    header('location: ../html/login.php?error=no_password');
    die();
}

//interfacce col database
$hash = new HashMethods();
$dbms = connect();
$table_credenziali = new CredenzialiUtenti($dbms, $hash);

//tento di ottenere l'id dell'utente che vorrebbe loggarsi
$user_id = $table_credenziali->getId($email, $password);

//verifico che l'utente esista
if($user_id < 0)
{
    //errore durante l'accesso
    header('location: ../html/login.php?error=invalid_data');
    die();
}

//l'utente esiste! carico tutti i dati sulla sessione
$password_hash = $hash->getHash($password);
openSession($user_id, $email, $password, $password_hash, new ProfiliUtenti($dbms), new Donazioni($dbms), new ImgProfilo($dbms));

header('location: ../html/profiloprivato.php');
?>