<?php
session_start();
$ganesh = "SEARCH";

if(!isset($_GET['code']))
{
    //header('location: ./comingsoon.php');
    echo 'niente get del code';
    die();
}
elseif(!is_numeric($_GET['code']))
{
    //header('location: ./comingsoon.php');
    echo 'code non valido.';
    die();
}

require_once('../php/modules/navbar.php');
require_once('../php/db/mysql_credentials.php');
require_once('../php/db/ProfiliUtenti.php');
require_once('../php/db/Articoli.php');

$dbms = connect();
$articolo = (new Articoli($dbms))->getArticle($_GET['code']);
if(!$articolo)
{
    echo 'l\'articolo selezionato non esiste.';
    die();
}
$profilo = (new ProfiliUtenti($dbms))->getProfileDataById($articolo['id_autore']);

$titolo = $articolo['titolo'];
$sottotitolo = $articolo['sottotitolo'];
$nick_autore = $profilo['nickname'];
$data_pubblicazione = (new DateTime($profilo['data_iscrizione']))->format('d/m/Y');
$ora_pubblicazione = (new DateTime($profilo['data_iscrizione']))->format('h:m');

$tags = explode(';', $articolo['lista_tag']);
function inserisci_tag($tag)
{
    return '<span class="userinfo-tag tag-tag"><i class="fas fa-frog"></i>' . $tag . '</span>';
}
$contenuto_articolo = $articolo['contenuto'];

$altri_articoli = array();
require_once('../php/modules/altriArticoli.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titolo; ?></title>

    <!-- CSS -->
    <link type="text/css" rel="stylesheet" href="../css/utils/clearsheet.css">
    <link type="text/css" rel="stylesheet" href="../css/utils/bg.css">
    <link type="text/css" rel="stylesheet" href="../css/splash.css">
    <link type="text/css" rel="stylesheet" href="../css/nav.css">
    <link type="text/css" rel="stylesheet" href="../css/fonts.css">
    <link type="text/css" rel="stylesheet" href="../css/containers.css">
    <link type="text/css" rel="stylesheet" href="../css/footer2.css">
    <link type="text/css" rel="stylesheet" href="../css/text-container.css">
    <link type="text/css" rel="stylesheet" href="../css/board.css">
    <link type="text/css" rel="stylesheet" href="../css/profile_settings_style.css">
    <link type="text/css" rel="stylesheet" href="../css/articolo.css">
    
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

</head>
<body>
    <?php
        if(isset($_SESSION['user_id']))
        {
            get_private_navbar($ganesh);
        }
        else
        {
            get_public_navbar($ganesh);
        }
    ?>
    
    <div class="contenitore">
        <div class="example articleStyle" style="background-image: url('../assets/img/news-rane.jpg');">
            <div class="articleContainer" style="background-color: rgba(173, 216, 230, 0.50);">

                <h1 class="articleTitle"><?php echo $titolo; ?></h1>
                <p class="articleTitle" style="padding-bottom: 1vh"><?php echo $sottotitolo; ?></p>
                <div class="articleTags">
                    <p><i><?php echo $nick_autore; ?></i> || <?php echo $data_pubblicazione; ?> alle <?php echo $ora_pubblicazione; ?> || <?php foreach($tags as $tag) { echo inserisci_tag($tag); } ?> </p> 
                </div>
                
            </div>

            <div class="article" style="background-color: rgba(250, 250, 210, 0.5);">
                <?php echo $contenuto_articolo; ?>
            </div>

        </div>
        
        <div class="incolonnatoMiazza">
            <div class="hh2 titolo">Altri interessantissimi articoli</div>
                <?php foreach($altri_articoli as $a): ?>
                    <div class="list-item" style="background-image: url('<?php echo $a['immagine_path'] ?>');" onclick="window.open('<?php echo $a['url'] ?>', '_blank');"><?php echo $a['titolo'] ?></div>
                <?php endforeach ?>
            <div class="hh2 back" onclick="location.href='../HTML/search.php';">Torna alla pagina di ricerca</div>
        </div>
    </div>
    
    <?php require_once('../php/modules/footer.php'); ?>

</body>
</html>