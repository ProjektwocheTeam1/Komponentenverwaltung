<?php
  include('assets/helpers.php');
  redirectToLogin();
  breadCrumb();
  $con = establishLinkForUser();
  $title = "Komponentenattributübersicht";
  $type= "Komponentenattribut";

  $query = <<<SQL
    SELECT kat_id AS ID,
      kat_bezeichnung AS Bezeichnung
    FROM komponentenattribute;
SQL;

  $result = mysqli_query($con, $query);
  $result = mysqli_fetch_assoc($result);
?>

<html>
 <?php include('assets/header.php'); ?>

  <body>
 	<?php include('assets/nav.php'); ?>
    <div id="compAttrOverview">
      <h3 id="OverviewHeader">Übersicht aller Komponentenattribute</h3>

      <form action="create.php?type=compAttr" method="get">
        <input type="submit" name="btnAnlegen" value="Komponentenattribute anlegen">
      </form>

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
