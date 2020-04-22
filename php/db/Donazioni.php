<?php

class Donazioni 
{
    //-------------------------------------------------------------
    //   DATI CLASSE
    //-------------------------------------------------------------

    //connessione col dbms
    public $dbms = null;

    //la tabella credenziali_utenti esiste?
    private $table_exists = false;

    //nome della tabella
    private const TABLE_NAME = "donazioni";

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
            $query_create_table = "CREATE TABLE " . self::TABLE_NAME . " (
                id_donazione INT NOT NULL AUTO_INCREMENT,
                id_utente INT NOT NULL,
                somma_donazione FLOAT NOT NULL CHECK (somma_donazione>0),
                timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
                PRIMARY KEY (id_donazione),
                FOREIGN KEY (id_utente) REFERENCES credenziali_utenti(id)
            );";

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
    //   OPERAZIONI SPECIFICHE DI profili_utenti
    //-------------------------------------------------------------

    //registra una donazione
    /*
        il metodo inserisce automaticamente l'orario della donazione
    */
    function recordDonation($user_id, $amount)
    {
        if(!$this->table_exists) return -1;

        //query per registrare la donazione
        $query = 'INSERT INTO ' . self::TABLE_NAME . ' (id_utente, somma_donazione) VALUES (?, ?) ;';

        //inserimento (prepared statement)
        $dbms_op = $this->dbms->prepare($query);
        if(!$dbms_op->bind_param("id", $user_id, $amount))
        {
            $dbms_op->execute();
        }

        return $this->dbms->errno;
    }

    //calcola quanto ha donato un certo utente
    /*
        il metodo ritorna -1 se ci sono problemi
        altrimenti un valore >= 0
    */
    function getDonationAmountFrom($user_id)
    {
        if(!$this->table_exists) return -1;

        $amount = 0;

        //cerca tutte le donazioni fatte da quell'utente
        $query = 'SELECT * FROM ' . self::TABLE_NAME . ' WHERE id_utente = ' . $user_id . ' ;';
        $result = $this->dbms->query($query);
        if(!$result) return -1;

        while($row = $result->fetch_assoc())
        {
            $amount += $row['somma_donazione'];
        }

        return $amount;
    }

    //calcola quante donazioni ha fatto un certo utente
    /*
        ritorna un numero >= 0 , o -1 in caso di problemi
    */
    function getDonationNumberFrom($user_id)
    {
        if(!$this->table_exists) return -1;

        $count = 0;

        //cerca tutte le donazioni fatte da quell'utente
        $query = 'SELECT * FROM ' . self::TABLE_NAME . ' WHERE id_utente = ' . $user_id . ' ;';
        $result = $this->dbms->query($query);
        if(!$result) return -1;

        while($row = $result->fetch_assoc())
        {
            $count++;
        }

        return $count;
    }

    //trova tutti gli utenti che hanno donato non oltre una certa cifra
    /*
        ritorna un array di id, al più un array vuoto
        e null in caso di problemi
    */
    function findByMaxAmount($max_amount)
    {
        if(!$this->table_exists) return null;

        $results = array();

        //ricerca
        $query = 'SELECT SUM(somma_donazione) AS somma , id_utente FROM ' . self::TABLE_NAME . ' GROUP BY id_utente ;';
        $table = $this->dbms->query($query);
        if(!$table) return null;

        //ricerca degli utenti tra qeulli nella tabella
        while($row = $table->fetch_assoc())
        {
            if($row['somma'] <= $max_amount)
            {
                array_push($results, $row['id_utente']);
            }
        }

        return $results;
    }

    //trova tutti gli utenti che hanno donato almeno una certa cifra
    /*
        ritorna un array di id, al più un array vuoto, 
        e ritorna null in caso di problemi.
    */
    function findByMinAmount($min_amount)
    {
        if(!$this->table_exists) return null;

        $results = array();

        //ricerca
        $query = 'SELECT SUM(somma_donazione) AS somma , id_utente FROM ' . self::TABLE_NAME . ' GROUP BY id_utente ;';
        $table = $this->dbms->query($query);
        if(!$table) return null;

        //ricerca degli utenti tra qeulli nella tabella
        while($row = $table->fetch_assoc())
        {
            if($row['somma'] >= $max_amount)
            {
                array_push($results, $row['id_utente']);
            }
        }

        return $results;
    }

    //lista di tutte le donazioni fatte da un certo utente
    /*
        ritorna una select della tabella, o null in caso di problemi.
    */
    function getDonationListFrom($user_id)
    {
        if(!$this->table_exists) return null;

        $query = 'SELECT somma_donazione, timestamp AS data FROM ' . self::TABLE_NAME . ' WHERE id_utente = ' . $user_id . ' ;';
        return $this->dbms->query($query);
    }
}

?>