<?php
include("Assets/helpers.php");
//redirectToLogin(); include("Assets/nav.php");
$con = establishLinkForUser();

$result = array(
	"Name" => "Max",
	"Nachname" => "Mustermann",
	"Passwort" => "Test123"
);
// Get DB array here as $result!
	
// $id = $_GET['id'];
$title = "";
?>

<html>
	<?php include("Assets/header.php");?>
	<body>
		<?php include('assets/nav.php'); ?>
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
				<?php include("assets/table.php"); ?>
			</form>
		</div>
	</body>
</html>
