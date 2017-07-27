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
		$sql = "INSERT INTO komponentenattribute (kat_bezeichnung)
		VALUES ('".$value[0]."');";
		$err = mysqli_query($con, $sql);
		if($err==false)
		{
			$errors[]= $value[0];
		}
	}
}
?>

