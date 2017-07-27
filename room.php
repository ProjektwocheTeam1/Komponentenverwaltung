<?php
/**
* Lists components filtered for the given room.
* Needs to be called with a GET like ?room={r_id}
* @author: Lukas Dallhammer, Ben 
**/
	include('Assets/helpers.php');
	redirectToLogin();

	$link = establishLinkForUser();

	//For Software as component:: LEFT JOIN software_in_raum AS sir ON sir.sir_k_id=k.k_id
	$findComponentsInRoomSQL = "
	SELECT k_id AS Nummer, ka_komponentenart AS Komponentenart, k_notiz AS Notiz, k_hersteller AS Hersteller, k_einkaufsdatum AS Einkaufsdatum, k_gewaehrleistungsdauer AS Gewahrleistungsdauer
	FROM komponenten AS k
	LEFT JOIN komponentenarten AS ka ON k.komponentenarten_ka_id=ka.ka_id
	LEFT JOIN raeume AS r ON r.r_id=k.raeume_r_id
	WHERE k.raeume_r_id={$_GET['room']};
	";
	$findRoomSQL = "SELECT r_id AS r_id, r_nr AS Raumnummer, r_bezeichnung AS Bezeichnung, r_notiz AS Notiz FROM raeume WHERE r_id={$_GET['room']};";
	$query = mysqli_query($link, $findComponentsInRoomSQL);
	if($query)
	{
		$result = queryToArray($query);
		$room = mysqli_query($link, $findRoomSQL);
		$room = mysqli_fetch_assoc($room);
	}
	else
	{
		echo "Keine Komponenten gefunden";
	}
	$title = "Raum".$_GET['room'];
	mysqli_close($link);
 ?>
<html>
 <?php include('assets/header.php'); ?>
 <body>
	<?php include('assets/nav.php'); ?>
	<?php echo breadCrumb(); ?>
	<div class="content">
		<h1><?php echo $room['Bezeichnung']; ?></h1>
		<form method="GET" action="create.php?type=Komponente">
			<input type="submit" value="Komponente anlegen" >
		</form>
		<?php
			$type='Raum'; //needs to be set for table.php
			if(isset($result[0]))
			{
				include('assets/table.php');
			}
			else
			{
				echo "Keine Komponenten angelegt";
			}
		?>
	</div>
 </body>
</html>
