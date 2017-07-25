<?php
	include('assets/helpers.php');
	//get login credentials
	if(isset($_POST['login']))
	{
		$db_full = mysqli_connect('localhost', 'root', '', 'itverwaltung');//@TODO: database
		//start login
		//query database for user
		$passwordhash = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$getUserSQL = <<<SQL
		SELECT r.r_bez
		FROM rechte AS r
		JOIN benutzer AS b ON r.rechte_id = b.rechte_id
		WHERE b.username='{$_POST['username']}' AND b.passwort='$passwordhash';
SQL;
		$tmp = mysqli_query($db_full, $getUserSQL);
		$role = mysqli_fetch_assoc($tmp)['r_bez'];
		if(!empty($role))
		{
			$role = mysqli_fetch_assoc($tmp)['r_bez'];
		}
		else
		{

			redirectToLogin();
		}

		//save user in session
		session_start();

		$_SESSION['user'] = $role;
		echo("user gesetzt".$role);
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
