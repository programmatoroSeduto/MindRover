<?php

//input
$autore = $_GET['nick'];
$titolo = $_GET['titolo'];
$sottotitolo = $_GET['sottotitolo'];
$descrizione = $_GET['descrizione'];
$contenuto = $_GET['contenuto'];

$danger = strpos($contenuto, '<script') || strpos($contenuto, '<link') || strpos($contenuto, '<meta') || strpos($descrizione, '<script') || strpos($descrizione, '<link') || strpos($descrizione, '<meta') || strpos($sottotitolo, '<script') || strpos($sottotitolo, '<link') || strpos($sottotitolo, '<meta') || strpos($titolo, '<script') || strpos($titolo, '<link') || strpos($titolo, '<meta');

if($danger)
{
    header('location: ../../html/comingsoon.php?error=accesso_negato');
    die();
}

//$data_pubblicazione = $_GET['data'];
//$orario_pubblicazione = $_GET['ora'];
$tags = $_GET['tags'];

//$dataeora = (new DateTime($data_pubblicazione . ' ' . $orario_pubblicazione))->format('Y/m/d h:i:s');

//librerie
require_once('./mysql_credentials.php');
require_once('./ProfiliUtenti.php');
require_once('./Articoli.php');

$dbms = connect();
$articoli = new Articoli($dbms);
$profili = new ProfiliUtenti($dbms);

//inserimento
$tags = implode(";", explode(' ', $tags));
$autore = $profili->getIdByNickname($autore);
if($autore < 0)
{
    echo "ERRORE durante la ricerca dell'id dell'autore.";
    die();
}

$query = 'INSERT INTO articoli (id_autore, titolo, sottotitolo, descrizione, contenuto, lista_tag) VALUES (?, ?, ?, ?, ?, ?);';

$dbms_op = $dbms->prepare($query);
if(!$dbms_op->bind_param("isssss", $autore, $titolo, $sottotitolo, $descrizione, $contenuto, $tags))
{
    echo 'ERRORE nel binding! (' . $dbms->errno . ') ' . $dbms->error;
    die();
}
$dbms_op->execute();

echo 'operazione conclusa. (' . $dbms->errno . ') ' . $dbms->error . '<br>';
//var_dump($_GET);

header('location: ../../html/profiloprivato.php');
?>