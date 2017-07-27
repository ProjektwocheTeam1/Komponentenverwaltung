<html>
<?php $title = "Login"; include('assets/header.php');?>
	<body>
		<div class="loginContent">
			<h1>Komponentenverwaltung</h1>
			<div class="loginlabel">Login</div>
			<div class="loginform">
				<form method="POST" action="overview.php">
					<table align="center">
						<tr>
							<td><label for="BName">Benutzername:</label></td>
							<td><input type ="text" id="BName" name="username"></td>
						</tr>
						<tr>
							<td><label for="Pass">Passwort:</label></td>
							<td><input type ="password" id="Pass" name="password"></td>
						</tr>
						<tr>
							<td></td>
							<td style="text-align: right;"><input type="submit" name="login" value="Anmelden"></td>
						</tr>
					</table>
				</form>
			</div>
			<img class="loginfooter" src="Assets/img/footer.png"/>
		</div>
	</body>
	<footer>
	</footer>
</html>
