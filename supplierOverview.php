<?php
  include('assets/helpers.php');
  redirectToLogin();
  breadCrumb();
  $con = establishLinkForUser();
  $title = "Lieferantenübersicht";
  $type= "Lieferant";

  $query = <<<SQL
    SELECT l_id AS ID,
      l_firmennname AS Firmenname,
      l_strasse AS Strasse,
      l_plz AS PLZ,
      l_ort AS Ort,
      l_tel AS Tel,
      l_mobil AS Mobil,
      l_fax AS Fax,
      l_email AS E-Mail
    FROM lieferant;
SQL;

  $result = mysqli_query($con, $query);
?>

<html>
 <?php include('assets/header.php'); ?>

  <body>
 	<?php include('assets/nav.php'); ?>
    <div id="supplierOverview">
      <h3 id="OverviewHeader">Übersicht aller Lieferanten</h3>

      <form action="create.php?type=supplier" method="get">
        <input type="submit" name="btnAnlegen" value="Lieferanten anlegen">
      </form>

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
