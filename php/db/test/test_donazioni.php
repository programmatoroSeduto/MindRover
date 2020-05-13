<?php

require_once('../Donazioni.php');
require_once('../mysql_credentials.php');

$dbms = connect(true);
$table = new Donazioni($dbms);

echo 'DEFINIZIONE TABELLA: <br><pre>' . $table->getTableDefinition() . '</pre><br>';
echo 'la tabella esiste? ' . ($table->exists() ? 'Sì.' : 'No.') . '<br>';
if(!$table->exists())
{
    echo 'creazione tabella; codice ' . $table->createTable() . '<br>';
}
$table->destryTableContent();

$user_id = array(1, 2);
$amount = array(10, 20, 30, 40, 50, 60, 70, 80, 90, 100);
$n_donazioni = 80;

for($i=0; $i<$n_donazioni; $i++)
{
    $id = $user_id[$i % count($user_id)];
    $sum = $amount[$i % count($amount)];

    echo 'inserimento: utente ' . $id . ' somma ' . $sum . '<br>';
    echo 'codice: ' . $table->recordDonation($id, $sum) . '<br>';
    echo 'testo errore SQL: ' . $dbms->error . '<br>';
}

echo 'contenuto: <br>';
$table->getTableContentAsList(true);

echo 'quante donazioni ha fatto l\'utente 1? ' . $table->getDonationNumberFrom($user_id[1]) . '<br>';
echo 'quanto ha donato l\'utente 1? ' . $table->getDonationAmountFrom($user_id[1]) . '<br>';

echo 'quanti hanno donato non oltre 5000? <br>';
var_dump($table->findByMaxAmount(5000));
echo '<br>';
echo 'quanti hanno donato non oltre 50? <br>';
var_dump($table->findByMaxAmount(50));
echo '<br>';
echo 'quanti hanno donato almeno 50? <br>';
var_dump($table->findByMinAmount(50));
echo '<br>';
echo 'quanti hanno donato almeno 500? <br>';
var_dump($table->findByMinAmount(500));
echo '<br>';
echo 'ecco una lista delle donazioni:<br>';
var_dump($table->getDonationListFrom($user_id[1]));
echo '<br>';

$dbms->close();

?>