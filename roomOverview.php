<?php
  include('assets/helpers.php');
  redirectToLogin();
  breadCrumb();
  $con = establishLinkForUser();
  $title = "Raumübersicht";
  $type= "Raum";

  $query = <<<SQL
    SELECT r_nr AS Raumnummer,
			r_bezeichnung AS Bezeichnung
		FROM raeume;
SQL;

  $result = mysqli_query($con, $query);
  $result = mysqli_fetch_assoc($result);
?>

<html>
 <?php include('assets/header.php'); ?>

  <body>
 	<?php include('assets/nav.php'); ?>
    <div id="supplierOverview">
      <h3 id="OverviewHeader">Übersicht aller Räume</h3>

      <form action="create.php?type=room" method="get">
        <input type="submit" name="btnAnlegen" value="Raum anlegen">
      </form>

      <?php if (count($result) > 0) {
        include('assets/table.php');
      } else {
        ?>
        <div>Keine Räume vorhanden!</div>
        <?php
      } ?>
    </div>
  </body>
</html>
