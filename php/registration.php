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

//prima di registrare l'utente, gli assegno automaticamente un nickname
/*
    per garantire l'unicità del nickname assegnato automaticamente dal sistema,
    1-  provo prima con nomecognome; se esiste ...
    2-  provo con nomecognome<codice di 4 cifre>; se esiste...
    3-  faccio le seguenti prove fin quando non trovo il nickname giusto:
        a-  aumento di 1 il codice generato (sempre di 4 cifre) per un tot di tentativi; ad ogni tentativo provo il nuovo nick generto; se ancora non va ...
        b-  genero random il codice e provo; se ancora non va bene, torno al passo a-
    
    continuo così fin quando non sono riuscito a trovare il nickname giusto; questo potrebbe portare a qualche problema...
    ... ma quante persone vuoi che ci siano di nome MarioRossi? ho 8999 codici! è possibile avere 8999 posti occupati? per un sito così piccolo, no...
*/
$nickname = '' . $firstname . $lastname;
if($table_profili->getIdByNickname($nickname) >= 0)
{
    $random_code = rand(1000, 9999);
    $nickname = '' . $firstname . $lastname . $random_code;

    $n_attemps = 5;
    $counter = $n_attemps;
    while($table_profili->getIdByNickname($nickname) >= 0)
    {
        if($counter > 0)
        {
            $random_code = ($random_code == 9999 ? 1000 : $random_code + 1);
            $counter--;
        }
        else
        {
            $random_code = rand(1000, 9999);
            $counter = $n_attemps;
        }
        $nickname = '' . $firstname . $lastname . $random_code;
    }
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

//registrazione dei dati di profilo
$table_profili->createAccount($id_profilo, $nickname, $firstname, $lastname);

//registrazione completata con successo; ora, fai qualcosa
echo 'registrazione completata.';

?>