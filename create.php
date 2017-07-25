<?php
include("Assets/helpers.php");
	$result = array(
		"Name" => "Tanna",
		"Nachname" => "Deniz",
		"Passwort" => "Test123"
	);
	// Get DB array here as $result!
?>


<html>
	<?php include("Assets/header.php");?>
	<body>
		<?php redirectToLogin(); include("Assets/nav.php");?>
		<div>
			<h2>Anlegen</h2>
			<form method="post" action="overview.php">
				<table>
					<?php
					foreach($result as $key => $value)
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
