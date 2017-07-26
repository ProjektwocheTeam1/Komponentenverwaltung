<?php
include("Assets/helpers.php");
//redirectToLogin(); include("Assets/nav.php");
$con = establishLinkForUser();

$result = array(
	"Name" => "Taner",
	"Nachname" => "Deniz",
	"Passwort" => "Test123"
);
// Get DB array here as $result!
	
$id = $_GET['id'];
$title = "";
	
	
?>

<html>
	<?php include("Assets/header.php");?>
	<body>
		<?= breadCrumb(); ?>
		<div>
			<table>
				<tr>
					<td><h2>Komponente ändern</h2></td>
					<td style="text-align: right;"><div>Komponentennummer: </div></td>
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
							<td>
							<?php
							if($key = "Raum" || "Komponentenart")
							{
								?><select><?php
									foreach(ArraySelect($key) as $element)
									{
										echo '<option value="'.$element.'">'.$element.'</option>';
									}
								?></select><?php
							}
							else
							{
								if($key = "Gewährleistung")
								{
									$key = "Gewährleistung (in Jahren)";
								}
								?><input type="text" name="<?= $key ?>" value="<?= $value ?>" /><?php
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
			</form>
		</div>
	</body>
</html>
