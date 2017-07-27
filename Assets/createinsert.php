<?php
/**
* This class insert data from the create form
* into the database in the right table
* @author: Dominik Berger
* @editor: Atom
**/
var_dump($_POST['attId']);
$Con = establishLinkForUser();
if(isset($_POST['create_btn'])){
  switch($_POST['type']){
    case'room':
      $logid = createLog($Con,"Raum erstellt",1);
      $query = <<<SQL
      INSERT INTO raeume (r_nr, r_bezeichnung, r_notiz, log_id) VALUES('{$_POST['RaumNr']}', '{$_POST['Bezeichnung']}', '{$_POST['Notiz']}' ,'{$logid}');
SQL;
      $id =mysqli_insert_id($Con);
      $type="Raum";
      $result = mysqli_query($Con,$query);
      $id = mysqli_insert_id($Con);
      break;
    case'supplier':
      $logid = createLog($Con,"Lieferant erstellt",1);
      $query=<<<SQL
      INSERT INTO lieferant (l_firmenname,l_strasse,l_plz,l_ort,l_tel,l_mobil,l_fax,l_email,log_id) VALUES('{$_POST['Firmenname']}','{$_POST['Strasse']}','{$_POST['Postleitzahl']}','{$_POST['Ort']}','{$_POST['Tel_']}','{$_POST['Mobil']}','{$_POST['Fax']}','{$_POST['Email']}','{$logid}');
SQL;
      $type="Lieferant";
      $result = mysqli_query($Con,$query);
      $id = mysqli_insert_id($Con);
      break;
    case'user':
      $hashpassword = password_hash($_POST["Passwort"],PASSWORD_DEFAULT);
      $query=<<<SQL
      INSERT INTO benutzer (passwort,username,rechte_id,benutzervorname,benutzernachname) VALUES('{$hashpassword}','{$_POST['Username']}','{$_POST['Rechte']}','{$_POST['Vorname']}','{$_POST['Nachname']}')
SQL;
      $type="Benutzer";
      $result = mysqli_query($Con,$query);
      $id = mysqli_insert_id($Con);
      break;
    case'compKind':
      $query=<<<SQL
      INSERT INTO komponentenarten(ka_komponentenart) VALUES ('{$_POST['Komponentenart']}')
SQL;
      $type="Komponentenart";
      $result = mysqli_query($Con,$query);
      $id = mysqli_insert_id($Con);
      break;
    case'compAttr':
      $query=<<<SQL
      INSERT INTO komponentenattribute(kat_bezeichnung) VALUES ('{$_POST['Bezeichnung']}')
SQL;
      $type="Komponentenattribut";
      $result = mysqli_query($Con,$query);
      $id = mysqli_insert_id($Con);
      break;
    case'component':
      foreach ($variable as $key => $value) {
        $query=<<<SQL
        INSERT INTO `komponente_hat_attribute` (`komponenten_k_id`, `komponentenattribute_kat_id`, `khkat_wert`) VALUES('{$key['compid']}', '{$key['attid']}', '{$key['attribute']}')
SQL;
      $result += mysqli_query($Con,$query);
      }
      $result = queryToArray($result);
      var_dump($result);
      $type="Komponente";
      // $result = mysqli_query($Con,$query);
      $id = $_POST['compid'];
      break;

  }
}else{
  $type = $_POST['type'];
  $id = $_POST['id'];
}
?>
