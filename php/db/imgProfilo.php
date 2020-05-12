<?php

class ImgProfilo
{
    //-------------------------------------------------------------
    //   DATI CLASSE
    //-------------------------------------------------------------

    //connessione col dbms
    public $dbms = null;

    //la tabella credenziali_utenti esiste?
    private $table_exists = false;

    //nome della tabella
    private const TABLE_NAME = "img_profilo";

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
                id_img INT NOT NULL AUTO_INCREMENT KEY,
                img_path VARCHAR(500) NOT NULL,
                sfondo_colore_1 VARCHAR(12) NOT NULL DEFAULT "255,0,0",
                sfondo_colore_2 VARCHAR(12) NOT NULL DEFAULT "255,0,0",
                colore_banner VARCHAR(12) NOT NULL DEFAULT "255,255,255"
            );';

            //creazione tabella
            $this->dbms->query($query_create_table);
            /*
            if($this->dbms->errno === 0) 
            {
                $this->table_exists = true;
                
                $this->dbms->query
                (
                    "INSERT 
                        INTO img_profilo (img_path, sfondo_colore_1, sfondo_colore_2, colore_banner) 
                        VALUES ('../assets/img/rana.jpg', '255,0,0', '255,0,0', '255,0,0');"
                );
            }
            */
            return $this->dbms->errno;
        }
    }

    //ritorna il contenuto della tabella, come oggetto mysql_result
    /*
        se qualcosa dovesse andare storto, il metodo ritornerebbe null
    */
    function getTableContent()
    {
        if(!$this->table_exists) return null;

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
    //   OPERAZIONI SPECIFICHE DI img_profilo
    //-------------------------------------------------------------

    //aggiungi uno stile alla tabella
    /*
        argomenti: 
        img_path    percorso dell'immagine
        grad_rgb_1  array rgb del primo gradiente
        grad_rgb_2  array rgb del secondo gradiente
        banner_rgb  array rgb, colore del banner

        ritorna il codice sql riferito all'ultima operazione effettuata, o -1 in caso di altri problemi.
    */
    function addNewStyle($img_path, $grad_rgb_1, $grad_rgb_2, $banner_rgb)
    {
        if(!$this->table_exists) return -1;

        //inserimento nel database dei dati (prepared statement)
        $query = 'INSERT INTO ' . self::TABLE_NAME . ' (img_path, sfondo_colore_1, sfondo_colore_2, colore_banner) VALUES (?, ?, ?, ?);';

        $dbms_op = $this->dbms->prepare($query);
        $grad_rgb_1 = implode(",", $grad_rgb_1);
        $grad_rgb_2 = implode(",", $grad_rgb_2);
        $banner_rgb = implode(",", $banner_rgb);
        if(!$dbms_op->bind_param("ssss", $img_path, $grad_rgb_1, $grad_rgb_2, $banner_rgb))
        {
            return $this->dbms->errno;
        }
        $dbms_op->execute();

        return $this->dbms->errno;
    }

    //verifica se un certo stile esiste
    function isSetStyle($img_path, $grad_rgb_1, $grad_rgb_2, $banner_rgb)
    {
        if(!$this->table_exists) return 0;

        $grad_rgb_1 = implode(",", $grad_rgb_1);
        $grad_rgb_2 = implode(",", $grad_rgb_2);
        $banner_rgb = implode(",", $banner_rgb);

        $q = 'SELECT id_img FROM ' . self::TABLE_NAME . ' WHERE img_path="' . $img_path . '" AND sfondo_colore_1="' . $grad_rgb_1 . '" AND sfondo_colore_2="' . $grad_rgb_2 . '"AND colore_banner="' . $banner_rgb . '";';

        $data = $this->dbms->query($q);
        if(!$data) return 0;

        return ($data->num_rows > 0);
    }

    //trova il primo id disponibile nel catalogo di stili
    function getFirstAvailableStyleId()
    {
        if(!$this->table_exists) return -1;

        $data = $this->getTableContent();
        if(!$data) return -1;
        if($data->num_rows == 0) return -1;

        return $data->fetch_assoc()['id_img'];
    }

    //controlla se un id è ancora disponibile
    function isValidId($id)
    {
        return (($row = $this->getStyleById($id)) !== null ? (count($row) > 0) : false);
    }

    //trova i dati di uno stile a partire da un id
    function getStyleById($style_id)
    {
        if(!$this->table_exists) return null;

        $query = 'SELECT * FROM ' . self::TABLE_NAME . ' WHERE id_img = ' . $style_id . ' ;';
        $result = $this->dbms->query($query);
        
        if(!$result) return null;
        if($result->num_rows === 0) return array();

        return $result->fetch_assoc();
    }

    //get di una riga con formato colori corretto
    function getStyle($style_id)
    {
        if(!$this->table_exists) return null;

        $row = $this->getStyleById($style_id);
        $res = array();

        $res['icon_path'] = $row['img_path'];
        $res['banner'] = explode(',', $row['colore_banner']);
        $res['color_1'] = explode(',', $row['sfondo_colore_1']);
        $res['color_2'] = explode(',', $row['sfondo_colore_2']);
        
        return $res;
    }


    //ritorna tutti gli stili
    /*
        id 
        stile:
            icon_path
            banner
            color_1
            color_2
    */
    function getAllStyles()
    {
        if(!$this->table_exists) return null;

        $data = $this->getTableContent();
        if(!$data) return -1;
        if($data->num_rows == 0) return -1;

        $styles = array();

        while($row = $data->fetch_assoc())
        {
            $styles[] = array('id' => $row['id_img'], 'stile' => $this->getStyle($row['id_img']));
        }

        return $styles;
    }
}

?>