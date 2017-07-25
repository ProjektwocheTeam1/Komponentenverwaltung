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
    foreach ($result as $v) {
      ?>
      <tr>
      <?php
        // Generate Table-Data
        foreach($v as $key => $value) {
          ?>
          <td id="<?php echo $i.'_'.$key; ?>"><?php echo $value; ?></td>
          <?php
        }
        ?>
        <td>
          <form action="create.php" method="get">
            <input type="submit" name="btnCopy" value="Kopieren">
          </form>
        </td>
        <td>
          <form action="update.php" method="get">
            <input type="submit" name="btnConfig" value="Konfigurieren">
          </form>
        </td>
        <td>
          <form action="delete.php" method="get">
            <input type="submit" name="btnDelete" value="Löschen">
          </form>
        </td>
      </tr>
      <?php
    }
  ?>
</table>
