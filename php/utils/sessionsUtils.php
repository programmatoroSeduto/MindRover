<?php

//crea una sessione (inserisci solo i dati di sessione)
function openSession($user_id, $email, $password, $pass_hash, $profiliUtenti, $donazioni, $stile)
{
    //dati di base
    $_SESSION['user_id'] = $user_id;
    
    //credenziali
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;

    //dati di profilo
    $profile_data = $profiliUtenti->getProfileDataById($user_id);
    $_SESSION['subscription_timestamp'] = $profile_data['data_iscrizione'];
    $_SESSION['nickname'] = $profile_data['nickname'];
    $_SESSION['firstname'] = $profile_data['first_name'];
    $_SESSION['lastname'] = $profile_data['last_name'];
    
    $_SESSION['descr'] = $profile_data['descrizione'];
    $_SESSION['status'] = $profile_data['stato'];
    
    //impostazioni di profilo
    $_SESSION['is_anonymous'] = ($profile_data['flag_anonimo'] == 1);
    $_SESSION['is_author'] = ($profile_data['flag_autore'] == 1);

    //informazioni crowdfunding
    $crowdfunding_count = $donazioni->getDonationNumberFrom($user_id);
    if($crowdfunding_count > 0)
    {
        //l'utente è un supporter riconosciuto
        $_SESSION['crowdfunding_supporter'] = true;
        
        //quanto ha donato
        $_SESSION['crowdfunding_count'] = $crowdfunding_count;
        $_SESSION['crowdfunding_sum'] = $donazioni->getDonationAmountFrom($user_id);

        //a che tier appartiene
        $tier_3 = 99;
        $tier_2 = 199;
        if($_SESSION['crowdfunding_sum'] > 0)
        {
            if($_SESSION['crowdfunding_sum'] > $tier_3)
            {
                if($_SESSION['crowdfunding_sum'] > $tier_2)
                {
                    $_SESSION['crowdfunding_tier'] = 1;
                }
                else
                    $_SESSION['crowdfunding_tier'] = 2;
            }
            else
                $_SESSION['crowdfunding_tier'] = 3;
        }

        //in che posizione della classifica si trova
        //$_SESSION['crowdfunding_rank'] = $donazioni->getRankOf($user_id);
        $_SESSION['crowdfunding_rank'] = -1;

        //lista delle donazioni da parte dell'utente
        $_SESSION['crowdfunding_donation_list'] = $donazioni->getDonationListFrom($user_id);
    }
    else
    {
        $_SESSION['crowdfunding_supporter'] = false;

        $_SESSION['crowdfunding_count'] = 0;
        $_SESSION['crowdfunding_sum'] = 0;

        $_SESSION['crowdfunding_tier'] = -1;
        $_SESSION['crowdfunding_position'] = -1;
        $_SESSION['crowdfunding_donation_list'] = array();

        $_SESSION['crowdfunding_rank'] = -1;
    }

    //stile del profilo
    $_SESSION['style_id'] = $profile_data['id_img_profilo'];
    $_SESSION['style_data'] = $stile->getStyle($_SESSION['style_id']);
}

?>