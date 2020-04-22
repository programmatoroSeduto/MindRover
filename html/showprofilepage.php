<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accesso effettuato</title>
</head>
<body>
    <h1>Benvenuto!</h1>
    <p>
<?php

echo "email: " . $_SESSION['email'] . "<br>" .
    "nome: " . $_SESSION['firstname'] . "<br>" .
    "cognome: " . $_SESSION['lastname'] . "<br>" .
    "nickname: " . $_SESSION['nickname'] . '<br>' .
    "stato: " . $_SESSION['status'] . '<br>' .
    "descrizione: " . $_SESSION['descr'] . '<br>';

?>
    </p>
    <form method="POST" action="../php/logout.php">
        <input type="submit" value="logout">
    </form>
</body>
</html>
