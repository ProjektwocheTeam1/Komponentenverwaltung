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
<<<<<<< HEAD
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
=======
							<td>
							<?php
							if($key = "Raum" || "Komponentenart")
							{
								?><select><?php
									foreach(ArraySelect($key) as $element)
>>>>>>> 08d850f4d4ef6456e22d0613f7ce19801ed6ece9
									{
										$key = "Gewährleistung (in Jahren)";
									}
<<<<<<< HEAD
									echo '<input type="text" name="'.$key.'" value="'.$value.'" />';
								}
=======
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
>>>>>>> 08d850f4d4ef6456e22d0613f7ce19801ed6ece9
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
