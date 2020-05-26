<?php

class CredenzialiUtenti 
{
    //-------------------------------------------------------------
    //   DATI CLASSE
    //-------------------------------------------------------------

    //connessione col dbms
    public $dbms;

    //la tabella credenziali_utenti esiste?
    private $table_exists = false;

    //metodi per hashare le password
    private $hm = null;

    //nome della tabella
    private const TABLE_NAME = "credenziali_utenti";

    //-------------------------------------------------------------
    //   COSTRUTTORI
    //-------------------------------------------------------------

    //costruttore con connessione al dbms
    /*
        richiede una connessione al dbms, e una classe contenente i metodi per hashare le password
    */
    function __construct($dbms_conn, $hash_methods_class)
    {
        //connessione col dbms
        $this->dbms = $dbms_conn;

        //verifica che la tabella esista
        $query_check_schema = 'SHOW TABLES LIKE "' . self::TABLE_NAME . '"';
        $result = $this->dbms->query($query_check_schema);
        $this->table_exists = ($result->num_rows > 0);

        //servizi hash
        $this->hm = $hash_methods_class;
    }

    //-------------------------------------------------------------
    //   SCHEMA e CONTENUTO
    //-------------------------------------------------------------

    //lo schema esiste nel database?
    function exists()
    {
        return $this->table_exists;
    }

    //istanzia tabella credenziali_utenti
    /*
        ritorna il codice riferito all'ultima operazione effettuata
    */
    function createTable()
    {
        //istanziazione della tabella, solo se ancora non esiste
        if(!$this->table_exists)
        {
            //la query
            $query_create_table = "CREATE TABLE " . self::TABLE_NAME . " (
                id INT NOT NULL AUTO_INCREMENT,
                email VARCHAR(50) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                PRIMARY KEY (id)
            );";

            //creazione tabella
            $this->dbms->query($query_create_table);

            if($this->dbms->errno === 0) 
                $this->table_exists = true;

            return $this->dbms->errno;
        }
    }

    //ritorna il contenuto della tabella, come oggetto mysql_result
    /*
        in caso di problemi, ritorna null
    */
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
    //   OPERAZIONI SPECIFICHE DI credenziali_utenti
    //-------------------------------------------------------------

    //registrazione di un nuovo utente
    /*
        il metodo presuppone
        -   la verifica della password prima della registrazione e
        -   l'aver già verificato l'unicità della mail che si sta inserendo

        il metodo semplicemente inserisce i dati nella tabella, e ritorna
        il codice mysql associato all'ultima operazione eseguita.

        parametri:
        -   email, già verificata
        -   codice hash associato alla password
    */
    function createAccount($email, $password_hash)
    {
        if(!$this->table_exists) return -1;

        //inserimento nel database dei dati (prepared statement)
        $query = 'INSERT INTO ' . self::TABLE_NAME . ' (email, password) VALUES (?, ?);';

        $dbms_op = $this->dbms->prepare($query);
        if(!$dbms_op->bind_param("ss", $email, $password_hash))
        {
            return $this->dbms->errno;
        }
        $dbms_op->execute();

        return $this->dbms->errno;
    }

    //cambiare email ad un account
    /*
        si presuppone di aver già verificato che non esistano due mail uguali
        il metodo semplicemente cambia la mail di una ennupla

        ritorna il codice MySQL associato all'ultima operazione eseguita (0 in caso di successo).

        parametri:
        -   id dell'utente; assicurarsi che l'id esista
        -   nuova email, già verificata
    */
    function setEmail($user_id, $new_email)
    {
        if(!$this->table_exists) return -1;

        //esecuzione query (prepared statement)
        $query = 'UPDATE ' . self::TABLE_NAME . ' SET email = ? WHERE id = ? ;';

        $dbms_op = $this->dbms->prepare($query);
        if(!$dbms_op->bind_param("si", $new_email, $user_id))
        {
            return $this->dbms->errno;
        }
        $dbms_op->execute();

        return $this->dbms->errno;
    }

    //ottenere la mail di un certo account
    /*
        il metodo ritorna null nel caso l'id non esistesse nel database.
    */
    function getEmail($user_id)
    {
        if(!$this->table_exists) return null;

        //ricerca
        $query = 'SELECT * FROM ' . self::TABLE_NAME . ' WHERE id = ' . $user_id . ' ;';
        $result = $this->dbms->query($query);
        
        if(!$result) return $dbms->errno;
        if($result->num_rows === 0) return -1;

        return $result->fetch_assoc()['email'];
    }

    //ottieni l'impronta hash della password dall'id
    /*
        il metodo ritorna null nel caso l'id non esistesse nel database
        altrimenti ritorna l'impronta hash della password dell'utente selezionato
    */
    function getPassword($user_id)
    {
        if(!$this->table_exists) return null;

        //ricerca
        $query = 'SELECT * FROM ' . self::TABLE_NAME . ' WHERE id = ' . $user_id . ' ;';
        $result = $this->dbms->query($query);
        
        if(!$result) return $dbms->errno;
        if($result->num_rows === 0) return -1;

        return $result->fetch_assoc()['password'];
    }

    //cambiare password ad un account
    /*
        il metodo prende in argomento
        -   l'id dell'account, trovato col metodo per ricerca della mail e della password 
        -   la vecchia password, NON HASHATA, da confrontare con quella nel database
        -   la nuova password, NON HASHATA
        -   la conferma della nuova password, NON HASHATA

        ritorna il codice MySQL associato all'ultima operazione eseguita
        oppure ritorna -1 nel caso l'operazione non sia andata a buon fine per qualche ragione.
    */
    function setPassword($user_id, $old_password, $new_password, $new_password_confirm)
    {
        if(!$this->table_exists) return -1;

        //verifica della vecchia password per l'utente
        {
            $query = 'SELECT * FROM ' . self::TABLE_NAME . ' WHERE id = ' . $user_id . ' ;';
            $result = $this->dbms->query($query);
            
            if(!$result) return $dbms->errno;
            if($result->num_rows === 0) return -1;

            if(!$this->hm->verifyHash($old_password, $result->fetch_assoc()['password'])) return -1;
        }

        //verifica che corrispondano la nuova password e la conferma della nuova password
        if($new_password !== $new_password_confirm) return -1;

        //ricava il codice hash associato alla nuova password
        $new_password = $this->hm->getHash($new_password);

        //aggiorna il dato nel database (prepared)
        $query = 'UPDATE ' . self::TABLE_NAME . ' SET password = ? WHERE id = ? ;';

        $dbms_op = $this->dbms->prepare($query);
        if(!$dbms_op->bind_param("si", $new_password, $user_id))
        {
            return $this->dbms->errno;
        }
        $dbms_op->execute();

        return $this->dbms->errno;
    }

    //ricerca di un id utente
    /*
        argomenti:
        -   la email di un certo account
        -   la password (non hashata!) di un certo account

        ritorna l'id >= 0 dell'utente se esiste, altrimenti ritorna -1
    */
    function getId($email, $password)
    {
        if(!$this->table_exists) return -1;

        $query = 'SELECT * FROM ' . self::TABLE_NAME . ' WHERE email = "' . $email . '";';
        $result = $this->dbms->query($query);

        if(!$result) return -1;
        if($result->num_rows === 0) return -1;
        $row = $result->fetch_assoc();
        
        if(!$this->hm->verifyHash($password, $row['password'])) return -1;

        return $row['id'];
    }

    //verifica di unicità di una certa mail
    /*
        il metodo ritorna true se qualche account possiede già quella mail;
        altrimenti false
    */
    function isSetEmail($email)
    {
        if(!$this->table_exists) return false;

        $query = 'SELECT * FROM ' . self::TABLE_NAME . ' WHERE email = "' . $email . '";';
        $result = $this->dbms->query($query);

        if(!$result) 
            return false;

        return ($result->num_rows > 0) ;
    }

    //rimuovere un account utente (opzionale)
    /*
        il metodo prende l'id del profilo da eliminare
        si presuppone di aver già eliminato anche i dati di profilo, altrimenti il DBMS 
        non consetirà l'operazione

        ritorna il codice associato all'ultima operazione eseguita
    */
    function destroyAccount($user_id)
    {
        if(!$this->table_exists) return -1;

        $query = 'DELETE FROM ' . self::TABLE_NAME . ' WHERE id = ' . $user_id . ' ;';
        $result = $this->dbms->query($query);

        return $this->dbms->errno;
    }

    //RECUPERO DA REGISTRAZIONE ERRATA: elimina l'account usando la mail
    function recoverWrongRegistration($email)
    {
        if(!$this->table_exists) return -1;

        $query = 'DELETE FROM credenziali_utenti WHERE email = ' . $email . ';';
        $result = $this->dbms->query($query);

        return $this->dbms->errno;
    }
}

?>