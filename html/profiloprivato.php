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
            <div class="tabcontent"></div>
            <!-- <div class="tabcontent">le tue credenziali</div>
            <div class="tabcontent">il tuo profilo</div>
            <div class="tabcontent">le tue donazioni</div> -->
        </div>
    </div>

    <!-- Footer -->
    <div class="footer-container footer-bg" style="min-height: 270px"> 
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
