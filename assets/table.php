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
        <td>
          <form action="create.php" method="post">
            <input type="submit" name="btnCopy" value="Kopieren">
          </form>
        </td>
        <td>
          <form action="update.php" method="post">
            <input type="submit" name="btnConfig" value="Konfigurieren">
          </form>
        </td>
        <td>
          <form action="delete.php" method="post">
            <input type="submit" name="btnDelete" value="Löschen">
          </form>
        </td>
      </tr>
      <?php
    }
    ?>
</table>
