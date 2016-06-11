	<!DOCTYPE html>
<html lang="fr">
	<head>		

		<meta charset="UTF-8">

		<!-- Facebook Meta share -->
		<!-- <meta property="og:url"           content="http://localhost/esgi/Breakthem-all/" />
		<meta property="og:type"               content="article" />
		<meta property="og:title"              content="BreakEm All!" />
		<meta property="og:description"        content="Organise ton propre tournoi!" />
		<meta property="og:image"              content="http://image.noelshack.com/fichiers/2016/19/1462894934-logo-full.png" />-->
		<!-- Fin Facebook Meta share -->

		<!-- Security -->

		<!-- J'en rajouterais plutard -->
		<!-- <meta http-equiv="Content-Security-Policy" content="default-src 'self'"> -->
		<!-- Fin Security -->

		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="robots" content="index,follow" />
			<title>Break'em All<?php echo (isset($title)) ? ' - '.$title : '';?></title>
			<?php echo '<link rel="shortcut icon" href="' . WEBPATH . '/web/img/icon/logo-full.ico" type="image/x-icon">';?>
			<meta name="description" content=<?php echo (isset($content)) ? '"'.$content.'"' : 'tournois de jeux vidéos';?>>
			<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

				<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/template.css" media="screen">';?>

			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/general-stylesheet.css">';?>

			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/animation.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/background.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/body.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/border.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/button.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/caption.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/checkbox.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/cursor.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/display.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/failed-input.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/float.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/fonts.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/grid.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/header.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/hr.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/icon.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/image.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/input-radio.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/input.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/loading.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/margin.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/menu.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/navbar.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/overflow.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/padding.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/position.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/search.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/shadow.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/select.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/size.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/text.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/header.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/transform.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/width.css">';?>

			
			<?php echo (isset($css)) ? '<link rel="stylesheet" href="'.WEBPATH.'/web/css/'.$css.'-stylesheet.css">' : '';?>

	</head>

	<body>

		<header>
						<!-- Navbar top -->
			<nav class="navbar full fixed transparent" id="navbar">
				<div class="container resultat-container m-a">

					<!-- MENU -->
					<div class="grid-md-8 hidden-xs hidden-sm navbar-menu">
						<ul class="navbar-menu-ul">
							<li class="navbar-menu-li">
								<a href="<?php echo WEBPATH.'/index'; ?>" class="navbar-logo"><?php echo '<img src="' . WEBPATH . '/web/img/logo-nb-title.png">';?></a>
							</li>
							<li class="navbar-menu-li navbar-menu-tournoi">
								<a href="<?php echo WEBPATH; ?>/tournoi">Tournoi<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="' . WEBPATH . '/web/img/icon/icon-down.png">';?></a>
								<ul class="navbar-menu-tooltip animation fadeUpLow" id="navbar-menu-tooltip-tournoi">
									<li class="navbar-menu-tooltip-li">
										<a href="<?php echo WEBPATH; ?>/creationtournoi">
											Créer 
										</a>
									</li>
									<li class="navbar-menu-tooltip-li">
										<a>
											En cours
										</a>
									</li>
									<li class="navbar-menu-tooltip-li">
										<a href="<?php echo WEBPATH; ?>/listetournois">
											Liste
										</a>
									</li>																	
								</ul>
							</li>
							<li class="navbar-menu-li navbar-menu-joueur">
								<a href="<?php echo WEBPATH; ?>/listejoueurs">Joueurs</a>
							</li>							
							<li class="navbar-menu-li navbar-menu-team">
								<a href="<?php echo WEBPATH ?>/team">Team<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="' . WEBPATH . '/web/img/icon/icon-down.png">';?></a>
								<ul class="navbar-menu-tooltip animation fadeUpLow" id="navbar-menu-tooltip-team">
									<?php 
										if(isset($_isConnected)){
											echo '<li class="navbar-menu-tooltip-li">';

											if(!empty($_idTeam))
												echo "<a href='".WEBPATH."/detailteam?name=".$_nameTeam."'>Ma team</a>";
											
											else
												echo "<a href=''>Créer ma team</a>";
											
											echo "</li>";
										}
									?>
									<li class="navbar-menu-tooltip-li">
										<a href="<?php echo WEBPATH; ?>/listeteams">
											Liste
										</a>
									</li>																							
								</ul>
							</li>							
							<li class="navbar-menu-li navbar-menu-classement">
								<a href="<?php echo WEBPATH ?>/classement">Classement<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="' . WEBPATH . '/web/img/icon/icon-down.png">';?></a>
								<ul class="navbar-menu-tooltip animation fadeUpLow" id="navbar-menu-tooltip-classement">
									<li class="navbar-menu-tooltip-li">
										<a>
											Meilleur joueur 
										</a>
									</li>
									<li class="navbar-menu-tooltip-li">
										<a>
											Meilleur team
										</a>
									</li>
									<li class="navbar-menu-tooltip-li">
										<a>
											Classement total
										</a>
									</li>																								
								</ul>
							</li>								   			   				    
						</ul>
					</div>
					
					<?php (isset($_isConnected)) ? include("views/includes/connected/navbar.php") : include("views/includes/visitor/navbar.php");?>

					<!-- FIN MENU -->

					<!-- MENU TOGGLE -->
					<div class="grid-md-12 hidden-md hidden-lg navbar-menu">
						<?php echo '<img id="navbar-toggle-logo" src="'. WEBPATH . '/web/img/logo-nb-title.png">';?>
						<?php echo '<img id="navbar-toggle" src="'. WEBPATH . '/web/img/icon/icon-menu.png">';?>
					</div>
					<!-- FIN MENU TOGGLE -->

					<!-- NAVBAR SIDE -->
					<div class="navbar-side-menu hidden-md hidden-lg navbar-collapse">
						<ul class="navbar-menu-ul">
							<li class="navbar-menu-li">
								<a href="<?php echo WEBPATH ?>" class="active">Accueil
									<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="'. WEBPATH . '/web/img/icon/icon-down.png">';?>
								</a>
							</li>
							<li class="navbar-menu-li">
								<a href="<?php echo WEBPATH ?>/tournoi">Tournoi
									<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="'. WEBPATH . '/web/img/icon/icon-down.png">';?>
								</a>
							</li>
							<li class="navbar-menu-li">
								<a href="<?php echo WEBPATH ?>/creationtournoi">Creer<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="' . WEBPATH . '/web/img/icon/icon-down.png">';?></a>
							</li>
							<li class="navbar-menu-li">
								<a href="<?php echo WEBPATH ?>/team">Team 
									<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="'. WEBPATH . '/web/img/icon/icon-down.png">';?>
								</a>
							</li>
							<li class="navbar-menu-li">
								<a href="">Joueur
									<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="'. WEBPATH . '/web/img/icon/icon-down.png">';?>
								</a>
							</li>
							<li class="navbar-menu-li">
								<a href="<?php echo WEBPATH ?>/resultat">Classement
								<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="'. WEBPATH . '/web/img/icon/icon-down.png">';?>
								</a>
							</li>
							<li class="navbar-menu-li">
								<a href="">
								<?php echo '<img class="icon icon-size-3 navbar-icon" src="'. WEBPATH . '/web/img/icon/icon-profil.png">';?>
								</a>
							</li>
							<li class="navbar-menu-li">
								<button type="button" class="search-toggle" style="padding:0 35px;">
								<?php echo '<img src="'. WEBPATH . '/web/img/icon/icon-search.png">';?>
								</button>
							</li>
						</ul>
					</div>
					<!-- FIN NAVBAR SIDE -->

				</div>
			</nav>	

			<?php (isset($_isConnected)) ? : include("views/includes/visitor/navbar-form.php");?>

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
		

		<?php if(isset($compteValide)): ?>
			<div id="index-creation-compte-terminee-divtodelete" data-compte="<?php echo $compteValide; ?>"></div>
		<?php endif; ?> 

		<div id="content">
			<?php include $this->view; ?>
		</div>

		<!-- Footer des pages -->
		<footer class="relative">
		<div class="footer">
		    <div class="footer_wrap">
		        <div class="footer_content">
		            <h3 class="footer_title">Break'em All</h3>
		            <ul>
		                <li><a href="<?php echo WEBPATH ?>" title="accueil">Accueil</a></li>
		                <li><a href="#" title="link 2">Tournoi</a></li>
		                <li><a href="#" title="link 3">Team</a></li>
		                <li><a href="#" title="link 4">Classement</a></li>
		            </ul>
		        </div>
		        <div class="footer_content">
		            <h3 class="footer_title">Tournoi - Team</h3>
		            <ul>
		                <li><a href="#" title="link 3">Créer un tournoi</a></li>
		                <li><a href="#" title="link 4">Créer une team</a></li>
		            </ul>
		        </div>
		        <div class="footer_content">
		            <h3 class="footer_title">Help</h3>
		            <ul>
		                <li><a href="#" title="link 1">Profil</a></li>
		                <li><a href="#" title="link 2">Nous contacter</a></li>
		                <li><a href="#" title="link 3">CGU</a></li>
		                <li><a href="#" title="link 4">About</a></li>
		            </ul>
		        </div>
		    </div>
		</div>

		<div class="copy">
		    <div class="copy_wrap">Copyright &copy; ESGI Break'em All. All right reserved. 2016 | <a href="#">Privacy</a></div>
		</div>
		</footer>


		<?php echo '<script src="'.WEBPATH.'/web/js/jquery-1.12.2.min.js"></script>';?>
		<?php 
			if(isset($js)){ 
				if(is_array($js)){
					foreach ($js as $key => $value)
						echo '<script src="'.WEBPATH.'/web/js/'.$value.'.js"></script>';
				}
				else 
					echo '<script src="'.WEBPATH.'/web/js/'.$js.'.js"></script>';
			}
		?>
		<?php echo '<script src="'.WEBPATH.'/web/js/navbar.js"></script>';?>
	</body>
</html>
