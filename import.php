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
			Hier können Sie Ihre UTF-8 kodierten CSV Dateien hochladen.
			Bitte geben Sie an welche Datenbankobjekte Sie importieren möchten!<br />
			
			Die Reihenfolge des Imports und der Attribute entnehmen Sie bitte folgender Tabelle:
				<table>
					<tr>
						<td>Benutzer:</td>
						<td>Benutzername</td>
						<td>Passwort</td>
						<td>Rolle(1: Lehrer, 2: Verwaltung, 3: Systembetreuer, 4: Azubi)</td>
						<td>Vorname</td>
						<td>nachname</td>						
					</tr>
					<tr>
						<td>Lieferanten:</td>
						<td>Firmenname</td>
						<td>Straße mit Hausnummer</td>
						<td>PLZ</td>
						<td>Ort</td>
						<td>Telefonnummer</td>
						<td>Mobilfunknummer</td>
						<td>Faxnummer</td>
						<td>Email</td>
					</tr>
					<tr>
						<td>Räume:</td>
						
					</tr>
					<tr>
						<td>Komponentenattribute:</td>
						<td>Name</td>
					</tr>
					<tr>
						<td>Komponentenarten:</td>
						<td>Name</td>
					</tr>
					<tr>
						<td>Komponenten:</td>
						<td>Einkaufsdatum</td>
						<td>Gewährleistung in Jahren</td>
						<td>Notiz</td>
						<td>Hersteller</td>
					</tr>
				</table><br />
			Verknüpfungen müssen Sie in den Bearbeitungsansichten der jeweiligen Objekte vornehmen.
				
				<?php foreach($errors as $error)
				{
					echo $error;
				}
				?>
			</div>
		</div>
	</body>
</html>