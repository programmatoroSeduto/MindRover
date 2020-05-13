<?php

$data = array();

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
        'id_img_profilo' => -1
    ),
    'donazioni' => array()
);
*/

$data[] = array(
    'credenziali' => array(
        'email' => 'a@b.c',
        'password' => 'abc'
    ),
    'profilo' => array(
        'nickname' => 'signorSignaro',
        'nome' => 'Bella',
        'cognome' => 'Greg',
        'stato' => 'la password è abc.',
        'descrizione' => 'nient\'altro da aggiungere ... bella greg.',
        'flag_anonimo' => false,
        'id_img_profilo' => 4
    ),
    'donazioni' => array(500, 250, 300, 24.50)
);

$data[] = array(
    'credenziali' => array(
        'email' => 'test@test.t',
        'password' => 'test'
    ),
    'profilo' => array(
        'nickname' => 'BellaGreg',
        'nome' => 'Bella',
        'cognome' => 'Greg',
        'stato' => 'Bella greg?',
        'descrizione' => 'Bella greg.',
        'flag_anonimo' => false,
        'id_img_profilo' => -1
    ),
    'donazioni' => array(500, 250, 300, 24.50)
);











































require_once('./mysql_credentials.php');
require_once('./CredenzialiUtenti.php');
require_once('./ProfiliUtenti.php');
require_once('./Donazioni.php');
require_once('./ImgProfilo.php');
require_once('./../utils/hashMethods.php');
require_once('./../utils/sanitize_input.php');
$dbms = connect(true);
$hash = new HashMethods();

//connessione col database
$table_credenziali = new CredenzialiUtenti($dbms, $hash);
$table_profili = new ProfiliUtenti($dbms);
$table_donazioni = new Donazioni($dbms);
$table_stili = new ImgProfilo($dbms);
$id_stili = array_map(function($elem){return $elem['id'];}, $table_stili->getAllStyles());

$i = 1;
foreach($data as $k)
{
    echo '--- (' . $i . ') ---';

    if($table_credenziali->isSetEmail($k['credenziali']['email']))
    {
        echo 'la mail esiste già: ' . $k['credenziali']['email'] . '<br>';
        continue;
    }

    if($table_profili->getIdByNickname($k['profilo']['nickname']) >= 0)
    {
        echo 'nickname ' . $k['profilo']['nickname'] . 'già presente nel database. <br>';
        continue;
    }

    if($table_credenziali->createAccount($k['credenziali']['email'], $hash->getHash($k['credenziali']['password'])) === -1)
    {
        echo "errore: " . $dbms->errno . ' ' . $dbms->error;
        continue;
    }
    $id_profilo = $table_credenziali->getId($k['credenziali']['email'], $k['credenziali']['password']);
    $id_img = $id_stili[$i];
    if($k['profilo']['id_img_profilo'] >= 0)
    {
        $id_img = $k['profilo']['id_img_profilo'];
    }
    else
    {
        $i++;
    }
    if($errcode = $table_profili->createAccount($id_profilo, $k['profilo']['nickname'], $k['profilo']['nome'], $k['profilo']['cognome'], $id_stili[$i]))
    {
        echo "errore: " . $dbms->errno . ' ' . $dbms->error;
        continue;
    }
    $supporter = false;
    if(count($k['donazioni']) > 0)
    {
        $table_profili->setSupporter($id_profilo, true);
        $supporter = true;
    }
    $table_profili->setStatus($id_profilo, $k['profilo']['stato']);
    $table_profili->setDescription($id_profilo, $k['profilo']['descrizione']);
    if($k['profilo']['flag_anonimo'])
    {
        $table_profili->setAnonymous($id_profilo, true);
    }

    if($supporter)
    {
        echo '<br>';
        foreach($k['donazioni'] as $amount)
        {
            echo $table_donazioni->recordDonation($id_profilo, $amount) . '<br>';
        }
    }
}

echo '<br><br>';
echo '>> --- IMPORTAZIONE Account utente TERMINATA --- <<';
echo '<br><br><br><br><br>';

?>