<?php
session_start();
$ganesh = "ACCOUNT_PUBBLICO";
?>
<?php
require_once('../php/modules/navbar.php');
require_once('../php/db/mysql_credentials.php');
require_once('../php/db/ImgProfilo.php');
require_once('../php/modules/funny.php');

$tier_icon = array
(
    '',
    /* -- TIER 1 -- */'<img class="brahma-tier" src="../assets/img/scambio.png" style="width: 7vh; margin: 8vh 0; margin-left: 3vw;">',
    /* -- TIER 2 -- */'<img class="brahma-tier" src="../assets/img/imbrogliona.png" style="width: 7vh; margin: 8vh 0; margin-left: 3vw;">',
    /* -- TIER 3 -- */'<img class="brahma-tier" src="../assets/img/logo.png" style="width: 7vh; margin: 8vh 0; margin-left: 3vw;">'
);
$my_tier = 1;

$banner_rgb = implode(', ', array(255, 0, 0));
$color1_rgb = implode(', ', array(255, 255, 0));
$color2_rgb = implode(', ', array(255, 0, 255));
$avatar = '../assets/avatar/fagiolo.png';

$supporter = true;
$is_author = true;

$nickname = 'barbagianni';
$status = 'm\'illumino di CACTUS.';
$descr = ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus mollitia dolor ratione perspiciatis modi? Omnis, tempora. Odit aspernatur nisi reprehenderit similique neque numquam, asperiores ipsa vitae obcaecati soluta blanditiis rem aliquid dolorum distinctio quo officiis, sint eius corporis, eos possimus modi minima culpa. Aut quam animi adipisci delectus, saepe consectetur? ';

$first_name = 'ciao';
$last_name = 'peraalgelsomino';

$date_subscr = 50;
$time_subscr = 26;
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

    <style>

        .example::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE,Edge e Firefox  */
        .example {
            overflow: auto;
            -ms-overflow-style: none;
            scrollbar-width: none; /* Firefox 64 */
        }      

    </style>

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
                <?php if($supporter): ?>
                    <p> <span class="userinfo-tag tag-supporter"><i class="fas fa-frog"></i> supporter </span> </p>
                <?php endif ?>

                <?php if($is_author): ?>
                    <p> <span class="userinfo-tag tag-author"><i class="fas fa-frog"></i> autore </span> </p>
                <?php endif ?>

                <?php if(!$is_author and !$supporter): ?>
                    <p> <span class="userinfo-tag tag-basic"><i class="fas fa-frog"></i> base </span> </p>
                <?php endif ?>
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
            <button class="tablinks active" onclick="activator('#s1', this); changeTitlePage('Benvenuto <?php echo $nickname; ?>!');"><?php echo $nickname; ?></button>

            <?php if($is_author): ?>
                <!-- voci riservate agli autori -->
                <button class="tablinks" onclick="activator('#s2', this); changeTitlePage('I miei articoli');">Gli Articoli di barbagianni</button>
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
                <div id="s2" class="tabcontent kali example" style="overflow: scroll">
                    <!-- <div>L'Incredibile Storia del Miazza Sommergibile</div>
                    <div>Pelato Riazza a Caccia di Marmotte</div>
                    <div>Conturbato Miazza nel Paese delle Scolopendre</div>
                    <div>L'Avvincente Diatriba Artistica tra Pennellato Miazza e Architetturizzato Miazza</div> -->
                <div>
                    <div class="result-item-article"  onclick="location.href='#';">
                        <div class="ria-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <div class="ria-info" style="background: linear-gradient(90deg, #007882, #000050);">
                            <div>
                                <h1>Questo articolo parla di tua madre!</h1>
                            </div>
                        <div class="ria-inner">
                            <p>
                            <i>xXxGermanoGaneshxXx</i> || 20/02/2020 || 
                            <span class="userinfo-tag tag-tag"><i class="fas fa-frog"></i> allah </span>
                            <span class="userinfo-tag tag-tag"><i class="fas fa-frog"></i> tette </span>
                            <span class="userinfo-tag tag-tag"><i class="fas fa-frog"></i> GGMosconi </span>
                            </p>
                        </div>
                        <p style="margin-top: 1rem; width: 70%;"><i>"Questa stanza è bella. Anche questa stanza è bella. Questa stanza ... è bella. E guarda com'è bella anche questa stanza. Bella questa stanza. E anche questa stanza è bella. Fre, non ho mai visto stanza così bella."</i></p>
                    </div>
                </div>

                <div>
                    <div class="result-item-article"  onclick="location.href='#';">
                        <div class="ria-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <div class="ria-info" style="background: linear-gradient(90deg, #007882, #000050);">
                            <div>
                                <h1>Giulia hai cotto il razzo!</h1>
                            </div>
                        <div class="ria-inner">
                            <p>
                            <i>Kallaari</i> || 5/5/2020 || 
                            <span class="userinfo-tag tag-tag"><i class="fas fa-frog"></i> giug </span>
                            <span class="userinfo-tag tag-tag"><i class="fas fa-frog"></i> tette -anche no- </span>
                            <span class="userinfo-tag tag-tag"><i class="fas fa-frog"></i> MattiaèBello </span>
                            </p>
                        </div>
                        <p style="margin-top: 1rem; width: 70%;"><i>"Piccola ebrea bastarda."</i></p>
                    </div>
                </div>

                <div>
                    <div class="result-item-article"  onclick="location.href='#';">
                        <div class="ria-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <div class="ria-info" style="background: linear-gradient(90deg, #007882, #000050);">
                            <div>
                                <h1>L'Incredibile Storia di Catapultato Miazza</h1>
                            </div>
                        <div class="ria-inner">
                            <p>
                            <i>xXxCucinatoMiazzaxXx</i> || 12/2/2020 || 
                            <span class="userinfo-tag tag-tag"><i class="fas fa-frog"></i> catapultato </span>
                            <span class="userinfo-tag tag-tag"><i class="fas fa-frog"></i> miazza </span>
                            <span class="userinfo-tag tag-tag"><i class="fas fa-frog"></i> ComeUnaCatapulta </span>
                            </p>
                        </div>
                        <p style="margin-top: 1rem; width: 70%;"><i>"Bella Rena! Rena è stato catapultato contro una casa urlando AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA!"</i></p>
                    </div>
                </div>
                
                </div>
                <div style="height: 10vh"></div>
            </div>
                </div>
            <?php endif ?>
        </div>
    </div>

    <!-- Footer
    <div class="profile-footer footer-bg"> 
        <div class="footer-content">

            <img src="../assets/img/logo.png" style="height: 9vh;">   
            <img src="../assets/img/unige.png" alt="Unige" style="height: 8vh;">
            <i class="fab fa-facebook-square d"></i>
            <i class="fab fa-youtube d"></i>
            <i class="fab fa-instagram d"></i>
            <i class="fas fa-envelope d"></i>
            <br>
            <span style="font-size: 0.6rem; letter-spacing: normal;">©2020 Frog Studios, Inc. Tutti i diritti riservati. mindROVER©, 
            Golarion©, Toad of Duty© sono proprietà intelletuali di Frog Studios, Inc.</span>
            
        </div>
    </div> -->

    <?php require_once('../php/modules/footer.php'); ?>

</body>
</html>