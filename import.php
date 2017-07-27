<?php
include('Assets/helpers.php');

	redirectToLogin();

	$link = establishLinkForUser();

$title = "Import";
	/**
	* CSV File Upload for Database initialisation.
	* @author Lukas Dallhammer
	**/
?>
<html>
	<?php include('Assets/header.php'); ?>
	<body>
		<?php include('Assets/nav.php'); ?>
		<?php echo breadCrumb(); ?>
	</body>
</html>