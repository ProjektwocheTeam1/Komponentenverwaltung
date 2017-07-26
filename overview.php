<?php
	include('assets/helpers.php');
		//get login credentials
	if(isset($_POST['login']))
	{
		$db_full = mysqli_connect('localhost', 'Full', 'Passwort12345', 'itverwaltung');//@TODO: database
		//start login
		//query database for user
		$options = [
		 'cost' => 11,
		 'salt' => '�}��-�����mb�����r�',
	 	];
		$passwordhash = password_hash("admin", PASSWORD_BCRYPT,$options);

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
		$rooms = array(); //from db
	}
	else
	{
		redirectToLogin();
	}
?>
<html>
 <?php include('assets/header.php'); ?>
 <body>
	<?php include('assets/nav.php'); ?>
	<div>
		<div>
			<a href="#">Start</a>
		</div>
		<form method="POST" action="overview.php">
			<input type ="text" id="Csearch" name="components">
			<input class="hidden" type="submit" value="Komponente suchen">
		</form>
		<?php
			foreach($rooms as $room)
			{
				?>
				<div>
					<a href="room.php?room=<?php echo $room_id; ?>">
						<?php echo $room['r_bezeichnung']; ?>
					</a>
					<!-- echo Room Name -->
				</div>
				<?php
			}
		?>
	</div>

 </body>
</html>
