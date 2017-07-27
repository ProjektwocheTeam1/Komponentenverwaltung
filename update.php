<?php
include("Assets/helpers.php");
redirectToLogin();
$con = establishLinkForUser();
$type = $_POST['type'];
$id = $_POST['id'];
$title = 'Änderung - '.$type;
$result = array();
$numberText = '';
$target = '';

switch ($type) {
	case 'Komponentenattribut':
		$result = getCompAttrData($id, $con);
		$numberText = 'Komponentenattributnummer: '.$id;
		break;
	case 'Raum':
		$result = getRoomData($id, $con);
		$numberText = 'Raumnummer: '.$id;
		break;
	case 'Komponentenart':
		$result = getCompKindData($id, $con);
		$numberText = 'Komponentenartnummer: '.$id;
		break;
	case 'Komponente':
		$result = getComponentData($id, $con);
		$numberText = 'Komponentennummer: '.$id;
		$target = 'componentOverview.php';
		var_dump($result);
		break;
	case 'Lieferant':
		$result = getSupplierData($id, $con);
		$numberText = 'Lieferantennummer: '.$id;
		break;
	case 'Benutzer':
		$result = getUserData($id, $con);
		$numberText = 'Benutzernummer: '.$id;
		break;
}

function getCompAttrData($id, $con) {
	$query = <<<SQL
		SELECT kat_id as ID,
			kat_bezeichnung as Bezeichnung
		FROM komponentenattribute
		WHERE kat_id = {global $id};
SQL;

	$result = mysqli_query($con, $query);
	return queryToArray($result);
}

function getCompKindData($id, $con) {
	return '';
}

function getComponentData($id, $con) {
	$query = <<<SQL
	SELECT r.r_bezeichnung AS Raum,
		l.l_firmenname AS Lieferant,
		k.k_einkaufsdatum AS Einkaufsdatum,
		k.k_gewaehrleistungsdauer AS Gewaehrleistung,
		k.k_notiz AS Notiz,
		k.k_hersteller AS Hersteller,
		ka.ka_komponentenart AS Komponentenart
	FROM komponenten AS k
	INNER JOIN raeume AS r
		ON k.raeume_r_id = r.r_id
	INNER JOIN lieferant AS l
		ON k.lieferant_l_id = l.l_id
	INNER JOIN komponentenarten AS ka
		ON k.komponentenarten_ka_id = ka.ka_id
	WHERE k.k_id = {$id};
SQL;

	$result = mysqli_query($con, $query);
	return mysqli_fetch_assoc($result);
}

function getRoomData($id, $con) {
	return '';
}

function getSupplierData($id, $con) {
	return '';
}

function getUserData($id, $con) {
	return '';
}
?>

<html>
	<?php include("Assets/header.php");?>
	<body>
		<?php include('assets/nav.php'); ?>
		<?= breadCrumb(); ?>
		<div>
			<table>
				<tr>
					<td><h2><?php echo $_POST['type']; ?> ändern</h2></td>
					<td style="text-align: right;"><div><?php echo $numberText ?></div></td>
				</tr>
			</table>
			<form method="post" action="<?php echo $target; ?>">
				<table>
					<?php
					foreach($result as $key => $value)
					{
						?>
						<tr>
							<td><label for="<?= $key ?>"><?= $key ?></label></td>
							<td><?php
								if($key == "Raum" || $key == "Komponentenart")
								{
									echo'<select>';
										foreach(ArraySelect($key) as $element)
										{
											echo '<option value="'.$element.'">'.$element.'</option>';
										}
									echo '</select>';
								}
								else
								{
									if($key = "Gewährleistung")
									{
										$key = "Gewährleistung (in Jahren)";
									}
									echo '<input type="text" name="'.$key.'" value="'.$value.'" />';
								}
							?></td>
						</tr>
						<?php
					}
					?>
					<tr>
						<td></td>
						<td style="text-align: right;"><input type="submit" value="Ändern" name="create_btn" class="create_btn" /></td>
					</tr>
				</table>
				<?php //include("assets/table.php"); ?>
			</form>
		</div>
	</body>
</html>
