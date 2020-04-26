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

    <link type="text/css" rel="stylesheet" href="../css/utils/clearsheet.css">
    <link type="text/css" rel="stylesheet" href="../css/nav.css">
    <link type="text/css" rel="stylesheet" href="../css/fonts.css">
    <link type="text/css" rel="stylesheet" href="../css/footer.css">
    <link type="text/css" rel="stylesheet" href="../css/profile_settings_style.css">
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
    //get_public_navbar($ganesh);
    header('location: ../html/login.php');
    die();
}

?>
    <div class="settings-container">
        <div class="tab">
            <button class="tablinks" onclick="">Il tuo profilo</button>
            <button class="tablinks" onclick="">Le tue credenziali</button>
            <button class="tablinks" onclick="">Le tue informazioni di profilo</button>
            <button class="tablinks" onclick="">Le tue donazioni</button>
        </div>

        <div class="panel-container">

            <div class="tabcontent" style="grid-template-columns: 11fr 8fr; grid-column-gap: 200px; padding: 2%;">
            
                <div class="vishnu" style="display: flex; flex-direction: column;">

                    <div style="flex: 2;">
                        <img src="../assets/img/ronin.png" style="height: auto; width: 300px; border-radius: 50%; background-color: red; border: 1.5px solid rgba(0, 0, 0, 0.8);"><br>
                        <b style="text-align: center;">Imperatore Genoveffo Peppolesto III</b>
                    </div>

                </div>

                <div class="vishnu" style="display: flex; flex-direction: column;">

                    <div style="flex: 1;">
                        genoveffo.peppolesto@truffa.it
                    </div>
                    
                    <div style="flex: 1;">
                        Hai donato il tumore al pancreas a Luigino il bambino birichino
                    </div>

                    <div style="flex: 1;">
                        <img src="../assets/img/logo.png" style="height: auto; width: 100px; border-radius: 50%; background-color: green; border: 1.5px solid rgba(0, 0, 0, 0.8);"><br>
                        Bravo! Con la tua donazione ti conferiamo il titolo di BASTARDO!
                    </div>

                </div>

            </div>
            
            <div class="tabcontent" style="grid-template-columns: 11fr 8fr; grid-column-gap: 200px; padding: 2%; display: none;">
            
                <div class="vishnu" style="display: flex; flex-direction: column;">

                <div style="flex: 1;">
                        La tua e-mail:
                        <br>genoveffo.peppolesto@truffa.it
                    </div>
                    
                    <div style="flex: 1;">
                        La tua password:
                        <br> sexypeppone69
                    </div>

                </div>

                <div class="vishnu" style="display: flex; flex-direction: column;">

                    <div style="flex: 1;">
                        Modifica e-mail
                    </div>
                    
                    <div style="flex: 1;">
                        Modifica password
                    </div>

                </div>

            </div>
            
            <div class="tabcontent" style="grid-template-columns: 1fr 4fr 4fr; grid-column-gap: 100px; padding: 2%; display: none;">
            
                <div class="vishnu" style="display: flex; flex-direction: column;">

                    <div style="flex: 1;">
                        <img src="../assets/img/ronin.png" style="height: auto; width: 300px; border-radius: 50%; background-color: red; border: 1.5px solid rgba(0, 0, 0, 0.8);"><br>
                        La tua immagine di profilo
                    </div>

                </div>

                <div class="vishnu" style="display: flex; flex-direction: column;">

                    <div style="flex: 1;">
                        Il tuo nickname:
                        <br>Imperatore Genoveffo Peppolesto III
                    </div>
                    
                    <div style="flex: 1;">
                        Il tuo informazione2:
                        <br>Sas?
                    </div>

                    <div style="flex: 1;">
                        Il tuo informazione3:
                        <br>Callafix?
                    </div>

                </div>

                <div class="vishnu" style="display: flex; flex-direction: column;">

                    <div style="flex: 1;">
                        Modifica il tuo nickname
                    </div>
                    
                    <div style="flex: 1;">
                        Modifica il tuo informazione2
                    </div>

                    <div style="flex: 1;">
                        Modifica il tuo informazione3
                    </div>

                </div>

            </div>

            <div class="tabcontent" style="grid-template-columns: 4fr 4fr; grid-column-gap: 100px; padding: 2%; display: none;">
            
                <div class="vishnu" style="display: flex; flex-direction: column;">

                    <div style="flex: 1;">
                        <img src="../assets/img/logo.png" style="height: auto; width: 300px; border-radius: 50%; background-color: green; border: 1.5px solid rgba(0, 0, 0, 0.8);"><br>
                        Il tuo Tier
                    </div>

                </div>

                <div class="vishnu" style="display: flex; flex-direction: column;">

                    <div style="flex: 1;">
                        Le tue donazioni:
                        <br>Codifica donazione1
                        <br>Codifica donazione2
                        <br>Codifica donazHai rotto il cazzo, fai una sola donazione.
                    </div>
                    
                    <div style="flex: 1;">
                        Il Tier su cui ricadi:
                        <br>Complimenti, sei Tier I! 
                        <br><a href="../HTML/crowdfunding.html"><i class="d">Clicca qui</i></a> per scoprire tutti i vantaggi!
                    </div>

                </div>

            </div>

        </div>
    </div>

    <!-- Footer -->
    <div class="footer-container footer-bg" style="min-height: 277px"> 
        <div class="footer-content">

            <img src="../assets/img/logo.png" style="width: 6%;">   
            <img src="../assets/img/unige.png" alt="Unige" style="width: 4%;">
            <i class="fab fa-facebook-square d"></i>
            <i class="fab fa-youtube d"></i>
            <i class="fab fa-instagram d"></i>
            <i class="fas fa-envelope d"></i>
            <br>
            <span style="font-size: 12px; letter-spacing: normal;">©2020 Frog Studios, Inc. Tutti i diritti riservati. mindROVER©, 
            Golarion©, Toad of Duty© sono proprietà intelletuali di Frog Studios, Inc.</span>
            
        </div>
    </div>
    
</body>
</html>
