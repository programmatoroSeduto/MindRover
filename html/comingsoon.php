<?php
session_start();
$ganesh = "COMINGSOON";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coming Soon</title>
 
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
    
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <style>

    .title404{
        text-shadow: -1px 1px 2px #000, 
        1px 1px 2px #000, 
        1px -1px 0 #000, 
        -1px -1px 0 #000;"
    }

    </style>

</head>

<body style="background-color: #aa281e">
    <!-- Immagine iniziale pagina -->
    <div class="splash-container splash-bg-main" style="background-image: url('../assets/img/stanco.jpg'); 
    opacity: 0.9; background-size: auto; background-repeat: repeat; background-position: 65px 65px;">
       
        <div class="splash-body">
            <h1 class="splash-body-heading title404">
                Errore: pagina non esistente!
            </h1>

            <p class="splash-body-paragraph title404">
                Forse non c'è proprio, forse la stiamo ancora costruendo...
            </p>
        
        </div>
    </div>

<!-- Navbar -->
<?php

require_once('../php/modules/navbar.php');

if(isset($_SESSION['user_id']))
{
    get_private_navbar($ganesh);
}
else
{
    get_public_navbar($ganesh);
}

?>

    <div>
        
    </div>
    
    <!-- Footer -->
    <?php require_once('../php/modules/footer.php'); ?>

</body>

</html>