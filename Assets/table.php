<table class="sortable" border="1">
  <tr>
  <?php
    // Generate Table-Header
    foreach($result[0] as $key => $value) {
      ?>
      <th><?php echo $key; ?></th>
      <?php
    }
    if ($_SESSION['user'] == 'Azubi' || $_SESSION['user'] == 'Systembetreuer') {
  ?>
    <th>Kopieren</th>
    <th>Ändern</th>
    <th>Löschen</th>
  <?php } ?>
  </tr>

  <?php
    foreach ($result as $v) {
      ?>
      <tr>
      <?php
        // Generate Table-Data
        foreach($v as $key => $value) {
          if ($type == 'Raum' && $key == 'Raumnummer') {
            ?>
            <td>
              <a href="room.php?room=<?php echo $v['ID']; ?>">
                <?php echo $value; ?>
              </a>
            </td>
            <?php
          } else {
            ?>
            <td><?php echo $value; ?></td>
            <?php
          }
        }
        if ($_SESSION['user'] == 'Azubi' || $_SESSION['user'] == 'Systembetreuer') {
        ?>
        <td>
          <form action="create.php" method="post">
            <input type="hidden" name="type" value="<?php echo $type; ?>">
            <input type="hidden" name="id" value="<?php echo $v['ID']; ?>">
            <button type="submit" class="iconDiv"><img src="Assets/img/Copy.png" class="tableIcon"/></button>
			<!--<input type="submit" name="btnCopy" value="Kopieren">-->
          </form>
        </td>
        <td>
          <form action="update.php" method="post">
            <input type="hidden" name="type" value="<?php echo $type; ?>">
            <input type="hidden" name="id" value="<?php echo $v['ID']; ?>">
            <div class="iconDiv"><img src="Assets/img/Pencil.png" class="tableIcon" onclick="submit();"/></div>
			<!--<input type="submit" name="btnConfig" value="Konfigurieren">-->
          </form>
        </td>
        <td>
          <form action="delete.php" method="post">
            <input type="hidden" name="type" value="<?php echo $type ?>">
            <input type="hidden" name="id" value="<?php echo $v['ID']; ?>">
            <div class="iconDiv"><img src="Assets/img/Delete.png" class="tableIcon" onclick="submit();"/></div>
            <!--<input type="submit" name="btnDelete" value="Löschen">-->
          </form>
        </td>
      </tr>
      <?php
      }
    }
  ?>
</table>
