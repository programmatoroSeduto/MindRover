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
    echo "ERRORE: dato mancante. -> " . "email";
    die();
}
if(!($password = verify_data("pass")))
{
    echo "ERRORE: dato mancante. -> " . "pass";
    die();
}

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
    echo "<h1>Qualcosa è andato storto durante l'accesso...</h1>";
    echo '<p>SQL: codice(' . $dbms->errno . ') <i>' . $dbms->error . '</i></p>';
    die();
}

//l'utente esiste! carico tutti i dati sulla sessione
$password_hash = $hash->getHash($password);
openSession($user_id, $email, $password, $password_hash, $table_profili, new Donazioni($dbms));

echo "accesso effettuato.";
?>