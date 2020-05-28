<?php
session_start();

/*
    CARATTERISTICHE:
    -   diversi tipi di ricerca
    -   ricerca sia tra utenti che tra articoli
    -   possibilità di cercare o solo utenti, o solo articoli, o entrambi
    -   lo script riceve una richiesta di ricerca, e ritorna un array di link (formato JSON)
    -   dati inviati in get
    -   possibilità di eseguire la ricerca inviando un JSON(in seguito), oppure tramite link normale(prima versione)

    INTERFACCIA JSON O URL
    use_interface=...
    flags:
    -   url: imposta la ricerca via url
    -   json: usa input in formato json (segue json=...)

    FLAGS PER TIPO DI RICERCA search_type=...
    -   article: ricerca per articolo
    -   user: ricerca per utenti
    -   all: ricerca sia per utenti che per articoli

    RICERCA TOTALE (parametro opzionale)
    nella ricerca totale, il server invia i riferimenti a tutti gli articoli e/o a tutti gli utenti pubblici.
    use_all_data=0/1
    0   >>  false
    1   >>  true

    MODALITA' STRICT (solo ricerca per articoli)
    strict=... (1/0)

    TIPI DI RICERCA ARTICOLI (a-...)
    --  ricerca per titolo
        a_title=...
    --  ricerca per tag associato all'articolo
        a_tags=...;...
    --  ricerca per contenuto
        a_content=...
    --  ricerca per data di pubblicazione (solo ricerca di range)
        a_min_timestamp=...
        a_max_timestamp=...
    --  ricerca per autore; specifica nickname
        a_author=... 

    TIPI DI RICERCA UTENTI (u-...)
    --  ricerca per nickname
        u_nickname=...
*/

function eq($str1, $str2, $case = true)
{
    if($case)
    {
        return !strcasecmp($str1, $str2);
    }
    else
    {
        return !strcmp($str1, $str2);
    }
}

//librerie
require_once('./db/mysql_credentials.php');
require_once('./db/ProfiliUtenti.php');
require_once('./db/Articoli.php');
require_once('./db/ImgProfilo.php');
require_once('./utils/sanitize_input.php');

//interfacce col database
$dbms = connect();
$profili = new ProfiliUtenti($dbms);
$articoli = new Articoli($dbms);
$stili = new ImgProfilo($dbms);

//che interfaccia utilizzare?
if(!isset($_GET['use_interface']))
{
    echo "motore di ricerca ERRORE: non specificato il tipo di ricerca da eseguire!";
    die();
}

$interface_type = sanitize($_GET['use_interface']);
if(!eq($interface_type, 'url') and !eq($interface_type, 'json'))
{
    echo 'motore di ricerca ERRORE: interfaccia non riconosciuta.';
    die();
}

//risultati della ricerca
$a_results = array();
$u_results = array();

//le informazioni da usare
$search_mode = "";
$use_strict = false;

$use_all_data = false;

$use_article_search = false;
$a_title = "";
$a_tags = "";
$a_content = "";
$a_min_timestamp = null;
$a_max_timestamp = null;
$a_author = "";

$use_users_search = false;
$u_nickname = "";

if(eq($interface_type, 'json'))
{
    //... interfaccia json ...
    if(!isset($_GET['json']))
    {
        echo 'motore di ricerca ERRORE (json): nessun pacchetto json passato al server! chiusura...';
        die();
    }
    
    //pacchetto json
    $packet = json_decode($_GET['json']);

    //ricerca totale?
    if(property_exists($packet, 'use_all_data'))
    {
        $use_all_data = $packet->use_all_data;
        if($use_all_data) 
            $use_all_data = true;
        else 
            $use_all_data = false;
    }

    //tipo di ricerca
    if(property_exists($packet, 'search_type'))
    {
        $search_mode = sanitize($packet->search_type);
    }
    else
    {
        echo "motore di ricerca ERRORE: non specificato il tipo di ricerca";
        die();
    }
    if(eq($search_mode, 'article'))
    {
        $use_article_search = true;
    }
    elseif(eq($search_mode, 'user'))
    {
        $use_users_search = true;
    }
    elseif(eq($search_mode, 'all'))
    {
        $use_article_search = true;
        $use_users_search = true;
    }
    else
    {
        echo "motore di ricerca ERRORE: tipo di ricerca non riconosciuto.";
        die();
    }

    //dati per la ricerca per articolo
    if($use_article_search){
        if(property_exists($packet, 'a_title'))
        {
            $a_title = sanitize($packet->a_title);
        }
        if(property_exists($packet, 'a_tags'))
        {
            $a_tags = explode(';', sanitize($packet->a_tags));
        }
        if(property_exists($packet, 'a_content'))
        {
            $a_content = sanitize($packet->a_content);
        }
        if(property_exists($packet, 'a_min_timestamp'))
        {
            if($packet->a_min_timestamp !== '') $a_min_timestamp = new DateTime(sanitize($packet->a_min_timestamp));
        }
        if(property_exists($packet, 'a_max_timestamp'))
        {
            if($packet->a_max_timestamp !== '') $a_max_timestamp = new DateTime(sanitize($packet->a_max_timestamp));
        }
        if(property_exists($packet, 'a_author'))
        {
            $a_author = sanitize($packet->a_author);
        }
    }

    //dati per la ricerca degli utenti
    if($use_users_search)
    {
        if(property_exists($packet, 'u_nickname'))
        {
            $u_nickname = sanitize($packet->u_nickname);
        }
    }
}
else
{
    // ... interfaccia url ...

    //tipo di ricerca
    if(isset($_GET['search_type']))
    {
        $search_mode = sanitize($_GET['search_type']);
    }
    else
    {
        echo "motore di ricerca ERRORE (url): non specificato il tipo di ricerca";
        die();
    }

    if(eq($search_mode, 'article'))
    {
        $use_article_search = true;
    }
    elseif(eq($search_mode, 'user'))
    {
        $use_users_search = true;
    }
    elseif(eq($search_mode, 'all'))
    {
        $use_article_search = true;
        $use_users_search = true;
    }
    else
    {
        echo "motore di ricerca ERRORE: tipo di ricerca non riconosciuto.";
        die();
    }

    //ricerca totale?
    if(isset($_GET['use_all_data']))
    {
        $use_all_data = sanitize($_GET['use_all_data']);
        if($use_all_data) 
            $use_all_data = true;
        else 
            $use_all_data = false;
    }

    //modalità strict?
    if(isset($_GET['strict']))
    {
        $use_strict = sanitize($_GET['strict']);
        if($use_strict) 
            $use_strict = true;
        else 
            $use_strict = false;
    }

    //dati per la ricerca per articolo
    if($use_article_search)
    {
        if(isset($_GET['a_title']))
        {
            $a_title = sanitize($_GET['a_title']);
        }
        if(isset($_GET['a_tags']))
        {
            if($_GET['a_tags'] !== '')
                $a_tags = explode(';', sanitize($_GET['a_tags']));
        }
        if(isset($_GET['a_content']))
        {
            $a_content = sanitize($_GET['a_content']);
        }
        if(isset($_GET['a_min_timestamp']))
        {
            if($_GET['a_min_timestamp'] !== "")
                $a_min_timestamp = new DateTime(sanitize($_GET['a_min_timestamp']));
        }
        if(isset($_GET['a_max_timestamp']))
        {
            if($_GET['a_max_timestamp'] !== "")
                $a_max_timestamp = new DateTime(sanitize($_GET['a_max_timestamp']));
        }
        if(isset($_GET['a_author']))
        {
            $a_author = sanitize($_GET['a_author']);
        }
    }

    //dati per la ricerca degli utenti
    if($use_users_search)
    {
        if(isset($_GET['u_nickname']))
        {
            $u_nickname = sanitize($_GET['u_nickname']);
        }
    }
}

//intersezione dei due insiemi di elementi
function getCommons($array_1, $array_2)
{
    $res = array();

    foreach($array_1 as $elem)
    {
        if(in_array($elem, $array_2, true))
        {
            array_push($res, $elem);
        }
    }

    return $res;
}
function isEmpty($string)
{
    if($string === '')
    {
        return true;
    }
    else
    {
        return false;
    }
}

if($use_all_data)
{
    //prendi tutti gli id degli articoli
    if($use_article_search)
    {
        foreach($articoli->getTableContent() as $row)
        {
            array_push($a_results, $row['id_articolo']);
        }
    }

    //ricerca nickname
    if($use_users_search)
    {
        $u_results = $profili->searchIdByNickname($u_nickname, $use_strict, false);
    }
}
else 
{
    //ricerca articoli (metodo del setaccio)
    if($use_article_search)
    {
        $a_temp_results = array();
        $next_step = true;
        $init_state = true;

        //ricerca per titolo
        if(!isEmpty($a_title))
        {
            $a_temp_results = $articoli->searchByTitle($a_title);
            // echo "<br>";
            //echo 'ricerca per titolo articolo  ';
            //var_dump($a_temp_results);
            
            //eseguire il confronto con gli id già trovati?
            if(!$init_state) 
                $a_results = getCommons($a_temp_results, $a_results);
            else
                $a_results = $a_temp_results;
            
            //trovato qualcosa?
            $next_step = (count($a_results) > 0);
            //echo ( $next_step ? 'trovato qualcosa   ' : 'niente da fare.    ');
            if($next_step) $init_state = false;
        }

        //ricerca per autore
        if(!isEmpty($a_author) and $next_step)
        {
            //ottengo l'id dell'autore dal nickname, se esiste
            //echo 'ricerca per autore   ';
            $a_author = $profili->searchIdByNickname($a_author, $use_strict, true);
            
            if(count($a_author) > 0)
            {
                $a_temp_results = array();
                foreach($a_author as $id)
                {
                    foreach($articoli->searchByAuthorId($id) as $a_id)
                    {
                        array_push($a_temp_results, $a_id);
                    }
                }
                
                //eseguire il confronto con gli id già trovati?
                if(!$init_state) 
                    $a_results = getCommons($a_temp_results, $a_results);
                else
                    $a_results = $a_temp_results;
            }
            else
            {
                $a_results = array();
            }
            
            //trovato qualcosa?
            $next_step = (count($a_results) > 0);
            if($next_step) $init_state = false;
        }

        //ricerca per tag
        //var_dump($a_tags);
        if(($a_tags !== '') and !(count($a_tags) === 1 and $a_tags[0] === '') and $next_step)
        {
            //echo 'ricerca per tags   ';
            $a_temp_results = $articoli->searchByTagList($a_tags);
            //var_dump($a_temp_results);
            //echo "<br>";
                
            if(!$init_state) 
                $a_results = getCommons($a_temp_results, $a_results);
            else
                $a_results = $a_temp_results;
            
            //trovato qualcosa?
            $next_step = (count($a_results) > 0);
            if($next_step) $init_state = false;
        }

        //ricerca per contenuto
        if(!isEmpty($a_content) and $next_step)
        {
            //echo 'ricerca per contenuto   ';
            $a_temp_results = $articoli->searchByContent($a_content, $use_strict);
            //var_dump($a_temp_results);
            //echo "<br>";
                
            //eseguire il confronto con gli id già trovati?
            if(!$init_state) 
                $a_results = getCommons($a_temp_results, $a_results);
            else
                $a_results = $a_temp_results;
            
            //trovato qualcosa?
            $next_step = (count($a_results) > 0);
            if($next_step) $init_state = false;
        }

        //ricerca per timestamp
        if((($a_min_timestamp !== null) or ($a_max_timestamp !== null)) and $next_step)
        {
            //echo 'ricerca per data di pubblicazione   ';
            $a_temp_results = $articoli->searchByTimeRange($a_min_timestamp, $a_max_timestamp);
            //var_dump($a_temp_results);
            //echo "<br>";
                
            //eseguire il confronto con gli id già trovati?
            if(!$init_state) 
                $a_results = getCommons($a_temp_results, $a_results);
            else
                $a_results = $a_temp_results;
            
            //trovato qualcosa?
            $next_step = (count($a_results) > 0);
            if($next_step) $init_state = false;
        }
    }

    //ricerca degli utenti (metodo del setaccio)
    if($use_users_search)
    {
        //ricerca nickname
        $u_results = $profili->searchIdByNickname($u_nickname, $use_strict, false);
    }

}

//estrearre i link dei risultati
$to_send = array();
class package_to_send {};
class pack {};

if($use_article_search)
{
    foreach($a_results as $id)
    {
        $article_obj_json = new pack();

        $article_data = $articoli->getArticle($id);
        $baseURL = '../html/articolo.php';
        
        $article_obj_json->type = "article";
        $article_obj_json->url = $baseURL . '?' . 'code=' . $id;
        $article_obj_json->title = $article_data['titolo'];
        $article_obj_json->author = $profili->getNicknameOf($article_data['id_autore']);
        $article_obj_json->description = $article_data['descrizione'];
        $article_obj_json->timestamp = $article_data['data_pubblicazione'];
        $article_obj_json->tag_list = explode(';', $article_data['lista_tag']);

        array_push($to_send, $article_obj_json);
    }
}

if($use_users_search)
{
    foreach($u_results as $id)
    {
        $user_obj_json = new pack();

        $data = $profili->getProfileDataById($id);
        $baseURL = '../html/profilopubblico.php';

        $user_obj_json->type = "user";
        $user_obj_json->url = $baseURL . '?' . 'code=' . $id;
        $user_obj_json->nick = $data['nickname'];
        $user_obj_json->status = $data['stato'];
        $user_obj_json->style = $stili->getStyle($data['id_img_profilo']);
        $user_obj_json->flag_supporter = $data['flag_supporter'];
        $user_obj_json->flag_author = $data['flag_autore'];

        array_push($to_send, $user_obj_json);
    }
}

$to_encode = new package_to_send();
$to_encode->lenght = count($to_send);
$to_encode->content = $to_send;

//ritorna il json della ricerca
echo json_encode($to_encode);
/*
    lenght : quanti elementi ci sono nell'insieme di risultato
    content : i risultati della ricerca (array)
        
        contiene elementi di due tipi:
        -   type=user
            url : usato per richiamare il profilo
            nick
            status
            flag_supporter
            flag_author
            style (vedi stili)
                icon_path
                banner
                color_1
                color_2
        
        -   type=article
            url
            title
            author
            description
            timestamp 
            tag_list (array)
*/
?>