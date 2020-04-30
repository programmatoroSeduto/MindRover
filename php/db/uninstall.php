<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disinstallazione Database</title>
</head>
<body>
    <h1>Rimozione tabelle dal database...</h1>

<?php
require_once('./mysql_credentials.php');
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


echo "--- tabella [profili_utenti] ---<br>";
if($profiliUtenti->exists())
{
    $profiliUtenti->destroyTable();
    echo 'ritorno ultima operazione:' . $dbms->errno . ' ' . $dbms->error . '<br>';
}
else
{
    echo 'la tabella non esiste. <br>';
}

echo "--- tabella [img_profilo] ---<br>";
if($imgProfilo->exists())
{
    $imgProfilo->destroyTable();
    echo 'ritorno ultima operazione:' . $dbms->errno . ' ' . $dbms->error . '<br>';
}
else
{
    echo 'la tabella non esiste. <br>';
}

echo "--- tabella [donazioni] ---<br>";
if($donazioni->exists())
{
    $donazioni->destroyTable();
    echo 'ritorno ultima operazione:' . $dbms->errno . ' ' . $dbms->error . '<br>';
}
else
{
    echo 'la tabella non esiste. <br>';
}

echo "--- tabella [articoli] ---<br>";
if($articoli->exists())
{
    $articoli->destroyTable();
    echo 'ritorno ultima operazione:' . $dbms->errno . ' ' . $dbms->error . '<br>';
}
else
{
    echo 'la tabella non esiste. <br>';
}

//installa le tabelle solo se non esistono ancora
echo "--- tabella [credenziali_utenti]---<br>";
if($credenzialiUtenti->exists())
{
    $credenzialiUtenti->destroyTable();
    echo 'ritorno ultima operazione:' . $dbms->errno . ' ' . $dbms->error . '<br>';
}
else
{
    echo 'la tabella non esiste. <br>';
}

/* ELIMINARE TABELLA IMMAGINI */

echo '>> --- Tabelle del database eliminate. --- <<';

//chiusura connessione
$dbms->close();
?>

</body>
</html>