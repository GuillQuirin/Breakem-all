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
		<link rel="stylesheet" href="web/css/module/navbar.css" media="screen">
		<link rel="stylesheet" href="web/css/module/position.css" media="screen">
		<link rel="stylesheet" href="web/css/module/margin.css" media="screen">
		<link rel="stylesheet" href="web/css/module/fonts.css" media="screen">
		<link rel="stylesheet" href="web/css/module/icon.css" media="screen">
		<script src="../web/js/navbar.js"></script>
		<?php echo (isset($css)) ? '<link rel="stylesheet" href="web/css/'.$css.'-stylesheet.css">' : '';?>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<?php echo (isset($js)) ? '<script src="web/js/'.$js.'.js"></script>' : '';?>
	</head>

	<body>

		<header>
			 <!-- Navbar top -->
			  <nav class="navbar full fixed transparent" id="navbar">
			    <div class="container resultat-container m-a">
			      <div class="grid-md-12 navbar-menu left">
			      	<ul>
				        <li>
				        	<a href="" class="active">Accueil 
				        		<img class="icon icon-size-1-demi navbar-icon" src="web/img/icon/icon-down.png">
				        		<span>News</span>
				        	</a>
				        </li>
				        <li>
				        	<a href="">Tournoi 
				        		<img class="icon icon-size-1-demi navbar-icon" src="web/img/icon/icon-down.png">
				        		<span>avalaible</span>
				        	</a>
				        </li>
				        <li><a href="">Team 
				        		<img class="icon icon-size-1-demi navbar-icon" src="web/img/icon/icon-down.png">
				        		<span>challenger</span>
				        	</a>
				        </li>
				        <li>
				        	<a href="#" class="navbar-logo">
			      				<img src="web/img/logodown.png">
			      			</a>
			      		</li>
				        <li>
				        	<a href="">Joueur 
				        		<img class="icon icon-size-1-demi navbar-icon" src="web/img/icon/icon-down.png">
				        		<span>full list</span>
				        	</a>
				        </li>
				        <li>
				        	<a href="">Classement 
				        		<img class="icon icon-size-1-demi navbar-icon" src="web/img/icon/icon-down.png">
				        		<span>rank</span>
				        	</a>
				        </li>
				        <li>
				        	<a href="">
				        		<img class="icon icon-size-3 navbar-icon" src="web/img/icon/icon-profil.png">
				        	</a>
				        </li>
				        <li>
				        	<a href="">
				        		<img class="icon icon-size-3 navbar-icon" src="web/img/icon/icon-search.png">
				        	</a>
				        </li>
			        </ul>
			       </div>
			      </div>
			    </div>
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