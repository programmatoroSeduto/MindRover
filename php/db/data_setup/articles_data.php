<?php

$data = array();
















/*
$data[] = array(
    'nickname_autore' => '',
    'titolo' => '',
    'sottotitolo' => '',
    'descrizione' => '',
    'data_pubblicazione' => '',
    'lista_tag' => array
    (
        ''
    ),
    'contenuto' => ''
);
*/

$data[] = array(
    'nickname_autore' => 'BellaGreg',
    'titolo' => 'L\'importanza del BELLAGREG',
    'sottotitolo' => 'bella greg.',
    'descrizione' => 'BELLAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA',
    'data_pubblicazione' => -1, //lascia -1 per avere come data di pubblicazione quella dell'installazione del database
    'lista_tag' => array
    (
        'greg',
        'bella',
        'bellagreg'
    ),
    'contenuto' => '<b>BELLA </b> Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, provident ratione. Vero quasi quis aut deleniti quisquam? Id perferendis enim fuga ullam iusto necessitatibus illo ab itaque impedit vel ad dolorum, officia natus delectus odit voluptatibus nihil, similique exercitationem culpa tempore possimus illum laudantium nostrum? Quod odit eveniet adipisci. Harum, asperiores dolorem. Veniam ea repellat alias omnis ipsa vel praesentium nobis mollitia repudiandae, ducimus, perferendis numquam ab? Facilis, magni excepturi! Laboriosam veritatis numquam nesciunt quos dolorum saepe molestiae. In accusamus velit ex maiores dolorum asperiores beatae ullam perferendis placeat, voluptatibus, natus aut mollitia qui error. In cum dolore quaerat voluptas suscipit, reiciendis perspiciatis quod alias totam cumque ullam error dolor eligendi rerum doloribus quo excepturi nemo. Sed, nemo tempora. Quis adipisci temporibus deleniti explicabo dolorem ex eaque nulla velit voluptates blanditiis provident aut est vel non incidunt atque commodi, reiciendis, dignissimos iste numquam! Architecto error consectetur repellat dolores sit consequatur eaque facere. Necessitatibus architecto explicabo, culpa quae veniam facere. Repellendus, cumque. Error, velit. Aut, dolor. Quos accusantium velit doloremque a totam nam, eaque nesciunt et enim ratione mollitia inventore omnis at vitae facere sint,   <img src="../assets/img/rana.jpg" alt="EHI! E\' PROPRIO UNA RANA!">    molestias aliquid laborum sapiente excepturi quibusdam eveniet quidem modi ea. Commodi deleniti quis cumque, suscipit exercitationem, aspernatur non magni ipsa sequi amet explicabo, delectus iure. Adipisci amet sit necessitatibus ut ipsa neque incidunt consequatur dolores ex cupiditate provident non dolorum, ipsam sapiente repellat nam fuga tempore modi omnis, labore mollitia perspiciatis nisi reiciendis? Fugit enim possimus dolor doloribus esse veniam quam praesentium. Debitis ea, libero explicabo vel perspiciatis consectetur sapiente nihil asperiores totam amet neque rem, adipisci optio, ipsum illo possimus autem error deserunt incidunt magnam ratione hic omnis voluptate! Iusto explicabo amet dolores! Excepturi, voluptates corrupti! Aperiam neque quo quae possimus quos odit mollitia excepturi, impedit facere laborum odio tempora dolorem ipsa laboriosam rerum, nemo voluptate, eveniet molestiae consequuntur harum ea modi! Repellat ut, nemo ea, officiis deleniti doloremque dolor pariatur, ipsam unde officia soluta illo nobis necessitatibus repellendus reprehenderit consequatur neque voluptatibus sed earum quaerat ad distinctio perferendis. At sint amet delectus iure. Reiciendis adipisci animi repudiandae sint, quisquam architecto tempora magni porro? Dolore dolores eos hic dolor itaque delectus. Impedit temporibus nisi error ut accusamus quam voluptas exercitationem quod, corrupti fugiat commodi maxime veniam animi vero voluptatum perferendis, earum tenetur quisquam doloribus dolore, recusandae illum saepe fuga. In blanditiis eveniet eum reiciendis commodi voluptatibus possimus natus voluptatem id veniam provident nemo ullam obcaecati eos sed nam corporis nobis ipsa, quod earum tempore sint accusantium labore consequatur. Similique perspiciatis, obcaecati aut maiores reprehenderit ad dolorem eum molestiae voluptatibus fugit, fugiat ea asperiores et doloremque adipisci accusamus a voluptates, rem atque vitae. Dicta debitis tempore, officiis distinctio saepe praesentium blanditiis quam perspiciatis natus quaerat numquam, vel, est assumenda doloribus quod ea architecto ipsam aperiam! Impedit accusantium quod sequi, cupiditate nihil quae, neque, accusamus dolorum possimus animi officia voluptates velit officiis deserunt! Totam debitis asperiores animi libero sint id optio dignissimos dolor nisi a, magnam ex odio porro consectetur quod! Enim laudantium asperiores sequi corporis esse! <b>GREG</b>'
);















































echo '>> --- CREAZIONE ARTICOLI --- <<<br>';

require_once('./mysql_credentials.php');
require_once('./ProfiliUtenti.php');
require_once('./Articoli.php');
$dbms = connect(true);
$profili = new ProfiliUtenti($dbms);
$articoli = new Articoli($dbms);

for($i = 1;$i <= count($data); $i++)
{
    $k = $data[$i - 1];
    echo '<br> -- operazione ' . $i . '<br>';

    $id = -1;

    //ricerca l'id associato all'articolo
    {
        $nick = $k['nickname_autore'];
        $id = $profili->getIdByNickname($nick);
        
        if($id < 0)
        {
            echo 'ERRORE: il nickname dato non esiste.<br>' . 'occorrenza ' . ($i-1) . ' nickname ' . $nick . '<br>';
            continue;
        }

        //segna come autore riconosciuto quel nickname
        if(!$profili->isAuthor($id))
        {
            echo '' . $nick . ' promosso ad AUTORE.<br>';
            $profili->setAuthor($id, true);
        }
    }
    
    //registra l'articolo
    if($err = $articoli->addArticle($id, $k['titolo'], $k['sottotitolo'], $k['descrizione'], $k['contenuto'], $k['lista_tag'], $k['data_pubblicazione']))
    {
        echo 'ERRORE!<br>';
    }

    getSQLerror($dbms);
}

echo'<br><br>';

echo '>> --- CREAZIONE ARTICOLI operazione conclusa. --- <<<br>';

?>
