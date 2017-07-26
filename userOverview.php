<?php
  include('assets/helpers.php');
  redirectToLogin();
  $con = establishLinkForUser();
  $title = "Benutzerübersicht";

  $query = <<<SQL
    SELECT benutzer_id AS ID,
      username AS Benutzername,
      passwort AS Passwort,
      rechte_id AS Rechte_ID,
      benutzervorname AS Vorname,
      benutzernachname AS Nachname
    FROM benutzer;
SQL;

  $result = mysqli_query($con, $query);
?>

<html>
 <?php include('assets/header.php'); ?>

  <body>
 	<?php include('assets/nav.php'); ?>
    <div id="userOverview">
      <h3 id="OverviewHeader">Übersicht aller Benutzer</h3>

      <form action="create.php?type=user" method="get">
        <input type="submit" name="btnAnlegen" value="Benutzer anlegen">
      </form>

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
