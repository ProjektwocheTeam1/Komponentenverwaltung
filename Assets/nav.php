<html>
	<head>
		<style>
			.navbar-left {
				position: fixed;
				width: 200px;
				height: 100%;
				float: left;
				display: inline;
				padding: 0;
				margin: 0;
				margin-right: 10px;
				border-right: 1px solid grey;
			}
			
			.img_logo {
				margin: 10px 30px;
				width: 120px;
			}
			
			a, span {
				margin: 0;
				display: block;
				text-decoration: none;
				color: black;
				padding: 8px 6px;
				border: 1px solid lightgrey;
			}
			ul { margin: 0; }
			
			a:hover, span:hover, li:hover {
				border: 1px solid blue;
			}
		</style>
	</head>
	<body>
		<div class="navbar-left">
			<img src="img/logo.png" class="img_logo"/>
			<nav role="main">
				<a href="overview.php">Start</a>
				<a href="generellOverview.php">&Uuml;bersicht</a>
				<span>Verwaltung</span>
				<ul>
					<li><a href="#">Lieferanten</a></li>
					<li><a href="#">R&auml;ume</a></li>
					<li><a href="#">Benutzer</a></li>
					<li><a href="#">Komponentenarten</a></li>
					<li><a href="#">Komponentenattribute</a></li>
				</ul>
			</nav>
		</div>
	</body>
</html>