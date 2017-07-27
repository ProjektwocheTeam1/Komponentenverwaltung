<?php
/**
* Starting page of the Application. Handles login.
* Login causes Session to be started and user saved in it.
* Offers search field for a component.
* Shows tiles as quick filters for each room.
* Contains nav on the side ans breadcrumb navigation history.
* @author: Lukas Dallhammer, Ben , Dominik Berger
**/
	include('Assets/helpers.php');
	//get login credentials
	if(isset($_POST['login']))
	{
		$db_full = mysqli_connect('localhost', 'Full', 'Passwort12345', 'itverwaltung');
		//start login
		//query database for user
		$getUserSQL = <<<SQL
		SELECT r_bez, passwort
		FROM rechte AS r
		JOIN benutzer AS b ON r.rechte_id = b.rechte_id
		WHERE b.username='{$_POST['username']}';
SQL;
		$tmp = mysqli_query($db_full, $getUserSQL);
		$tmp = mysqli_fetch_assoc($tmp);
		//check password integrity
		if(password_verify($_POST['password'], $tmp['passwort']))
		{
			$role = $tmp['r_bez'];
		}
		else
		{
			redirectToLogin();
		}
		//save user in session
		session_start();
		$_SESSION['user'] = $role;
		mysqli_close($db_full);
		//end login
	}
	else
	{
		redirectToLogin();
	}
	$db_link = establishLinkForUser();

	//get rooms from db
	$getRoomsSQL = "SELECT r_id AS r_id, r_nr AS Raumnummer, r_bezeichnung AS Bezeichnung, r_notiz AS Notiz FROM raeume;";
	$rooms = mysqli_query($db_link, $getRoomsSQL);
	$rooms = queryToArray($rooms);
	mysqli_close($db_link);
	$title="Start";
?>
<html>
 <?php include('Assets/header.php'); ?>
 <body>
	<?php include('Assets/nav.php'); ?>
	<div>
		<?php echo breadCrumb(); ?>
		<?php if ($_SESSION['user'] == 'Azubi' || $_SESSION['user'] == 'Systembetreuer') { ?>
      <form action="create.php?type=component" method="POST">
        <input type="submit" name="btnAnlegen" value="Komponente anlegen">
      </form>
      <?php } ?>
		<?php
			if(isset($rooms[0]))
			{
				foreach($rooms as $room)
				{
					?>
					<a class="roomTile" href="room.php?room=<?php echo $room['r_id']; ?>">
						<div >
								<?php echo $room['Bezeichnung']; ?>
						</div>
					</a>
					<?php
				}
			}
			else
			{
				echo "Bitte legen Sie einen Raum an um die Schnellfilterfunktion freizuschalten!";
			}
		?>
	</div>

 </body>
</html>
