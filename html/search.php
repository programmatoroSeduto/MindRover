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
    <link type="text/css" rel="stylesheet" href="../css/modal.css">

    <script src="../js/search_utils.js"></script>
    
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- METADATI -->
    <link rel="icon" href="../assets/img/frog-icon.png">
    <meta name="author" content="Francesco Ganci, Lorenzo Terranova">
    <meta name="description" content="Cerchi qualcosa o qualcuno in particolare? Un articolo interessante, magari? Sei nel posto giusto!">

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
                    function openSearchTab(idx, btn)
                    {
                        if(idx == active_panel_idx) return;
                        var panel_to_enable = 'search-settings-panel-' + idx;
                        var panel_to_disable = 'search-settings-panel-' + active_panel_idx;
                        var btn_to_enable = 'btn-' + idx;
                        var btn_to_disable = 'btn-' + active_panel_idx;

                        $('#' + panel_to_disable).addClass('hidden').removeClass('panel');
                        $('#' + panel_to_enable).removeClass('hidden').addClass('panel');                        
                        
                        $('#'+ btn_to_enable).addClass('activeButton');
                        $('#'+ btn_to_disable).removeClass('activeButton');

                        active_panel_idx = idx;

                    }
                </script>

                <div class="search-toolbar" id="srcTlbr">
                    <div id="btn-1" onclick="openSearchTab(1);" class="bottoneRicerca activeButton">Articoli</div>
                    <div id="btn-2" onclick="openSearchTab(2);" class="bottoneRicerca">Utenti</div>
                    <div id="btn-3" onclick="openSearchTab(3);" class="bottoneRicerca">Opzioni ricerca</div>
                    <div id="btn-4" class="bottoneRicerca" onclick="search();" style="color: whitesmoke; background-color: green">Cerca</div>
                </div>

                <div class="search-inner-panel">
                    <div id="search-settings-panel-1" class="panel">
                        <div style="display: grid; grid-template-rows: 1fr 1fr 1fr 1fr;">
                            <div class="form-container">
                                <input type="text" name="a_title" id="a_title" placeholder="Titolo articolo" class="form">
                                <i class="fas fa-book-open"></i>
                            </div>

                            <div class="form-container" style="margin-bottom: 0">
                                <input type="text" name="a_author" id="a_author" placeholder="Autore dell'articolo" class="form" title="Occhio alle maiuscole e le minuscole!">
                                <i class="fas fa-user"></i>
                            </div>

                            <div class="form-container">
                                <input type="text" name="a_tags" id="a_tags" placeholder="Tag articolo" class="form">
                                <i class="fas fa-tags"></i>
                            </div>

                            <div class="form-container" style="margin-bottom: 0">
                                <input type="text" name="a_content" id="a_content" placeholder="Qualche riga dell'articolo che stai cercando" class="form">
                                <i class="fas fa-bookmark"></i>
                            </div>
                        </div>

                        <div style="display: grid; grid-template-rows: 1fr 2fr 1fr 2fr">
                            <span style=" font-family: ganesh">Pubblicato tra il:</span>
                            <div class="form-container">
                                <input type="date" name="a_min_timestamp" id="a_min_timestamp" min="0" class="form">
                                <i class="fas fa-clock" style="top: 1.1vh;"></i>
                            </div>
                            <span style=" font-family: ganesh">e il:</span>
                            <div class="form-container" style="margin-bottom: 0">
                                <input type="date" name="a_max_timestamp" id="a_max_timestamp" class="form">
                                <i class="fas fa-clock" style="top: 1.1vh;"></i>
                            </div>
                            
                        </div>

                    </div>

                    <div id="search-settings-panel-2" class="hidden" class="panel">
                        <div style="display: grid; grid-template-rows: 2fr 1fr 2fr">
                            <div> </div>
                            <div class="form-container">
                                <input type="text" name="u_nickname" id="u_nickname" placeholder="Cerca un nickname utente" class="form"  title="Occhio alle maiuscole e le minuscole!">
                                <i class="fas fa-user"></i>
                            </div>
                            <div> </div>
                        </div>
                    </div>

                    <div id="search-settings-panel-3" class="hidden" class="panel" style="grid-gap: 2vh 0vh;">
                        <span style=" font-family: ganesh; margin-top: 1vh">Tipo di ricerca:</span>
                        <div style="margin-top: 1vh">
                            <select id="search_type" name="search_type" class="form" style="padding-left: 1vh">
                                <option value="all">Utenti e articoli</option>
                                    
                                <option value="article">Articoli</option>
                                <option value="user">Utenti</option>
                            </select>
                        </div>
                        <span style=" font-family: ganesh; cursor: help" title="Questa opzione permette di visualizzare tutti i contenuti più recenti del server">Ricerca totale (articoli):</span>
                        <input type="checkbox" id="use_all_data" name="use_all_data" value="1">
                        <span style=" font-family: ganesh; cursor: help" title="Questa opzione permette di visualizzare tutti i contenuti che hanno precisamente gli attributi da te inseriti">Modalità strict: </span>
                        <input type="checkbox" id="strict" name="strict" value="1">
                    </div>

                </div>

            </div>
            <div id="search-settings-minimized" class="search-settings-minimized hidden">
                <!-- barra di ricerca minimizzata -->
                <div style="margin-top: 0.8rem; font-family: ganesh; text-transform: uppercase; letter-spacing: 0.2rem; font-size: 1rem; color: white">
                Barra di ricerca minimizzata - clicca a destra per riaprirla!
                </div>
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
        <div id="search-body" class="results-list-panel example">

            <div class="result-item-article"  onclick="location.href='#';">
                <div class="ria-icon">
                    <i class="fas fa-search" style="color: orange; "></i>
                </div>
                <div class="ria-info" style="background: linear-gradient(120deg, red, orange);">
                    <div>
                        <h1>Che aspetti? Inizia a cercare!</h1>
                    </div>
                    <div class="ria-inner">
                        
                    </div>
                    <p style="margin-top: 1rem; width: 70%;">Cerca qualcosa di croccante sul nostro sito. C'è tanta roba interessante!</p>
                </div>
            </div>

        </div>
    </div>
    

    <?php require_once('../php/modules/footer.php'); ?>
</body>
</html>