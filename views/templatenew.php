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
		<link rel="stylesheet" href="web/css/general-stylesheet.css">
		<link rel="stylesheet" href="web/css/module/grid.css">
		<link rel="stylesheet" href="web/css/module/size.css">
		<link rel="stylesheet" href="web/css/module/text.css">
		<link rel="stylesheet" href="web/css/module/display.css">
		<link rel="stylesheet" href="web/css/module/search.css">
		<link rel="stylesheet" href="web/css/module/button.css">
		<link rel="stylesheet" href="web/css/module/image.css">

		<?php echo (isset($css)) ? '<link rel="stylesheet" href="web/css/'.$css.'-stylesheet.css">' : '';?>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<?php echo (isset($js)) ? '<script src="web/js/'.$js.'.js"></script>' : '';?>
		<script src="web/js/navbar.js"></script>
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
					        	<a href="#" class="navbar-logo">
				      				<img src="web/img/logo-nb-title.png">
				      			</a>
			      			</li>
					        <li>
					        	<a href="/esgi/Breakem-all/index" class="active">Accueil 
					        		<img class="icon icon-size-1-demi navbar-icon" src="web/img/icon/icon-down.png">
					        	</a>
					        </li>
					        <li>
					        	<a href="/esgi/Breakem-all/tournoi">Tournoi 
					        		<img class="icon icon-size-1-demi navbar-icon" src="web/img/icon/icon-down.png">
					        	</a>
					        </li>
					        <li><a href="/esgi/Breakem-all/team">Team 
					        		<img class="icon icon-size-1-demi navbar-icon" src="web/img/icon/icon-down.png">					        		
					        	</a>
					        </li>	
					        <li>
					        	<a href="">Joueur 
					        		<img class="icon icon-size-1-demi navbar-icon" src="web/img/icon/icon-down.png">					 
					        	</a>
					        </li>
					        <li>
					        	<a href="/esgi/Breakem-all/resultat">Classement 
					        		<img class="icon icon-size-1-demi navbar-icon" src="web/img/icon/icon-down.png">					        		
					        	</a>
					        </li>					   				     
				        </ul>
			       </div>
			       <div class="grid-md-4 hidden-xs hidden-sm navbar-menu">
			      		<ul>
			      			<li class="hover-none" style="width:80px;">
			      				<button type="button" class="btn btn-blue"><a>Subscribe</a></button>
			      			</li>
			      			<li class="hover-none" style="width:205px;">
			      				<button type="button" class="btn btn-blue"><a>Login</a></button>
			      			</li>
			      			<li class="hover-none hidden">
					        	<a href="">
					        		<img class="icon icon-size-3 navbar-icon" src="web/img/icon/icon-profil.png">
					        	</a>
					        </li>
					        <li class="hover-none">
					        	<button type="button" class="search-toggle">
            						<img src="web/img/icon/icon-search.png">
       				 			</button>
					        </li>
		      			</ul>
	      			</div>
			       <!-- FIN MENU -->

			       <!-- MENU TOGGLE -->
			       <div class="grid-md-12 hidden-md hidden-lg navbar-menu">
			       	<img src="web/img/logo-nb-title.png" id="navbar-toggle-logo">
			       	<img src="web/img/icon/icon-menu.png" id="navbar-toggle">
			       </div>
			       <!-- FIN MENU TOGGLE -->

			       <!-- NAVBAR SIDE -->
			       	<div class="navbar-side-menu hidden-md hidden-lg navbar-collapse">
				       	<ul>
					        <li>
					        	<a href="/esgi/Breakem-all/index" class="active">Accueil 
					        		<img class="icon icon-size-1-demi navbar-icon" src="web/img/icon/icon-down.png">					    
					        	</a>
					        </li>
					        <li>
					        	<a href="/esgi/Breakem-all/tournoi">Tournoi 
					        		<img class="icon icon-size-1-demi navbar-icon" src="web/img/icon/icon-down.png">
					        	</a>
					        </li>
					        <li><a href="/esgi/Breakem-all/team">Team 
					        		<img class="icon icon-size-1-demi navbar-icon" src="web/img/icon/icon-down.png">
					        	</a>
					        </li>
					        <li>
					        	<a href="">Joueur 
					        		<img class="icon icon-size-1-demi navbar-icon" src="web/img/icon/icon-down.png">
					        	</a>
					        </li>
					        <li>
					        	<a href="/esgi/Breakem-all/resultat">Classement 
					        		<img class="icon icon-size-1-demi navbar-icon" src="web/img/icon/icon-down.png">
					        	</a>
					        </li>
					        <li class="hover-none">
					        	<a href="">
					        		<img class="icon icon-size-3 navbar-icon" src="web/img/icon/icon-profil.png">
					        	</a>
					        </li>
					       <li class="hover-none">
					        	<button type="button" class="search-toggle" style="padding:0 35px;">
            						<img src="web/img/icon/icon-search.png">
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
	            <img class="search-close" src="web/img/icon/icon-close.png">
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