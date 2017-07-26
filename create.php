<?php
include("Assets/helpers.php");
	redirectToLogin();
	$Con = establishLinkForUser();
	if(isset($_GET['type']))
	{
		if($_GET['type']=='raeume'){
			$result =array(
				"RaumNr",
				"Bezeichnung",
				"Notiz"
			);
		}elseif ($_GET['type']=="lieferant"){
			$result =array(
				"Firmenname",
				"Strasse",
				"Postleitzahl",
				"Ort",
				"Tel.",
				"Fax",
				"Email"
			);
		}elseif($_GET['type']=="komponentenarten"){
			$result = array("Komponentenart",);
		}
		elseif($_GET['type']=="komponentenattribute"){
			$result = array("Bezeichnung");
		}
		elseif($_GET['type']=="komponenten"){
			$result = array("");
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
		<div class="delete">
			<h2>Anlegen</h2>
			<form method="post" action="overview.php">
				<table>
					<?php
					foreach($result as $key)
					{
						?>
						<tr>
							<td><label for="<?= $key ?>"><?= $key ?></label></td>
							<td><input type="text" name="<?= $key ?>" /></td>
						</tr>
						<?php
					}
					?>
					<tr>
						<td></td>
						<td style="text-align: right;"><input type="submit" value="Anlegen" name="create_btn" class="create_btn" /></td>
					</tr>
				</table>
			</form>
		</div>
	</body>
</html>
