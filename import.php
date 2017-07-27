<?php
/**
* CSV File Upload for Database initialisation.
* @author Lukas Dallhammer
**/
include('Assets/helpers.php');

redirectToLogin();
$link = establishLinkForUser();

$title = "Import";
$errors=array();
if(isset($_POST['import']))
{
	echo "Import";
	$uploaddir = 'import/';
	$uploadfile = $uploaddir . basename($_FILES['userfile']['name']); //filename for insert scripts
	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
		$errors[]= "Datei ist valide und wurde erfolgreich hochgeladen.\n";
	} else {
		$errors[]= "Möglicherweise eine Dateiupload-Attacke!\n";
	}
	switch($_POST['type'])
	{
		case 'benutzer':
			include('csvtomysqluser.php');
			break;
		case 'lieferant':
			include('csvtomysqluser.php');
			break;
		case 'raeume':
			include('csvtomysqlroom.php');
			break;
		case 'komponentenattribute':
			include('csvtomysqlatributes.php');
			break;
		case 'komponentenarten':
			include('csvtomysqltype.php');
			break;
		case 'komponenten':
			include('csvtomysqlcomponents.php');
			break;
	}
	unlink($uploadfile);
}
?>
<html>
	<?php include('Assets/header.php'); ?>
	<body>
		<?php include('Assets/nav.php'); ?>
		<?php echo breadCrumb(); ?>
		<div>
			<form enctype="multipart/form-data" method='POST' action="import.php">
				<label for='type'>Dateityp</label>
				<select id='type' name='type'>
					<!-- values are database names -->
					<option value='benutzer'>Benutzer<option>
					<option value='lieferant'>Lieferanten</option>
					<option value='raeume'>Räume</option>
					<option value='komponentenattribute'>Komponentenattribute</option>
					<option value='komponentenarten'>Komponentenarten</option>
					<option value='komponenten'>Komponenten</option>
				</select>
				<!-- MAX_FILE_SIZE muss vor dem Dateiupload Input Feld stehen -->
				<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
				<!-- Der Name des Input Felds bestimmt den Namen im $_FILES Array -->
				Diese Datei hochladen: <input name="userfile" type="file" />
				<input type="submit" name="import" value="Importieren" />
			</form>
			<div>
				<?php foreach($errors as $error)
				{
					echo $error;
				}
				?>
			</div>
		</div>
	</body>
</html>