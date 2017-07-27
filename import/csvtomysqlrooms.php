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
		$sql = "INSERT INTO raeume (r_nr, r_bezeichnung, r_notiz, log_id)
		VALUES ('".$value[0]."', '".$value[1]."', '".$value[2]."', ".createLog($con, "Neu", "Neuen Raum hizugefügt").");";
		$err = mysqli_query($con, $sql);
		if($err==false)
		{
			$errors[]= $value[0];
		}
	}
}
?>

