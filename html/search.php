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

                    function search()
                    {
                        alert('sesso.');
                    }
                </script>
                <div class="search-toolbar">
                    <div id="btn-1" onclick="openSearchTab(1);">Articoli</div>
                    <div id="btn-2" onclick="openSearchTab(2);">Utenti</div>
                    <div id="btn-3" onclick="openSearchTab(3);">Ricerca avanzata</div>
                </div>
                <div class="search-inner-panel">
                    <div id="search-settings-panel-1" class="">
                        <label for="a_title">titolo articolo:</label><input type="text" name="a_title"><br>
                        <label for="a_tags">lista di tag:</label><input type="text" name="a_tags"><br>
                        <label for="a_content">contenuto dell'articolo:</label><input type="text" name="a_content"><br>
                        <label for="a_min_timestamp">periodo di pubblicazione: da </label><input type="date" name="a_min_timestamp" min="0"><label for="a_max_timestamp"> a </label><input type="date" name="a_max_timestamp"><br>
                        <label for="a_author">nickname autore: </label><input type="text" name="a_author"><br>
                        <button onclick="search();">Cerca!</button>
                    </div>
                    <div id="search-settings-panel-2" class="hidden">
                        <label for="u_nickname">nickname utente da cercare: </label><input type="text" name="u_nickname"><br>
                        <button onclick="search();">Cerca!</button>
                    </div>
                    <div id="search-settings-panel-3" class="hidden">
                        <label for="search_type">tipo di ricerca:</label>
                        <select name="search_type">
                            <option value="all">utenti e articoli</option>
                            <option value="article">articoli</option>
                            <option value="user">utenti</option>
                        </select><br>
                        <input type="checkbox" name="use_all_data" value="1"><label for="use_all_data">ricerca totale</label><br>
                        <input type="checkbox" name="strict" value="1"><label for="strict">modalità strict</label><br>
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

            <div class="result-item-article">
                <div style="display: grid; text-align: center; margin: auto;"><i class="fas fa-frog" style="font-size: 4rem;"></i></div>
                <div style="background-color: green; padding: 1rem;">
                    <div style="line-height: 2.3rem;">
                        <h1>Un articolo molto interessante!</h1>
                        <h2>di <i>unIndianoPerfetto</i></h2>
                    </div>
                    <br>
                    <p>In questo articolo palrerò dell'importanza di dire sempre 'ZIH!' al dio Ganesh... ZIH?</p>
                </div>
            </div>

            <div class="result-item-user">
                <div style="display: grid; margin: auto;"><img src="../assets/avatar/fagiolo.png" style="width: 10vh; margin: 0; padding: 0;"></div>
                <div style="background-color: red; padding: 1rem; line-height: 2.2rem;">
                    <h1>
                        Germano Mosconi
                    </h1>
                    <p><i>Chi è quel mona che sbatte la porta????</i></p>
                </div>
            </div>

            <div class="result-item-article">
                <div style="display: grid; text-align: center; margin: auto;"><i class="fas fa-frog" style="font-size: 4rem;"></i></div>
                <div style="background-color: green; padding: 1rem;">
                    <div style="line-height: 2.3rem;">
                        <h1>Un articolo molto interessante!</h1>
                        <h2>di <i>unIndianoPerfetto</i></h2>
                    </div>
                    <br>
                    <p>In questo articolo palrerò dell'importanza di dire sempre 'ZIH!' al dio Ganesh... ZIH?</p>
                </div>
            </div>

            <div class="result-item-user">
                <div style="display: grid; margin: auto;"><img src="../assets/avatar/fagiolo.png" style="width: 10vh; margin: 0; padding: 0;"></div>
                <div style="background-color: red; padding: 1rem; line-height: 2.2rem;">
                    <h1>
                        Germano Mosconi
                    </h1>
                    <p><i>Chi è quel mona che sbatte la porta????</i></p>
                </div>
            </div>
            
            <div class="result-item-article">
                <div style="display: grid; text-align: center; margin: auto;"><i class="fas fa-frog" style="font-size: 4rem;"></i></div>
                <div style="background-color: green; padding: 1rem;">
                    <div style="line-height: 2.3rem;">
                        <h1>Un articolo molto interessante!</h1>
                        <h2>di <i>unIndianoPerfetto</i></h2>
                    </div>
                    <br>
                    <p>In questo articolo palrerò dell'importanza di dire sempre 'ZIH!' al dio Ganesh... ZIH?</p>
                </div>
            </div>

            <div class="result-item-user">
                <div style="display: grid; margin: auto;"><img src="../assets/avatar/fagiolo.png" style="width: 10vh; margin: 0; padding: 0;"></div>
                <div style="background-color: red; padding: 1rem; line-height: 2.2rem;">
                    <h1>
                        Germano Mosconi
                    </h1>
                    <p><i>Chi è quel mona che sbatte la porta????</i></p>
                </div>
            </div>
            
            <div class="result-item-article">
                <div style="display: grid; text-align: center; margin: auto;"><i class="fas fa-frog" style="font-size: 4rem;"></i></div>
                <div style="background-color: green; padding: 1rem;">
                    <div style="line-height: 2.3rem;">
                        <h1>Un articolo molto interessante!</h1>
                        <h2>di <i>unIndianoPerfetto</i></h2>
                    </div>
                    <br>
                    <p>In questo articolo palrerò dell'importanza di dire sempre 'ZIH!' al dio Ganesh... ZIH?</p>
                </div>
            </div>
            
            <div class="result-item-article">
                <div style="display: grid; text-align: center; margin: auto;"><i class="fas fa-frog" style="font-size: 4rem;"></i></div>
                <div style="background-color: green; padding: 1rem;">
                    <div style="line-height: 2.3rem;">
                        <h1>Un articolo molto interessante!</h1>
                        <h2>di <i>unIndianoPerfetto</i></h2>
                    </div>
                    <br>
                    <p>In questo articolo palrerò dell'importanza di dire sempre 'ZIH!' al dio Ganesh... ZIH?</p>
                </div>
            </div>
            
            <div class="result-item-article">
                <div style="display: grid; text-align: center; margin: auto;"><i class="fas fa-frog" style="font-size: 4rem;"></i></div>
                <div style="background-color: green; padding: 1rem;">
                    <div style="line-height: 2.3rem;">
                        <h1>Un articolo molto interessante!</h1>
                        <h2>di <i>unIndianoPerfetto</i></h2>
                    </div>
                    <br>
                    <p>In questo articolo palrerò dell'importanza di dire sempre 'ZIH!' al dio Ganesh... ZIH?</p>
                </div>
            </div>
            
            <div class="result-item-article">
                <div style="display: grid; text-align: center; margin: auto;"><i class="fas fa-frog" style="font-size: 4rem;"></i></div>
                <div style="background-color: green; padding: 1rem;">
                    <div style="line-height: 2.3rem;">
                        <h1>Un articolo molto interessante!</h1>
                        <h2>di <i>unIndianoPerfetto</i></h2>
                    </div>
                    <br>
                    <p>In questo articolo palrerò dell'importanza di dire sempre 'ZIH!' al dio Ganesh... ZIH?</p>
                </div>
            </div>
            
            <div class="result-item-article">
                <div style="display: grid; text-align: center; margin: auto;"><i class="fas fa-frog" style="font-size: 4rem;"></i></div>
                <div style="background-color: green; padding: 1rem;">
                    <div style="line-height: 2.3rem;">
                        <h1>Un articolo molto interessante!</h1>
                        <h2>di <i>unIndianoPerfetto</i></h2>
                    </div>
                    <br>
                    <p>In questo articolo palrerò dell'importanza di dire sempre 'ZIH!' al dio Ganesh... ZIH?</p>
                </div>
            </div>
            
            <div class="result-item-article">
                <div style="display: grid; text-align: center; margin: auto;"><i class="fas fa-frog" style="font-size: 4rem;"></i></div>
                <div style="background-color: green; padding: 1rem;">
                    <div style="line-height: 2.3rem;">
                        <h1>Un articolo molto interessante!</h1>
                        <h2>di <i>unIndianoPerfetto</i></h2>
                    </div>
                    <br>
                    <p>In questo articolo palrerò dell'importanza di dire sempre 'ZIH!' al dio Ganesh... ZIH?</p>
                </div>
            </div>
            
            <div class="result-item-article">
                <div style="display: grid; text-align: center; margin: auto;"><i class="fas fa-frog" style="font-size: 4rem;"></i></div>
                <div style="background-color: green; padding: 1rem;">
                    <div style="line-height: 2.3rem;">
                        <h1>Un articolo molto interessante!</h1>
                        <h2>di <i>unIndianoPerfetto</i></h2>
                    </div>
                    <br>
                    <p>In questo articolo palrerò dell'importanza di dire sempre 'ZIH!' al dio Ganesh... ZIH?</p>
                </div>
            </div>
            
            <div class="result-item-article">
                <div style="display: grid; text-align: center; margin: auto;"><i class="fas fa-frog" style="font-size: 4rem;"></i></div>
                <div style="background-color: green; padding: 1rem;">
                    <div style="line-height: 2.3rem;">
                        <h1>Un articolo molto interessante!</h1>
                        <h2>di <i>unIndianoPerfetto</i></h2>
                    </div>
                    <br>
                    <p>In questo articolo palrerò dell'importanza di dire sempre 'ZIH!' al dio Ganesh... ZIH?</p>
                </div>
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