<?php
session_start();
$ganesh = "SEARCH";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link type="text/css" rel="stylesheet" href="../css/utils/clearsheet.css">
    <link type="text/css" rel="stylesheet" href="../css/utils/bg.css">
    <link type="text/css" rel="stylesheet" href="../css/splash.css">
    <link type="text/css" rel="stylesheet" href="../css/nav.css">
    <link type="text/css" rel="stylesheet" href="../css/fonts.css">
    <link type="text/css" rel="stylesheet" href="../css/containers.css">
    <link type="text/css" rel="stylesheet" href="../css/footer.css">
    <link type="text/css" rel="stylesheet" href="../css/text-container.css">
    <link type="text/css" rel="stylesheet" href="../css/board.css">
    <link type="text/css" rel="stylesheet" href="../css/search_page_style.css">

    <script src="../js/search_utils.js"></script>
    
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <title>Cerca ...</title>
</head>

<?php

?>

<body>
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
    
    <div class="page-container">
        <!-- sarà possibile far collassare la barra per dare più spazio agli articoli
                vedi classe CSS .hidden -->
        <div class="search-settings-panel">
            <script>
                var minimized = false;
            </script>
            <div id="search-settings-maximized" class="search-settings-maximized">
                <div class="search-toolbar">
                    <div>opzione 1</div>
                    <div>opzione 2</div>
                    <div>opzione 3</div>
                    <div>opzione 4</div>
                </div>
                <div class="search-inner-panel">
                    <div id="search-settings-panel-1" class="">ciao</div>
                    <div id="search-settings-panel-2" class="hidden"></div>
                    <div id="search-settings-panel-3" class="hidden"></div>
                    <div id="search-settings-panel-4" class="hidden"></div>
                </div>
            </div>
            <div id="search-settings-minimized" class="search-settings-minimized hidden">
                <p>barra di ricerca minimizzata</p>
            </div>
            <div class="search-settings-button">
                <i class="fas fa-angle-down" onclick="
                    if(minimized)
                    {
                        $('#search-settings-maximized').removeClass('hidden');
                        $('#search-settings-minimized').addClass('hidden');
                        $('#search-body').removeClass('body-maximized');
                        minimized = false;
                    }
                    else
                    {
                        $('#search-settings-maximized').addClass('hidden');
                        $('#search-settings-minimized').removeClass('hidden');
                        $('#search-body').addClass('body-maximized');
                        minimized = true;
                    }
                "></i>
            </div>
        </div>
        <!-- per adattare il contenuto alla riduzione di dimensioni della barra, applica la classe body-maximized -->
        <div id="search-body" class="results-list-panel">
            <div class="result-item">
                
            </div>
        </div>
    </div>
    

    <div class="footer-container footer-bg"> 
        <div class="footer-content">

            <img src="../assets/img/logo.png" style="height: 11vh;">   
            <img src="../assets/img/unige.png" alt="Unige" style="height: 10vh;">
            <i class="fab fa-facebook-square d"></i>
            <i class="fab fa-youtube d"></i>
            <i class="fab fa-instagram d"></i>
            <i class="fas fa-envelope d"></i>
            <br>
            <span style="font-size: 0.8rem; letter-spacing: normal;">©2020 Frog Studios, Inc. Tutti i diritti riservati. mindROVER©, 
            Golarion©, Toad of Duty© sono proprietà intelletuali di Frog Studios, Inc.</span>
            
        </div>
    </div>
</body>
</html>