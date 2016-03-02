<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="robots" content="index,follow" />
			<title>Break'em All<?php echo (isset($title)) ? ' - '.$title : '';?></title>
			<meta name="description" content=<?php echo (isset($content)) ? '"'.$content.'"' : 'tournois de jeux vidéos';?>>
			<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<link rel="stylesheet" href="web/css/template.css" media="screen">
		<?php echo (isset($css)) ? '<link rel="stylesheet" href="web/css/'.$css.'-stylesheet.css">' : '';?>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<?php echo (isset($js)) ? '<script src="web/js/'.$js.'.js"></script>' : '';?>
	</head>

	<body>

		<header>
			<div id="symbol" class="hide">
				<span class="symbol" id="menu_icon">&#9776</span>
			</div>
			<div id="logo">
				<img src="web/img/logo.png" class="logo">
			</div>

			
			<nav id="menu" >
				<ul>
	 				<li><a href="/esgi/Breakem-all/index">Accueil</a></li>
	 				<li><a href="/esgi/Breakem-all/tournoi">Tournoi</a>
	 					<ul> 
	 						<li><a href="#">Jeux</a></li>
	 						<li><a href="#">Evenement</a></li>
	 					</ul>
	 				</li>

					<li><a href="/esgi/Breakem-all/team">Team</a></li>
					<li><a href="#"></a></li>
					<li><a href="#">Joueur</a></li>
					<li><a href="#">Classement</a></li>
					<li><a href="#">Mon compte</a></li>
				</ul>
			</nav>
			<nav id="menu2" >
				<ul class="hide">
	 				<li><a href="/esgi/Breakem-all/index">Accueil</a></li>
	 				<li><a href="/esgi/Breakem-all/tournoi">Tournoi</a>
	 					<ul> 
	 						<li><a href="#">Jeux</a></li>
	 						<li><a href="#">Evenement</a></li>
	 					</ul>
	 				</li>

					<li><a href="/esgi/Breakem-all/team">Team</a></li>
					<li><a href="#">Joueur</a></li>
					<li><a href="#">Classement</a></li>
					<li><a href="#">Mon compte</a></li>
				</ul>
			</nav>
		</header>
		<div id="content">
			<?php include $this->view; ?>
		</div>
		<footer>
			<div id="copyright">
				&#169 Copyright 2016 Break'em All. All right reserved.
			</div>
		</footer>
	</body>
</html>