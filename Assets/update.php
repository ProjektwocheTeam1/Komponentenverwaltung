<?php
	if(isset($_POST['update_btn']))
	{
		switch ($_POST['type']) {
			case 'Komponentenattribut':
				$updateDatabaseSQL = "
				UPDATE komponentenattribute
				SET kat_bezeichnung = $_POST['Bezeichnung']
				WHERE kat_id = $_GET['kat_id'];
				";
				break;
			case 'Raum':
				$result = getRoomData($id, $con);
				$numberText = 'Raumnummer: '.$id;
				break;
			case 'Komponentenart':
				$result = getCompKindData($id, $con);
				$numberText = 'Komponentenartnummer: '.$id;
				break;
			case 'Komponente':
				$result = getComponentData($id, $con);
				$rooms = getRoomData(NULL, $con);
				$compKinds = getCompKindData(NULL, $con);
				$numberText = 'Komponentennummer: '.$id;
				$target = 'componentOverview.php';
				var_dump($result);
				var_dump($rooms);
				break;
			case 'Lieferant':
				$result = getSupplierData($id, $con);
				$numberText = 'Lieferantennummer: '.$id;
				break;
			case 'Benutzer':
				$result = getUserData($id, $con);
				$numberText = 'Benutzernummer: '.$id;
				break;
		}
		$updateDatabaseSQL = "
		UPDATE {$_POST['type']}
		";
	}
?>