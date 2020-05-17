<?php

class ProfiliUtenti 
{
    //-------------------------------------------------------------
    //   DATI CLASSE
    //-------------------------------------------------------------

    //connessione col dbms
    public $dbms = null;

    //la tabella credenziali_utenti esiste?
    private $table_exists = false;

    //nome della tabella
    private const TABLE_NAME = "profili_utenti";

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
                id_utente INT NOT NULL UNIQUE,
                nickname VARCHAR(50) NOT NULL UNIQUE,
                first_name VARCHAR(50) NOT NULL,
                last_name VARCHAR(50) NOT NULL,
                descrizione TEXT DEFAULT "" ,
                stato VARCHAR(100) DEFAULT "" ,
                data_iscrizione TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
                flag_anonimo BOOLEAN NOT NULL DEFAULT false,
                flag_autore BOOLEAN NOT NULL DEFAULT false,
                flag_supporter BOOLEAN NOT NULL DEFAULT false,
                id_img_profilo INT NOT NULL,
                PRIMARY KEY (id_utente),
                FOREIGN KEY (id_utente) REFERENCES credenziali_utenti(id),
                FOREIGN KEY (id_img_profilo) REFERENCES img_profilo(id_img)
            );';

            //creazione tabella
            $this->dbms->query($query_create_table);

            if($this->dbms->errno === 0) $this->table_exists = true;

            return $this->dbms->errno;
        }
    }

    //ritorna il contenuto della tabella, come oggetto mysql_result
    /*
        se qualcosa dovesse andare storto, il metodo ritornerebbe null
    */
    function getTableContent()
    {
        if(!$this->table_exists) return -1;

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
        while($row = $table_content->fetch_assoc())
        {
            echo '<li>';
            foreach($row as $key => $value)
            {
                echo '-- ';
                echo $key . '[' . $value . '] ';
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
    //   OPERAZIONI SPECIFICHE DI profili_utenti : OPERAZIONI BASE
    //-------------------------------------------------------------

    //crea un nuovo profilo utente
    /*
        il metodo inserisce nel database solo le informazioni essenziali;
        usare un altro metodo per le restanti informazioni

        ritorna il codice errore SQL associato alla query.
    */
    function createAccount($id, $nickname, $first_name, $last_name, $id_img)
    {
        if(!$this->table_exists) return -1;

        //inserimento nel database dei dati (prepared statement)
        $query = 'INSERT INTO ' . self::TABLE_NAME . ' (id_utente, nickname, first_name, last_name, id_img_profilo) VALUES (?, ?, ?, ?, ?);';

        $dbms_op = $this->dbms->prepare($query);
        if(!$dbms_op->bind_param("isssi", $id, $nickname, $first_name, $last_name, $id_img))
        {
            return $this->dbms->errno;
        }
        $dbms_op->execute();

        return $this->dbms->errno;
    }

    //ritorna un nickname da un id
    function getNicknameOf($id)
    {
        if(!$this->table_exists) return -1;

        $query = 'SELECT * FROM ' . self::TABLE_NAME . ' WHERE id_utente = ' . $id . ' ;';

        $result = $this->dbms->query($query);

        if(!$result) return -1;
        if($result->num_rows === 0) return -1;

        return $result->fetch_assoc()['nickname'];
    }

    //ricerca id utente per nickname
    /*
        il metodo ritorna un id >= 0 se il nickname esiste
        altrimenti ritorna -1.
        NOTA BENE: usa questo metodo solo per lavorare sul lato server, non per il motore di ricerca.
    */
    function getIdByNickname($nickname)
    {
        if(!$this->table_exists) return -1;

        $query = 'SELECT * FROM ' . self::TABLE_NAME . ' WHERE nickname = "' . $nickname . '" ;';

        $result = $this->dbms->query($query);

        if(!$result) return -1;
        if($result->num_rows === 0) return -1;

        return $result->fetch_assoc()['id_utente'];
    }

    //ricerca id degli utenti con nickname che assomiglia ad un altro nickname
    /*
        la funzione prende in ingresso una stringa
        e ritorna un array di id utenti: i nickname di quegli
        utenti hanno qualcosa che assomiglia alla stringa data.

        ritorna un arrya, eventualmente vuoto, di id. 
        in caso di problemi, ritorna null.

        NOTA BENE: solo per il motore di ricerca.
    */
    function searchIdByNickname($str, $strict = false, $only_authors = false)
    {
        if(!$this->table_exists) return null;
        if($str === '') return array();

        $result = $this->getTableContent();
        if(!$result) return null;

        $results = array();
        if($result->num_rows === 0) return $results;
        
        while($row = $result->fetch_assoc())
        {
            $nickname = $row['nickname'];
            if($row['flag_anonimo'] == 1) continue;
            if($only_authors and ($row['flag_autore'] == 0)) continue;

           if($strict) 
            {
                if(!strcmp($nickname, $str))
                {
                    array_push($results, $row['id_utente']);
                }
            }
            else
            {
                if(strpos($nickname, $str) !== false)
                {
                    array_push($results, $row['id_utente']);
                }
            }
        }

        return $results;
    }

    //ritorna tutti gli id pubblici
    function getAllPublicId()
    {
        if(!$this->table_exists) return null;

        $query = 'SELECT id_utente AS id, flag_supporter AS supporter FROM ' . self::TABLE_NAME . ' WHERE flag_anonimo = 0 ;';
        $result = $this->dbms->query($query);

        if(!$result) return null;
        if($result->num_rows === 0) return array();

        return $result;
    }

    //test esistenza di un nickname
    /*
        ritorna false se il nickname non esiste;
        ritorna true se il nickname esiste;
        ritorna null se c'è stato qualche problema tecnico.
    */
    function isSetNickname($nickname)
    {
        if(!$this->table_exists) return null;

        $query = 'SELECT * FROM ' . self::TABLE_NAME . ' WHERE nickname = "' . $nickname . '" ;';
        $result = $this->dbms->query($query);

        if(!$result) return null;
        return ($result->num_rows > 0);
    }

    //rimuovere un profilo utente
    /*
        il metodo prende in ingresso l'id dell'utente di cui eliminare i dati di profilo
        e ritorna true se l'operazione ha avuto successo, altrimenti false.
    */
    function destroyProfile($user_id)
    {
        if(!$this->table_exists) return -1;

        $query = 'DELETE FROM ' . self::TABLE_NAME . ' WHERE id_utente = ' . $user_id . ';';
        $result = $this->dbms->query($query);

        return $this->dbms->errno;
    }

    //-------------------------------------------------------------
    //   OPERAZIONI SPECIFICHE DI profili_utenti : IMPOSTAZIONI
    //-------------------------------------------------------------

    //cerca un profilo per id
    /*
        il metodo prende in argomento l'id dell'utente
        e ritorna un array con tutti i dati di profilo

        ritorna null nel caso il profilo indicato non esistesse
    */
    function getProfileDataById($user_id)
    {
        if(!$this->table_exists) return null;

        $query = 'SELECT * FROM ' . self::TABLE_NAME . ' WHERE id_utente = ' . $user_id . ';';
        $result = $this->dbms->query($query);

        if(!$result) 
            return null;
        else 
        {
            if($result->num_rows == 0)
                return null;
            else
                return $result->fetch_assoc();
        }
    }

    //cambia nickname
    /*
        il nickname dev'essere unico! altrimenti il DBMS bloccherà l'operazione (si spera...) .
    */
    function setNickname($user_id, $nickname)
    {
        if(!$this->table_exists) return -1;

        $query = 'UPDATE ' . self::TABLE_NAME . ' SET nickname = ? WHERE id_utente = ? ;';

        $dbms_op = $this->dbms->prepare($query);
        if(!$dbms_op->bind_param("si", $nickname, $user_id))
        {
            return $this->dbms->errno;
        }
        $dbms_op->execute();

        return $this->dbms->errno;
    }

    //cambia nome
    function setFirstName($user_id, $first_name)
    {
        if(!$this->table_exists) return -1;

        $query = 'UPDATE ' . self::TABLE_NAME . ' SET first_name = ? WHERE id_utente = ? ;';

        $dbms_op = $this->dbms->prepare($query);
        if(!$dbms_op->bind_param("si", $first_name, $user_id))
        {
            return $this->dbms->errno;
        }
        $dbms_op->execute();

        return $this->dbms->errno;
    }

    //cambia cognome
    function setLastName($user_id, $last_name)
    {
        if(!$this->table_exists) return -1;

        $query = 'UPDATE ' . self::TABLE_NAME . ' SET last_name = ? WHERE id_utente = ? ;';

        $dbms_op = $this->dbms->prepare($query);
        if(!$dbms_op->bind_param("si", $last_name, $user_id))
        {
            return $this->dbms->errno;
        }
        $dbms_op->execute();

        return $this->dbms->errno;
    }

    //cambiare descrizione del profilo
    function setDescription($user_id, $description)
    {
        if(!$this->table_exists) return -1;

        $query = 'UPDATE ' . self::TABLE_NAME . ' SET descrizione = ? WHERE id_utente = ? ;';

        $dbms_op = $this->dbms->prepare($query);
        if(!$dbms_op->bind_param("si", $description, $user_id))
        {
            return $this->dbms->errno;
        }
        $dbms_op->execute();

        return $this->dbms->errno;
    }

    //cambiare stato di un profilo
    function setStatus($user_id, $status)
    {
        if(!$this->table_exists) return -1;

        $query = 'UPDATE ' . self::TABLE_NAME . ' SET stato = ? WHERE id_utente = ? ;';

        $dbms_op = $this->dbms->prepare($query);
        if(!$dbms_op->bind_param("si", $status, $user_id))
        {
            return $this->dbms->errno;
        }
        $dbms_op->execute();

        return $this->dbms->errno;
    }

    //toggle: anonimato
    /*
        in argomento:
        true        il profilo dev'essere anonimo
        false       il profilo ora diventa anonimo
    */
    function setAnonymous($user_id, $value)
    {
        if(!$this->table_exists) return -1;

        if($value) $value = 1;
        else $value = 0;

        $query = 'UPDATE ' . self::TABLE_NAME . ' SET flag_anonimo = ? WHERE id_utente = ? ;';

        $dbms_op = $this->dbms->prepare($query);
        if(!$dbms_op->bind_param("ii", $value, $user_id))
        {
            return $this->dbms->errno;
        }
        $dbms_op->execute();

        return $this->dbms->errno;
    }

    //toggle: autore
    /*
        in argomento:
        true        l'utente è un autore riconosciuto dalla frog studios
        false       l'utente non è un autore
    */
    function setAuthor($user_id, $value)
    {
        if(!$this->table_exists) return -1;

        if($value) $value = 1;
        else $value = 0;

        $query = 'UPDATE ' . self::TABLE_NAME . ' SET flag_autore = ? WHERE id_utente = ? ;';

        $dbms_op = $this->dbms->prepare($query);
        if(!$dbms_op->bind_param("ii", $value, $user_id))
        {
            return $this->dbms->errno;
        }
        $dbms_op->execute();

        return $this->dbms->errno;
    }

    //controlla se l'utente è un autore
    function isAuthor($user_id)
    {
        if(!$this->table_exists) return -1;

        $query = 'SELECT * FROM profili_utenti WHERE id_utente = ' . $user_id . ' AND flag_autore = 1';
        $result_set = $this->dbms->query($query);
        if(!$result_set)
        {
            return false;
        }

        return ($result_set->num_rows > 0);
    }

    //toggle: donatore
    /*
        in argomento:
        true        l'utente ha fatto almeno una donazione
        false       l'utente non ha fatto ancora nessuna donazione
    */
    function setSupporter($user_id, $value)
    {
        if(!$this->table_exists) return -1;

        if($value) $value = 1;
        else $value = 0;

        $query = 'UPDATE ' . self::TABLE_NAME . ' SET flag_supporter = ? WHERE id_utente = ? ;';

        $dbms_op = $this->dbms->prepare($query);
        if(!$dbms_op->bind_param("ii", $value, $user_id))
        {
            return $this->dbms->errno;
        }
        $dbms_op->execute();

        return $this->dbms->errno;
    }

    //imposta una certa immagine di profilo
    function setProfileStyle($user_id, $img_id)
    {
        if(!$this->table_exists) return -1;

        $query = 'UPDATE ' . self::TABLE_NAME . ' SET id_img_profilo = ? WHERE id_utente = ? ;';

        $dbms_op = $this->dbms->prepare($query);
        if(!$dbms_op->bind_param("ii", $img_id, $user_id))
        {
            return $this->dbms->errno;
        }
        $dbms_op->execute();

        return $this->dbms->errno;
    }

    //ritorna l'immagine di profilo di un certo utente
    /*
        ritorna id dell'immagine di profilo scelta
        o -1 nel caso ci fossero problemi
    */
    function getProfileStyle($user_id)
    {
        $data = $this->getProfileDataById($user_id);

        if(!$data) return -1;
        else return  $data['id_img_profilo'];
    }
}

?>