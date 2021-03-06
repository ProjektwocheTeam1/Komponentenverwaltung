<?php
/**
* Shows all needed data for the update of the following modules:
* - Komponentenattribute
* - Komponentenarten
* - Komponenten
* - Lieferanten
* - Benutzer
* - Räume
*
* @author: Felix Binder
* @editor: Atom
**/
include("Assets/helpers.php");
redirectToLogin();
include ("Assets/createinsert.php");
$con = establishLinkForUser();

$title = 'Änderung - '.$type;
$type_old = $type;
$data = array();
$numberText = '';
$target = '';
$rooms = array();
$compKinds = array();
$result = array();
$supplier = array();

switch ($type) {
	case 'Komponentenattribut':
		$data = getCompAttrData($id, $con);
		$numberText = 'Komponentenattributnummer: '.$id;
		$target = 'compAttrOverview.php';
		break;
	case 'Raum':
		$data = getRoomData($id, $con);
		$numberText = 'Raumnummer: '.$id;
		$target = 'roomOverview.php';
		break;
	case 'Komponentenart':
		$data = getCompKindData($id, $con);
		$numberText = 'Komponentenartnummer: '.$id;
		$target = 'compKindOverview.php';
		break;
	case 'Komponente':
		$data = getComponentData($id, $con);
		$rooms = getRoomData(NULL, $con);
		$compKinds = getCompKindData(NULL, $con);
		$result = getCompAttrsForComp($id, $con);
		$supplier = getSupplierForComp($id, $con);
		$numberText = 'Komponentennummer: '.$id;
		$target = 'componentOverview.php';
		$type = "Komponentenattribut";
		break;
	case 'Lieferant':
		$data = getSupplierData($id, $con);
		$numberText = 'Lieferantennummer: '.$id;
		$target = 'supplierOverview.php';
		break;
	case 'Benutzer':
		$data = getUserData($id, $con);
		$numberText = 'Benutzernummer: '.$id;
		$target = 'userOverview.php';
		break;
}

/**
* Get a specific component attribute.
*
* @param $id: component-attribute ID
* @param $con: database link
* @return assoc-array
* @author: Felix Binder
* @editor: Atom
**/
function getCompAttrData($id, $con) {
	$query = <<<SQL
		SELECT kat_bezeichnung AS Bezeichnung
		FROM komponentenattribute
		WHERE kat_id = {$id};
SQL;

	$query = $query.';';
	$result = mysqli_query($con, $query);
	return mysqli_fetch_assoc($result);

}

/**
* Get all component attributes for one specific component.
*
* @param $compId: component ID
* @param $con: database link
* @return array with assoc-arrays
* @author: Felix Binder
* @editor: Atom
**/
function getCompAttrsForComp($compId, $con) {
	$query = <<<SQL
		SELECT ka.kat_id AS ID,
			ka.kat_bezeichnung AS Bezeichnung
		FROM komponentenattribute AS ka
		INNER JOIN komponente_hat_attribute AS kha
			ON ka.kat_id = kha.komponentenattribute_kat_id
		INNER JOIN komponenten AS k
			ON kha.komponenten_k_id = k.k_id
		WHERE k.k_id = {$compId};
SQL;

	$result = mysqli_query($con, $query);
	return queryToArray($result);
}

/**
* Get all component kinds when $id ist NULL.
* Get one specific component kind when $id is not NULL.
*
* @param $id: component-kind ID, can be NULL
* @param $con: database link
* @return assoc-array or array with assoc-arrays
* @author: Felix Binder
* @editor: Atom
**/
function getCompKindData($id, $con) {
	$query = <<<SQL
	SELECT ka_komponentenart AS Komponentenart
	FROM komponentenarten
SQL;

	if ($id == NULL) {
		$query = $query.';';
		$result = mysqli_query($con, $query);
		return queryToArray($result);
	} else {
		$query = $query.' WHERE ka_id = '.$id.';';
		$result = mysqli_query($con, $query);
		return mysqli_fetch_assoc($result);
	}
}

/**
* Get one specific component.
*
* @param $id: component ID
* @param $con: database link
* @return assoc-array
* @author: Felix Binder
* @editor: Atom
**/
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

/**
* Get all rooms when $id ist NULL.
* Get one specific room when $id is not NULL.
*
* @param $id: room ID, can be NULL
* @param $con: database link
* @return assoc-array or array with assoc-arrays
* @author: Felix Binder
* @editor: Atom
**/
function getRoomData($id, $con) {
	$query = <<<SQL
	SELECT r_id AS ID,
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

/**
* Get one specific supplier when $id.
*
* @param $id: supplier ID
* @param $con: database link
* @return assoc-array
* @author: Felix Binder
* @editor: Atom
**/
function getSupplierData($id, $con) {
	$query = <<<SQL
	SELECT l_firmenname  AS Firmenname,
		l_strasse AS Strasse,
		l_plz AS PLZ,
		l_ort AS Ort,
		l_tel AS Tel,
		l_mobil AS Mobil,
		l_fax AS Fax,
		l_email AS Mail
	FROM lieferant
	WHERE l_id = {$id};
SQL;

	$result = mysqli_query($con, $query);
	return mysqli_fetch_assoc($result);
}

/**
* Get all suppliers for given component ID.
*
* @param $id: component ID
* @param $con: database link
* @return array with assoc-arrays
* @author: Felix Binder
* @editor: Atom
**/
function getSupplierForComp($compId, $con) {
	$query = <<<SQL
	SELECT l.l_id AS ID,
		l.l_firmenname AS Firmenname
	FROM lieferant AS l
	INNER JOIN komponenten AS k
		ON l.l_id = k.lieferant_l_id
	WHERE k.k_id = {$compId};
SQL;

	$result = mysqli_query($con, $query);
	return queryToArray($result);
}

/**
* Get one specific user.
*
* @param $id: user ID
* @param $con: database link
* @return assoc-array
* @author: Felix Binder
* @editor: Atom
**/
function getUserData($id, $con) {
	$query = <<<SQL
	SELECT username AS Benutzername,
		rechte_id AS Rechte_ID,
		benutzervorname AS Vorname,
		benutzernachname AS Nachname
	FROM benutzer
	WHERE benutzer_id = {$id};
SQL;

	$result = mysqli_query($con, $query);
	return mysqli_fetch_assoc($result);
}

mysqli_close($con);
?>

<html>
	<?php include("Assets/header.php");?>
	<body>
		<?php include('Assets/nav.php'); ?>
		<?= breadCrumb(); ?>
		<div>
			<table>
				<tr>
					<td><h2><?php echo $type_old; ?> ändern</h2></td>
					<td style="text-align: right;"><div><?php echo $numberText ?></div></td>
				</tr>
			</table>
			<form method="post" action="<?php echo $target; ?>">
				<table>
					<?php
					foreach($data as $key => $value)
					{
						if($key == "Gewaehrleistung")
						{
							$key = "Gewährleistung (in Jahren)";
						}
						if ($key != 'ID') {
						?>
						<tr>
							<td><label for="<?= $key ?>"><?= $key ?>:</label></td>
							<td><?php
						}
								if($key == "Raum")
								{
									echo '<select name="'.$key.'">';
										foreach ($rooms as $v) {
											if ($v['ID'] == $value) {
												echo '<option value="'.$v['ID'].'" selected="selected">'.$v['Bezeichnung'].'</option>';
											} else {
												echo '<option value="'.$v['ID'].'">'.$v['Bezeichnung'].'</option>';
											}
										}
									echo '</select>';
								} else if ($key == "Komponentenart" && count($compKinds) > 0) {
									echo '<select name="'.$key.'">';
										foreach ($compKinds as $v) {
											if ($v['ID'] == $value) {
												echo '<option value="'.$v['ID'].'" selected="selected">'.$v['Komponentenart'].'</option>';
											} else {
												echo '<option value="'.$v['ID'].'">'.$v['Komponentenart'].'</option>';
											}
										}
									echo '</select>';
								} else if ($key == "Lieferant") {
									echo '<select name="'.$key.'">';
										foreach ($supplier as $v) {
											if ($v['ID'] == $value) {
												echo '<option value="'.$v['ID'].'" selected="selected">'.$v['Firmenname'].'</option>';
											} else {
												echo '<option value="'.$v['ID'].'">'.$v['Firmenname'].'</option>';
											}
										}
									echo '</select>';
								} else if ($key == 'ID') {
									// hide IDs
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
						<?php
							if ($type_old == 'Benutzer') {
								echo '<td><label for="Passwort">Passwort:</label></td>';
								echo '<td><input type="text" name="Passwort" value="" placeholder="Passwort unverändert"/></td>';
							}
						?>
					</tr>
					<tr>
						<td></td>
						<td style="text-align: right;">
	            <input type="hidden" name="controller" value="<?php echo $type_old; ?>">
	            <input type="hidden" name="id" value="<?php echo $id; ?>">
							<input type="submit" value="Ändern" name="update_btn" class="update_btn" />
						</td>
					</tr>
				</table>
				<?php
				if ($type_old == 'Komponente') {
					if (count($result) > 0) {
						include("Assets/table.php");
					} else {
						?>
						<div>Keine Komponenten vorhanden!</div>
						<?php
					}
				}
				?>
			</form>
		</div>
	</body>
</html>
