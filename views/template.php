<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="robots" content="index,follow" />
			<title>Break'em All<?php echo (isset($title)) ? ' - '.$title : '';?></title>
			<?php echo '<link rel="shortcut icon" href="' . WEBPATH . '/web/img/icon/logo-full.ico" type="image/x-icon">';?>
			<meta name="description" content=<?php echo (isset($content)) ? '"'.$content.'"' : 'tournois de jeux vidéos';?>>
			<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/template.css" media="screen">';?>
		<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/navbar.css" media="screen">';?>
		<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/position.css" media="screen">';?>
		<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/margin.css" media="screen">';?>
		<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/fonts.css" media="screen">';?>
		<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/icon.css" media="screen">';?>
		<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/general-stylesheet.css">';?>
		<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/grid.css">';?>
		<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/size.css">';?>
		<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/text.css">';?>
		<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/display.css">';?>
		<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/search.css">';?>
		<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/button.css">';?>
		<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/image.css">';?>
		<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/border.css">';?>
		<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/failed-input.css">';?>
		<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/checkbox.css">';?>
		<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/input.css">';?>
		<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/menu.css">';?>
		<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/background.css">';?>
		<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/body.css">';?>
		<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/header.css">';?>
		<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/animation.css">';?>
		
		<?php echo (isset($css)) ? '<link rel="stylesheet" type="text/css" href="'.WEBPATH.'/web/css/'.$css.'-stylesheet.css">' : '';?>

	</head>

	<body>
		<header>
			<?php (isset($_isConnected)) ? include("views/includes/connected/navbar.php") : include("views/includes/visitor/navbar.php");?>
		</header>

		<div class="search-page hidden-fade hidden">
			<div class="container m-a">
				<div class="grid-md-12">
					<h2>Recherchez n'importe quoi puis appuyez sur entrer.</h2>
					<form method="post" class="">
		                    <!-- Input Search -->
		                    <div class="grid-md-12">
		                        <input class="input-search full-width" type="text" name="searchzone" placeholder="Recherchez" autocomplete="off">
		                    </div>
		            </form>
				</div>
			</div>

			<button class="search-btn btn-default circle-button default btn-close">
		        <span class="circle-greater-than">
		        	<?php echo '<img class="search-close" src="'. WEBPATH . '/web/img/icon/icon-close.png">';?>
		        </span>
		    </button>

		</div>

		<div class="index-modal hidden-fade hidden">
				
			<div class="index-modal-login align">
			<!-- Login Form -->
				<div id="login-form" class="grid-md-4 inscription_rapide animation fadeDown">
					<form id="login-form">			    
					    <label for="email">E-mail :</label>
					    <input class="input-default" type="text" id="email" name="email">

					    <label for="pwd1">Mot de passe : </label>
					    <input class="input-default" type="password" id="pwd1" name="password">			 					   
					    <button type="button" class="btn btn-pink"><a>Se connecter</a></button>
			  		</form>
			  	</div>
		  	<!-- Fin Login -->

		  	<!-- Subscribe Form -->
				<div id="subscribe-form" class="grid-md-4 inscription_rapide animation fadeDown">
					<form id="register-form">
					    <label for="pseudo">Pseudo :</label>
					    <input class="input-default" type="text" id="pseudo" name="pseudo">

					    <label for="email">E-mail :</label>
					    <input class="input-default" type="text" id="email" name="email">

					    <label for="pwd1">Mot de passe : </label>
					    <input class="input-default" type="password" id="pwd1" name="password">
					    <label for="pwd2">Confirmation mot de passe : </label>
					    <input class="input-default" type="password" id="pwd2" name="password_check">
						<p id="naissance">Date de naissance:
								<span class="index-input-default-date">
									<input class="input-default" type="number" name="day"   placeholder="dd" min="1" max="31">
									<input class="input-default" type="number" name="month" placeholder="mm" min="1" max="12">
									<input class="input-default" type="number" name="year"  placeholder="yyyy" min="1950" max="2016">
								</span>
							</p>
					    <input type="checkbox" class="checkbox input-default" id="cgu" name="cgu"><label for="cgu">
					    Vous acceptez les Conditions Générales du site Break'em All</label>
					   
					    <button type="button" class="btn btn-pink"><a>S'inscrire et jouer</a></button>
			  		</form>
			  	</div>
			  	<!-- Fin SF -->
				
			</div>
		</div>
		
		<div id="content">
			<?php include $this->view; ?>
		</div>
		<footer>
			<div id="copyright">
				&#169 Copyright 2016 Break'em All. All right reserved.
			</div>
		</footer>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<?php echo (isset($js)) ? '<script src="'.WEBPATH.'/web/js/'.$js.'.js"></script>' : '';?>
		<?php echo '<script src="'.WEBPATH.'/web/js/navbar.js"></script>';?>
	</body>
</html>
