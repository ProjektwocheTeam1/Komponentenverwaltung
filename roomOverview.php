<html>
<?php
	$title =
	$room = " ";//db
 ?>
 <?php include('assets/header.php'); ?>
 
 <body>
	<?php include('assets/nav.php'); ?>
	<div>
		<a href="overview.php">Start</a> >
		<a href="generalOverview.php?type=raum">Räume</a> >
		<a href="#">Raum <?= $_GET['room']?></a>
	</div>
	<div class="content">
		<h1><?php echo $room; ?></h1>
		<form method="GET" action="create.php?type=component">
			<input type="submit" value="Komponente anlegen" >
		</form>
		<?php include('assets/table.php'); ?>
	</div>
 </body>
</html>			