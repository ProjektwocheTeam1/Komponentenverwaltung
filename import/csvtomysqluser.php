<?php
$fp = fopen($uploadfile, "r");
$zeilen = array();
while( !feof($fp) ) {
    $zeilen[] = fgetcsv  ( $fp  , 4096 , ";" , "\"" );
}
fclose($fp);

//Passwort verschlüsseln
foreach ($zeilen as &$value){
	$value[1] = password_hash($value[1], 1);
	}

//Insert Array to mysql-db
$con = mysqli_connect("localhost", "Full", "Passwort12345", "itverwaltung");
foreach ($zeilen as &$value){
	if ($value!="")
	{
		$sql = "INSERT INTO benutzer (username, passwort, rechte_id, benutzervorname, benutzernachname)
		VALUES ('".$value[0]."', '".$value[1]."', ".$value[2].", '".$value[3]."', '".$value[4]."');";
		$err = mysqli_query($con, $sql);
		if($err==false)
		{
			$errors[]= $value[0];
		}
	}
}
?>

