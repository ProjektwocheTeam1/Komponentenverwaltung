<?php
$fp = fopen("E:\userlist.csv", "r");
$zeilen = array();

while( !feof($fp) ) {
    $zeilen[] = fgetcsv  ( $fp  , 4096 , ";" , "\"" );
}
fclose($fp);

foreach ($zeilen as &$value){
	$value[1] = password_hash($value[1], 1);
	}
?>

<br><br><br><br>

<?php
$con = mysqli_connect("localhost", "testuser", "test", "usertest");
foreach ($zeilen as &$value){
	echo "<br><br>";
	echo "<br><br>";
	$sql = "INSERT INTO benutzer (username, passwort, rechte_id, benutzervorname, benutzernachname) VALUES ('".$value[0]."', '".$value[1]."', ".$value[2].", '".$value[3]."', '".$value[4]."');";

	var_dump($sql);
	//var_dump(mysqli_query($con, $sql));
	mysqli_query($con, $sql);
}
?>

