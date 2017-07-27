<?php
/**
* Update Controller. Writes updates to db.
* $con is mysqli link
*  requires helpers.php to be included before.
* @author: Lukas Dallhammer
**/
	if(isset($_POST['update_btn']))
	{
		switch ($_POST['controller']) {
			case 'Komponentenattribut':
				$updateDatabaseSQL = "
				UPDATE komponentenattribute
				SET kat_bezeichnung = '{$_POST['Bezeichnung']}'
				WHERE kat_id = {$_POST['id']};
				";
				break;
			case 'Raum':
				$log = createLog($con, 'Änderung', '');
				$updateDatabaseSQL = "
				UPDATE raeume
				SET r_nr = {$_POST['Raum']},
					r_bezeichnung = '{$_POST['Bezeichnung']}',
					r_notiz = '{$_POST['Notiz']}',
					log_id = {$log}
				WHERE r_id = {$_POST['id']};
				";
				break;
			case 'Komponentenart':
				$updateDatabaseSQL = "
				UPDATE komponentenarten
				SET ka_komponentenart = '{$_POST['Komponentenart']}'
				WHERE ka_id={$_POST['id']};
				";
				break;
			case 'Komponente':
				$log = createLog($con, 'Änderung', '');
				$updateDatabaseSQL = "
				UPDATE komponenten
				SET raeume_r_id = {$_POST['Raum']},
					lieferant_l_id = {$_POST['Lieferant']},
					k_einkaufsdatum = '{$_POST['Einkaufsdatum']}',
					k_gewaehrleistungsdauer = {$_POST['Gewährleistung_(in_Jahren)']},
					k_notiz = '{$_POST['Notiz']}',
					k_hersteller = '{$_POST['Hersteller']}',
					komponentenarten_ka_id = {$_POST['Komponentenart']},
					log_id = $log
				WHERE k_id = {$_POST['id']};";
				break;
			case 'Lieferant':
				$log = createLog($con, 'Änderung', '');
				$updateDatabaseSQL = "
				UPDATE lieferant
				SET l_firmenname = '{$_POST['Firmenname']}',
					l_strasse = '{$_POST['Strasse']}',
					l_plz = '{$_POST['PLZ']}',
					l_ort = '{$_POST['Ort']}',
					l_tel = '{$_POST['Tel']}',
					l_mobil = '{$_POST['Mobil']}',
					l_fax = '{$_POST['Fax']}',
					l_email = '{$_POST['E-Mail']}',
					log_id = $log
				WHERE l_id = {$_POST['id']};
				";
				var_dump($_POST);
				var_dump($updateDatabaseSQL);
				break;
			case 'Benutzer':
				$passwort = password_hash($_POST['Passwort']);
				$updateDatabaseSQL = "
				UPDATE benutzer
				SET username = '{$_POST['Benutzername']}',
					passwort = '$passwort',
					rechte_id = {$_POST['Rechte_id']},
					benutzervorname = '{$_POST['Vorname']}',
					benutzernachname = '{$_POST['Nachname']}'
				WHERE benutzer_id = {$_POST['id']};
				";
				break;
		}
		//n-m-Tabellen Pflegen
		mysqli_query($con, $updateDatabaseSQL);
	}
?>