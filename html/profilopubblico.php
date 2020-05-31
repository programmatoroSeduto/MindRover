<?php
session_start();
$ganesh = "SEARCH";
$dictator = false;


if(!isset($_GET['code']))
{
    header('location: ./comingsoon.php?error=quattrocentoquattro');
    // echo 'niente get del code';
    die();
}
elseif(!is_numeric($_GET['code']))
{
    header('location: ./comingsoon.php?error=quattrocentoquattro');
    // echo 'niente get del code';
    die();
}
?>

<?php
require_once('../php/modules/navbar.php');
require_once('../php/db/mysql_credentials.php');
require_once('../php/db/ProfiliUtenti.php');
require_once('../php/db/ImgProfilo.php');
require_once('../php/db/Donazioni.php');
require_once('../php/modules/funny.php');
$dbms = connect();
$profilo = new ProfiliUtenti($dbms);
$stile = new ImgProfilo($dbms);
$donazioni = new Donazioni($dbms);

$profilo = $profilo->getProfileDataById($_GET['code']);
if ($profilo['flag_anonimo'])
{
    header('location: ./comingsoon.php?error=profilo_anonimo');
    die();
}

$stile = $stile->getStyle($profilo['id_img_profilo']);
if(!$profilo || !$stile)
{
    header('location: ./comingsoon.php?error=quattrocentoquattro');
    // echo 'niente get del code';
    die();
}
$donazioni = $donazioni->getDonationAmountFrom($_GET['code']);

$my_tier = 0;
{
    $tier_3 = 99;
    $tier_2 = 199;
    if($donazioni > 0)
    {
        if($donazioni > $tier_3)
        {
            if($donazioni > $tier_2)
            {
                $my_tier = 1;
            }
            else
                $my_tier = 2;
        }
        else
            $my_tier = 3;
    }
}
$tier_icon = array
(
    '',
    /* -- TIER 1 -- */'<img class="brahma-tier" src="../assets/img/logo.png" style="width: 7vh; margin: 8vh 0; margin-left: 3vw;">',
    /* -- TIER 2 -- */'<img class="brahma-tier" src="../assets/img/imbrogliona.png" style="width: 7vh; height: 7vh; margin: 8vh 0; margin-left: 3vw;">',
    /* -- TIER 3 -- */'<img class="brahma-tier" src="../assets/img/scambio.png" style="width: 7vh; margin: 8vh 0; margin-left: 3vw;">',
);

$banner_rgb = implode(', ', $stile['banner']);
$color1_rgb = implode(', ', $stile['color_1']);
$color2_rgb = implode(', ', $stile['color_1']);
$avatar = $stile['icon_path'];

$supporter = $profilo['flag_supporter'];
$is_author = $profilo['flag_autore'];

$nickname = $profilo['nickname'];
$dictator = ((strcmp('Kallaari', $nickname) == 0) || (strcmp('KungKurth', $nickname) == 0));

$status = $profilo['stato'];
$descr = $profilo['descrizione'];

$first_name = $profilo['first_name'];
$last_name = $profilo['last_name'];

$date_subscr = (new DateTime($profilo['data_iscrizione']))->format('d/m/Y');
$time_subscr = (new DateTime($profilo['data_iscrizione']))->format('h:m');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $nickname; ?></title>

    <!-- CSS -->
    <link type="text/css" rel="stylesheet" href="../css/utils/clearsheet.css">
    <link type="text/css" rel="stylesheet" href="../css/nav.css">
    <link type="text/css" rel="stylesheet" href="../css/fonts.css">
    <link type="text/css" rel="stylesheet" href="../css/footer2.css">
    <link type="text/css" rel="stylesheet" href="../css/text-container.css">
    <link type="text/css" rel="stylesheet" href="../css/profile_settings_style.css">
    <link type="text/css" rel="stylesheet" href="../css/modal.css">
    <link type="text/css" rel="stylesheet" href="../css/search_page_style.css">
    
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/f61875768d.js" crossorigin="anonymous"></script>

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- METADATI -->
    <link rel="icon" href="../assets/img/frog-icon.png">

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
    <div class="banner" style="background: linear-gradient(90deg, rgb(<?php echo $banner_rgb; ?>, 1), rgb(<?php echo $banner_rgb; ?>, 0.8)); ">
        <div style="display: grid; margin: auto;">
            <div class="brahma-profile" style="background: linear-gradient(45deg, rgb(<?php echo $color1_rgb; ?>), rgb(<?php echo $color2_rgb; ?>));">
                <img src="<?php echo $avatar; ?>" class="avatar">
            </div>
        </div>
        <div style="padding-left: 5vw; display: grid; grid-template-columns: 1fr 2fr;">
            <div>
                <h1 style="padding-top: 5vh;">
                    <span style="padding-top: 7.5vh;">
                        <?php echo funny() . ' ' . $nickname; ?>
                    </span>
                </h1>            
                
                
                <p style="padding-top: 4vh; padding-bottom: 0.8vh;"> 
                    <i><?php echo $status; ?></i> 
                </p>
                
                <!-- ruoli -->
                <?php if(!$dictator): ?>

                <?php if($supporter): ?>
                    <p> <span class="userinfo-tag tag-supporter"><i class="fas fa-frog"></i> supporter </span> </p>
                <?php endif ?>

                <?php if($is_author): ?>
                    <p> <span class="userinfo-tag tag-author"><i class="fas fa-frog"></i> autore </span> </p>
                <?php endif ?>

                <?php else: ?>
                    <p> <span class="userinfo-tag tag-dictator"><i class="fas fa-frog"></i> dittatore supremo </span> </p>
                <?php endif ?>
            </div>

            <div>
                <?php echo $tier_icon[$my_tier];?>
            </div>
        </div>
    </div>

    <div class="settings-container">
        <!-- Aggiornamento barra -->
        <script>
            function activator(panel_tag, but)
            {

                $('.panel-container').children().addClass('kali');
                $('.tab').children().removeClass('active');

                $(panel_tag).removeClass('kali').addClass('tabcontent');
                $(but).addClass('active');

            }
        </script>

        <!-- Barra sinistra -->
        <script>
            function changeTitlePage(newtitle)
            {
                document.getElementsByTagName('title')[0].innerHTML = newtitle;
            }
        </script>
        <div class="tab">
            <!-- voci generali per il profilo privato -->
            <button class="tablinks active" onclick="activator('#s1', this); changeTitlePage('<?php echo $nickname; ?>');"><?php echo $nickname; ?></button>

            <?php if($is_author): ?>
                <!-- voci riservate agli autori -->
                <button class="tablinks" onclick="activator('#s2', this); changeTitlePage('Articoli di <?php echo $nickname; ?>');">Gli Articoli di <?php echo $nickname; ?></button>
            <?php endif ?>
        </div>

        <!-- Barra destra -->
        <div class="panel-container">
            <div id="s1" class="tabcontent">
                <div class="vishnu">
                    <div><?php echo datetime_funny(); ?></div> <div><?php echo $date_subscr ?> alle <?php echo $time_subscr ?></div>
                    <div class="sep"></div> <div class="sep"></div>
                    <div><b>Nickname:</b></div> <div><b><?php echo $nickname ?></b></div>
                    <div class="sep"></div> <div class="sep"></div>
                    <div><b>Bio: </b></div><div><i><?php echo $descr ?></i></div>
                </div>
            </div>

            <?php if($is_author): ?>
            <?php
                require_once('../php/db/Articoli.php');
                $table_articoli = new Articoli($dbms);
                $articoli = $table_articoli->searchByAuthorId($profilo['id_utente']);
            ?>
            <div id="s2" class="tabcontent kali example" style="overflow: scroll">
                <div style="display: flex; flex-direction: column;">
                    <?php
                        if($is_author)
                        {
                            echo '<h1 style="margin: 0 0 5vh 0; font-family: ganesh; font-size: 3.25rem; color: rgb(46, 46, 46);">Gli articoli di ' . $nickname . ' :</h1>
                                <div style="padding: 10px; margin: 3px 0; background-color: #8f281d; font-family: ganesh; color: white; display: grid; grid-template-columns: 1fr 1fr 1fr; font-weight: bolder;">
                                    <div>Titolo</div>
                                    <div>Data pubblicazione</div>
                                    <div></div>
                                </div>';
                            
                            foreach($articoli as $row)
                            {
                                $row = $table_articoli->getArticle($row);
                                echo '<div style="padding: 10px; margin: 3px 0; background-color: rgb(212, 212, 212); display: grid; grid-template-columns: 1fr 1fr 1fr;">';
                                    echo '<div>' . $row['titolo'] . '</div>';
                                    echo '<div>' . $row['data_pubblicazione'] . '</div>';
                                    echo '<div><a href="' . './articolo.php?code=' . $row['id_articolo'] . '">vai all\'articolo</a></div>';
                                echo '</div>';
                            }
                        }
                        else
                        {
                            echo '';
                        }
                    ?>
                </div>
                <div style="height: 8vh;"></div>
            </div>
            <?php endif ?>
        </div>
    </div>

    <?php require_once('../php/modules/footer.php'); ?>

</body>
</html>