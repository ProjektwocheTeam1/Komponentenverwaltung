<?php
  include('assets/helpers.php');
  redirectToLogin();
  $con = establishLinkForUser();
  $title = "Komponentenübersicht";
  $type= "Komponente";

  $query = <<<SQL
    SELECT k.k_id AS ID,
      r.r_bezeichnung AS Raum,
      ka.ka_komponentenart AS Komponentenart,
      k.k_hersteller AS Hersteller,
      k.k_notiz AS Notiz,
      k.k_gewaehrleistungsdauer AS Gewährleistung (Jahre),
      k.k_einkaufsdatum AS Einkaufsdatum,
      l.l_firmenname AS Lieferant,
    FROM komponenten AS k
    INNER JOIN raeume AS r
      ON k.raeume_r_id = r.r_id
    INNER JOIN lieferant AS l
      ON k.lieferant_l_id = l.l_id
    INNER JOIN komponentenarten AS ka
      ON k.komponentenarten_ka_id = ka.ka_id;
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
    <div id="generalOverview">
      <h3 id="OverviewHeader">Übersicht aller Komponenten</h3>

      <form action="create.php" method="post">
        <input type="submit" name="btnAnlegen" value="Komponente anlegen">
      </form>

      <?php if (count($result) > 0) {
        include('assets/table.php');
      } else {
        ?>
        <div>Keine Komponenten vorhanden!</div>
        <?php
      } ?>
    </div>
  </body>
</html>
