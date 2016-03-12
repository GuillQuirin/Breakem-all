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
			      <div class="grid-md-5 navbar-menu left">
			      	<ul>
			      		<li>
				        	<a href="#" class="navbar-logo">
			      				<img src="web/img/logo.png" width="100">
			      				<span class="navbar-title">Breakthemall</span>
			      			</a>
			      		</li>
				        <li><a href="" class="active">Lien 1</a></li>
				        <li><a href="">Lien 2</a></li>
				        <li><a href="">Lien 3</a></li>
				        <li><a href="">Lien 4</a></li>
			        </ul>
			       </div>
			      <div class="grid-md-5 grid-md-offset-1 navbar-menu right">
			      	<ul>
			      		<li><a href="">Lien 3</a></li>
				        <li><a href="">Lien 4</a></li>
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