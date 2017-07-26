<html>
 <?php include('assets/header.php');?>
 <body>
	<form method="POST" action="overview.php">
		<label for="BName">Benutzername:
			<input type ="text" id="BName" name="username">
		</label>
		<br />
		<label for="Pass">Passwort:
			<input type ="password" id="Pass" name="password">
		</label>
		<br />
		<input type="submit" name="login" value="Anmelden">
	</form>
 </body>
</html>
