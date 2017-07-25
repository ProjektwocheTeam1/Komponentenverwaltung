<?php

		$Con = mysqli_connect("localhost","root","","itverwaltung");
		$query = "SELECT r_id AS ID, r_nr AS Raum-Nummer,r_bezeichnung AS Bezeichnung, r_notiz AS Notiz FROM raeume WHERE ID='1';";
		$result = mysqli_query($Con,$query);
		$data = mysqli_fetch_assoc($result);
	// Get DB array here as $result!
?>


<html>
	<head></head>
	<body>
		<div>
			<h2>Löschen</h2>
			<form method="post" action="overview.php">
				<table>
					<?php
					foreach($data as $key => $value)
					{
						?>
						<tr>
							<td><label for="<?= $key ?>"><?= $key ?></label></td>
							<td><input type="text" name="<?= $key ?>" value="<?= $value?>"disabled /></td>
						</tr>
						<?php
					}
					?>
		      <tr>
						<td></td>
						<td style="text-align: right;"><input type="submit" value="Löschen" name="create_btn" class="create_btn" /></td>
					</tr>
				</table>
			</form>
		</div>
	</body>
</html>
