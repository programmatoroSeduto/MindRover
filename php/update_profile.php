<?php
/*
    NOTE:
    -   si possono modificare tutte le impostazioni di profilo in un colpo solo, ma
    -   si può modificare una sola credenziale alla volta
    -   i campi con stringhe vuote vengono ignorati
    
    --- MODIFICA CREDENZIALI ---
    >> modifica email
    -   email -- la nuova email
    -   password -- la password usata per accedere all'account

    >> modifica password
    -   email -- la mail attuale
    -   password -- la vecchia password
    -   new_password -- la nuova password
    -   confirm_password -- la conferma della nuova password

    --- MODIFICA IMPOSTAZIONI DI PROFILO ---
    >>nickname
    -   nickname (str)

    >> nome
    -   firstname (str)

    >> cognome
    -   lastname (str)

    >> descrizione
    -   description (str)

    >> stato
    -   status (str)

    >> anonimato
    -   anonimo (1 o 0)

    >> stile di profilo
    -   id_stile (int)
*/



session_start();

//controlla che sia stato fatto il login
if(!isset($_SESSION['user_id']))
{
    //echo "ERRORE: nessun login effettuato. impossibile modificare le impostazioni.";
    header('location: ../html/login.php');
    die();
}

//funzioni di libreria
require_once('./db/mysql_credentials.php');
require_once('./db/CredenzialiUtenti.php');
require_once('./db/ProfiliUtenti.php');
require_once('./db/ImgProfilo.php');

require_once('./utils/hashMethods.php');
require_once('./utils/sanitize_input.php');
require_once('./utils/sessionsUtils.php');

//interfaccia col database
$hash = new HashMethods();
$dbms = connect();
$credenziali = new CredenzialiUtenti($dbms, $hash);
$profili = new ProfiliUtenti($dbms);
$imgProfilo = new ImgProfilo($dbms);

//funzioni per purificare l'input
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

// --- modifica impostazioni di profilo
//new_password
/*
    informazioni richieste:
        -   email
        -   password
        -   new_password
        -   confirm_password
*/
function setNewPassword()
{
    global $profili;
    global $credenziali;

    if(isset($_POST['new_password']))
    {
        //la nuova informazione da inserire nel database
        $new_password = sanitize($_POST['new_password']);

        //per la modifica della password sono richiesti email, vecchia password e conferma della nuova password
        $email = "";
        $old_password = "";
        $confirm_password = "";

        if(!isset($_POST['email']))
        {
            //echo "set password OPERAZIONE FALLITA: email mancante.";
            //echo 1;
            header('location: ../html/profiloprivato.php');
            die();
        }
        $email = sanitize($_POST['email']);

        if(!isset($_POST['password']))
        {
            //echo "set password OPERAZIONE FALLITA: password mancante.";
            header('location: ../html/profiloprivato.php');
            die();
        }
        $old_password = sanitize($_POST['password']);

        if(!isset($_POST['confirm_password']))
        {
            //echo "set password OPERAZIONE FALLITA: confirm_password mancante.";
            header('location: ../html/profiloprivato.php');
            die();
        }
        $confirm_password = sanitize($_POST['confirm_password']);

        //controllo che la password sia corretta (uso le informazioni di sessione)
        if(strcmp($old_password, $_SESSION['password']))
        {
            //echo "set password OPERAZIONE FALLITA: errore durante l'operazione. chiusura...";
            header('location: ../html/profiloprivato.php');
            die();
        }

        //inserisco il dato nel database
        if($errcode = $credenziali->setPassword($_SESSION['user_id'], $old_password, $new_password, $confirm_password))
        {
            /*
            echo "set password OPERAZIONE FALLITA: inserimento rifiutato.<br>";
            echo 'errore: codice(' . $errcode . ') -- codice SQL('. $dbms->errno . ") -- " . $dbms->error;
            */
            header('location: ../html/profiloprivato.php');
            die();
        }

        //cambio le informazioni di sessione
        $_SESSION['password'] = $new_password;
        $_SESSION['password_hash'] = $credenziali->getPassword($_SESSION['user_id']);

        //conferma operazione
        //echo "set password OPERAZIONE RIUSCITA. <br>";
        header('location: ../html/profiloprivato.php');

        //non è possibile modificare altre opzioni, una sola credenziale alla volta
        die();
    }
}
//email
/*
    richiede:
    -   email
    -   password
*/
function setNewEmail()
{
    global $profili;
    global $credenziali;
    
    if(isset($_POST['email']))
    {
        //la nuova informazione da inserire nel database
        $email = sanitize($_POST['email']);

        //per la verifica della mail è richiesta anche la password
        $password = "";

        if(!isset($_POST['password']))
        {
            //echo "set email OPERAZIONE FALLITA: password mancante.";
            header('location: ../html/profiloprivato.php');
            die();
        }
        $password = sanitize($_POST['password']);

        //controllo che la password sia corretta (uso le informazioni di sessione)
        if(strcmp($password, $_SESSION['password']))
        {
            //echo "set email OPERAZIONE FALLITA: errore durante l'operazione. chiusura...";
            header('location: ../html/profiloprivato.php');
            die();
        }

        //controllo prima che non esistano altre mail nel database uguali a quella che si vuole inserire
        if($credenziali->isSetEmail($_POST['email']))
        {
            //echo "set email OPERAZIONE FALLITA: la mail esiste già nel database.";
            header('location: ../html/profiloprivato.php');
            die();
        }

        //inserisco la nuova email nel database
        if($errcode = $credenziali->setEmail($_SESSION['user_id'], $email))
        {
            /*
            echo "set email OPERAZIONE FALLITA: impossibile inserire il dato.<br>";
            echo 'errore: codice(' . $errcode . ') -- codice SQL('. $dbms->errno . ") -- " . $dbms->error;
            */
            header('location: ../html/profiloprivato.php');
            die();
        }

        //modifico le informazioni di sessione
        $_SESSION['email'] = $email;

        //conferma l'operazione
        //echo "set email OPERAZIONE RIUSCITA --- nuova email: " . $_SESSION['email'] . "<br>";
        header('location: ../html/profiloprivato.php');

        //non è possibile modificare altre opzioni, una sola credenziale alla volta
        die();
    }
}

//nickname
function setNewNickname()
{
    global $profili;
    global $credenziali;
    
    if(isset($_POST['nickname']))
    {
        //purificare l'input
        $nickname = sanitize($_POST['nickname']);

        if($nickname !== "") 
        {
            //verifico prima che il nickname scelto sia unico
            $test = $profili->isSetNickname($nickname);
            if($test === null)
            {
                //echo "set nickname PROBLEMA TECNICO.";
                header('location: ../html/profiloprivato.php');
                die();
            }
            elseif($test)
            {
                //echo "set nickname OPERAZIONE FALLITA: il nickname è già stato preso da un altro profilo.";
                header('location: ../html/profiloprivato.php');
                die();
            }

            //modifica l'impostazione
            if($profili->setNickname($_SESSION['user_id'], $nickname))
            {
                //operazione fallita
                //echo "set nickname OPERAZIONE FALLITA: (" . $dbms->errno . ") " . $dbms->error;
                header('location: ../html/profiloprivato.php');
                die();
            }

            //modifica i dati di profilo
            $_SESSION['nickname'] = $nickname;
            
            //conferma l'operazione
            //echo "set nickname OPERAZIONE RIUSCITA --- nuovo nickname: " . $_SESSION['nickname'] . "<br>";
            header('location: ../html/profiloprivato.php');
        }
    }
}

//firstname
function setNewFirstname()
{
    global $profili;
    global $credenziali;

    //var_dump($_POST);
    
    if(isset($_POST['firstname']))
    {
        //purificare l'input
        $firstname = sanitize($_POST['firstname']);

        //echo $firstname;

        if($firstname !== "")
        {
            //modifica l'impostazione
            if($profili->setFirstName($_SESSION['user_id'], $firstname))
            {
                //operazione fallita
                //echo "set firstname OPERAZIONE FALLITA: (" . $dbms->errno . ") " . $dbms->error;
                header('location: ../html/profiloprivato.php');
                die();
            }

            //modifica i dati di profilo
            $_SESSION['firstname'] = $firstname;
            
            //conferma l'operazione
            //echo "set firstname OPERAZIONE RIUSCITA --- nuovo firstname: " . $_SESSION['firstname'] . "<br>";
            header('location: ../html/profiloprivato.php');
        }
    }
}

//lastname
function setNewLastname()
{
    global $profili;
    global $credenziali;
    
    if(isset($_POST['lastname']))
    {
        //purificare l'input
        $lastname = sanitize($_POST['lastname']);
        
        if($lastname !== "")
        {
            //modifica l'impostazione
            if($profili->setLastName($_SESSION['user_id'], $lastname))
            {
                //operazione fallita
                //echo "set lastname OPERAZIONE FALLITA: (" . $dbms->errno . ") " . $dbms->error;
                header('location: ../html/profiloprivato.php');
                die();
            }

            //modifica i dati di profilo
            $_SESSION['lastname'] = $lastname;
            
            //conferma l'operazione
            //echo "set lastname OPERAZIONE RIUSCITA --- nuovo lastname: " . $_SESSION['lastname'] . "<br>";
            header('location: ../html/profiloprivato.php');
        }
    }
}

//descrizione
function setNewDescription()
{
    global $profili;
    global $credenziali;
    
    if(isset($_POST['description']))
    {
        //purificare l'input
        $descr = sanitize($_POST['description']);

        if($descr !== "")
        {
            //modifico l'impostazione
            if($profili->setDescription($_SESSION['user_id'], $descr))
            {
                //operazione fallita
                //echo "set description OPERAZIONE FALLITA: (" . $dbms->errno . ") " . $dbms->error;
                header('location: ../html/profiloprivato.php');
                die();
            }

            //modifico i dati di sessione
            $_SESSION['descr'] = $descr;

            //conferma operazione
            //echo "set description OPERAZIONE RIUSCITA --- nuova descrizione: <br><p>" . $_SESSION['descr'] . "</p>";
            header('location: ../html/profiloprivato.php');
        }
    }
}

//stato
function setNewStatus()
{
    global $profili;
    global $credenziali;
    
    if(isset($_POST['status']))
    {
        //purificare l'input
        $status = sanitize($_POST['status']);

        if($status !== "")
        {
            //modifico l'impostazione
            if($profili->setStatus($_SESSION['user_id'], $status))
            {
                //operazione fallita
                //echo "set status OPERAZIONE FALLITA: (" . $dbms->errno . ") " . $dbms->error;
                header('location: ../html/profiloprivato.php');
                die();
            }

            //modifico i dati di sessione
            $_SESSION['status'] = $status;

            //conferma operazione
            //echo "set status OPERAZIONE RIUSCITA --- nuovo stato: " . $_SESSION['status'] . "<br>";
            header('location: ../html/profiloprivato.php');
        }
    }
}

//is_anonymous
/*
    passa ad argomento 'true' o 'false'
*/
function setNewAnonymousFlag()
{
    global $profili;
    global $credenziali;

    //var_dump($_SESSION);
    
    if(isset($_POST['anonimo']) || isset($_GET['anonimo']))
    {
        //l'informazione
        $flag = true;
        if(isset($_POST['anonimo']))
            $flag = (($_POST['anonimo'] != 0) ? true : false);
        else
            $flag = (($_GET['anonimo'] != 0) ? true : false);
        /*
        if($flag)
        {
            echo 'flag: true';
        }
        else
        {
            echo 'flag: false';
        }
        */

        //verifico che l'opzione sia effettivamente cambiata
        if($_SESSION['is_anonymous'] === $flag)
        {
            //echo "set anonymous WARNING: nulla da cambiare! chiusura...";
            header('location: ../html/profiloprivato.php');
            die();
        }

        //cambio l'impostazione nel database
        //modifico l'impostazione
        if($profili->setAnonymous($_SESSION['user_id'], $flag))
        {
            //operazione fallita
            //echo "set anonymous OPERAZIONE FALLITA: (" . $dbms->errno . ") " . $dbms->error;
            header('location: ../html/profiloprivato.php');
            die();
        }

        //modifico le informazioni di sessione
        $_SESSION['is_anonymous'] = $flag;

        //conferma operazione
        /*
        echo "set anonymous OPERAZIONE RIUSCITA --- ";    
        $flag ? print("ora sei anonimo.") : print("non sei più anonimo.") ;
        echo "<br>";
        */
        header('location: ../html/profiloprivato.php');
    }
}

//id_stile
function setStyle()
{
    global $profili;
    global $imgProfilo;

    if(isset($_POST['id_stile']) || isset($_GET['id_stile']))
    {
        //l'informazione
        /** TODO try/catch per eventuali eccezioni nella conversione numerica? */
        $style_id = '';
        if(isset($_POST['id_stile']))
            $style_id = (int) sanitize($_POST['id_stile']);
        else
            $style_id = (int) sanitize($_GET['id_stile']);

        //controllo che l'indice sia valido; se non lo è, prendo il primo disponibile
        if(!$imgProfilo->isValidId($style_id)) $style_id = $imgProfilo->getFirstAvailableStyleId();

        //verifico che l'opzione sia veramente cambiata
        if($_SESSION['style_id'] == $style_id)
        {
            echo "set stile WARNING: nulla da cambiare! chiusura...";
            header('location: ../html/profiloprivato.php');
            die();
        }

        //cambio l'impostazione nel database
        if($profili->setProfileStyle($_SESSION['user_id'], $style_id))
        {
            //operazione fallita
            //echo "set stile OPERAZIONE FALLITA: (" . $dbms->errno . ") " . $dbms->error;
            header('location: ../html/profiloprivato.php');
            die();
        }

        //informazioni di sessione
        $_SESSION['style_id'] = $style_id;
        $_SESSION['style_data'] = $imgProfilo->getStyle($style_id);

        //conferma operazione
        //echo "set stile OPERAZIONE RIUSCITA" . "<br>";
        header('location: ../html/profiloprivato.php');

        //var_dump($_SESSION);
    }
}

setNewPassword();
setNewEmail();
setNewFirstname();
setNewLastname();
setNewNickname();
setNewStatus();
setNewDescription();
setNewAnonymousFlag();
setStyle();

//header('location: ../html/profiloprivato.php');
?>