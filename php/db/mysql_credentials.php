<?php

$mysql_host = "localhost";
$mysql_user = "root";
$mysql_pass = "";
$mysql_db = "saw";

//connessione col DBMS già pronta
function connect($show_confirm = false)
{
	// recupero le credenziali del server
	global $mysql_host;
	global $mysql_user;
	global $mysql_pass;
	global $mysql_db;
	
	//apri la connessione con mySQLi
	$conn  = new mysqli($mysql_host, $mysql_user, $mysql_pass, $mysql_db);

	if(!$conn)
	{
		die("errore: ___construct() ha ritornato false!");
	}
	
	//verifica che la connessione sia andata a buon fine
	if ($conn->connect_error) 
	{
		die("Connection failed: " . $conn->connect_error);
	}

	if($show_confirm)
	{
		echo 'connection OK.<br>';
	}
	
	//ritorna la connessione col DBMS
	return $conn;
}

function getSQLerror($dbms, $die = false)
{
	echo '>> codice SQL dell\'ultima operazione: ' . $dbms->errno . ' testo: ' . $dbms->error . '<br>';
	if($die)
	{
		die('>> --- ERRORE - chiusura... --- <<');
	}
}

?>