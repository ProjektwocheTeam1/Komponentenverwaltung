<?php
/**
* Lists all suppliers.
*
* @author: Felix Binder
* @editor: Atom
**/
  include('assets/helpers.php');
  redirectToLogin();
  $con = establishLinkForUser();
  include('Assets/updateController.php');
  $title = "Lieferantenübersicht";
  $type= "Lieferant";

  $query = <<<SQL
    SELECT l_id AS ID,
      l_firmenname  AS Firmenname,
      l_strasse AS Strasse,
      l_plz AS PLZ,
      l_ort AS Ort,
      l_tel AS Tel,
      l_mobil AS Mobil,
      l_fax AS Fax,
      l_email AS Mail
    FROM lieferant;
SQL;

  $result = mysqli_query($con, $query);
  $result = queryToArray($result);
  mysqli_close($con);
?>

<html>
 <?php include('assets/header.php'); ?>

  <body>
    <?php
    include('assets/nav.php');
    echo breadCrumb();
    ?>
    <div id="supplierOverview">
      <h2 id="OverviewHeader">Übersicht aller Lieferanten</h2>

      <?php if ($_SESSION['user'] == 'Azubi' || $_SESSION['user'] == 'Systembetreuer') { ?>
      <form action="create.php?type=supplier" method="post">
        <input class="submit_btn" type="submit" name="btnAnlegen" value="Lieferanten hinzufügen">
      </form>
      <?php } ?>

      <?php if (count($result) > 0) {
        include('assets/table.php');
      } else {
        ?>
        <div>Keine Lieferanten vorhanden!</div>
        <?php
      } ?>
    </div>
  </body>
</html>
