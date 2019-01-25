<?php
$_ENV = "DISTANT";

if ($_ENV === "LOCAL" && $_SERVER['REMOTE_ADDR'] == "127.0.0.1"){
    //Local
    $host   = "localhost";
    $userdb = "root";
    $passdb = "root";
    $dbname = "my_database";
}

if($_ENV === "DISTANT"){
    //Distant
    $host   = "";
    $userdb = "";
    $passdb = "";
    $dbname = "";
}

if(empty($host) && empty($dbname)) die("Echec il manque des informations de connexion");

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