<?php
/**
* this class gets the different Komponentenattribute
* from the Komponentenart and creates a form
* @author: Dominik Berger
* @editor: Atom
**/
  include("Assets/helpers.php");
	redirectToLogin();
  include("Assets/header.php");
  include("Assets/nav.php");
  $Con = establishLinkForUser();
  $logId = createLog($Con,"1","Komponente angelegt");
  $query = <<<SQL
    INSERT INTO komponenten (raeume_r_id, lieferant_l_id, k_einkaufsdatum, k_gewaehrleistungsdauer, k_notiz, k_hersteller, komponentenarten_ka_id, log_id)
    VALUES ('{$_POST['Raum']}','{$_POST['Lieferant']}','{$_POST['Einkaufsdatum']}','{$_POST['Gewährleistungsdauer']}','{$_POST['Notiz']}','{$_POST['Hersteller']}','{$_POST['Komponentenart']}','{$logId}');
SQL;
  $result = mysqli_query($Con, $query);
  $compid = mysqli_insert_id($Con);
  $query = <<<SQL
  SELECT * FROM komponentenattribute WHERE (SELECT komponentenattribute_kat_id FROM wird_beschrieben_durch WHERE komponentenarten_ka_id= '{$_POST['Komponentenart']}');
SQL;
  $result = mysqli_query($Con, $query);
  $result = queryToArray($result);
  $i=0;
?>

<form method="POST" action="update.php">
  <table>
    <?php foreach ($result as $key) {
    ?>
    <tr>
      <td><label><?=$key['kat_bezeichnung']?></label></td>
      <td><input name="attribute" required/><input type="hidden" name="attId" value="<?= $key['kat_id']?>"/></td>
    </tr>
    <?php }?>
  </table>
  <input type="hidden" name="compid" value="<?= $compid ?>"/>

  <input type="hidden" name="type" value="component" />
  <input type="submit" name"create_btn" value="Erstelle Attribute" />
</form>
