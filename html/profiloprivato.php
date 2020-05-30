<?php
session_start();
$ganesh = "ACCOUNT";
$dictator = false;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benvenuto <?php echo $_SESSION['nickname']; ?>!</title>

    <!-- CSS -->
    <link type="text/css" rel="stylesheet" href="../css/utils/clearsheet.css">
    <link type="text/css" rel="stylesheet" href="../css/nav.css">
    <link type="text/css" rel="stylesheet" href="../css/fonts.css">
    <link type="text/css" rel="stylesheet" href="../css/footer2.css">
    <link type="text/css" rel="stylesheet" href="../css/text-container.css">
    <link type="text/css" rel="stylesheet" href="../css/profile_settings_style.css">
    <link type="text/css" rel="stylesheet" href="../css/modal.css">
    
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/f61875768d.js" crossorigin="anonymous"></script>

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- METADATI -->
    <link rel="icon" href="../assets/img/frog-icon.png">

    <style>
        .tablinks
        {
            flex: 1;
        }

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
</head>

<body>
    
<!-- navbar -->
<?php

require_once('../php/modules/navbar.php');
require_once('../php/db/mysql_credentials.php');
require_once('../php/db/ImgProfilo.php');
require_once('../php/db/Articoli.php');
$dbms = connect();
$imgProfilo_stili = array();
{
    $table = new ImgProfilo($dbms);
    $imgProfilo_stili = $table->getAllStyles();
}

if(isset($_SESSION['user_id']))
{
    get_private_navbar($ganesh);
}
else
{
    header('location: ../html/login.php');
    die();
}

//informazioni di stile per la pagina (per comodità...)
$banner_rgb = implode(', ', $_SESSION['style_data']['banner']);
$color1_rgb = implode(', ', $_SESSION['style_data']['color_1']);
$color2_rgb = implode(', ', $_SESSION['style_data']['color_2']);
$avatar = $_SESSION['style_data']['icon_path'];

$date_subscr = (new DateTime($_SESSION['subscription_timestamp']))->format('d/m/Y');
$time_subscr = (new DateTime($_SESSION['subscription_timestamp']))->format('h:m');
$email = $_SESSION['email'];

$nickname = $_SESSION['nickname'];
$dictator = ((strcmp('Kallaari', $nickname) == 0) || (strcmp('KungKurth', $nickname) == 0));
$first_name = ucfirst($_SESSION['firstname']);
$last_name = ucfirst($_SESSION['lastname']);
$descr = $_SESSION['descr'];
$status = $_SESSION['status'];
$is_anonymous = $_SESSION['is_anonymous'];

$is_author = $_SESSION['is_author'];

//icone tier
$tier_icon = array
(
    '',
    /* -- TIER 1 -- */'<img class="brahma-tier" src="../assets/img/logo.png" style="width: 7vh; margin: 8vh 0; margin-left: 3vw;" title="Sei Tier I!">',
    /* -- TIER 2 -- */'<img class="brahma-tier" src="../assets/img/imbrogliona.png" style="width: 7vh; height: 7vh; margin: 8vh 0; margin-left: 3vw;" title="Sei Tier II!">',
    /* -- TIER 3 -- */'<img class="brahma-tier" src="../assets/img/scambio.png" style="width: 7vh; margin: 8vh 0; margin-left: 3vw;" title="Sei Tier III!">',
);

$supporter = $_SESSION['crowdfunding_supporter'];
$my_tier = ($supporter? $_SESSION['crowdfunding_tier'] : 0);

//altri dati crowdfunding
$crowd_count = $_SESSION['crowdfunding_count'];
$crowd_sum = $_SESSION['crowdfunding_sum'];
$crowd_rank = /*$_SESSION['crowdfunding_rank']*/ 22;

$donation_table = $_SESSION['crowdfunding_donation_list'];

//appellativo divertente prima del nome
require_once('../php/modules/funny.php');

//articoli
$table_articoli = new Articoli($dbms);
$articoli = array();
if($is_author)
{
    $articoli = $table_articoli->searchByAuthorId($_SESSION['user_id']);
}

?>

    <div class="banner" style="background: linear-gradient(90deg, rgb(<?php echo $banner_rgb; ?>, 1), rgb(<?php echo $banner_rgb; ?>, 0.8)); ">
        
        <!-- la propria icona di profilo -->
        <div style="display: grid; margin: auto;">
            
            <!-- click: seleziona altra immagine di profilo -->
            <div class="brahma-profile" style="background: linear-gradient(45deg, rgb(<?php echo $color1_rgb; ?>), rgb(<?php echo $color2_rgb; ?>));">
                <img src="<?php echo $avatar; ?>" class="avatar">
                
                <div class="overlay" id="style_btn" style="cursor: pointer;">
                    <div class="text-img">Cambia immagine di profilo</div>
                </div>
                <div id="style_modal" class="modal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span id="style_close" class="close">&times;</span>
                            <h2>Modifica Stile</h2>
                        </div>
                        <div class="modal-body">
                            <div style="min-height: 50vh; max-height: 50vh; overflow-y: scroll; padding: 3vh 3vh; display: flex; flex-direction: column;">
                                
                                <?php
                                    foreach($imgProfilo_stili as $stile)
                                    {
                                        $stile['stile']['banner'] = 'rgb(' . implode(', ', $stile['stile']['banner']) . ')';
                                        $stile['stile']['color_1'] = 'rgb(' . implode(', ', $stile['stile']['color_1']) . ')';
                                        $stile['stile']['color_2'] = 'rgb(' . implode(', ', $stile['stile']['color_2']) . ')';
                                        echo '<div style="background-color: ' . $stile['stile']['banner'] . '; flex: 1; min-height: 8vh; max-height: 8vh; margin-top: 1rem;">';
                                            echo '<a href="../php/update_profile.php?id_stile=' . $stile['id'] . '">';
                                                echo '<div class="brahma-profile-mini" style="margin-top: 1vh; margin-left: 1vw; background: linear-gradient(45deg, '. $stile['stile']['color_1'] .', ' . $stile['stile']['color_2'] . ');">';
                                                    echo '<img src="' . $stile['stile']['icon_path'] . '" class="avatar-mini">';
                                                echo '</div>';
                                            echo '</a>';
                                        echo '</div>';
                                    }
                                ?>
                                
                            </div>
                        </div>
                        <div class="modal-footer">Non trovi il tuo stile? Vuoi suggerircene uno? <b>Contattaci!</b></div>
                    </div>
                </div>
            
            </div>

        </div>
        
        <!-- informazioni sull'utente -->
        <div style="padding-left: 5vw; display: grid; grid-template-columns: 1fr 2fr;">
            
            <!-- informazioni -->
            <div>
                <h1 style="padding-top: 5vh;">
                    <span style="padding-top: 7.5vh;">
                        <!-- <?php echo funny() . ' ' . $first_name . ' ' . $last_name; ?> -->
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

            <!-- icona tier -->
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
            <button class="tablinks active" onclick="activator('#s1', this); changeTitlePage('Benvenuto <?php echo $nickname; ?>!');" title="Un'occhiata generale al tuo profilo.">Il tuo profilo</button>
            <button class="tablinks" onclick="activator('#s2', this); changeTitlePage('Impostazioni di Profilo');" title="Puoi modificare da qui le tue credenziali, il tuo nickname, e molto altro.">Modifica il tuo profilo</button>

            <?php if($supporter): ?>
                <button class="tablinks" onclick="activator('#s3', this); changeTitlePage('Donazioni');" title="Vedi quante donazioni hai fatto, quando le hai fatte, e molto altro.">Le tue donazioni</button>
            <?php endif ?>

            <?php if($is_author): ?>
                <!-- voci riservate agli autori -->
                <button class="tablinks" onclick="activator('#s4', this); changeTitlePage('I miei articoli');" tilte="Una lista di tutti gli articoli che hai scritto finora.">I miei articoli</button>
                <button class="tablinks" onclick="activator('#s5', this); changeTitlePage('Scrivi un articolo');" tilte="Come pubblicare un nuovo articolo.">Scrivi un articolo</button>
            <?php endif ?>

            <!-- logout -->
            <button class="ghandi" style="<?php 
                if(!$is_author && $supporter) echo 'flex: 4;'; 
                elseif($is_author && !$supporter) echo 'flex: 3';
                elseif($is_author && $supporter) echo 'flex: 2';
                else echo 'flex: 5;' 
            ?>"> </button>
            <button class="tablinks" onclick="location.href='../php/logout.php';"><p style="color: blue;">Logout</p></button>
        </div>

        <!-- Barra destra -->
        <div class="panel-container">

            <!-- Anteprima profilo -->
            <div class="tabcontent" id="s1">

                <div class="vishnu">
                    <!-- email e data creazione del profilo -->
                    <div><?php echo datetime_funny(); ?></div> <div><?php echo $date_subscr ?> alle <?php echo $time_subscr ?></div>
                    <div>La tua Email:</div> <div><?php echo $email ?></div>

                    <div class="sep"></div> <div class="sep"></div>

                    <!-- nome e cognome -->
                    <div>Nome e cognome:</div> <div><?php echo $first_name ?> <?php echo $last_name ?></div>

                    <!-- nickname -->
                    <div><b>Nickname:</b></div> <div><b><?php echo $nickname ?></b></div>

                    <div class="sep"></div> <div class="sep"></div>                    

                    <!-- check: profilo anonimo? -->
                    <div title="Non vuoi che gli altri utenti ti trovino tramite il nostro motore di ricerca? Spunta questa opzione su 'modifica il tuo profilo', timidone.">
                        Il tuo profilo è anonimo?
                    </div>
                    <div id="info-profilo-anonimo">
                        <?php if($is_anonymous): ?>
                            <i class="fas fa-check" style="color:green;"></i>
                        <?php else: ?>
                            <i class="fas fa-times" style="color:red;"></i>
                        <?php endif ?>
                    </div>
                    
                    <!-- check: sei un autore? -->
                    <div title="Possibilità riservata solo ai portavoce ufficialmente riconosciuti dalla Frog Studios.">
                        Puoi scrivere articoli?
                    </div>
                    <div id="info-profilo-autore">
                        <?php if($is_author): ?>
                            <i class="fas fa-check" style="color:green;"></i>
                        <?php else: ?>
                            <i class="fas fa-times" style="color:red;"></i>
                        <?php endif ?>
                    </div>
                    
                    <!-- check: supporter? -->
                    <div title="Sei un supporter se hai fatto almeno una donazione alla Frog Studios">
                        Sei un supporter?
                    </div> 
                    <div id="info-profilo-supporter">
                        <?php if($supporter): ?>
                            <i class="fas fa-check" style="color:green;"></i> 
                        <?php else: ?>
                            <i class="fas fa-times" style="color:red;"></i>
                        <?php endif ?>
                    </div>

                    <!-- sezione riservata ai supporter -->
                    <?php if($supporter): ?>

                        <div class="sep"></div> <div class="sep"></div>

                        <div title="Evvai!">Quante donazioni hai effettuato:</div> <div title="evviva!"><?php echo $crowd_count; ?></div>
                        <div title="Evviva!">Somma donata alla causa:</div> <div title="evvai!"><?php echo $crowd_sum; ?> €</div>
                        <div title="Scala la vetta! E soprattutto, vantatene coi tuoi amici"><b>Posizione classifica Top Donators:</b></div> <div title="Scala la vetta! E soprattutto, vantatene coi tuoi amici"><b><i>prossimamente...</i></b></div>
                    <?php endif ?>
                </div>

            </div>
            
            <!-- Modifica profilo -->
            <div class="tabcontent kali" id="s2">
            
                <div class="vishnu" style="grid-template-columns: 1fr 2fr 2fr;">
                    
                    <div>La tua Email:</div> <div id="email-info"><?php echo $email ?></div> 
                    <div>
                        <a class="d text-content modifica" id="email_btn">modifica</a>
                        <div id="email_modal" class="modal">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <span id="email_close" class="close">&times;</span>
                                    <h2>Modifica Email</h2>
                                </div>
                                <div class="modal-body">
                                    <div style="padding: 5vh 3vh">
                                        <form method="POST" action="../php/update_profile.php">
                                            <div class="form-container">
                                                <input type="email" name="email" placeholder="La tua nuova email" class="form">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                            
                                            <div class="form-container">
                                                <input type="password" name="password" placeholder="Conferma inserendo la tua password" class="form">
                                                <i class="fas fa-key"></i>
                                            </div>
                                            
                                            <br>
                                            <div>
                                                <input class="d text-content modifica" type="submit" value="Applica" style="background-color: transparent; border-style: none;"></input>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal-footer"><!-- solo per decorazione --></div>
                            </div>
                        </div>
                    </div>
                    
                    <div>Password:</div> <div><i>(Una password incredibilmente sicura e affidabile)</i></div>
                    <div>
                        <a class="d text-content modifica" id="pass_btn">modifica</a>
                        <div id="pass_modal" class="modal">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <span id="pass_close" class="close">&times;</span>
                                    <h2>Modifica Password</h2>
                                </div>
                                <div class="modal-body">
                                    <div style="padding: 5vh 3vh">
                                        <form method="POST" action="../php/update_profile.php">
                                            <div class="form-container">
                                                <input type="password" name="new_password" placeholder="La tua nuova password" class="form">
                                                <i class="fas fa-key"></i>
                                            </div>

                                            <div class="form-container">
                                                <input type="password" name="confirm_password" placeholder="Conferma la tua nuova password" class="form">
                                                <i class="fas fa-key"></i>
                                            </div>

                                            <div class="form-container">
                                                <input type="email" name="email" placeholder="Conferma inserendo la tua email" class="form">
                                                <i class="fas fa-envelope"></i>
                                            </div>

                                            <div class="form-container">
                                                <input type="password" name="password" placeholder="La tua attuale password" class="form">
                                                <i class="fas fa-key"></i>
                                            </div>

                                            <br>
                                            <div>
                                                <input class="d text-content modifica" type="submit" value="Applica" style="background-color: transparent; border-style: none;"></input>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal-footer"><!-- solo per decorazione --></div>
                            </div>
                        </div>
                    </div>
                    
                    <div title="clicca sul check per modificare">Sei anonimo?</div> 
                        <?php if($is_anonymous): ?>
                            <a href="../php/update_profile.php?anonimo=0"><i class="fas fa-check" style="color:green;"></i></a>
                        <?php else: ?>
                            <a href="../php/update_profile.php?anonimo=1"><i class="fas fa-times" style="color:red;"></i></a>
                        <?php endif ?>
                    <div>
                        
                    </div>
                    
                    <div class="sep"></div> <div class="sep"></div> <div class="sep"></div>
                    
                    <div><b>Nickname:</b></div> <div><b><?php echo $nickname; ?></b></div> 
                    <div>
                        <a class="d text-content modifica" id="nick_btn">modifica</a>
                        <div id="nick_modal" class="modal">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <span id="nick_close" class="close">&times;</span>
                                    <h2>Modifica Nickname</h2>
                                </div>
                                <div class="modal-body">
                                    <div style="padding: 5vh 3vh">
                                        <form method="POST" action="../php/update_profile.php">
                                            <div class="form-container">
                                                <input type="text" name="nickname" placeholder="Un nuovo incredibile nickname" class="form">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <br>
                                            <div>
                                                <input class="d text-content modifica" type="submit" value="Applica" style="background-color: transparent; border-style: none;"></input>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal-footer"><!-- solo per decorazione --></div>
                            </div>
                        </div>
                    </div>
                    
                    <div>Nome:</div> <div><?php echo $first_name; ?></div> 
                    <div>
                        <a class="d text-content modifica" id="first_btn">modifica</a>
                        <div id="first_modal" class="modal">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <span id="first_close" class="close">&times;</span>
                                    <h2>Modifica Nome</h2>
                                </div>
                                <div class="modal-body">
                                    <div style="padding: 5vh 3vh">
                                            <form method="POST" action="../php/update_profile.php">
                                                <div class="form-container">
                                                    <input type="text" name="firstname" placeholder="Hai davvero cambiato nome?" class="form">
                                                    <i class="fas fa-signature"></i>
                                                </div>
                                                <br>
                                                <div>
                                                    <input class="d text-content modifica" type="submit" value="Applica" style="background-color: transparent; border-style: none;"></input>
                                                </div>
                                            </form>
                                    </div>
                                </div>
                                <div class="modal-footer"><!-- solo per decorazione --></div>
                            </div>
                        </div>
                    </div>
                    
                    <div>Cognome:</div> <div><?php echo $last_name; ?></div> 
                    <div>
                        <a class="d text-content modifica" id="last_btn">modifica</a>
                        <div id="last_modal" class="modal">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <span id="last_close" class="close">&times;</span>
                                    <h2>Modifica Cognome</h2>
                                </div>
                                <div class="modal-body">
                                    <div style="padding: 5vh 3vh">
                                        <form method="POST" action="../php/update_profile.php">
                                            <div class="form-container">
                                                <input type="text" name="lastname" placeholder="Hai davvero cambiato cognome?" class="form">
                                                <i class="fas fa-signature"></i>
                                            </div>
                                            <br>
                                            <div>
                                                <input class="d text-content modifica" type="submit" value="Applica" style="background-color: transparent; border-style: none;"></input>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal-footer"><!-- solo per decorazione --></div>
                            </div>
                        </div>
                    </div>

                    <div class="sep"></div> <div class="sep"></div> <div class="sep"></div>

                    <div>Stato:</div> <div><?php echo ($status === '' ? '<i>Nessuno stato.</i>' : $status); ?></div> 
                    <div>
                        <a class="d text-content modifica" id="status_btn">modifica</a>
                        <div id="status_modal" class="modal">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <span id="status_close" class="close">&times;</span>
                                    <h2>Modifica Stato</h2>
                                </div>
                                <div class="modal-body">
                                    <div style="padding: 5vh 3vh">
                                        <form method="POST" action="../php/update_profile.php">
                                            <div class="form-container">
                                                <input type="text" name="status" placeholder="Una citazione acculturata, magari?" class="form">
                                                <i class="fas fa-comment"></i>
                                            </div>
                                            <br>
                                            <div>
                                                <input class="d text-content modifica" type="submit" value="Applica" style="background-color: transparent; border-style: none;"></input>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal-footer"><!-- solo per decorazione --></div>
                            </div>
                        </div>
                    </div>
                    
                    <div>Bio:</div> <div style="text-align: justify; padding-right: 10px;"><?php echo ($descr === '' ? '<i>Nessuna bio.</i>' : substr($descr, 0, 50)) . (strlen($descr) > 50 ? '...' : ''); ?></div> 
                    <div>
                        <a class="d text-content modifica" id="descr_btn">modifica</a>
                        <div id="descr_modal" class="modal">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <span id="descr_close" class="close">&times;</span>
                                    <h2>Modifica Bio</h2>
                                </div>
                                <div class="modal-body">
                                    <div style="padding: 5vh 3vh">
                                        <p><?php echo $descr; ?></p>
                                        <div style="min-height: 2rem;"><!-- separatore --></div>
                                        <form method="POST" action="../php/update_profile.php">
                                            <div class="form-container">
                                                <input type="text" name="description" placeholder="Parlaci di te, non so, dicci se hai dei cani." class="form">
                                                <i class="fas fa-book-open"></i>
                                            </div>
                                            <br>
                                            <div>
                                                <input class="d text-content modifica" type="submit" value="Applica" style="background-color: transparent; border-style: none;"></input>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal-footer"><!-- solo per decorazione --></div>
                            </div>
                        </div>
                    </div>

                </div>

                <script src="../js/autocomplete.js"></script>
            </div>

            <!-- Donazioni -->
            <div class="tabcontent kali example" id="s3">
                <div style="display: flex; flex-direction: column;">
                    <?php
                        if($supporter)
                        {
                            echo '<h1 style="margin: 0 0 5vh 0; font-family: ganesh; font-size: 3.25rem; color: rgb(46, 46, 46);">Le tue donazioni</h1>
                                <div style="padding: 10px; font-family: ganesh; margin: 3px 0; color:white; background-color: #8f281d; display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; font-weight: bolder;">
                                    <div>Codice</div>
                                    <div>Data donazione</div>
                                    <div>Somma donazione</div>
                                    <div>Confermata?</div>
                                </div>';
                            //var_dump($donation_table);die();
                            foreach($donation_table as $row)
                            {
                                echo '<div style="padding: 10px; margin: 3px 0; background-color: rgb(212, 212, 212); display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; ">';
                                    echo '<div>' . $row['id'] . '</div>';
                                    echo '<div>' . $row['data'] . ' ' . $row['ora']  . '</div>';
                                    echo '<div>' . $row['somma'] . '</div>';
                                    echo '<div><i class="fas fa-check" style="color: green;"></i></div>';
                                echo '</div>';
                            }
                        }
                        else
                        {
                            echo '<h1 style="margin: 0 0 5vh 0; font-family: ganesh; font-size: 3.25rem; color: rgb(46, 46, 46);">Nessuna donazione!</h1>';
                        }
                    ?>
                </div>
                <div style="height: 8vh;"></div>
            </div>
            
            <?php if($is_author): ?>
            <!-- Raccolta articoli postati -->
            <div class="tabcontent kali example" id="s4">
                <div style="display: flex; flex-direction: column;">
                    <?php
                        if($is_author)
                        {
                            echo '<h1 style="margin: 0 0 5vh 0; font-family: ganesh; font-size: 3.25rem; color: rgb(46, 46, 46);">I tuoi articoli</h1>
                                <div style="padding: 10px; margin: 3px 0; font-family: ganesh; color: white; background-color: #8f281d; display: grid; grid-template-columns: 1fr 1fr 1fr; font-weight: bolder;">
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
            
            <!-- Postare un nuovo articolo -->
            <div class="tabcontent kali example" id="s5">
                <div style="display: block;">
                    <!-- ELIMINARE PRIMA DELL'ESAME! -->
                    <p><i>Pssssss ehi tester! Usa questo form per scrivere un articolo, <a href="./createArticle.php"><b>è qui!</b></a></i></p>
                    <br>
                    <br>
                    <br>
                    <br>
                    <h1 style="font-family: ganesh">Ehi! Vuoi scrivere un nuovo articolo?</h1>
                    <p>Fantastico! Ti spiego come fare:</p>
                    <ol>
                        <li><b style="font-family: ganesh">Scrivi prima il tuo articolo!</b> E' sufficiente un documento word, o anche uno scanner del tuo scritto. <br> Puoi anche inviarci direttamente il documento in formato HTML, per darci un'idea più precisa di come dovrà apparire all'utente il tuo articolo.</li>
                        <li><b style="font-family: ganesh">Inviaci il tuo scritto.</b> Scrivimi, sono KungKurth, mi trovi sul motore di ricerca. 
                        <br>La mia email è <i style="text-decoration: underline;">kung.autori@frogstudios.com</i> (per favore, niente spam o pacchi bomba ...)</li>
                        <li><b style="font-family: ganesh">Sorseggia la tua bevanda preferita</b> mentre lavoriamo per pubblicare il tuo articolo.<br>Tipicamente impieghiamo una settimana per valutare e ottimizzare la grafica del tuo articolo (eh sì, siamo molto impegnati da queste parti); ti contatteremo per informarti su come procede il lavoro.</li>
                        <li><b style="font-family: ganesh">Controlla la tua pubblicazione</b> e vantatene con gli amici.</li>
                    </ol>
                    <br>
                    <h1 style="font-family: ganesh">A te che ci supporti: <i>GRAZIE!</i></h1>
                    <p>Ti ringraziamo per il tuo tempo e il tuo impegno, stai partecipando a qualcosa di grande!</p>
                    <p style="text-align: center; text-transform: capitalize; font-style: italic;">Kallaari, KungKurth</p>
                </div>
            </div>
            <?php endif ?>

        </div>
    </div>

    <?php require_once('../php/modules/footer.php'); ?>

<!-- Script per il modal -->
<script src="../js/profilo_privato_modals.js"></script> 

</body>

</html>
