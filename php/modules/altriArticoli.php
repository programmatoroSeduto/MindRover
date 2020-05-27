<?php

//primi 4 articoli più recenti
$data_max = new DateTime();
$data_min = (new DateTime())->setTimestamp(time() - 100000);
$table_articoli = new Articoli($dbms);

//ricerca dei primi 4 articoli
$res = $table_articoli->searchByTimeRange($data_min, $data_max);
if(count($res) < 4)
{
    $res = $table_articoli->searchByTimeRange((new DateTime())->setTimestamp(0), $data_max);
}

$altri_articoli = array(
    array(
        'titolo' => 'titolo',
        'immagine_path' => '../assets/img/pattr.jpg',
        'url' => '#'
    ),
    array(
        'titolo' => 'titolo',
        'immagine_path' => '../assets/img/pattr.jpg',
        'url' => '#'
    ),
    array(
        'titolo' => 'titolo',
        'immagine_path' => '../assets/img/pattr.jpg',
        'url' => '#'
    ),
    array(
        'titolo' => 'titolo',
        'immagine_path' => '../assets/img/pattr.jpg',
        'url' => '#'
    )
);

for($i = 0; $i < 4 && $i < count($res); $i++)
{
    $res[$i] = $table_articoli->getArticle($res[$i]);

    $altri_articoli[$i]['titolo'] = $res[$i]['titolo'];
    $altri_articoli[$i]['url'] = './articolo.php?code=' . $res[$i]['id_articolo'];
}
?>