<?php
session_start();

//funzioni di libreria
require_once('./db/mysql_credentials.php');
require_once('./db/CredenzialiUtenti.php');
require_once('./db/ProfiliUtenti.php');
require_once('./utils/hashMethods.php');
require_once('./utils/sanitize_input.php');

$hash = new HashMethods();

//controllo delle informazioni in ingresso
$email = "";
$firstname = "";
$lastname = "";
$pass = "";
{
    $confirm = "";

    //verifica delle informazioni provenienti dal client
    //se qualcosa manca, ritorna messaggio d'errore e chiudi lo script
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
        echo "ERRORE: dato mancante. ->" . "email";
        die();
    }
    if(!($firstname = verify_data("firstname")))
    {
        echo "ERRORE: dato mancante. ->" . "firstname";
        die();
    }
    if(!($lastname = verify_data("lastname")))
    {
        echo "ERRORE: dato mancante. ->" . "lastname";
        die();
    }
    if(!($pass = verify_data("pass")))
    {
        echo "ERRORE: dato mancante. ->" . "pass";
        die();
    }
    if(!($confirm = verify_data("confirm")))
    {
        echo "ERRORE: dato mancante. ->" . "confirm";
        die();
    }

    //posso verificare subito che le due password coincidano
    if($pass !== $confirm)
    {
        echo "ERRORE nella conferma delle password!<br>" 
            . "password: $pass <br>"
            . "conferma: $confirm<br>";
        die();
    }
}

//hashare la password prima di metterla nel db
$hashOfPass = $hash->getHash($pass);

//connessione col database
$dbms = connect();
$table_credenziali = new CredenzialiUtenti($dbms, $hash);
$table_profili = new ProfiliUtenti($dbms);

//verifica prima che la mail non esista già
if($table_credenziali->isSetEmail($email))
{
    //l'email esiste già; rifiuta la registrazione
    echo 'la mail ' . $email . ' esiste già nel database. REGISTRAZIONE RIFIUTATA.';
    die();
}

//registrazione del profilo nel database
if($table_credenziali->createAccount($email, $hashOfPass) === -1)
{
    echo "errore: " . $dbms->errno . ' ' . $dbms->error;
    die();
}

//ottieni l'id appena registrato
$id_profilo = $table_credenziali->getId($email, $pass);
if($id_profilo === -1)
{
    die("errore nella ricerca dell'id!");
}

//registra dati di profilo
$table_profili->createAccount($id_profilo, '' . $firstname . $lastname, $firstname, $lastname);

//registrazione completata con successo; ora, fai qualcosa
echo 'registrazione completata.';

?>