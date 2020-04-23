<?php
session_start();

//chiudi subito lo script se non c'è alcuna sessione aperta
if(!isset($_SESSION['user_id']))
{
    echo "nessuna sessione aperta! chiusura...";
    die();
}

//distruggi e salva i dati di profilo
session_unset();

//distruggi la sessione
session_destroy();

header('location: ../html/homepage.php');
?>