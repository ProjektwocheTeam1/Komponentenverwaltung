<?php
//include("assets/helpers.php");

// redirectToLogin();

// establishLinkForUser();

//CSV in Array einlesen
$fp = fopen("Assets/componentlist.csv", "r");
$zeilen = array();
while( !feof($fp) ) {
    $zeilen[] = fgetcsv  ( $fp  , 4096 , ";" , "\"" );
}
fclose($fp);
var_dump($zeilen);

//INSERT Array to mysql-db
$con = mysqli_connect("localhost", "Full", "Passwort12345", "itverwaltung");
foreach ($zeilen as &$value){
	$sql = "INSERT INTO komponenten (raeume_id, lieferant_l_id, k_einkaufsdatum, k_gewaehrleistungsdauer, k_notiz, k_hersteller, komponentenarten_ka_id)
	VALUES (".$value[0].", ".$value[1].", '".$value[2]."', ".$value[3].", '".$value[4]."', '".$value[5]."', ".$value[6].");";
	mysqli_query($con, $sql);
}
?>

