<?php
include("assets/helpers.php");

// redirectToLogin();

// establishLinkForUser();

//CSV in Array einlesen
$fp = fopen("Assets/userlist.csv", "r");
$zeilen = array();
while( !feof($fp) ) {
    $zeilen[] = fgetcsv  ( $fp  , 4096 , ";" , "\"" );
}
fclose($fp);
var_dump($zeilen);

//Passwort verschlüsseln
foreach ($zeilen as &$value){
	$value[1] = password_hash($value[1], 1);
	}

//INSERT Array to mysql-db
$con = mysqli_connect("localhost", "Full", "Passwort12345", "itverwaltung");
foreach ($zeilen as &$value){
	$sql = "INSERT INTO benutzer (username, passwort, rechte_id, benutzervorname, benutzernachname)
	VALUES ('".$value[0]."', '".$value[1]."', ".$value[2].", '".$value[3]."', '".$value[4]."');";
	mysqli_query($con, $sql);
}
?>

