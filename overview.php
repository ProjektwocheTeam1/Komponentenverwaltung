<html>
<?php
	$rooms = array(); //from db
?>
 <head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
 </head>
 <body>
	<?php include('assets/nav.php'); ?>
	<div>
		<form method="POST" action="overview.php">
			<input type ="text" id="KSuche" name="components">
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

	</body>
</html>

