<?php

//crea una sessione (inserisci solo i dati di sessione)
function openSession($user_id, $email, $password, $pass_hash, $profiliUtenti, $donazioni)
{
    //credenziali utenti
    $_SESSION['user_id'] = $user_id;
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;
    $_SESSION['password_hash'] = $pass_hash;

    //da profilo utente...
    $profile_data = $profiliUtenti->getProfileDataById($user_id);

    $_SESSION['nickname'] = $profile_data['nickname'];
    $_SESSION['firstname'] = $profile_data['first_name'];
    $_SESSION['lastname'] = $profile_data['last_name'];
    $_SESSION['subscription_timestamp'] = $profile_data['data_iscrizione'];
    $_SESSION['is_anonymous'] = $profile_data['flag_anonimo'];
    $_SESSION['descr'] = $profile_data['descrizione'];
    $_SESSION['status'] = $profile_data['stato'];
    $_SESSION['is_author'] = $profile_data['flag_autore'];

    //conta quante donazioni ha fatto un certo utente
    $crowdfunding_count = $donazioni->getDonationNumberFrom($user_id);
    if($crowdfunding_count >= 0)
    {
        $_SESSION['crowdfunding_count'] = $crowdfunding_count;
    }

    //conta quanto ha donato l'utente
    $crowdfunding_sum = $donazioni->getDonationAmountFrom($user_id);
    if($crowdfunding_sum >= 0)
    {
        $_SESSION['crowdfunding_sum'] = $crowdfunding_sum;
    }
}

?>