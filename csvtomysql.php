<?php
$fp = fopen("E:\userlist.csv", "r");
$zeilen = array();

while( !feof($fp) ) {
    $zeilen[] = fgetcsv  ( $fp  , 4096 , ";" , "\"" );
}
fclose($fp);

var_dump($zeilen);
foreach ($zeilen as &$value){
	$value[2] = password_hash($value[2], PASSWORD_DEFAULT);
	}
?>

<br><br><br><br>

<?php
var_dump($zeilen);


$con = mysqli_connect("localhost", "testuser", "test", "usertest");
foreach ($zeilen as $value){
	echo "<br><br>";
	var_dump($con);
	echo "<br><br>";
	$sql = "INSERT INTO benutzer (benutzer_id, username, passwort, rechte_id, benutzervorname, benutzernachname) VALUES (".$value[0].", '".$value[1]."', '".$value[2]."', ".$value[3].", '".$value[4]."', '".$value[5]."');";
	var_dump($sql);
	mysqli_query($con, $sql);
}
?>

