<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installazione Database</title>
</head>
<body>
    <h1>Creazione Database...</h1>

<?php
require_once('./mysql_credentials.php');
{
require_once('./CredenzialiUtenti.php');
require_once('./ProfiliUtenti.php');
require_once('./Donazioni.php');
require_once('./Articoli.php');
require_once('./ImgProfilo.php');
require_once('../utils/HashMethods.php');


$hashMethods = new HashMethods();
$dbms = connect(true);


//interfacce per le tabelle
$credenzialiUtenti = new CredenzialiUtenti($dbms, $hashMethods);
$profiliUtenti = new ProfiliUtenti($dbms);
$donazioni = new Donazioni($dbms);
$articoli = new Articoli($dbms);
$imgProfilo = new ImgProfilo($dbms);


//installa le tabelle solo se non esistono ancora
echo "--- creazione tabella [credenziali_utenti]---<br>";
if(!$credenzialiUtenti->exists())
{
    $credenzialiUtenti->createTable();
    echo 'ritorno ultima operazione:' . $dbms->errno . ' ' . $dbms->error . '<br>';
}
else
{
    echo 'la tabella esiste già nel database. <br>';
}


echo "--- creazione tabella [img_profilo]---<br>";
if(!$imgProfilo->exists())
{
    $imgProfilo->createTable();
    echo 'ritorno ultima operazione:' . $dbms->errno . ' ' . $dbms->error . '<br>';
}
else
{
    echo 'la tabella esiste già nel database. <br>';
}


echo "--- creazione tabella [profili_utenti]---<br>";
if(!$profiliUtenti->exists())
{
    $profiliUtenti->createTable();
    echo 'ritorno ultima operazione:' . $dbms->errno . ' ' . $dbms->error . '<br>';
}
else
{
    echo 'la tabella esiste già nel database. <br>';
}


echo "--- creazione tabella [donazioni]---<br>";
if(!$donazioni->exists())
{
    $donazioni->createTable();
    echo 'ritorno ultima operazione:' . $dbms->errno . ' ' . $dbms->error . '<br>';
}
else
{
    echo 'la tabella esiste già nel database. <br>';
}


echo "--- creazione tabella [articoli]---<br>";
if(!$articoli->exists())
{
    $articoli->createTable();
    echo 'ritorno ultima operazione:' . $dbms->errno . ' ' . $dbms->error . '<br>';
}
else
{
    echo 'la tabella esiste già nel database. <br>';
}

echo '>> --- Database creato. --- <<';

//chiusura connessione
$dbms->close();
}

{
    require_once('./data_setup/preset_styles.php');
}

{
    require_once('./data_setup/account_data.php');
}

{
    require_once('./data_setup/articles_data.php');
}
?>

<br>
<br>
<br>
<br>
<br>
<br>
<br>

</body>
</html>






