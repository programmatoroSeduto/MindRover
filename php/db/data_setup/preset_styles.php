<?php

/* TEMPLATE PER L'NSERIMENTO DI DATI NEL DATABASE
$data[] = array(
    'path' => '../assets/avatar/ ', 
    'banner' => array(255, 0, 0),
    'colore1' => array(255, 0, 0),
    'colore1' => array(255, 0, 0)
);
*/

//path, banner, colore1, colore2
$data[] = array(
    'path' => '../assets/avatar/fagiolo.png', 
    'banner' => array(255, 0, 0),
    'colore1' => array(255, 0, 0),
    'colore1' => array(255, 0, 0)
);
/*
    INSERISCI AL POSTO DI QUESTO COMMENTO tutte le altre ennuple.
*/

//inserimento nel database
require_once('../ImgProfilo.php');
require_once('../mysqli_credentials.php');

$imgs = new ImgProfilo(connect());

foreach($data as $k)
{
    if($err = $img->addNewStyle($k['path'], $k['colore1'], $k['colore2'], $k['banner']))
    {
        echo 'ERRORE! impossibile inserire la seguente: path(' . $k['path'] . ') colore1(' . implode(', ', $k['colore1']) . ') colore2(' . implode(', ', $k['colore2']) . ') banner(' . implode(', ', $k['banner']) . ')<br>';
        echo "codice d'errore " . $err . ' codice SQL ' . $img->dbms->errno . ' errore: ' . $img->dbms->error . '<br>';
    }
}
?>
