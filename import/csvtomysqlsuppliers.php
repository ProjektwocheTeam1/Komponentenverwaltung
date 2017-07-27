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
		$sql = "INSERT INTO lieferant ( l_firmenname, l_strasse, l_plz, l_ort, l_tel, l_mobil, l_fax, l_email, log_id)
		VALUES ('".$value[0]."', '".$value[1]."', '".$value[2]."', '".$value[3]."', '".$value[4]."', '".$value[5]
		."', '".$value[6]."', '".$value[7]."', ".createLog($con, "Neu", "Neuen Raum hizugefügt").");";
		$err = mysqli_query($con, $sql);
		if($err==false)
		{
			$errors[]= $value[0];
		}
	}
}
?>

