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

$data[] = array(
    'credenziali' => array(
        'email' => 'capocchia.lucente@hotmail.com',
        'password' => 'cazziamari'
    ),
    'profilo' => array(
        'nickname' => 'xXxCapocchiaLucentexXx',
        'nome' => 'Fernando',
        'cognome' => 'Cartomastro',
        'stato' => 'Dal mattino alla sera, bella Lore bella Rena!',
        'descrizione' => 'La mia capocchia è lucente',
        'flag_anonimo' => false,
        'id_img_profilo' => -1
    ),
    'donazioni' => array(1, 2, 3, 4444)
);

$data[] = array(
    'credenziali' => array(
        'email' => 'c.asdrubale@gmail.it',
        'password' => 'ringhiera'
    ),
    'profilo' => array(
        'nickname' => 'PetardoIndiano777',
        'nome' => 'Francesco',
        'cognome' => 'Asdrubale',
        'stato' => 'Ciccio Asdrubale sta arrivando!',
        'descrizione' => 'Sono Ciccio, ho 43 anni, vivo con mia madre e guardo i piedini online.',
        'flag_anonimo' => false,
        'id_img_profilo' => -1
    ),
    'donazioni' => array()
);

$data[] = array(
    'credenziali' => array(
        'email' => 'cangrande@live.it',
        'password' => 'dantesuca'
    ),
    'profilo' => array(
        'nickname' => 'xxBIGDOG',
        'nome' => 'Cangrande',
        'cognome' => 'Della Scala',
        'stato' => 'Vuolsì così, colà, che cazzo vuol dire?',
        'descrizione' => 'Sono un ricco figlio di papà arrabbiato con Dante.',
        'flag_anonimo' => false,
        'id_img_profilo' => -1
    ),
    'donazioni' => array()
);

$data[] = array(
    'credenziali' => array(
        'email' => 'cliff.unger@gmail.us',
        'password' => 'bb'
    ),
    'profilo' => array(
        'nickname' => 'CombatVeteran',
        'nome' => 'Cliff',
        'cognome' => 'Unger',
        'stato' => 'Dov\'è il mio BB?',
        'descrizione' => 'Fa ridere perchè Cliff Unger sembra "cliffhanger", e la mia identità è proprio un colpo di scena. SaS.',
        'flag_anonimo' => false,
        'id_img_profilo' => -1
    ),
    'donazioni' => array(600, 1200, 2400, 4800, 7600, 0.1)
);

$data[] = array(
    'credenziali' => array(
        'email' => 'lorenzo.terranova96@hotmail.com',
        'password' => 'lorenzo96'
    ),
    'profilo' => array(
        'nickname' => 'Kallaari',
        'nome' => 'Lorenzo',
        'cognome' => 'Terranova',
        'stato' => '"This time I finally let you... Go."',
        'descrizione' => '5 giorni fa ho fatto colazione coi pancakes, il giorno dopo invece con le uova strapazzate e il succo d\'arancia. Tre mattine fa invece con delle specie di Egg McMuffin ma coi pancakes. L\' altro ieri invece ho mangiato i pancakes, però a sto giro solo col burro. Ieri mattina invece dieta, non avevo sbatti e non c\'era la mami. Oggi mi sono svegliato tardi quindi il pancake con l\'uovo era freddo, ma ugualmente buono, evviva.',
        'flag_anonimo' => false,
        'id_img_profilo' => 15
    ),
    'donazioni' => array(600, 1200, 2400, 4800, 7600, 0.1)
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