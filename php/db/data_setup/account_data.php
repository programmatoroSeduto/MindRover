<?php

echo '<br><br>';
echo '>> --- IMPORTAZIONE Account utente --- <<';
echo '<br><br><br><br><br>';

/*
$data[] = array(
    'credenziali' => array(
        'email' => '',
        'password' => ''
    ),
    'profilo' => array(
        'nickname' => '',
        'nome' => '',
        'cognome' => '',
        'stato' => '',
        'descrizione' => '',
        'flag_anonimo' => false,
        'id_img_profilo' => 50
    ),
    'donazioni' => array(500, 250, 300, 24.50)
);
*/






require_once('./mysql_credentials.php');
$dbms = connect(true);

$query_credenziali = 'INSERT INTO credenziali_utenti(email, password) VALUES (?, ?)';
$query_profili = 'INSERT INTO profili_utenti(nickname, first_name, last_name, descrizione, stato, flag_anonimo, flag_autore, flag_supporter, id_img_profilo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
$query_donazioni = 'INSERT INTO donazioni(id_utente, somma_donazione, timestamp) VALUES (?, ?, ?)';

foreach($data as $k)
{
    
}
?>