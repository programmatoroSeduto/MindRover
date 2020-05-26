<?php
session_start();

//funzioni di libreria
require_once('./db/mysql_credentials.php');
require_once('./db/CredenzialiUtenti.php');
require_once('./db/ProfiliUtenti.php');
require_once('./db//ImgProfilo.php');
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
    
    if(!($firstname = verify_data("firstname")))
    {
        //echo "ERRORE: dato mancante. ->" . "firstname";
        header('location: ../html/registrazione.php?' . 'error=no_firstname');
        die();
    }
    if(!($lastname = verify_data("lastname")))
    {
        //echo "ERRORE: dato mancante. ->" . "lastname";
        header('location: ../html/registrazione.php?' . 'error=no_lastname');
        die();
    }
    if(!($email = verify_data("email")))
    {
        //echo "ERRORE: dato mancante. ->" . "email";
        header('location: ../html/registrazione.php?' . 'error=no_email');
        die();
    }
    if(!($pass = verify_data("pass")))
    {
        //echo "ERRORE: dato mancante. ->" . "pass";
        header('location: ../html/registrazione.php?' . 'error=no_password');
        die();
    }
    if(!($confirm = verify_data("confirm")))
    {
        //echo "ERRORE: dato mancante. ->" . "confirm";
        header('location: ../html/registrazione.php?' . 'error=no_password_confirm');
        die();
    }

    //posso verificare subito che le due password coincidano
    if($pass !== $confirm)
    {
        /*
        echo "ERRORE nella conferma delle password!<br>" 
            . "password: $pass <br>"
            . "conferma: $confirm<br>";
        */
        header('location: ../html/registrazione.php?' . 'error=invalid_confirm');
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
    //echo 'la mail ' . $email . ' esiste già nel database. REGISTRAZIONE RIFIUTATA.';
    header('location: ../html/registrazione.php?' . 'error=invalid_email');
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
    //echo "errore: " . $dbms->errno . ' ' . $dbms->error;
    header('location: ../html/registrazione.php?' . 'error=invalid_credentials');
    die();
}

//ottieni l'id appena registrato
$id_profilo = $table_credenziali->getId($email, $pass);
if($id_profilo == -1)
{
    //die("errore nella ricerca dell'id!");
    $table_credenziali->recoverWrongRegistration($email);
    header('location: ../html/registrazione.php?' . 'error=zampata_di_ganesh_il_dio_burlone');
    die();
}

//registrazione dei dati di profilo
if($errcode = $table_profili->createAccount($id_profilo, $nickname, $firstname, $lastname, (new ImgProfilo($dbms))->getFirstAvailableStyleId()))
{
    $table_credenziali->recoverWrongRegistration($email);
    header('location: ../html/registrazione.php?' . 'error=il_garbato_distruttore_colpisce_ancora');
    die();
}

//registrazione completata con successo; ora, fai qualcosa
header('location: ../html/login.php');

?>