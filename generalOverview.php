<?php
  $title = "Komponentenübersicht";
	$result = array();

  $result[] = array(
		"Bezeichnung" => "Test Bezeichnung",
		"Raum" => "123",
		"Einkaufsdatum" => "01.01.2000",
		"Gewährleistungsdauer" => "365",
		"Notiz" => "Test Notiz",
		"Hersteller" => "Test Hersteller",
		"Komponentenart" => "Test Komponentenart",
		"Lieferant" => "Test Lieferant"
	);
  $result[] = array(
		"Bezeichnung" => "Test Bezeichnung 123",
		"Raum" => "123222",
		"Einkaufsdatum" => "01.01.2001",
		"Gewährleistungsdauer" => "365",
		"Notiz" => "Test Notiz 123",
		"Hersteller" => "Test Hersteller 123",
		"Komponentenart" => "Test Komponentenart 132",
		"Lieferant" => "Test Lieferant 123"
	);
	// Get DB array here as $result!
?>

<html>
  <head>
    <meta charset="utf-8">
  	<title><?php echo $title; ?></title>
    <script src="assets/sorttable.js" charset="utf-8"></script>
  </head>

  <body>
    <div id="generalOverview">
      <form action="create.php" method="post">
        <h3 id="gOverviewHeader">Übersicht aller Komponenten</h3>

        <input type="submit" name="btnAnlegen" value="Anlegen">

        <table class="sortable" border="1">
  		  <tr>
    			<th>Bezeichnung</th>
    			<th>Raum</th>
    			<th>Einkaufsdatum</th>
    			<th>Gewährleistungsdauer</th>
    			<th>Notiz</th>
    			<th>Hersteller</th>
    			<th>Komponentenart</th>
    			<th>Lieferant</th>
  		  </tr>

        <?php
    		  for($i = 0; $i < count($result); $i++) {
    			  ?>
    			  <tr>
      			  <?php
      			  foreach($result[$i] as $key => $value) {
        			  ?>
        				<td><?php echo $value; ?></td>
        			  <?php
      			  }
      			  ?>
      			</tr>
      			<?php
    		  }
  		  ?>
        </table>
      </form>
    </div>
  </body>
</html>
