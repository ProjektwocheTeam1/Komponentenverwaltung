<?php
include("Assets/helpers.php");
redirectToLogin();
$con = establishLinkForUser();
$type = $_POST['type'];
$id = $_POST['id'];
$title = 'Änderung - '.$type;
$result = array();
$numberText = '';

switch ($type) {
	case 'Komponentenattribut':
		$result = getCompAttrData();
		$numberText = 'Komponentenattributnummer: ';
		break;
	case 'Raum':
		$result = getRoomData();
		$numberText = 'Raumnummer: ';
		break;
	case 'Komponentenart':
		$result = getCompKindData();
		$numberText = 'Komponentenartnummer: ';
		break;
	case 'Komponente':
		$result = getComponentData();
		$numberText = 'Komponentennummer: ';
		break;
	case 'Lieferant':
		$result = getSupplierData();
		$numberText = 'Lieferantennummer: ';
		break;
	case 'Benutzer':
		$result = getUserData();
		$numberText = 'Benutzernummer: ';
		break;
}

function getCompAttrData() {
	$query = <<<SQL
		SELECT kat_id as ID,
			kat_bezeichnung as Bezeichnung
		FROM komponentenattribute
		WHERE kat_id = {$id};
SQL;

	$result = mysqli_query($con, $query);
	return mysqli_fetch_assoc($result);
}

function getCompKindData() {
	return '';
}

function getComponentData() {
	return '';
}

function getRoomData() {
	return '';
}

function getSupplierData() {
	return '';
}

function getUserData() {
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
					<td><h2><?php echo $title; ?> ändern</h2></td>
					<td style="text-align: right;"><div><?php echo $numberText ?></div></td>
				</tr>
			</table>
			<form method="post" action="overview.php">
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
