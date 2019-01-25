<?php
if ($_SERVER['REMOTE_ADDR'] == "127.0.0.1"){
    //Local
    $host   = "localhost";
    $userdb = "root";
    $passdb = "root";
    $dbname = "my_database";
}
else{
    //Distant
    $host   = "";
    $userdb = "";
    $passdb = "";
    $dbname = "";
}


//Connexion au serveur MySQL
$mysqli  = new mysqli($host, $userdb, $passdb, $dbname);
if ($mysqli->connect_errno) {
    die("Connection failed ! : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
}

// Selection de la DB
/* $SQLselect_db = mysql_select_db($dbname, $SQLconnect);
if (!$SQLselect_db) {
    die ('Impossible d\'utiliser la base : ' . mysql_error());
} */