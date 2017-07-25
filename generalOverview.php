<?php
  $title = "Komponentenübersicht";
	$result = array();

  $result[] = array(
    "ID" => 0,
    "Komponentenart" => "Test Komponentenart",
		"Raum" => "123",
		"Einkaufsdatum" => "01.01.2000",
		"Gewährleistungsdauer" => "365",
		"Notiz" => "Test Notiz",
		"Hersteller" => "Test Hersteller",
		"Lieferant" => "Test Lieferant"
	);
  $result[] = array(
    "ID" => 1,
    "Komponentenart" => "Test Komponentenart 132",
		"Raum" => "123222",
		"Einkaufsdatum" => "01.01.2001",
		"Gewährleistungsdauer" => "365",
		"Notiz" => "Test Notiz 123",
		"Hersteller" => "Test Hersteller 123",
		"Lieferant" => "Test Lieferant 123"
	);
	// Get DB array here as $result!

  /*
    Benötigte Daten:
    ID: komponenten.k_id
    Komponentenart: komponentenarten.ka_komponentenart
    Raum: raeume.r_bezeichnung
    Einkaufsdatum: komponenten.k_einkaufsdatum
    Gewährleistungsdauer: komponenten.k_gewaehrleistungsdatum
    Notiz: komponenten.k_notiz
    Hersteller: komponenten.k_hersteller
    Lieferant: lieferant.l_firmenname
  */
?>

<html>
  <head>
    <meta charset="utf-8">
  	<title><?php echo $title; ?></title>
    <script src="assets/sorttable.js" charset="utf-8"></script>
  </head>

  <body>
    <div id="generalOverview">
      <h3 id="gOverviewHeader">Übersicht aller Komponenten</h3>

      <form action="create.php" method="post">
        <input type="submit" name="btnAnlegen" value="Anlegen">
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
