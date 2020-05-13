<?php

class RankObject 
{
    public $last_update;

    //formato: 
    //tier[n_tier][rank]['id']
    //tier[n_tier][rank]['sum']
    public $tier = array(array(), array(), array());

    public $tier_size = array(0, 0, 0);

    //registra in automatico la data odierna
    function __construct()
    {
        $this->last_update = new DateTime();
    }

    //ordinamento degli utenti in base a quanto hanno donato
    /*
        ordine decrescente
    */
    function sort_records()
    {
        if(count($this->tier[$n_tier]) == 0) return;

        $callback = function($a, $b)
        {
            $sum_a = $a['sum'];
            $sum_b = $b['sum'];

            if($sum_a === $sum_b) return 0;
            elseif ($sum_a < $sum_b) return 1;
            elseif ($sum_a > $sum_b) return -1;
        };

        usort($this->tier[1], $callback);
        usort($this->tier[2], $callback);
        usort($this->tier[3], $callback);
    }

    //aggiungi una donazione di un utente
    function add($tier, $id, $sum)
    {
        array_push($this->tier[$tier], array('id' => $id, 'sum' => $sum));
        $this->$tier_size[$tier]++;
    }

    //l'oggetto è vuoto?
    function isEmpty($tier = -1)
    {
        if($tier < 0)
        {
            return ($tier_size[0] > 0) || ($tier_size[1] > 0) || ($tier_size[2] > 0);
        }
        else
        {
            return ($tier_size[$tier] > 0);
        }
    }
}

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
    function recordDonation($user_id, $amount, $showError = false)
    {
        $amount = (double) $amount;
        if(!$this->table_exists) return -1;

        //query per registrare la donazione
        $query = 'INSERT INTO ' . self::TABLE_NAME . ' (id_utente, somma_donazione) VALUES (?, ?) ;';

        //inserimento (prepared statement)
        $dbms_op = $this->dbms->prepare($query);
        if(!($err = $dbms_op->bind_param("id", $user_id, $amount)))
        {
            $dbms_op->execute();
        }
        else
        {
            return $err;
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
        la tabella ritornata contiene:
        -   id,
        -   somma,
        -   data
        -   ora
    */
    function getDonationListFrom($user_id)
    {
        if(!$this->table_exists) return null;

        $query = 'SELECT id_donazione AS id, somma_donazione AS somma, timestamp AS data_ora FROM ' . self::TABLE_NAME . ' WHERE id_utente = ' . $user_id . ' ;';
        $result = $this->dbms->query($query);
        if(!$result) return null;
        if($result->num_rows == 0) return array();

        $return = array();
        while($row = $result->fetch_assoc())
            array_push($result, array('id' => $row['id'], 'somma' => $row['somma'], 'data' => (new DateTime($row['data_ora']))->format('y/m/d'), 'ora' => (new DateTime($row['data_ora']))->format('h:m:s')));

        return $return;
    }

    //classifica degli utenti che hanno donato
    /*
        la classifica è riportata su un file in formato json aggiornato ogni 10 ore
        quando richiesto. il file riporterà la data dell'ultimo aggiornamento, e tre array:
        -   classifica per il tier 1 (sopra i 200 €)
        -   classifica per il tier 2 (tra i 100€ e i 199€)
        -   classifica per il tier 3 (sotto i 100€ ma maggiore di zero)
        ogni array associa una posizione della classifica a
        -   l'id dell'utente (id)
        -   quanto ha donato l'utente (sum)

        campi del json:
        -   last_update     timestamp dell'ultima donazione
        -   tier[1]          classifica tier 1
        -   tier[2]          classifica tier 2
        -   tier[3]          classifica tier 3
        struttura interna dell'array:
        tier[n_tier][rank]['id']
        tier[n_tier][rank]['sum']

        il metodo ritorna l'oggetto json associato al file.
    */
    function getRankObject($force_update = false)
    {
        //l'oggetto da ritornare
        $rankObj = null;

        //forzare l'aggiornamento?
        if($force_update)
        {
            $rankObj = updateRankObject();
        }
        else
        {
            //il file esiste?
            $flag = !file_exists('../rank.txt');

            //il file è vuoto?
            $flag = ($flag ? true : filesize('../rank.txt') == 0);

            if(!$flag)
            {
                //lettura del file
                $rankObj = json_decode(readfile('../rank.txt'));

                //l'ultimo aggiornamento è stato fatto meno di 10 ore fa?
                $last_update_date = new DateTime($rankObj.last_update);
                $today = new DateTime();
                $flag = ($last_update_date > $today + (new DateTime("00:10:00")));
            }
            
            if($flag)
            {
                $rankObj = updateRankObject();
            }
        }

        return $rankObj;
    }

    //aggiornamento della classifica delle donazioni
    /*
        ritorna la rappresentazione json del file rank.txt, dopo averlo scritto sul server.
    */
    function updateRankObject()
    {
        //scrivi il nuovo file
        $rankFile = fopen("rank.txt", "w");

        //oggetto da convertire in json e stampare su file
        $rankObj = new RankObject();

        //ottengo tutti gli id pubblici
        require_once('./ProfiliUtenti.php');
        $users = (new ProfiliUtenti($this->dbms))->getAllPublicId(); /* campi: id, supporter */
        if(!users)
        {
            /** TODO notifica errore query */
        }
        elseif(count($user) == 0)
        {
            /** TODO stampa file vuoto */
        }

        //per ogni id...
        while($row = $users->fetch_assoc())
        {
            //skip se l'utente non è un supporter
            if(row['supporter'] == 0) continue;

            //trova quanto ha donato l'utente indicato
            $sum = $this->getDonationAmountFrom(row['id']);
            if($sum < 0)
            {
                /** TODO problemi con la query */
            }

            //a quale tier appartiene l'utente?
            $tier = 1;
            {
                $tier_3 = 99;
                $tier_2 = 199;
                if($sum > $tier_2)
                {
                    $tier = 1;
                }
                else if($sum > $tier_3)
                {
                    $tier = 2;
                }
                else if($sum > 0)
                {
                    $tier = 3;
                }
            }

            //registra la donazione
            $rankObj->add($tier, $row['id'], $sum);
        }

        //sorting delle donazioni
        $rankObj->sort_records();

        //salvo il json della classe su file
        fwrite($rankFile, json_encode($rankObj));
        fclose($rankFile);

        return $rankObj;
    }

    //posizione di un utente nella classifica
    /*
        nota bene: il metodo deve tener conto anche del fatto che la classifica potrebbe nonessere aggiornata!
        se l'utente non risulta nella classifica, ritorna -1.
    */
    function getRankOf($user_id)
    {
        //prima, verifica che l'utente sia pubblico
        require_once('./ProfiliUtenti.php');
        if((new ProfiliUtenti($this->dbms))->getProfileDataById($user_id)['flag_anonimo'] === 1 ) 
            return -1;
        if((new ProfiliUtenti($this->dbms))->getProfileDataById($user_id)['flag_supporter'] === 0 ) 
            return -1;

        $rankObj = $this->getRankObject();
        if($rankObj->isEmpty()) return -1;

        //per ogni tier...
        for($i = 0; $i < 3; $i++)
        {
            for($r = 0; $r<count($rankObj->tier[$i]); $r++)
            {
                if($rankObj->tier[$i][$r]['id'] === $user_id)
                    return $r;
            }
        }

        return -1;
    }

    //ritorna i 3 utenti più in alto nella classifica, per un certo tier
    /*
        array di struttura
        ganesh (tier 1)
            1
            2
            3
        shiva (tier 2)
            1
            2
            3
        vishnu (tier 3)
            1
            2
            3
    */
    function grandiVeneratoriDelDioGaneshNelTier($n_tier)
    {
        $rankObj = $this->getRankObject();

        /** TODO da rivedere nel caso non ci fossero abbastanza donazioni */
        return array(
            'ganesh' => array(
                $rankObj->tier[1][1],                
                $rankObj->tier[1][2],
                $rankObj->tier[1][3]
            ),
            'shiva' => array(
                $rankObj->tier[2][1],                
                $rankObj->tier[2][2],
                $rankObj->tier[2][3]
            ),
            'vishnu' => array(
                $rankObj->tier[3][1],                
                $rankObj->tier[3][2],
                $rankObj->tier[3][3]
            )
        );
    }
}

?>