<html>
  <head>
    <meta charset="utf-8">
  	<title><?php echo $title; ?></title>
    <script src="Assets/sorttable.js" charset="utf-8"></script>
  </head>

  <body>
    <div id="generalOverview">
      <form action="create.php" method="post">
        <h3 id="gOverviewHeader">Übersicht aller Komponenten</h3>

        <input type="submit" name="btnAnlegen" value="Anlegen">
        <table class="sortable">
        <tr> </tr>
          <?php
          // Komponenten anzeigen
          ?>
        </table>
      </form>
    </div>
  </body>
</html>
