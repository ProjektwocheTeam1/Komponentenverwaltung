<head>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="Assets/styling.css">
	<link rel="stylesheet" href="Assets/JQuery/jquery-ui-1.12.1.custom/jquery-ui.theme.min.css">
	<script src="Assets/sorttable.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script>
		$(function() {
			$( "#datepicker" ).datepicker({
				dateFormat: "yy-mm-dd"
			});
		});
	</script>
	<title><?php echo $title; ?></title>
</head>
