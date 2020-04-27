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
    //get_public_navbar($ganesh);
    header('location: ../html/login.php');
    die();
}

?>

    <div class="settings-container">
        <div class="tab">
            <button class="tablinks" onclick="$('.panel-container').children().addClass('kali'); $('#s1').removeClass('kali').addClass('tabcontent');">Il tuo profilo</button>
            <button class="tablinks" onclick="$('.panel-container').children().addClass('kali'); $('#s2').removeClass('kali').addClass('tabcontent');">Le tue credenziali</button>
            <button class="tablinks" onclick="$('.panel-container').children().addClass('kali'); $('#s3').removeClass('kali').addClass('tabcontent');">Le tue informazioni di profilo</button>
            <button class="tablinks" onclick="$('.panel-container').children().addClass('kali'); $('#s4').removeClass('kali').addClass('tabcontent');">Le tue donazioni</button>
        </div>

        <div class="panel-container">

            <!-- 
                profilo
             -->
            <div class="tabcontent" id="s1" style="grid-template-columns: 5fr 16fr; grid-column-gap: 200px; padding: 2%;">
            
                <div class="vishnu" style="display: flex; flex-direction: column;">
                    <img src="../assets/img/ronin.png" style="height: auto; width: 300px; border-radius: 50%; background-color: red; border: 1.5px solid rgba(0, 0, 0, 0.8);">
                    <b style="text-align:center">Imperatore Genoveffo Peppolesto III</b>
                </div>

                <div class="vishnu" style="display: flex; flex-direction: column;">

                    <div style="flex: 1;">
                        Genoveffo Peppolesto
                    </div>
                    
                    <div style="flex: 1;">
                        genoveffo.peppolesto@truffa.it
                    </div>

                    <div style="flex: 1;">
                        <img src="../assets/img/logo.png" style="height: auto; width: 100px; border-radius: 50%; background-color: green; border: 1.5px solid rgba(0, 0, 0, 0.8);"><br>
                        Davvero Rospotente, sei Tier I!
                    </div>

                </div>

            </div>
            
            <!-- 
                credenziali 
            -->
            <div class="tabcontent kali" id="s2" style="grid-template-columns: 11fr 8fr; grid-column-gap: 200px; padding: 5%;">
            
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
            
            <!--
                modifica profilo 
            -->
            <div class="tabcontent kali" id="s3" style="grid-template-columns: 10fr 9fr 9fr; grid-column-gap: 200px; padding: 2%;">
            
                <div class="vishnu" style="display: flex; flex-direction: column;">
                        <img src="../assets/img/ronin.png" style="height: auto; width: 300px; border-radius: 50%; background-color: red; border: 1.5px solid rgba(0, 0, 0, 0.8);">
                        <b style="text-align:center">La tua immagine di profilo</b>
                </div>

                <div class="vishnu" style="display: flex; flex-direction: column;">

                    <div style="flex: 1;">
                        Genoveffo Peppolesto
                    </div>
                    
                    <div style="flex: 1;">
                        Il tuo nickname:
                        <br>Imperatore Genoveffo Peppolesto III
                    </div>

                    <div style="flex: 1;">
                        La tua bio:
                        <br>Sono Peppo sono Lesto son Peppolesto Sparalesto!
                    </div>

                </div>

                <div class="vishnu" style="display: flex; flex-direction: column;">

                    <div style="flex: 1;">
                        Modifica nome e cognome
                    </div>
                    
                    <div style="flex: 1;">
                        Modifica nickname
                    </div>

                    <div style="flex: 1;">
                        Modifica bio
                    </div>

                </div>

            </div>

            <!-- 
                donazioni 
            -->
            <div class="tabcontent kali" id="s4" style="grid-template-columns: 16fr 5fr; grid-column-gap: 200px; padding: 2%;">

                <div class="vishnu" style="display: flex; flex-direction: column;">

                    <table>
                        <tr>
                            <th>ID Donazione</th>
                            <th>Somma Donata</th>
                            <th>Data</th>
                        </tr>
                        <tr>
                            <td>SR909P21</td>
                            <td>100€</td>
                            <td>21/7/2020 16:43</td>
                        </tr>
                        <tr>
                            <td>CZ202R43</td>
                            <td>50€</td>
                            <td>3/9/2020 6:13</td>
                        </tr>
                        <tr>
                            <td>RZ989Q12</td>
                            <td>5€</td>
                            <td>30/10/2020 22:22</td>
                        </tr>
                        <tr>
                            <td>WW212K23</td>
                            <td>25€</td>
                            <td>7/12/2020 23:32</td>
                        </tr>
                    </table>
                    <br><b style="text-align:center">Le tue donazioni</b>

                </div>

                <div class="vishnu" style="display: flex; flex-direction: column;">
                        <img src="../assets/img/logo.png" style="height: auto; width: 300px; border-radius: 50%; background-color: green; border: 1.5px solid rgba(0, 0, 0, 0.8);">
                        <b style="text-align:center">Il tuo Tier</b>
                </div>

            </div>

        </div>
    </div>

    <!-- Footer -->
    <div class="footer-container footer-bg" style="min-height: 207px"> 
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
    

    <script>



    </script>

</body>
</html>
