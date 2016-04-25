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

		<?php echo (isset($css)) ? '<link rel="stylesheet" type="text/css" href="'.WEBPATH.'/web/css/'.$css.'-stylesheet.css">' : '';?>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<?php echo (isset($js)) ? '<script src="'.WEBPATH.'/web/js/'.$js.'.js"></script>' : '';?>
		<?php echo '<script src="'.WEBPATH.'/web/js/navbar.js"></script>';?>
	</head>

	<body>
		<header>
			 <!-- Navbar top -->
			  <nav class="navbar full fixed transparent" id="navbar">
			    <div class="container resultat-container m-a">

			    <!-- MENU -->
			      <div class="grid-md-8 hidden-xs hidden-sm navbar-menu">
			      		<ul>
			      			<li class="hover-none">
					        	<a href="index" class="navbar-logo"><?php echo '<img src="' . WEBPATH . '/web/img/logo-nb-title.png">';?></a>
			      			</li>
					        <li>
					        	<a href="/esgi/Breakem-all/index" class="active">Accueil<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="' . WEBPATH . '/web/img/icon/icon-down.png">';?></a>
					        </li>
					        <li>
					        	<a href="/esgi/Breakem-all/tournoi">Tournoi<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="' . WEBPATH . '/web/img/icon/icon-down.png">';?></a>
					        </li>
					        <li>
					        	<a href="/esgi/Breakem-all/team">Team<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="' . WEBPATH . '/web/img/icon/icon-down.png">';?></a>
					        </li>	
					        <li>
					        	<a href="">Joueur<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="' . WEBPATH . '/web/img/icon/icon-down.png">';?></a>
					        </li>
					        <li>
					        	<a href="/esgi/Breakem-all/resultat">Classement<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="' . WEBPATH . '/web/img/icon/icon-down.png">';?></a>
					        </li>					   				     
				        </ul>
			       </div>
			       <div class="grid-md-4 hidden-xs hidden-sm navbar-menu">
			      		<ul>
			      			<li class="hover-none" style="width:80px;">
			      				<button type="button" class="btn btn-pink"><a>Subscribe</a></button>
			      			</li>
			      			<li class="hover-none" style="width:205px;">
			      				<button type="button" class="btn btn-pink"><a>Login</a></button>
			      				<form action=<?php echo getActionPage($this->view, 'connexion'); ?> method="post">
			      					<input type="email" name="email" placeholder="email">
			      					<input type="password" name="password" placeholder="mot de passe">
			      					<input type="submit">
			      				</form>
			      			</li>
			      			<li class="hover-none hidden">
					        	<a href="">
					        		<?php echo '<img class="icon icon-size-3 navbar-icon" src="' . WEBPATH . '/web/img/icon/icon-profil.png">';?>
					        	</a>
					        </li>
					        <li class="hover-none">
					        	<button type="button" class="search-toggle">
					        		<?php echo '<img class="icon icon-size-3 navbar-icon" src="'. WEBPATH . '/web/img/icon/icon-search.png">';?>
       				 			</button>
					        </li>
		      			</ul>
	      			</div>
			       <!-- FIN MENU -->

			       <!-- MENU TOGGLE -->
			       <div class="grid-md-12 hidden-md hidden-lg navbar-menu">
			       	<?php echo '<img id="navbar-toggle-logo" src="'. WEBPATH . '/web/img/logo-nb-title.png">';?>
			       	<?php echo '<img id="navbar-toggle" src="'. WEBPATH . '/web/img/icon/icon-menu.png">';?>
			       </div>
			       <!-- FIN MENU TOGGLE -->

			       <!-- NAVBAR SIDE -->
			       	<div class="navbar-side-menu hidden-md hidden-lg navbar-collapse">
				       	<ul>
					        <li>
					        	<a href="/esgi/Breakem-all/index" class="active">Accueil
					        		<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="'. WEBPATH . '/web/img/icon/icon-down.png">';?>
					        	</a>
					        </li>
					        <li>
					        	<a href="/esgi/Breakem-all/tournoi">Tournoi
					        		<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="'. WEBPATH . '/web/img/icon/icon-down.png">';?>
					        	</a>
					        </li>
					        <li><a href="/esgi/Breakem-all/team">Team 
					        		<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="'. WEBPATH . '/web/img/icon/icon-down.png">';?>
					        	</a>
					        </li>
					        <li>
					        	<a href="">Joueur
					        		<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="'. WEBPATH . '/web/img/icon/icon-down.png">';?>
					        	</a>
					        </li>
					        <li>
					        	<a href="/esgi/Breakem-all/resultat">Classement
					        		<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="'. WEBPATH . '/web/img/icon/icon-down.png">';?>
					        	</a>
					        </li>
					        <li class="hover-none">
					        	<a href="">
					        		<?php echo '<img class="icon icon-size-3 navbar-icon" src="'. WEBPATH . '/web/img/icon/icon-profil.png">';?>
					        	</a>
					        </li>
					       <li class="hover-none">
					        	<button type="button" class="search-toggle" style="padding:0 35px;">
            						<?php echo '<img src="'. WEBPATH . '/web/img/icon/icon-search.png">';?>
       				 			</button>
					        </li>
				        </ul>
			       	</div>
			       <!-- FIN NAVBAR SIDE -->

			      </div>
			    </div>
			  </nav>
		</header>

		<div class="search-page hidden-fade hidden">
		<div class="container m-a">
			<div class="grid-md-12">
				<h2>Recherchez n'importe quoi puis appuyez sur entrer.</h2>
				<form method="post" class="">
	                    <!-- Input Search -->
	                    <div class="grid-md-12">
	                        <input class="" type="text" name="searchzone" placeholder="Recherchez" autocomplete="off">
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