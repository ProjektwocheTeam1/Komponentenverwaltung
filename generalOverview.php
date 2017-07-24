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

        <?php if (count($result) > 0) { ?>
        <table class="sortable" border="1">
        <tr>
        <?php
          // Generate Table-Header
          foreach($result[0] as $key => $value) {
            ?>
            <th><?php echo $key; ?></th>
            <?php
          }
        ?>
        </tr>

        <?php
    		  for($i = 0; $i < count($result); $i++) {
    			  ?>
    			  <tr>
      			  <?php
              // Generate Table-Data
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
        <?php } ?>
      </form>
    </div>
  </body>
</html>
