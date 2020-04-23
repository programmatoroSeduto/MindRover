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
            <button class="tablinks" onclick="">Home</button>
            <button class="tablinks" onclick="">Le tue credenziali</button>
            <button class="tablinks" onclick="">Le tue informazioni di profilo</button>
            <button class="tablinks" onclick="">Donazioni</button>
        </div>

        <div class="panel-container">
            <div class="tabcontent">il tuo profilo</div>
            <div class="tabcontent">le tue credenziali</div>
            <div class="tabcontent">il tuo profilo</div>
            <div class="tabcontent">le tue donazioni</div>
        </div>
    </div>
</body>
</html>
