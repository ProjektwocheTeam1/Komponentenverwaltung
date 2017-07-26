<?php
  include('assets/helpers.php');
  breadCrumb();
  redirectToLogin();
  $con = establishLinkForUser();
  $title = "Komponentenübersicht";

  $query = <<<SQL
    SELECT k.k_id AS ID,
      r.r_bezeichnung AS Raum,
      ka.ka_komponentenart AS Komponentenart,
      k.k_hersteller AS Hersteller,
      k.k_notiz AS Notiz,
      k.k_gewaehrleistungsdauer AS Gewährleistungsdauer,
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

	// $result = array();
  // $result[] = array(
  //   "ID" => 0,
  //   "Komponentenart" => "Test Komponentenart",
	// 	"Raum" => "123",
	// 	"Einkaufsdatum" => "01.01.2000",
	// 	"Gewährleistungsdauer" => "365",
	// 	"Notiz" => "Test Notiz",
	// 	"Hersteller" => "Test Hersteller",
	// 	"Lieferant" => "Test Lieferant"
	// );
  // $result[] = array(
  //   "ID" => 1,
  //   "Komponentenart" => "Test Komponentenart 132",
	// 	"Raum" => "123222",
	// 	"Einkaufsdatum" => "01.01.2001",
	// 	"Gewährleistungsdauer" => "365",
	// 	"Notiz" => "Test Notiz 123",
	// 	"Hersteller" => "Test Hersteller 123",
	// 	"Lieferant" => "Test Lieferant 123"
	// );
	// Get DB array here as $result!
?>

<html>
 <?php include('assets/header.php'); ?>

  <body>
 	<?php include('assets/nav.php'); ?>
    <div id="generalOverview">
      <h3 id="gOverviewHeader">Übersicht aller Komponenten</h3>

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
