<?php 
/* d'après PHPMYEXPORT v3.3, Axel de Vignon [ www.vidax.net ] */

//Inclusion des fichiers
require_once("SQLConnect.php");

$NbTables = 0;
$NbRecords = 0;

$sql = "SHOW TABLES FROM $dbname";
$result = $mysqli->query($sql);

if (!$result) {
    $fichier .="DB error, no tables are listed\r\n";
    $fichier .='MySQL error : ' . $mysqli->error;
    exit;
}

/* Génère le nom du fichier */
$date = date("d-m-Y H\hi\m");
$nom_fichier = $dbname." $date.sql";

$fichier = "\r\n".
"# database $dbname saved at : ".$date."\r\n".
"#\r\n";


/* Tant qu'il y a des tables */
while ($row = $result->fetch_row()){
    $fichier .="\r\n#\r\n# Table `".$row[0]."`\r\n#\r\n";

    /* La suppression est demandée */
    $fichier .="DROP TABLE IF EXISTS `$row[0]`;\r\n";

    /* Enregistre sa structure */
    $req = $mysqli->query("SHOW CREATE TABLE ".$row[0]);
    $res = $req->fetch_array();
    $fichier .=$res[1].";\r\n\r\n";

    /* Sélectionne toutes les entrées de la table */
    $req = $mysqli->real_query("SELECT * FROM ".$row[0].";");
    $req = $mysqli->use_result();
    $nb = $mysqli->field_count;
    $reqcomplete = "";
    $j = 0;

    /* Tant qu'il y a des entrées */
    while($res = $req->fetch_array()){
        $i = 0;

        /* Differents types de requetes */
        $fichier .="INSERT INTO `$row[0]`".$reqcomplete." VALUES (";

        while($i<$nb){
            /* Protege les caracteres speciaux */
            $ligne = $mysqli->escape_string($res[$i]);

            /* Si l'entree est un chiffre, pas de quotes */
            if(is_numeric($ligne))     $fichier .=$ligne;
            else             $fichier .='"'.$ligne.'"';

            /* Termine ou continue la ligne */
            if($i == ($nb - 1))    $fichier .=');';
            else            $fichier .=', ';
            $i++;
        }

        $fichier .="\r\n";

        /* Compteur du nombre d'enregistrements */
        $NbRecords ++;
    }

    /* Compteur du nombre de tables */
    $NbTables ++;
}

/* Génère le pied de page */
$fichier .=    "\r\n\r\n".
"#\r\n".
"# File: \"".$nom_fichier."\", ".$NbTables." table(s), ".$NbRecords." record(s)\r\n".
"#\r\n".
"#";

$sauvegarde = fopen($nom_fichier, "a");
fwrite($sauvegarde, $fichier."\r\n");
fclose($sauvegarde);

$result->free_result();