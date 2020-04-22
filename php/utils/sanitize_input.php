<?php

//pulizia dell'input dal form
function sanitize($var)
{
    $var = stripslashes($var);
    $var = strip_tags($var);
    $var = htmlentities($var);
    return $var;
}

//pulizia di una query sql completa
function sanitize_sql($connection, $var)
{
    $var = $connection->real_escape_string($var);
    $var = sanitizeString($var);
    return $var;
}

?>