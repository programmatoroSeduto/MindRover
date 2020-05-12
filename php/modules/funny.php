<?php

function funny() 
{
    $style = 'font-size: 1.0rem; line-height: 2.2rem; margin: 0; font-style: italic; font-weight: lighter;';

    $funny[] = "Imperatore";
    $funny[] = "É proprio lui!";
    $funny[] = "Sergente";
    $funny[] = "Sergente maggiore";
    $funny[] = "Grande capo";
    $funny[] = "Eccolo!";
    $funny[] = "Non lo conosci? Beh, dovresti.";
    $funny[] = "Supremo imburratore";
    $funny[] = "É un uccello? É un ufo? No, è";
    $funny[] = "Sei stato eliminato da";
    $funny[] = "L'incredibile pompelmo denonminato";
    $funny[] = "Il fantomatico profilo di";
    $funny[] = "Attenti, è davvero scarso";
    $funny[] = "Nascondete i bambini, è arrivato";
    $funny[] = "É QUI LA FESTA?";
    $funny[] = "Il famigerato";
    $funny[] = "Ti ha appena ultato in faccia";
    $funny[] = "Ladies and gentlemen,";
    $funny[] = "É appena atterrato";
    $funny[] = "Bentornato,";
    $funny[] = "State attenti, è arrivato";
    $funny[] = "Ecco il buontempone,";
    $funny[] = "Houston, abbiamo un problema. É arrivato ";

    $n = (rand(0, count($funny) - 1));
    return '<span style="' . $style . '">' . $funny[$n] . '</span>' . '<br>';
}

//frasi divertenti per indicare data e ora della registrazione:
function datetime_funny()
{
    $funny[] = "Ci segue dal";
    $funny[] = "Va a raccogliere papere in fiore dal";
    $funny[] = "Beve uno shottino di vodka ogni mattina in nostro onore dal";
    $funny[] = "Va ad abbracciare cactus nel deserto dal";
    $funny[] = "Si è dimenticato il bicentenario di Zio Paperone nel";
    $funny[] = "É ufficialmente diventato un rettiliano nel giorno";
    $funny[] = "Visita assiduamente il Taj Mahal dal";
    $funny[] = "Deambula col suo cesto di pesche sciroppate dal lontano";
    $funny[] = "Sta ricordando quel fatidico giorno del";
    $funny[] = "Fa cose, dal";
    $funny[] = "Prega assiduamente Ganesha dal";
    $funny[] = "É stato benedetto dalla luce di Vishnu il";
    $funny[] = "Non smette mai di fare cose dal";
    $funny[] = "Soffia nelle cannucce dal";
    $funny[] = "É iscritto dal";
    $funny[] = "Si è iscritto per sbaglio il";
    $funny[] = "Non riesce ad annullare l'iscrizione dal";
    $funny[] = "Ha scoperto di avere le mani nel";

    $n = (rand(0, count($funny) - 1));
    return $funny[$n];
}

?>