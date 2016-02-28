<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Break'em All</title>
		<meta name="description" content="Tournoi de jeux video">

		<link rel="stylesheet" href="web/css/template.css" media="screen">
	</head>

	<body>

		<header>
			<div id="logo">
				<img src="web/img/logo.png" class="logo">
			</div>
			
			<nav id="menu" >
				<ul>
	 				<li><a href="#">Accueil</a></li>
	 				<li><a href="#">Tournoi</a>
	 					<ul> 
	 						<li><a href="#">Jeux</a></li>
	 						<li><a href="#">Evenement</a></li>
	 					</ul>
	 				</li>

					<li><a href="#">Team</a></li>
					<li><a href="#"></a></li>
					<li><a href="#">Joueur</a></li>
					<li><a href="#">Classement</a></li>
					<li><a href="#">Mon compte</a></li>
				</ul>
			</nav>
		</header>
		<br>
		<?php include $this->view; ?>

		<footer>
			<div id="copyright">
				&#169 Copyright 2016 Break'em All. All right reserved.
			</div>
		</footer>
	</body>
</html>