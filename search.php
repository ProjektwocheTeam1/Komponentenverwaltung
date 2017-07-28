<?php
	include('Assets/helpers.php');
	redirectToLogin();
	$con = establishLinkForUser();
	$title = "Suchergebnisse";
	$search = $_POST['components'];

	$result = searchComponents($search);
	$result = queryToArray($result);
	$type = "Komponente";
?>

<html>
	<?php include('Assets/header.php'); ?>
	<body>
		<?php
		include('Assets/nav.php');
		echo breadCrumb();
		?>
		<div>
			<h2>Suchergebnisse</h2>
			<?php
			if (count($result) > 0)
			{
				include('Assets/table.php');
			}
			else
			{
				?><div>Keine Räume vorhanden!</div><?php
			}
			?>
		</div>
	</body>
</html>
