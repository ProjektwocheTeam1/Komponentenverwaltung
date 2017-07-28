<?php
/**
* Lists all users.
*
* @author: Felix Binder
* @editor: Atom
**/
  include('Assets/helpers.php');
  redirectToLogin();
  $con = establishLinkForUser();
  include('Assets/updateController.php');
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
  mysqli_close($con);
?>

<html>
 <?php include('Assets/header.php'); ?>

  <body>
    <?php
    include('Assets/nav.php');
    echo breadCrumb();
    ?>
    <div id="userOverview">
      <h2 id="OverviewHeader">Übersicht aller Benutzer</h2>

      <?php if ($_SESSION['user'] == 'Azubi' || $_SESSION['user'] == 'Systembetreuer') { ?>
      <form action="create.php?type=user" method="post">
        <input class="submit_btn" type="submit" name="btnAnlegen" value="Benutzer hinzufügen">
      </form>
      <?php } ?>

      <?php if (count($result) > 0) {
        include('Assets/table.php');
      } else {
        ?>
        <div>Keine Benutzer vorhanden!</div>
        <?php
      } ?>
    </div>
  </body>
</html>
