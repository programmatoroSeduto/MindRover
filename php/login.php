<?php
session_start();

//importazione funzioni di libreria
require_once('./db/mysql_credentials.php');
require_once('./db/CredenzialiUtenti.php');
require_once('./db/ProfiliUtenti.php');
require_once('./db/Donazioni.php');

require_once('./utils/hashMethods.php');
require_once('./utils/sanitize_input.php');
require_once('./utils/sessionsUtils.php');

//ricavare e sanificare le informazioni dal client
$email = "";
$password = "";
$error = false;

function verify_data($data)
{
    if(isset($_POST[$data]))
    {
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
    header('location: ../html/login.php?error_email=true');
    $error = true;
}
if(!($password = verify_data("pass")))
{
    //echo "ERRORE: dato mancante. -> " . "pass";
    if($error)
    {
        header('location: ../html/login.php?error_pass=true&error_email=true');
    }
    else
        header('location: ../html/login.php?error_pass=true');
    $error = true;
}

//termina lo script in caso di errore
if($error) /*when table deserves to */die();

//interfacce col database
$hash = new HashMethods();
$dbms = connect();
$table_credenziali = new CredenzialiUtenti($dbms, $hash);
$table_profili = new ProfiliUtenti($dbms);

//tento di ottenere l'id dell'utente che vorrebbe loggarsi
$user_id = $table_credenziali->getId($email, $password);

//verifico che l'utente esista
if($user_id < 0)
{
    //errore durante l'accesso
    header('location: ../html/login.php?error=true');
    die();
}

//l'utente esiste! carico tutti i dati sulla sessione
$password_hash = $hash->getHash($password);
openSession($user_id, $email, $password, $password_hash, $table_profili, new Donazioni($dbms));

header('location: ../html/profiloprivato.php');
?>