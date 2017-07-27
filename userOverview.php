<?php
  include('assets/helpers.php');
  redirectToLogin();
  $con = establishLinkForUser();
  $title = "Benutzerübersicht";
  $type= "Benutzer";

  $query = <<<SQL
    SELECT benutzer_id AS ID,
      username AS Benutzername,
      rechte_id AS Rechte_ID,
      benutzervorname AS Vorname,
      benutzernachname AS Nachname
    FROM benutzer;
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
    <div id="userOverview">
      <h3 id="OverviewHeader">Übersicht aller Benutzer</h3>

      <?php if ($_SESSION['user'] == 'Azubi' || $_SESSION['user'] == 'Systembetreuer') { ?>
      <form action="create.php?type=user" method="post">
        <input type="submit" name="btnAnlegen" value="Benutzer anlegen">
      </form>
      <?php } ?>

      <?php if (count($result) > 0) {
        include('assets/table.php');
      } else {
        ?>
        <div>Keine Benutzer vorhanden!</div>
        <?php
      } ?>
    </div>
  </body>
</html>
