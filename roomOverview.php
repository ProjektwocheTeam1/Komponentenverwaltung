<?php
  include('assets/helpers.php');
  redirectToLogin();
  $con = establishLinkForUser();
  $title = "Raumübersicht";
  $type= "Raum";

  $query = <<<SQL
    SELECT r_id as ID,
      r_nr AS Raumnummer,
			r_bezeichnung AS Bezeichnung,
      r_notiz as Notiz
		FROM raeume;
SQL;

  $result = mysqli_query($con, $query);
  $result = queryToArray($result);
?>

<html>
 <?php include('assets/header.php'); ?>

  <body>
    <?php
    include('assets/nav.php');
    echo breadCrumb();
    ?>
    <div id="supplierOverview">
      <h2 id="OverviewHeader">Übersicht aller Räume</h2>

      <?php if ($_SESSION['user'] == 'Azubi' || $_SESSION['user'] == 'Systembetreuer') { ?>
      <form action="create.php?type=room" method="post">
        <input class="submit_btn" type="submit" name="btnAnlegen" value="Raum hinzufügen">
      </form>
      <?php } ?>

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
