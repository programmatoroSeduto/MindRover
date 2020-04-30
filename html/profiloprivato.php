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
    
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/f61875768d.js" crossorigin="anonymous"></script>

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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

?>

    <div class="banner">
        <div style="display: grid; margin: auto;">
            <!-- click: seleziona altra immagine di profilo -->
            <div class="brahma-profile">
                <img src="../assets/avatar/fagiolo.png" style="width: 30vh; max-height: 30vh; min-height: 30vh;"> </img>
                
                <div class="overlay">
                    <div class="text-img">Cambia immagine di profilo</div>
                </div>
            
            </div>
        </div>
        
        <div style="padding-left: 5vw; ">
            <h1 style="line-height: 15vh;">Imperatore Genoveffo Peppolesto III <img class="brahma-tier" src="../assets/img/logo.png" style="width: 7vh; transform: translate(5vh, 2vh);"> </img></h1>
            <p> <i>"Tua madre è un cactus... É spinosa e vive nel deserto."</i> </p>
            <p> <span style="background-color: white; padding: 0 0.5vh; border-radius: 7%;"><i class="fas fa-frog" style="color:green;"></i>  supporter </span> </p>
            <p> <span style="background-color: red; padding: 0 0.5vh; border-radius: 7%;"><i class="fas fa-frog" style="color:white;"></i>  autore </span> </p>
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
            <button class="tablinks active" onclick="activator('#s1', this);">Il tuo profilo</button>
            <button class="tablinks" onclick="activator('#s2', this);">Modifica il tuo profilo</button>
            <button class="tablinks" onclick="activator('#s3', this);">Le tue donazioni</button>
            <button class="tablinks" onclick="activator('#s4', this);">I miei articoli</button>
            <button class="tablinks" onclick="activator('#s5', this);">Scrivi un articolo</button>
            <button class="ghandi"> </button>
            <button class="tablinks"> <a href="../php/logout.php" style="color:blue;">Logout</a> </button>
        </div>

        <!-- Barra destra -->
        <div class="panel-container">

            <!-- Anteprima profilo -->
            <div class="tabcontent" id="s1">

                <div class="vishnu">
                    <div>Iscritto da:</div> <div>16/09/2019 23:44</div>
                    <div>Email:</div> <div>g.peppo@gmail.com</div>
                    <div class="sep"></div> <div class="sep"></div>
                    <div>Nome:</div> <div>Genoveffo</div>
                    <div>Cognome:</div> <div>Peppolesto</div>
                    <div>Anonimo?</div> <div><i class="fas fa-check" style="color:green;"></i> <i class="fas fa-times" style="color:red;"></i></div>
                    <div>Autore?</div> <div><i class="fas fa-check" style="color:green;"></i> <i class="fas fa-times" style="color:red;"></i></div>
                    <div>Supporter?</div> <div><i class="fas fa-check" style="color:green;"></i> <i class="fas fa-times" style="color:red;"></i></div>
                    <div>Numero donazioni:</div> <div>23</div>
                    <div>Somma totale donata:</div> <div>100.000.000,00 €</div>
                    <div>Posizione classifica Top Donators:</div> <div><b>n° 23</b></div>
                </div>

            </div>
            
            <!-- Modifica profilo -->
            <div class="tabcontent kali" id="s2">
            
                <div class="vishnu" style="grid-template-columns: 1fr 2fr 2fr;">
                    <div>Email:</div> <div>g.peppo@gmail.com</div> <div><i>modifica</i></div>
                    <div>Password:</div> <div><i>Una password incredibilmente sicura e affidabile</i></div> <div><i>modifica</i></div>
                    <div class="sep"></div> <div class="sep"></div> <div class="sep"></div>
                    <div>Nickname:</div> <div>Imperatore Genoveffo Peppolesto III</div> <div><i>modifica</i></div>
                    <div>Stato:</div> <div>"Tua madre è un cactus... É spinosa e vive nel deserto."</div> <div><i>modifica</i></div>
                    <div>Nome:</div> <div>Genoveffo</div> <div><i>modifica</i></div>
                    <div>Cognome:</div> <div>Peppolesto</div> <div><i>modifica</i></div>
                    <div>Anonimo?</div> <div><i class="fas fa-check" style="color:green;"></i> <i class="fas fa-times" style="color:red;"></i></div> <div><i>modifica</i></div>
                </div>

            </div>

            <!-- Donazioni -->
            <div class="tabcontent kali" id="s3">
                Le tue donazioni
            </div>

            <!-- Raccolta articoli postati -->
            <div class="tabcontent kali" id="s4">
                I miei articoli
            </div>
            
            <!-- Postare un nuovo articolo -->
            <div class="tabcontent kali" id="s5">
                Scrivi un articolo
            </div>

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

    

</body>

</html>
