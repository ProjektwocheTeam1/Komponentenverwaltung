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
$rooms = array();

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
		$rooms = getRoomData(NULL, $con);
		$numberText = 'Komponentennummer: '.$id;
		$target = 'componentOverview.php';
		var_dump($result);
		var_dump($rooms);
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
		WHERE kat_id = {$id};
SQL;

	$result = mysqli_query($con, $query);
	return queryToArray($result);
}

function getCompKindData($id, $con) {
	return '';
}

function getComponentData($id, $con) {
	$query = <<<SQL
	SELECT r.r_id AS Raum,
		l.l_firmenname AS Lieferant,
		k.k_einkaufsdatum AS Einkaufsdatum,
		k.k_gewaehrleistungsdauer AS Gewaehrleistung,
		k.k_notiz AS Notiz,
		k.k_hersteller AS Hersteller,
		ka.ka_id AS Komponentenart
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
	$query = <<<SQL
	SELECT r_id as ID,
		r_nr AS Raumnummer,
		r_bezeichnung AS Bezeichnung,
		r_notiz as Notiz
	FROM raeume
SQL;

	if ($id == NULL) {
		$query = $query.';';
		$result = mysqli_query($con, $query);
		return queryToArray($result);
	} else {
		$query = $query.' WHERE r_id = '.$id.';';
		$result = mysqli_query($con, $query);
		return mysqli_fetch_assoc($result);
	}
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
						if($key == "Gewaehrleistung")
						{
							$key = "Gewährleistung (in Jahren)";
						}
						if($key=='Einkaufsdatum')
						{
							$date = date_create($value);
							$value = date_format($date, 'd,m,Y');
						}
						?>
						<tr>
							<td><label for="<?= $key ?>"><?= $key ?>:</label></td>
							<td><?php
								if($key == "Raum" || $key == "Komponentenart")
								{
									echo'<select>';
										foreach ($rooms as $v) {
											if ($v['ID'] == $value) {
												echo '<option value="'.$v['Bezeichnung'].'"selected="selected">'.$v['Bezeichnung'].'</option>';
											} else {
												echo '<option value="'.$v['Bezeichnung'].'">'.$v['Bezeichnung'].'</option>';
											}
										}
									echo '</select>';
								}
								else
								{
									if ($key == 'Einkaufsdatum') {
										echo '<input type="text" name="'.$key.'" value="'.$value.'" id="datepicker" />';
									} else {
										echo '<input type="text" name="'.$key.'" value="'.$value.'" />';
									}
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
