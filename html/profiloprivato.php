<?php
session_start();
$ganesh = "ACCOUNT";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Il tuo profilo</title>

    <!-- CSS -->
    <link type="text/css" rel="stylesheet" href="../css/utils/clearsheet.css">
    <link type="text/css" rel="stylesheet" href="../css/nav.css">
    <link type="text/css" rel="stylesheet" href="../css/fonts.css">
    <link type="text/css" rel="stylesheet" href="../css/footer.css">
    <link type="text/css" rel="stylesheet" href="../css/text-container.css">
    <link type="text/css" rel="stylesheet" href="../css/profile_settings_style.css">
    <link type="text/css" rel="stylesheet" href="../css/modal.css">
    
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/f61875768d.js" crossorigin="anonymous"></script>

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <style>
        .tablinks
        {
            flex: 1;
        }
    </style>
</head>

<body>
    
<!-- navbar -->
<?php

require_once('../php/modules/navbar.php');

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
    /* -- TIER 1 -- */'<img class="brahma-tier" src="../assets/img/logo.png" style="width: 7vh; margin: 8vh 0; margin-left: 3vw;">',
    /* -- TIER 2 -- */'<img class="brahma-tier" src="" style="">',
    /* -- TIER 3 -- */'<img class="brahma-tier" src="" style="">'
);

$supporter = $_SESSION['crowdfunding_supporter'];
$my_tier = ($supporter? $_SESSION['crowdfunding_tier'] : 0);

//altri dati crowdfunding
$crowd_count = $_SESSION['crowdfunding_count'];
$crowd_sum = $_SESSION['crowdfunding_sum'];
$crowd_rank = $_SESSION['crowdfunding_rank'];

//appellativo divertente prima del nome
require_once('../php/modules/funny.php');

?>

    <div class="banner" style="background: linear-gradient(90deg, rgb(<?php echo $banner_rgb; ?>, 1), rgb(<?php echo $banner_rgb; ?>, 0.8)); ">
        
        <!-- la propria icona di profilo -->
        <div style="display: grid; margin: auto;">
            
            <!-- click: seleziona altra immagine di profilo -->
            <div class="brahma-profile" style="background: linear-gradient(45deg, rgb(<?php echo $color1_rgb; ?>), rgb(<?php echo $color2_rgb; ?>));">
                <img src="<?php echo $avatar; ?>" class="avatar">
                
                <div class="overlay">
                    <div class="text-img">Cambia immagine di profilo</div>
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

                <?php if($supporter): ?>
                    <p> <span class="userinfo-tag tag-supporter"><i class="fas fa-frog"></i>  supporter </span> </p>
                <?php endif ?>

                <?php if($is_author): ?>
                    <p> <span class="userinfo-tag tag-author"><i class="fas fa-frog"></i>  autore </span> </p>
                <?php endif ?>

                <?php if(!$is_author and !$supporter): ?>
                    <p> <span class="userinfo-tag tag-basic"><i class="fas fa-frog"></i> base </span> </p>
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
        <div class="tab">
            <!-- voci generali per il profilo privato -->
            <button class="tablinks active" onclick="activator('#s1', this);" title="Un'occhiata generale al tuo profilo.">Il tuo profilo</button>
            <button class="tablinks" onclick="activator('#s2', this);" title="Puoi modificare da qui le tue credenziali, il tuo nickname, la tua bio, e molto altro.">Modifica il tuo profilo</button>
            <button class="tablinks" onclick="activator('#s3', this);" title="Vedi quante donazioni hai fatto, quando le hai fatte, la tua posizione in classifica, e molto altro.">Le tue donazioni</button>

            <?php if($is_author): ?>
                <!-- voci riservate agli autori -->
                <button class="tablinks" onclick="activator('#s4', this);" tilte="Una lista di tutti gli articoli che hai scritto finora.">I miei articoli</button>
                <button class="tablinks" onclick="activator('#s5', this);" tilte="Puoi pubblicare un nuovo articolo da qui.">Scrivi un articolo</button>
            <?php endif ?>

            <!-- logout -->
            <button class="ghandi" style="<?php if(!$is_author) echo 'flex: 4;'; else echo 'flex: 2;' ?>"> </button>
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

                    <!-- dato che gli indicatori andranno modificati dinamicamente dopo aggiornamento ajax, 
                        memorizzo l'html degli indicatori in modo da poterli utilizzare in furuto via js -->
                    <script>
                        let check_ok = '<i class="fas fa-check" style="color:green;"></i>';
                        let check_no = '<i class="fas fa-times" style="color:red;"></i>';

                        //funzione per cambiare gli indicatori
                        /*
                            id disponibili:
                            info-profilo-...
                                ...anonimo
                                ...autore
                                ...supporter
                        */
                        function setCheck(/*dove*/id, /*bool*/val)
                        {
                            //rimuovi il precedente check
                            $('#' + id).children().remove();

                            //inserisci il nuovo check
                            if(val)
                                $('#' + id).append(check_ok);
                            else
                                $('#' + id).append(check_no);
                        }
                    </script>

                    <!-- check: profilo anonimo? -->
                    <div title="Non vuoi che gli altri utenti ti trovino tramite il nostro motore di ricerca? Spunta questa opzione su 'modifica il tuo profilo', timidone.">
                        il tuo profilo è anonimo?
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
                        <div title="Scala la vetta! E soprattutto, vantatene coi tuoi amici"><b>Posizione classifica Top Donators:</b></div> <div title="Scala la vetta! E soprattutto, vantatene coi tuoi amici"><b>n° <?php echo $crowd_rank; ?></b></div>
                    <?php endif ?>
                </div>

            </div>
            
            <!-- Modifica profilo -->
            <div class="tabcontent kali" id="s2">
            
                <div class="vishnu" style="grid-template-columns: 1fr 2fr 2fr;">
                    
                    <div>la tua Email:</div> <div><?php echo $email ?></div> 
                    <!-- <div><i>cambia la tua mail</i></div> -->
                    <div>
                        <a class="d text-content modifica" id="email_btn">modifica</a>
                        <div id="email_modal" class="modal">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <span id="email_close" class="close">&times;</span>
                                    <h5>La tua nuova mail:</h2>
                                </div>
                                <div class="modal-body">
                                    <p><i>seeeeeEEEEEeeeees</i></p>
                                </div>
                                <div class="modal-footer"><!-- solo per decorazione --></div>
                            </div>
                        </div>
                    </div>
                    
                    <div>Password:</div> <div><i>(Una password incredibilmente sicura e affidabile)</i></div> 
                    <!-- <div><i>cambiala con una ancora più sicura!</i></div> -->
                    <div>
                        <a class="d text-content modifica" id="pass_btn">modifica</a>
                        <div id="pass_modal" class="modal">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <span id="pass_close" class="close">&times;</span>
                                    <h5>La tua nuova password:</h2>
                                </div>
                                <div class="modal-body">
                                    <p><i>seeeeeEEEEEeeeees</i></p>
                                </div>
                                <div class="modal-footer"><!-- solo per decorazione --></div>
                            </div>
                        </div>
                    </div>
                    
                    <div title="clicca sul check per modificare">sei anonimo?</div> 
                    <div>
                       <?php if($is_anonymous): ?>
                            <i class="fas fa-check" style="color:green;"></i> 
                        <?php else: ?>
                            <i class="fas fa-times" style="color:red;"></i>
                        <?php endif ?>
                    </div> 
                    <div><!--<i>modifica</i>--></div>
                    
                    <div class="sep"></div> <div class="sep"></div> <div class="sep"></div>
                    
                    <div><b>Nickname:</b></div> <div><b><?php echo $nickname; ?></b></div> 
                    <div>
                        <a class="d text-content modifica" id="nick_btn">modifica</a>
                        <div id="nick_modal" class="modal">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <span id="nick_close" class="close">&times;</span>
                                    <h5>Il tuo nuovo nickname:</h2>
                                </div>
                                <div class="modal-body">
                                    <p><i>...un incredibile e innovativo nickname nato dalla tua mente perversa...</i></p>
                                </div>
                                <div class="modal-footer"><!-- solo per decorazione --></div>
                            </div>
                        </div>
                    </div>
                    
                    <div>Nome:</div> <div>Genoveffo</div> 
                    <!-- <div><i>ho cambiato nome.</i></div> -->
                    <div>
                        <a class="d text-content modifica" id="first_btn">modifica</a>
                        <div id="first_modal" class="modal">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <span id="first_close" class="close">&times;</span>
                                    <h5>Il tuo nuovo nome:</h2>
                                </div>
                                <div class="modal-body">
                                    <p><i>...un incredibile e innovativo nickname nato dalla tua mente perversa...</i></p>
                                </div>
                                <div class="modal-footer"><!-- solo per decorazione --></div>
                            </div>
                        </div>
                    </div>
                    
                    <div>Cognome:</div> <div>Peppolesto</div> 
                    <!-- <div><i>ho cambiato cognome.</i></div> -->
                    <div>
                        <a class="d text-content modifica" id="last_btn">modifica</a>
                        <div id="last_modal" class="modal">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <span id="last_close" class="close">&times;</span>
                                    <h5>Il tuo nuovo cognome:</h2>
                                </div>
                                <div class="modal-body">
                                    <p><i>...un incredibile e innovativo nickname nato dalla tua mente perversa...</i></p>
                                </div>
                                <div class="modal-footer"><!-- solo per decorazione --></div>
                            </div>
                        </div>
                    </div>

                    <div class="sep"></div> <div class="sep"></div> <div class="sep"></div>

                    <div>Stato:</div> <div><?php echo ($status === '' ? '<i>Nessuno stato.</i>' : $status); ?></div> 
                    <!-- <div><i>modifica</i></div> -->
                    <div>
                        <a class="d text-content modifica" id="status_btn">modifica</a>
                        <div id="status_modal" class="modal">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <span id="status_close" class="close">&times;</span>
                                    <h5>Il tuo nuovo stato:</h2>
                                </div>
                                <div class="modal-body">
                                    <p><i>...un incredibile e innovativo nickname nato dalla tua mente perversa...</i></p>
                                </div>
                                <div class="modal-footer"><!-- solo per decorazione --></div>
                            </div>
                        </div>
                    </div>
                    
                    <div>Bio:</div> <div style="text-align: justify; padding-right: 10px;"><?php echo ($descr === '' ? '<i>Nessuna bio.</i>' : substr($descr, 0, 50)) . (strlen($descr) > 50 ? '...' : ''); ?></div> 
                    <!-- <div><i>modifica</i></div> -->
                    <div>
                        <a class="d text-content modifica" id="descr_btn">modifica</a>
                        <div id="descr_modal" class="modal">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <span id="descr_close" class="close">&times;</span>
                                    <h5>Descrizione:</h2>
                                </div>
                                <div class="modal-body">
                                    <p><i>...un incredibile e innovativo nickname nato dalla tua mente perversa...</i></p>
                                </div>
                                <div class="modal-footer"><!-- solo per decorazione --></div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <!-- Donazioni -->
            <div class="tabcontent kali" id="s3">
                Le tue donazioni
            </div>
            
            <?php if($is_author): ?>
            <!-- Raccolta articoli postati -->
            <div class="tabcontent kali" id="s4">
                I miei articoli
            </div>
            
            <!-- Postare un nuovo articolo -->
            <div class="tabcontent kali" id="s5">
                Scrivi un articolo
            </div>
            <?php endif ?>

        </div>
    </div>

    <!-- Footer -->
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
    </div>

<!-- Script per il modal -->
<script src="../js/profilo_privato_modals.js"></script> 

</body>

</html>
