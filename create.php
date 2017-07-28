<?php
include("Assets/helpers.php");
	redirectToLogin();
	$Con = establishLinkForUser();
	if(isset($_GET['type']))
	{
		if($_GET['type']=='room'){
			$result =array(
				"RaumNr",
				"Bezeichnung",
				"Notiz"
			);
		}elseif ($_GET['type']=="supplier"){
			$result =array(
				"Firmenname",
				"Strasse",
				"Postleitzahl",
				"Ort",
				"Tel.",
				"Mobil",
				"Fax",
				"Email"
			);
		}elseif ($_GET['type']=="user"){
			$result =array(
				"Username",
				"Passwort",
				"Vorname",
				"Nachname"
			);
			$getrightsSQL = "SELECT rechte_id AS id, r_bez AS Bezeichnung FROM rechte;";
			$rights = mysqli_query($Con, $getrightsSQL);
			if($rights){
				$rights = queryToArray($rights);
			}
		}elseif($_GET['type']=="compKind"){
			$result = array("Komponentenart",);
		}
		elseif($_GET['type']=="compAttr"){
			$result = array("Bezeichnung");
		}
		elseif($_GET['type']=="component"){
			$getRoomsSQL = "SELECT r_id AS id, r_nr AS Raumnummer, r_bezeichnung AS Bezeichnung FROM raeume;";
			$rooms = mysqli_query($Con, $getRoomsSQL);
			if($rooms){
				$rooms = queryToArray($rooms);
			}
			$getDeliversSQL = "SELECT l_id AS id, l_firmenname AS Firmenname FROM lieferant;";
			$delivers = mysqli_query($Con, $getDeliversSQL);
			if($delivers){
				$delivers = queryToArray($delivers);
			}
			$getCommpartSQL = "SELECT ka_id AS id, ka_komponentenart AS Art FROM komponentenarten;";
			$componenttypes = mysqli_query($Con, $getCommpartSQL);
			if($componenttypes){
				$componenttypes = queryToArray($componenttypes);
			}
			$result = array("Einkaufsdatum","Gewährleistungsdauer","Notiz","Hersteller");
		}
	}
	// Get DB array here as $result!
?>

<style>
.delete { margin-left: 6cm;}

</style>
<html>
	<?php include("Assets/header.php");?>
	<body>
		<?php include("Assets/nav.php");?>
		<?= breadCrumb(); ?>
		<div class="delete">
			<h2>Anlegen</h2>
			<form method="post" <?php if ($_GET['type']=="component") { ?> action="createComponentAttribute.php" <?php }else { ?> action="update.php" <?php } ?>>
				<table>
					<?php
					if($_GET['type']=="component" && $rooms){
						?>
						<tr>
							<td>
								<label>Raum</label>
								<select name="Raum" width="200px">
								<?php
								foreach($rooms as $room)
								{
								?>
										 <option value="<?php echo($room['id']); ?>"><?php echo($room['Raumnummer']); ?> <?php echo($room['Bezeichnung']); ?></option>
								<?php
								}
								?>
								</select>
							</td>
					</tr>
					<?php
				  }
					if($_GET['type']=="component" && $delivers){
						?>
						<tr>
							<td>
								<label>Lieferant</label>
								<select name="Lieferant" width="200px">
								<?php
								foreach($delivers as $deliver)
								{
								?>
										 <option value="<?php echo($deliver['id']); ?>"><?php echo($deliver['Firmenname']); ?></option>
								<?php
								}
								?>
								</select>
							</td>
					</tr>
					<?php
					}
					if($_GET['type']=="component" && $componenttypes){
						?>
						<tr>
							<td>
								<label>Komponentenart</label>
								<select name="Komponentenart" width="200px">
								<?php
								foreach($componenttypes as $componenttype)
								{
								?>
										 <option value="<?php echo($componenttype['id']); ?>"><?php echo($componenttype['Art']); ?></option>
								<?php
								}
								?>
								</select>
							</td>
					</tr>
					<?php
					}
					foreach($result as $key)
					{
						if(strcmp($key,"Passwort") == 0){
							?>
								<tr>
									<td><label for="<?= $key ?>"><?= $key ?></label></td>
									<td><input type="password" name="<?= $key ?>" /></td>
								</tr>
							<?php
						}elseif(strcmp($key,"Einkaufsdatum") == 0){
							?>
								<tr>
									<td><label for="<?= $key ?>"><?= $key ?></label></td>
									<td><input type="date" name="<?= $key ?>" /></td>
								</tr>
							<?php
						}else{
							?>
							<tr>
								<td><label for="<?= $key ?>"><?= $key ?></label></td>
								<td><input type="text" name="<?= $key ?>" /></td>
							</tr>
							<?php
						}
					}
					?>
					<?php
					if($_GET['type']=="user" && $rights){
						?>
						<tr>
							<td>
								<label>Rechte</label>
								<select name="Rechte" width="200px">
								<?php
								foreach($rights as $right)
								{
								?>
										 <option value="<?php echo($right['id']); ?>"><?php echo($right['Bezeichnung']); ?></option>
								<?php
								}
								?>
								</select>
							</td>
					</tr>
					<?php
					}
					?>
					<tr>
						<td></td>
						<td style="text-align: right;"><input type="submit" value="create" name="create_btn" class="create_btn" /></td>
					</tr>
				</table>
				<input type="hidden" name="type" value="<?= $_GET['type'] ?>" />
			</form>
		</div>
	</body>
</html>
