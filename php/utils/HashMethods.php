<?php

//metodi per hashare le password
class HashMethods 
{
    //-------------------------------------------------------------
    //   DATI CLASSE
    //-------------------------------------------------------------

    

    //-------------------------------------------------------------
    //   COSTRUTTORI
    //-------------------------------------------------------------

    //costruttore vuoto
    function __construct()
    {
        
    }

    //-------------------------------------------------------------
    //   METODI
    //-------------------------------------------------------------
    
    //ritorna il codice hash associato ad una stringa
    function getHash($str)
    {
        //ritorna il codice hash associato
        return password_hash($str, PASSWORD_BCRYPT);
    }

    //verifica se due codici hash corrispondono
    /*
        la funzione prende due parametri:
        -   la stringa, non hashata, la cui impronta hash dev'essere confrontata
        -   il codice hash
        $hash è l'impronta hash della stringa fornita?
    */
    function verifyHash($str, $hash)
    {
        return password_verify($str, $hash);
    }
}

?>