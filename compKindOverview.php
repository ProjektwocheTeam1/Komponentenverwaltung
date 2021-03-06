<?php
/**
* Lists all component-kinds.
*
* @author: Felix Binder
* @editor: Atom
**/
  include('Assets/helpers.php');
  redirectToLogin();
  $con = establishLinkForUser();
  include('Assets/updateController.php');
  $title = "Komponentenartenübersicht";
  $type= "Komponentenart";

  $query = <<<SQL
    SELECT ka_id AS ID,
      ka_komponentenart AS Komponentenart
    FROM komponentenarten;
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
    <div id="compAttrOverview">
      <h2 id="OverviewHeader">Übersicht aller Komponentenarten</h2>

      <?php if ($_SESSION['user'] == 'Azubi' || $_SESSION['user'] == 'Systembetreuer') { ?>
      <form action="create.php?type=compKind" method="post">
        <input class="submit_btn" type="submit" name="btnAnlegen" value="Komponentenarten hinzufügen">
      </form>
      <?php } ?>

      <?php if (count($result) > 0) {
        include('Assets/table.php');
      } else {
        ?>
        <div>Keine Komponentenarten vorhanden!</div>
        <?php
      } ?>
    </div>
  </body>
</html>
