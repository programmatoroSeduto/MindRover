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
    <link type="text/css" rel="stylesheet" href="../css/footer2.css">
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
                var active_panel_idx = 1;
            </script>
            <div id="search-settings-maximized" class="search-settings-maximized">
                <script>
                    function openSearchTab(idx)
                    {
                        var panel_to_enable = 'search-settings-panel-' + idx;
                        var panel_to_disable = 'search-settings-panel-' + active_panel_idx;
                        var btn_to_enable = 'btn-' . idx;
                        var btn_to_disable = 'btn-' . active_panel_idx;

                        $('#' + panel_to_disable).addClass('hidden');
                        $('#' + panel_to_enable).removeClass('hidden');

                        active_panel_idx = idx;
                    }
                </script>
                <div class="search-toolbar">
                    <div id="btn-1" onclick="openSearchTab(1);">Articoli</div>
                    <div id="btn-2" onclick="openSearchTab(2);">Utenti</div>
                    <div id="btn-3" onclick="openSearchTab(3);">Ricerca avanzata</div>
                </div>
                <div class="search-inner-panel">
                    <div id="search-settings-panel-1" class="">
                        <label for="a_title">titolo articolo:</label><input type="text" name="a_title" id="a_title"><br>
                        <label for="a_tags">lista di tag:</label><input type="text"  id="a_tags" name="a_tags"><br>
                        <label for="a_content">contenuto dell'articolo:</label><input type="text" id="a_content" name="a_content"><br>
                        <label for="a_min_timestamp">periodo di pubblicazione: da </label><input type="date" id="a_min_timestamp" name="a_min_timestamp" min="0"><label for="a_max_timestamp"> a </label><input type="date" id="a_max_timestamp" name="a_max_timestamp"><br>
                        <label for="a_author">nickname autore: </label><input type="text" id="a_author" name="a_author"><br>
                        <button onclick="search();">Cerca!</button>
                    </div>
                    <div id="search-settings-panel-2" class="hidden">
                        <label for="u_nickname">nickname utente da cercare: </label><input type="text" id="u_nickname" name="u_nickname"><br>
                        <button onclick="search();">Cerca!</button>
                    </div>
                    <div id="search-settings-panel-3" class="hidden">
                        <label for="search_type">tipo di ricerca:</label>
                        <select id="search_type" name="search_type">
                            <option value="all">utenti e articoli</option>
                            <option value="article">articoli</option>
                            <option value="user">utenti</option>
                        </select><br>
                        <input type="checkbox" id="use_all_data" name="use_all_data" value="1"><label for="use_all_data">ricerca totale</label><br>
                        <input type="checkbox" id="strict" name="strict" value="1"><label for="strict">modalità strict</label><br>
                        <button onclick="search();">Cerca!</button>
                    </div>
                </div>
            </div>
            <div id="search-settings-minimized" class="search-settings-minimized hidden">
                <p>barra di ricerca minimizzata</p>
            </div>
            <div class="search-settings-button">
                <i class="fas fa-angle-up" onclick="
                    if(minimized)
                    {
                        $('#search-settings-maximized').removeClass('hidden');
                        $('#search-settings-minimized').addClass('hidden');
                        $('#search-body').removeClass('body-maximized');
                        $(this).removeClass('fa-angle-down');
                        $(this).addClass('fa-angle-up');
                        minimized = false;
                    }
                    else
                    {
                        $('#search-settings-maximized').addClass('hidden');
                        $('#search-settings-minimized').removeClass('hidden');
                        $('#search-body').addClass('body-maximized');
                        $(this).removeClass('fa-angle-up');
                        $(this).addClass('fa-angle-down');
                        minimized = true;
                    }
                "></i>
            </div>
        </div>


        <!-- per adattare il contenuto alla riduzione di dimensioni della barra, applica la classe body-maximized -->
        <div id="search-body" class="results-list-panel">

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

            <div class="result-item-user" onclick="location.href='#';">
                <div class="riu-icon">
                    <img src="../assets/avatar/fagiolo.png">
                </div>
                <div class="riu-info" style="background: linear-gradient(90deg, rgba(150, 0, 0, 1), rgba(150, 0, 0, 0.75));">
                    <div>
                        <h1>xXxSEXY-MARMOTTONE-56xXx</h1>
                        
                        <span style="padding: 0 1.5rem;"><!-- separatore --></span>
                        
                        <span class="userinfo-tag tag-supporter"><i class="fas fa-frog"></i> supporter </span>
                        <span class="userinfo-tag tag-author"><i class="fas fa-frog"></i> autore </span>
                    </div>
                    <p style="margin-top: 1rem; width: 70%;">Lanciando aragoste ai bimbi ciechi...</p>
                    
                </div>
            </div>

        </div>
    </div>
    

    <?php require_once('../php/modules/footer.php'); ?>
</body>
</html>