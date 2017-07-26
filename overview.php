<?php
	include('Assets/helpers.php');
		//get login credentials
	if(isset($_POST['login']))
	{
		$db_full = mysqli_connect('localhost', 'Full', 'Passwort12345', 'itverwaltung');//@TODO: database
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

		$db_link = establishLinkForUser();

		//get rooms from db
		$getRoomsSQL = "SELECT r_id AS r_id, r_nr AS Raumnummer, r_bezeichnung AS Bezeichnung, r_notiz AS Notiz FROM raeume;";
		$rooms = mysqli_query($db_link, $getRoomsSQL);
		$rooms = mysqli_fetch_assoc($rooms);
	}
	else
	{
		redirectToLogin();
	}
?>
<html>
 <?php include('Assets/header.php'); ?>
 <body>
	<?php include('Assets/nav.php'); ?>
	<div>
		<?php echo breadCrumb(); ?>
		<form method="POST" action="overview.php">
			<input type ="text" id="Csearch" name="components">
			<input class="hidden" type="submit" value="Komponente suchen">
		</form>
		<?php
			var_dump($rooms);
			foreach($rooms as $room)
			{
				?>
				<div>
					<a href="room.php?room=<?php echo $r_id; ?>">
						<?php echo $room['Bezeichnung']; ?>
					</a>
					<!-- echo Room Name -->
				</div>
				<?php
			}
		?>
	</div>

 </body>
</html>
