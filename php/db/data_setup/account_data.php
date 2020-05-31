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
        'nickname' => 'SignorSignaro',
        'nome' => 'Bella',
        'cognome' => 'Greg',
        'stato' => 'la password è abc.',
        'descrizione' => 'nient\'altro da aggiungere ... questa A è bella ... questa B è bella .. questa C è bella .. questa D è bella .. questa E è bella .. questa F è bella .. questa G è bella .. questa H è bella .. questa I è bella .. questa J è bella .. questa K è bella .. questa L è bella .. questa M è bella .. questa N è bella .. questa O è bella .. questa P è bella .. questa Q è bella .. questa R è bella .. questa S è bella .. questa T è bella .. questa U è bella .. questa V è bella .. questa W è bella .. questa X è bella .. questa Y è bella .. e anche questa Z è bella. Non vedi quanto è bella?',
        'flag_anonimo' => false,
        'id_img_profilo' => 4
    ),
    'donazioni' => array(1, 2, 3, 4)
);

$data[] = array(
    'credenziali' => array(
        'email' => 'anonimo.baluardo@servizi.segretissimi.us',
        'password' => 'password'
    ),
    'profilo' => array(
        'nickname' => 'xxx_AGENTE-SEGRETO_xxx',
        'nome' => 'John',
        'cognome' => 'Allen',
        'stato' => 'Indagando su un certo traffico di droga ... a casa tua ... non avrei dovuto dirlo ...',
        'descrizione' => '0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 0011111101001011010101001100010011 1001001111010101011010101 1001010000111111010010110101 0100110001001110010011110101010 1101010110010100001111110100101 ',
        'flag_anonimo' => false,
        'id_img_profilo' => 5
    ),
    'donazioni' => array()
);

$data[] = array(
    'credenziali' => array(
        'email' => 'test@test.t',
        'password' => 'test'
    ),
    'profilo' => array(
        'nickname' => 'Testatore-_-95',
        'nome' => 'Testa',
        'cognome' => 'TOREEEEHHHH',
        'stato' => 'testtestetsttestetstestet è un test!',
        'descrizione' => 'test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test ',
        'flag_anonimo' => false,
        'id_img_profilo' => -1
    ),
    'donazioni' => array(5, 25, 3, 24)
);

$data[] = array(
    'credenziali' => array(
        'email' => 'killing.wendy@shining.sas',
        'password' => 'subito'
    ),
    'profilo' => array(
        'nickname' => 'iTzJohnny',
        'nome' => 'Jack',
        'cognome' => 'Torrance',
        'stato' => 'Wendy, non hai sentito il mio toc toc?',
        'descrizione' => 'Sono un amorevole padre di famiglia che vive per sua moglie e il suo splendido bambino. Ho una passione sfrenata per la falegnameria e le accette.
        <br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>
        Tutto lavoro e niente svago rendono Jack un ragazzo annoiato.<br>',

        'flag_anonimo' => false,
        'id_img_profilo' => 37
    ),
    'donazioni' => array()
);

$data[] = array(
    'credenziali' => array(
        'email' => 'pelata.lucente@hotmail.com',
        'password' => 'password'
    ),
    'profilo' => array(
        'nickname' => 'xXxPelataLucentexXx',
        'nome' => 'Fernando',
        'cognome' => 'Cartomastro',
        'stato' => 'Dal mattino alla sera, bella Lore bella Rena!',
        'descrizione' => 'La mia pelata è lucente, illuminante, una supernova di luce, un caleidoscopio di forme e colori, brillante, sfavillante, incandescente, accecante, sfolgorante, iridescente.',
        'flag_anonimo' => false,
        'id_img_profilo' => -1
    ),
    'donazioni' => array(1, 2, 3, 4)
);

$data[] = array(
    'credenziali' => array(
        'email' => 'guy.fawkes@gunpowder.anonymous',
        'password' => 'polveredasparo'
    ),
    'profilo' => array(
        'nickname' => 'V',
        'nome' => 'Guy',
        'cognome' => 'Fawkes',
        'stato' => '"Nascondi ciò che sono e aiutami a trovare la maschera più adatta alle mie intenzioni."',
        'descrizione' => 'Io sono il frutto di ciò che mi è stato fatto. È la legge fondamentale dell\'universo, a ogni azione corrisponde una reazione uguale e contraria.',
        'flag_anonimo' => false,
        'id_img_profilo' => 39
    ),
    'donazioni' => array(100000)
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
        'descrizione' => 'Sono Ciccio, ho 43 anni, vivo con mia madre e mangio gli hamburger.',
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
        'stato' => 'Niente Paradiso per me, eh?',
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
        'descrizione' => 'Fa ridere perchè Cliff Unger sembra "cliffhanger", e la mia identità è proprio un colpo di scena. ',
        'flag_anonimo' => false,
        'id_img_profilo' => 32
    ),
    'donazioni' => array(60, 10, 20, 40)
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
        'descrizione' => 'Stavo tenendo conto di ogni mia colazione ma alla fine mi sono stancato, basta.<br>
        Il CSS è bello, ma fa schifo.<br>
        Studi recenti mi fanno affermare con certezza che le scritture sataniche siano interpretabili dall\'HTML.<br>
        Alla mia laurea ringrazierò la Riot Games per avermi insegnato come NON si programma.',
        'flag_anonimo' => false,
        'id_img_profilo' => 15
    ),
    'donazioni' => array(6, 12, 24, 48, 76)
);

$data[] = array(
    'credenziali' => array(
        'email' => 'peppinodellapeppa@libero.it',
        'password' => 'peppomelopeppi'
    ),
    'profilo' => array(
        'nickname' => 'pep_PINO',
        'nome' => 'Giuseppe',
        'cognome' => 'Inguastato',
        'stato' => '"Ci sono molte cose che mi piacciono, ma IL QUADRO è ciò che mi ispira."',
        'descrizione' => 'Mi chiamo Giuseppe però le arance me le infilo nel baule lo stesso.',
        'flag_anonimo' => false,
        'id_img_profilo' => 14
    ),
    'donazioni' => array(600, 120, 200, 40, 700, 1)
);

$data[] = array(
    'credenziali' => array(
        'email' => 'tentennatoRiazza@albergo.frutta',
        'password' => 'repartoortofrutta'
    ),
    'profilo' => array(
        'nickname' => 'Lil\'ShoezZz',
        'nome' => 'Nicola',
        'cognome' => 'Scarpino',
        'stato' => '"Qualcuno ha detto SCARPA?"',
        'descrizione' => 'Mi piacciono le scarpe, gli scarponi, gli scarpini, i sandali, le infradito, il matto, e i nani da giardino di Giulia.',
        'flag_anonimo' => false,
        'id_img_profilo' => 11
    ),
    'donazioni' => array(600, 100, 200, 40, 10, 1)
);

$data[] = array(
    'credenziali' => array(
        'email' => 'aragosta@irachena.it',
        'password' => 'arachenairagosta'
    ),
    'profilo' => array(
        'nickname' => 'AragostaIrachena',
        'nome' => 'Peter',
        'cognome' => 'Griffin',
        'stato' => '"Non bollitemi, sono ancora viva!"',
        'descrizione' => 'Aragosta Irachena! Aragosta Irachena! Aragosta Irachena! Aragosta Irachena! Aragosta Irachena! Aragosta Irachena! ',
        'flag_anonimo' => false,
        'id_img_profilo' => 15
    ),
    'donazioni' => array(120, 150, 200, 480, 20, 1)
);

$data[] = array(
    'credenziali' => array(
        'email' => 'clause.shannon@monociclo.us',
        'password' => 'unavitadiinterruttori'
    ),
    'profilo' => array(
        'nickname' => 'signorSHANNON',
        'nome' => 'Claude',
        'cognome' => 'Shannon',
        'stato' => '',
        'descrizione' => 'Claude Shannon, lontano parente di Thomas Edison, nacque a Petoskey, una piccola città del Michigan. Dopo aver lavorato da ragazzo come telegrafista per la Western Union sotto la guida di Andrew Coltrey, nel 1932 iniziò gli studi presso l\'Università del Michigan, dove, nel 1936, conseguì due lauree triennali: in matematica e in ingegneria elettronica.
        <br><br>
        Shannon si iscrisse quindi al MIT. Qui frequentò, tra l\'altro, il laboratorio nel quale, sotto la direzione di Vannevar Bush, si lavorava alla realizzazione dell\'analizzatore differenziale, un calcolatore analogico. Nel 1938 conseguì il titolo di Master of Science in ingegneria elettronica presentando la tesi Un\'analisi simbolica dei relè e dei circuiti. In questo studio Shannon dimostrò che il fluire di un segnale elettrico attraverso una rete di interruttori - cioè dispositivi che possono essere in uno di due stati - segue esattamente le regole dell\'algebra di Boole, se si fanno corrispondere i due valori di verità - VERO e FALSO - della logica simbolica allo stato APERTO o CHIUSO di un interruttore. Pertanto un circuito digitale può essere descritto da un\'espressione booleana, la quale può poi essere manipolata secondo le regole di questa algebra. Shannon definì così un potente metodo, ancora oggi usato, per l\'analisi e la progettazione dei sistemi digitali di elaborazione dell\'informazione.
        <br><br>
        Per il dottorato di ricerca in matematica Shannon lavorò, su suggerimento del suo supervisore Bush, allo studio matematico della genetica. Trascorse un periodo presso il laboratorio di genetica di Cold Spring Harbor, un\'organizzazione di ricerca, ed ottenne il dottorato di ricerca dal MIT nel 1940, discutendo la tesi Un\'algebra per la genetica teorica.
        <br><br>
        Dopo il PhD, tra il 1940 ed il 1941 Shannon trascorse un periodo di studio come National Research Fellow all\'IAS di Princeton, sotto la supervisione di Hermann Weyl.
        <br><br>
        Durante l\'estate del \'41, per alcuni mesi lavorò nei Laboratori Bell; subito dopo, accettò un\'offerta per lavorare a tempo pieno su progetti di interesse militare. Sarebbe rimasto ai Bell Labs fino al 1972.
        <br><br>
        I primi progetti di Shannon riguardarono i dispositivi automatici di puntamento antiaereo ed i problemi connessi di riduzione del rumore[2]. Iniziò anche ad occuparsi di crittografia, lavorando al progetto di un dispositivo digitale per la segretezza delle comunicazioni telefoniche. In questo ruolo ebbe l\'occasione di conoscere Alan Turing, anch\'egli esperto criptoanalista, che nel 1943 passò alcuni mesi negli Stati Uniti su incarico del governo britannico. Poiché ambedue erano impegnati in attività riservate, delle quali non potevano parlare, nei loro incontri discussero principalmente di calcolatori e di intelligenza artificiale[3].
        <br><br>
        Nel 1948 pubblicò in due parti il saggio Una teoria matematica della comunicazione, un trattato scientifico di eccelsa qualità, anche dal punto di vista della scrittura tecnica, che poneva la base teorica per lo studio dei sistemi di codificazione e trasmissione dell\'informazione. In questo lavoro si concentrò sul problema di ricostruire, con un certo grado di certezza, le informazioni trasmesse da un mittente. Shannon utilizzò strumenti quali l\'analisi casuale e le grandi deviazioni, che in quegli anni si stavano appena sviluppando. Fu in questa ricerca che Shannon coniò la parola bit, per designare l\'unità elementare d\'informazione. La sua teoria dell\'informazione pose le basi per progettare sistemi informatici, partendo dal presupposto che l\'importante era cercare di memorizzare le informazioni in modo da poterle trasferire e collegare tra loro. Shannon ha affermato che la maggiore ispirazione alla sua ricerca in questo campo venne dal lavoro sulla trasmissione delle informazioni del suo collega dei Bell Labs Ralph Hartley, del 1928[4], che aveva discusso anche con Weyl a Princeton.
        <br><br>
        Nel 1949 pubblicò un altro notevole articolo, La teoria della comunicazione nei sistemi crittografici, con il quale praticamente fondò la teoria matematica della crittografia. Shannon è inoltre riconosciuto come il "padre" del teorema del campionamento, che studia la rappresentazione di un segnale continuo (analogico) mediante un insieme discreto di campioni a intervalli regolari (digitalizzazione).
        <br><br>
        Nel 1956 fu eletto membro della National Academy of Sciences. Dal 1958 al 1978 fu professore al MIT. ',
        'flag_anonimo' => false,
        'id_img_profilo' => -1
    ),
    'donazioni' => array(0.1, 10000)
);

$data[] = array(
    'credenziali' => array(
        'email' => 'programmatoroseduto.kungkurth@frogstudios.com',
        'password' => '----....k----'
    ),
    'profilo' => array(
        'nickname' => 'KungKurth',
        'nome' => 'Francesco',
        'cognome' => 'Ganci',
        'stato' => 'Lanciando parole poco lusinghiere contro Visual Studio =)',
        'descrizione' => 'Ehilà!
        <br><br> 
        ',
        'flag_anonimo' => false,
        'id_img_profilo' => 36
    ),
    'donazioni' => array(900, 750, 800, 180.50, 20.50, 100)
);

$data[] = array(
    'credenziali' => array(
        'email' => 'moc.soidutsgorf@htrukgnuk.otudesorotammargorp',
        'password' => 'adnamodalleb'
    ),
    'profilo' => array(
        'nickname' => 'HtrukGnuk',
        'nome' => 'Grancesco',
        'cognome' => 'Fanci',
        'stato' => '"Non ci penso, non ci penso..."',
        'descrizione' => '"Non ci penso... Dai quelle non le metto io poi..."',
        'flag_anonimo' => false,
        'id_img_profilo' => 29
    ),
    'donazioni' => array(9, 57, 8, 5.8, 5.2, 1)
);

$data[] = array(
    'credenziali' => array(
        'email' => 'giulia.stella@gmail.com',
        'password' => 'nonloso'
    ),
    'profilo' => array(
        'nickname' => 'GiuliaStella05',
        'nome' => 'Giulia',
        'cognome' => 'Stella',
        'stato' => '"<3"',
        'descrizione' => 'Sono una trippona che tiene segreta la sua vera identità...',
        'flag_anonimo' => false,
        'id_img_profilo' => 35
    ),
    'donazioni' => array(130, 30, 20)
);

$data[] = array(
    'credenziali' => array(
        'email' => 'Lucinda.250@lmaoyeet.com',
        'password' => '1234'
    ),
    'profilo' => array(
        'nickname' => 'Lucinda250',
        'nome' => 'Tizia',
        'cognome' => 'Memes',
        'stato' => 'Mi serve il magenta!',
        'descrizione' => 'Mi piace il sushi e feedare su Lol :)',
        'flag_anonimo' => false,
        'id_img_profilo' => 33
    ),
    'donazioni' => array(10, 30, 20)
);

$data[] = array(
    'credenziali' => array(
        'email' => 'montgomery.burns@nuclear.springfield',
        'password' => 'campusdeimiliardari'
    ),
    'profilo' => array(
        'nickname' => 'MontyBurns',
        'nome' => 'Montgomery',
        'cognome' => 'Burns',
        'stato' => 'Smithers, libera i cani!',
        'descrizione' => 'A che serve il denaro, se non si riesce a incutere terrore al tuo prossimo?<br><br>
        Se si può cogliere un vantaggio da una situazione, è dovere di un buon cittadino coglierlo. Perché la corsa deve essere solo dei più veloci e i rebus solo dei più astuti? Vincono soltanto perché Dio ha dato loro questo dono! Ma imbrogliare è un dono che l’uomo dà a se stesso!<br><br>
        Sarò breve e conciso. Famiglia, religione, amicizia: sono i tre demoni che dovete annientare per ottenere successo negli affari. Quando si presenta l’opportunità, non vorrete certo trovarvi in un reparto maternità, né seduti in qualche assurda chiesa o sinagoga. Domande?<br><br>
        Senta, signor Spilbergo, io e Schindler siamo della stessa pasta: entrambi abbiamo fatto armi per i nazisti. Solo che le mie funzionavano.<br><br>
        Sono un uomo potente, Simpson. Posso entrare da McDonalds, ordinare la minestra e averla.<br><br>
        Trattare gli impiegati come esseri umani è pura follia.<br><br>',
        'flag_anonimo' => false,
        'id_img_profilo' => 38
    ),
    'donazioni' => array(0.01)
);

$data[] = array(
    'credenziali' => array(
        'email' => 'sg.hartfrog@army.us',
        'password' => 'palladilardo'
    ),
    'profilo' => array(
        'nickname' => 'SGT.Hartfrog',
        'nome' => 'Gerheim',
        'cognome' => 'Hartfrog',
        'stato' => 'Lawrence? Lawrence come, d\'Arabia?',
        'descrizione' => 'Io sono il sergente maggiore Hartfrog, vostro Capo Istruttore. Da questo momento potete parlare soltanto quando vi sarà richiesto, e la prima e l\'ultima parola che dovrà uscire dalle vostre fogne sarà "Signore". Tutto chiaro luridissimi vermi?',
        'flag_anonimo' => false,
        'id_img_profilo' => 41
    ),
    'donazioni' => array()
);

$data[] = array(
    'credenziali' => array(
        'email' => 'consuela@gmail.mx',
        'password' => 'supermannocasa'
    ),
    'profilo' => array(
        'nickname' => 'Consuela',
        'nome' => 'Consuela',
        'cognome' => 'sconosciuto',
        'stato' => 'Nooooooooooooooooooooooooo, noooooooo. No.',
        'descrizione' => '<b>Signor Superman no casa...</b><br>
        <i>Senta, stiamo cercando un bambino...</i><br>
        <b>No continua, Signor Superman lui no qui, no casa...</b><br>
        <i>Sì, va bene, va bene... Può dargli almeno questo volantino?</i><br>
        <b>Grazie nooooo, noooo io no compra, io no ha soldi.</b><br>
        <i>Coraggio, lo prenda! E se vede questo bambino...</i><br>
        <b>Nooooooo, io deto nooooooooooo...</b><br>',
        'flag_anonimo' => false,
        'id_img_profilo' => 43
    ),
    'donazioni' => array()
);

$data[] = array(
    'credenziali' => array(
        'email' => 'brava.giovanna.brava@bravagiovanna.brava',
        'password' => 'bravagiovannabrava'
    ),
    'profilo' => array(
        'nickname' => 'Brava_giovannA',
        'nome' => 'Giovanna',
        'cognome' => 'Brava',
        'stato' => 'giava brovanna, giava',
        'descrizione' => 'Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>Brava Giovanna, brava.<br>',
        'flag_anonimo' => false,
        'id_img_profilo' => 44
    ),
    'donazioni' => array()
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
    if($errcode = $table_profili->createAccount($id_profilo, $k['profilo']['nickname'], $k['profilo']['nome'], $k['profilo']['cognome'], $id_img))
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