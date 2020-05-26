<?php

class Articoli
{
    //-------------------------------------------------------------
    //   DATI CLASSE
    //-------------------------------------------------------------

    //connessione col dbms
    public $dbms = null;

    //la tabella credenziali_utenti esiste?
    private $table_exists = false;

    //nome della tabella
    private const TABLE_NAME = "articoli";

    //-------------------------------------------------------------
    //   COSTRUTTORI
    //-------------------------------------------------------------

    //costruttore: prende in argomento la connessione col dbms
    function __construct($dbms_conn)
    {
        //connessione col dbms
        $this->dbms = $dbms_conn;

        //verifica che la tabella esista
        $query_check_schema = 'SHOW TABLES LIKE "' . self::TABLE_NAME . '"';
        $result = $this->dbms->query($query_check_schema);
        $this->table_exists = ($result->num_rows > 0);
    }

    //-------------------------------------------------------------
    //   SCHEMA e CONTENUTO
    //-------------------------------------------------------------

    //lo schema esiste nel database?
    function exists()
    {
        return $this->table_exists;
    }

    //istanzia tabella profili_utenti
    /*
        ritorna il codice riferito all'ultima operazione effettuata
    */
    function createTable()
    {
        //istanziazione della tabella, solo se ancora non esiste
        if(!$this->table_exists)
        {
            //la query
            $query_create_table = 'CREATE TABLE ' . self::TABLE_NAME . ' (
                id_articolo INT NOT NULL AUTO_INCREMENT,
                id_autore INT NOT NULL,
                titolo VARCHAR(120) NOT NULL,
                sottotitolo VARCHAR(250) NOT NULL DEFAULT "",
                descrizione VARCHAR(250) NOT NULL DEFAULT "",
                contenuto TEXT NOT NULL,
                data_pubblicazione TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
                lista_tag VARCHAR(500) NOT NULL,
                PRIMARY KEY (id_articolo),
                FOREIGN KEY (id_autore) REFERENCES credenziali_utenti(id)
            );';

            //creazione tabella
            $this->dbms->query($query_create_table);

            if($this->dbms->errno === 0) $this->table_exists = true;

            return $this->dbms->errno;
        }
    }

    //ritorna il contenuto della tabella, come oggetto mysql_result
    function getTableContent()
    {
        if($this->table_exists)
        {
            $query = 'SELECT * FROM ' . self::TABLE_NAME . " ;";

            return $this->dbms->query($query);
        }
        else
            return null;
    }

    //ritorna il contenuto della tabella come lista HTML
    /*
        LISTA ORDINATA: $ordered = true
        LISTA NON ORDINATA: $ordered = false (default)
    */
    function getTableContentAsList($ordered = false)
    {
        if(!$this->table_exists) return;
        
        //ottieni il contenuto della tabella
        $table_content = $this->getTableContent();
        if(!$table_content) return;

        //inizio lista
        if($ordered)
        {
            echo '<ol>';
        }
        else
        {
            echo '<ul>';
        }

        //contenuto della lista
        while($row = $table_content)
        {
            echo '<li>';
            foreach($row as $key => $value)
            {
                echo '--';
                echo '$key[ $value ] ';
            }
            echo '</li>';
        }

        //fine lista
        if($ordered)
        {
            echo '</ol>';
        }
        else
        {
            echo '</ul>';
        }
    }

    //svuota la tabella, ma non rimuovere lo schema
    function destryTableContent()
    {
        if(!$this->table_exists) return -1;

        $query = 'DELETE FROM ' . self::TABLE_NAME . ";";
        $this->dbms->query($query);

        return $this->dbms->errno;
    }

    //svuota la tabella e rimuovi anche lo schema
    function destroyTable()
    {
        if(!$this->table_exists) return -1;

        $query = 'DROP TABLE ' . self::TABLE_NAME . ";";
        $this->dbms->query($query);

        return $this->dbms->errno;
    }

    //-------------------------------------------------------------
    //   OPERAZIONI SPECIFICHE DI articoli : BASILARI
    //-------------------------------------------------------------

    //pubblicazione di un articolo
    /*
        argomenti:
        -   id dell'autore dell'articolo, autore approvato dalla Frog Studios
        -   title: il titlo dell'articolo, visibile al motore di ricerca
        -   subtitle
        -   description: descrizione dell'articolo, visibile durante la ricerca
        -   content: il contenuto dell'articolo, in html
        -   tag_list: un array di stringhe
    */
    function addArticle($author_id, $title, $subtitle, $description, $content, $tag_list, $data_pubblicazione = -1)
    {
        if(!$this->table_exists) return -1;
        
        //prima, ricompongo la lista di tag
        $tag_list = implode(";", $tag_list);

        if($data_pubblicazione === -1)
        {    
            $query = 'INSERT INTO ' . self::TABLE_NAME . ' (id_autore, titolo, sottotitolo, descrizione, contenuto, lista_tag) VALUES (?, ?, ?, ?, ?, ?);';

            $dbms_op = $this->dbms->prepare($query);
            if(!$dbms_op->bind_param("isssss", $author_id, $title, $subtitle, $description, $content, $tag_list))
            {
                return $this->dbms->errno;
            }
            $dbms_op->execute();
        }
        else
        {
            $query = 'INSERT INTO ' . self::TABLE_NAME . ' (id_autore, titolo, sottotitolo, descrizione, contenuto, lista_tag, data_pubblicazione) VALUES (?, ?, ?, ?, ?, ?, ?);';
            
            {
                $data = new DateTime();
                $data->setTimestamp($data_pubblicazione);
                $data_pubblicazione = $data->format('Y-m-d h:i:s');
            }

            $dbms_op = $this->dbms->prepare($query);
            if(!$dbms_op->bind_param("issssss", $author_id, $title, $subtitle, $description, $content, $tag_list, $data_pubblicazione))
            {
                return $this->dbms->errno;
            }
            $dbms_op->execute();
        }

        return $this->dbms->errno;
    }

    //rimozione di un certo articolo dalla tabella
    function destroyArticle($article_id)
    {
        if(!$this->table_exists) return -1;
        
        $query = 'DELETE FROM ' . self::TABLE_NAME . ' WHERE id_articolo = ' . $article_id . ' ;';
        $result = $this->dbms->query($query);

        return $this->dbms->errno;
    }

    //-------------------------------------------------------------
    //   OPERAZIONI SPECIFICHE DI articoli : GESTIONE TAG
    //-------------------------------------------------------------

    //ritorna tutti i tag definiti finora
    /*
        ritorna un array di stringhe, eventualmente vuoto
        oppure null nel caso ci fosse qualche problema.
    */
    function getAllTags()
    {
        if(!$this->table_exists) return null;
        
        //ottieni tutti i tag del database
        $query = 'SELECT DISTINCT lista_tag FROM ' . self::TABLE_NAME . ' ;';
        $result = $this->dbms->query($query);
        if(!$result) return null;

        $tags = array();
        if($result->num_rows === 0) return $tags;

        //estrazione dei tag
        while($row = $result->fetch_assoc())
        {
            $row_tags = explode(";", $row['lista_tag']);
            foreach($row_tags as $tag)
            {
                if(!in_array($tag, $tags))
                {
                    array_push($tags, $tag);
                }
            }
        }

        return $tags;
    }

    //ottieni i tag definiti in un certo articolo
    /*
        ritorna un array di stringhe, i tag associati ad un certo articolo
        oppure null nel caso le cose non andassero bene.
    */
    function getTagsOf($article_id)
    {
        if(!$this->table_exists) return null;
        
        //ottieni il tag dell'articolo, se esiste
        $query = 'SELECT DISTINCT lista_tag FROM ' . self::TABLE_NAME . ' WHERE id_articolo = ' . $article_id . ' ;';
        $result = $this->dbms->query($query);
        if(!$result) return null;

        $tags = array();

        if($result->num_rows === 0) return $tags;

        $row_tags = explode(";", $row['lista_tag']);

        //inserisco una sola volta i tag all'interno dell'array da ritornare
        foreach($row_tags as $tag)
        {
            if(!in_array($tag, $tags))
            {
                array_push($tags, $tag);
            }
        }

        return $tags;
    }

    //rimpiazza la lista di tag di un articolo
    /*
        prende in ingresso l'id dell'articolo e la nuova lista di tag, 
        come array di stringhe.

        ritorna il codice sql associato all'ultima operazione effettuata, oppure -1.
    */
    function setTagList($article_id, $tag_list)
    {
        if(!$this->table_exists) return -1;
        
        //ricava la stringa associata alla lista di tag
        $tag_list = implode(";", $tag_list);

        //inserimento nel database (prepared statement)
        $query = 'UPDATE ' . self::TABLE_NAME . ' SET lista_tag = ? WHERE id_articolo = ? ;';

        $dbms_op = $this->dbms->prepare($query);
        if(!$dbms_op->bind_param("si", $tag_list, $article_id))
        {
            return $this->dbms->errno;
        }
        $dbms_op->execute();

        return $this->dbms->errno;
    }

    //-------------------------------------------------------------
    //   OPERAZIONI SPECIFICHE DI articoli : RICERCA ID ARTICOLI
    //-------------------------------------------------------------

    //ricerca per titolo
    /*
        caratteristiche della ricerca:
        -   case-insensitive
        -   due modalità di ricerca (parametro $strict):
            -   true: ricerca precisamente quel titolo
            -   false: ricerca titoli che contengano quelle parole
        
        ritorna un array di id, eventualmente vuoto.
        ritorna null nel caso ci fosse qualche problema.
    */
    function searchByTitle($str, $strict = false)
    {
        if(!$this->table_exists) return null;
        
        $result = $this->getTableContent();
        if(!$result) return null;

        $keys = array();
        $results = array();

        if($result->num_rows === 0) return $results;
        
        if($strict)
        {
            array_push($keys, $str);
        }
        else
        {
            $keys = explode(" ", $str);
        }
        
        while($row = $result->fetch_assoc())
        {
            $title = $row['titolo'];

            foreach($keys as $k)
            {
                if(stripos($title, $k) !== false)
                {
                    array_push($results, $row['id_articolo']);
                    break;
                }
            }
        }

        return $results;
    }

    //ricerca per contenuto
    /*
        caratteristiche della ricerca:
        -   case-insensitive
        -   supporta la modalità strict

        ritorna un array di id, eventualmente vuoto.
        oppure null nel caso ci fosse qualche problema.
    */
    function searchByContent($str, $strict = false)
    {
        if(!$this->table_exists) return null;
        
        $result = $this->getTableContent();
        if(!$result) return null;

        $keys = array();
        $results = array();

        if($result->num_rows === 0) return $results;
        
        if($strict)
        {
            array_push($keys, $str);
        }
        else
        {
            $keys = explode(" ", $str);
        }
        
        while($row = $result->fetch_assoc())
        {
            $content = $row['contenuto'];

            foreach($keys as $k)
            {
                if(stripos($content, $k) !== false)
                {
                    array_push($results, $row['id_articolo']);
                    break;
                }
            }
        }

        return $results;
    }

    //ricerca per tag
    /*
        caratteristiche della ricerca:
        -   case-insensitive
        -   qui la modalità strict non ha senso

        prende in argomento un array di stringhe.

        ritorna un array di id, eventualmente vuoto, ordinato per maggior
        numero di id corrispondenti.
        oppure null nel caso ci siano problemi.
    */
    function searchByTagList($tag_list)
    {
        if(!$this->table_exists) return null;
        
        $result = $this->getTableContent();
        if(!$result) return null;

        $keys = $tag_list;
        $results = array();

        if($result->num_rows === 0) return $results;
        
        while($row = $result->fetch_assoc())
        {
            $article_tags = explode(";", $row['lista_tag']);

            foreach($keys as $tag_1)
            {
                $found = false;
                
                foreach($article_tags as $tag_2)
                {
                    if(strcasecmp($tag_1, $tag_2) == 0)
                    {
                        array_push($results, $row['id_articolo']);
                        $found = true;
                        break;
                    }
                }
                
                if($found) break;
            }
        }

        return $results;
    }

    //ricerca per data di pubblicazione
    /*
        la funzione prende in argomento due parametri:
        -   minimo timestamp (già data)
        -   massimo timestamp (già data)
        il metodo ricerca gli id degli articoli pubblicati tra quelle due date.
        ritorna un array di id, eventualmente vuoto; gli elementi sono ordinati 
        dall'articolo più recente a quello più vecchio.

        ritorna null nel caso ci siano problemi.
    */
    function searchByTimeRange($min, $max)
    {
        if(!$this->table_exists) return null;
        
        $result = $this->getTableContent();
        if(!$result) return null;

        $results = array();

        if($result->num_rows === 0) return $results;

        while($row = $result->fetch_assoc())
        {
            $date = new DateTime($row['data_pubblicazione']);
            if(($date >= $min) and ($date <= $max))
            {
                array_push($results, $row['id_articolo']);
            }
        }

        return $results;
    }

    //ricerca per autore
    /*
        ritorna gli id degli articoli associato ad un certo autore.
        oppure null in caso di problemi.
    */
    function searchByAuthorId($author_id)
    {
        if(!$this->table_exists) return null;
        
        $result = $this->getTableContent();
        if(!$result) return null;

        $results = array();

        if($result->num_rows === 0) return $results;

        while($row = $result->fetch_assoc())
        {
            $author = $row['id_autore'];

            if($author === $author_id)
            {
                array_push($results, $row['id_articolo']);
            }
        }

        return $results;
    }

    //-------------------------------------------------------------
    //   OPERAZIONI SPECIFICHE DI articoli : GETTERs
    //-------------------------------------------------------------

    //ritorna un intero articolo
    /*
        ritorna tutti i dati riguardanti l'articolo (l'intera riga di tabella)
        oppure null in caso di problemi.
    */
    function getArticle($article_id)
    {
        if(!$this->table_exists) return null;
        
        $query = 'SELECT * FROM ' . self::TABLE_NAME . ' WHERE id_articolo = ' . $article_id . ' ;';
        $result = $this->dbms->query($query);

        if(!$result) 
            return null;
        else   
            return $result->fetch_assoc();
    }
}

?>