<?php
  include('assets/helpers.php');
  redirectToLogin();
  $con = establishLinkForUser();
  $title = "Komponentenartenübersicht";
  $type= "Komponentenart";

  $query = <<<SQL
    SELECT ka_id AS ID,
      ka_komponentenart AS Komponentenart
    FROM komponentenarten;
SQL;

  $result = mysqli_query($con, $query);
  $result = mysqli_fetch_assoc($result);
?>

<html>
 <?php include('assets/header.php'); ?>

  <body>
    <?php
    include('assets/nav.php');
    echo breadCrumb();
    ?>
    <div id="compAttrOverview">
      <h3 id="OverviewHeader">Übersicht aller Komponentenarten</h3>

      <form action="create.php?type=compKind" method="get">
        <input type="submit" name="btnAnlegen" value="Komponentenarten anlegen">
      </form>

      <?php if (count($result) > 0) {
        include('assets/table.php');
      } else {
        ?>
        <div>Keine Komponentenarten vorhanden!</div>
        <?php
      } ?>
    </div>
  </body>
</html>
