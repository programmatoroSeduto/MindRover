<?php
session_start();

//controlla prima che sia stato fatto il login
if(!isset($_SESSION['user_id']))
{
    echo "nessun login effettuato! chiusura...";
    die();
}

//ritorna email, nome e cognome
echo "data: " . $_SESSION['email'] . ' ' . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . '.';

?>