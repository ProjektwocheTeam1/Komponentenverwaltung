<?php 
//CSV in Array einlesen
$fp = fopen($uploadfile, "r");
$zeilen = array();
while( !feof($fp) ) {
    $zeilen[] = fgetcsv  ( $fp  , 4096 , ";" , "\"" );
}
fclose($fp);

//Insert Array to mysql-db
$con = mysqli_connect("localhost", "Full", "Passwort12345", "itverwaltung");
foreach ($zeilen as &$value){
	if ($value!="")
	{
		$sql = "INSERT INTO komponenten (raeume_r_id, lieferant_l_id, k_einkaufsdatum, k_gewaehrleistungsdauer, k_notiz, k_hersteller, komponentenarten_ka_id, log_id)
		VALUES (".$value[0].", ".$value[1].", '".$value[2]."', ".$value[3].", '".$value[4]."', '".$value[5]."', ".$value[6].", ".createLog($con, "Neu", "Neue Komponente hizugefügt").");";
		$err = mysqli_query($con, $sql);
		if($err==false)
		{
			$errors[]= $value[0];
			var_dump($value[0]);
		}
	}
}
?>





@to do: in componentlist.csv wird der erste Satz nicht inserted????? Hier sollte ein SQL-Fehler vorliegen.