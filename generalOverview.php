<?php
  $title = "Komponentenübersicht";
	$result = array(
		"Beschreibung" => "Test Beschreibung",
		"Raum" => "123",
		"Einkaufsdatum" => "01.01.2000",
		"Gewährleistungsdauer" => "365",
		"Notiz" => "Test Notiz",
		"Hersteller" => "Test Hersteller",
		"Komponentenart" => "Test Komponentenart",
		"Lieferant" => "Test Lieferant"
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
          <?php
            // Generate Table-Header
      			foreach($result as $key => $value)
      			{
      				?>
      					<th><?php echo $key; ?></th>
      				<?php
      			}
      		?>
          </tr>

          <tr>
          <?php
            // Generate Table-Data
      			foreach($result as $key => $value)
      			{
      				?>
      					<td><?php echo $value; ?></td>
      				<?php
      			}
      		?>
        </tr>
        </table>
      </form>
    </div>
  </body>
</html>
