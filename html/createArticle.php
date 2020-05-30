<?php
session_start();
$ganesh = "SCRIVI ARTICOLO";
?>

<?php
require_once('../php//modules/navbar.php');

if(!isset($_SESSION['user_id']))
{
    header('location: ../html/login.php');
    die();
}
if(!$_SESSION['is_author'])
{
    header('location: ../html/comingsoon.php');
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scrivi un nuovo articolo!</title>

    <!-- CSS -->
    <link type="text/css" rel="stylesheet" href="../css/utils/clearsheet.css">
    <link type="text/css" rel="stylesheet" href="../css/nav.css">
    <link type="text/css" rel="stylesheet" href="../css/fonts.css">
    <link type="text/css" rel="stylesheet" href="../css/footer2.css">
    <link type="text/css" rel="stylesheet" href="../css/text-container.css">
    <link type="text/css" rel="stylesheet" href="../css/profile_settings_style.css">
    <link type="text/css" rel="stylesheet" href="../css/modal.css">
    
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/f61875768d.js" crossorigin="anonymous"></script>

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- METADATI -->
    <link rel="icon" href="../assets/img/frog-icon.png">
</head>
<body style="background-color: blue;">

    <?php
        if(isset($_SESSION['user_id']))
        {
            get_private_navbar($ganesh);
        }
    ?>
    <div style="position: absolute; top: 45%; left: 50%; transform: translate(-50%, -50%); border-radius: 2%; background-color: lightgray; padding: 30px;">
    <h1>Nuovo Articolo</h1>
    <hr>
    <form method="get" action="../php/db/createNewArticle.php">
        <input type="text" name="nick" value="<?php echo $_SESSION['nickname']; ?>" style="display: none;">
        <ul>
            <li><label for="titolo">Titolo articolo: </label><br><input type="text" name="titolo" style="width: 100%;"></li>
            <li><label for="sottotitolo">Sottotitolo: </label><br><input type="text" name="sottotitolo" style="width: 100%;"></li>
            <li><label for="descrizione">Descrizione: </label><br><textarea name="descrizione" rows="2" cols="100"></textarea></li>
            <li><label for="contenuto">Contenuto HTML:</label><br><textarea name="contenuto" rows="5" cols="100" title="per favore, niente JS injection o altri trucchetti; usal il markup solo per impaginare e modificare i caratteri. Puoi inserire immagini se vuoi."></textarea></li>
            <li><label for="tags" title="lista separata da spazio">lista di tag: </label><input type="text" name="tags" style="width: 100%;"></li>
            <span  style="display: flex; justify-content: right;"><input type="submit" value="Minchia Jonny, pubblicalo subbito!" style="padding: 25px; cursor: pointer; margin-top: 35px;"></span>
        </ul>
    </form>
    </div>

    <div style="position: absolute; bottom: 0; width: 100%;">
    <?php require_once('../php/modules/footer.php'); ?>
    </div>
</body>
</html>