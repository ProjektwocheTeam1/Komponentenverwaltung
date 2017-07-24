<html>
 <head>
	<meta charset="utf-8">
	<title>Übersicht: IT-Verwaltung</title>
 </head>
 <body>
	<div>
		<img src="http://www.b3-fuerth.de/b3/home.nsf/imgref/Image_logo_metall.png/$FILE/logo_metall.png">
		<!-- Nav-Leiste -->
	</div>
	<div>
		<form method="POST" action="overview.php">
			<label for="KSuche">Komponente suchen:
				<input type ="text" id="KSuche" name="components">
			</label>
			<input class="hidden" type="submit" value="KSuche">
		</form>
		<?php 
			foreach($rooms as $room)
			{
				?>
				<div>
					Raum 1
					<!-- echo Room Name -->
				</div>
				<?php
			}
		?>
	</div>
 </body>
</html>	