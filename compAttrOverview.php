<?php
  include('Assets/helpers.php');
  redirectToLogin();
  $con = establishLinkForUser();
  include('Assets/updateController.php');
  $title = "Komponentenattributübersicht";
  $type= "Komponentenattribut";

  $query = <<<SQL
    SELECT kat_id AS ID,
      kat_bezeichnung AS Bezeichnung
    FROM komponentenattribute;
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
    <div id="compAttrOverview">
      <h2 id="OverviewHeader">Übersicht aller Komponentenattribute</h2>

      <?php if ($_SESSION['user'] == 'Azubi' || $_SESSION['user'] == 'Systembetreuer') { ?>
      <form action="create.php?type=compAttr" method="post">
        <input class="submit_btn" type="submit" name="btnAnlegen" value="Komponentenattribute hinzufügen">
      </form>
      <?php } ?>

      <?php if (count($result) > 0) {
        include('assets/table.php');
      } else {
        ?>
        <div>Keine Komponentenattribute vorhanden!</div>
        <?php
      } ?>
    </div>
  </body>
</html>
