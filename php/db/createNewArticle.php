<?php

//input
$autore = $_GET['nick'];
$titolo = $_GET['titolo'];
$sottotitolo = $_GET['sottotitolo'];
$descrizione = $_GET['descrizione'];
$contenuto = $_GET['contenuto'];
$data_pubblicazione = $_GET['data'];
$orario_pubblicazione = $_GET['ora'];
$tags = $_GET['tags'];

$dataeora = (new DateTime($data_pubblicazione . ' ' . $orario_pubblicazione))->format('Y/m/d h:i:s');

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

$query = 'INSERT INTO articoli (id_autore, titolo, sottotitolo, descrizione, contenuto, lista_tag, data_pubblicazione) VALUES (?, ?, ?, ?, ?, ?, ?);';

$dbms_op = $dbms->prepare($query);
if(!$dbms_op->bind_param("issssss", $autore, $titolo, $sottotitolo, $descrizione, $contenuto, $tags, $dataeora))
{
    echo 'ERRORE nel binding! (' . $dbms->errno . ') ' . $dbms->error;
    die();
}
$dbms_op->execute();

echo 'operazione conclusa. (' . $dbms->errno . ') ' . $dbms->error . '<br>';
var_dump($_GET);

?>