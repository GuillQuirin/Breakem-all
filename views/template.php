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

			<?php echo '<link rel="stylesheet/less" href="' . WEBPATH . '/web/css/template.less" media="screen">';?>

			<?php echo '<link rel="stylesheet/less" href="' . WEBPATH . '/web/css/general-stylesheet.less">';?>

			<?php echo '<link rel="stylesheet/less" href="' . WEBPATH . '/web/css/module/main.less">';?>
			
			<?php echo (isset($css)) ? '<link rel="stylesheet/less" href="'.WEBPATH.'/web/css/'.$css.'-stylesheet.less">' : '';?>

	</head>

	<body>

		<header>
						<!-- Navbar top -->
			<nav class="navbar full fixed transparent" id="navbar">
			<div class="test">
			</div>
				<div class="container resultat-container m-a">

					<!-- MENU -->
					<div class="grid-md-8 hidden-xs hidden-sm navbar-menu">
						<ul class="navbar-menu-ul">
							<li class="navbar-menu-li">
								<a href="<?php echo WEBPATH ?>" class="navbar-logo"><?php echo '<img src="' . WEBPATH . '/web/img/logo-nb-title.png">';?></a>
							</li>
							<li class="navbar-menu-li navbar-menu-tournoi">
								<a href="<?php echo WEBPATH ?>/tournoi">Tournoi<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="' . WEBPATH . '/web/img/icon/icon-down.png">';?></a>
								<ul class="navbar-menu-tooltip animation fadeUpLow" id="navbar-menu-tooltip-tournoi">
									<li class="navbar-menu-tooltip-li">
										<a href="<?php echo WEBPATH ?>/creationtournoi">
											Créer 
										</a>
									</li>
									<li class="navbar-menu-tooltip-li">
										<a>
											En cours
										</a>
									</li>
									<li class="navbar-menu-tooltip-li">
										<a>
											Liste
										</a>
									</li>																	
								</ul>
							</li>
							<li class="navbar-menu-li navbar-menu-joueur">
								<a href="">Joueur<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="' . WEBPATH . '/web/img/icon/icon-down.png">';?></a>
								<ul class="navbar-menu-tooltip animation fadeUpLow" id="navbar-menu-tooltip-joueur">
									<li class="navbar-menu-tooltip-li">
										<a>
											Créer 
										</a>
									</li>
									<li class="navbar-menu-tooltip-li">
										<a>
											Liste
										</a>
									</li>																							
								</ul>
							</li>							
							<li class="navbar-menu-li navbar-menu-team">
								<a href="<?php echo WEBPATH ?>/team">Team<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="' . WEBPATH . '/web/img/icon/icon-down.png">';?></a>
								<ul class="navbar-menu-tooltip animation fadeUpLow" id="navbar-menu-tooltip-team">
									<li class="navbar-menu-tooltip-li">
										<a>
											Créer 
										</a>
									</li>
									<li class="navbar-menu-tooltip-li">
										<a>
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

		<!-- LESS COMPILATOR -->
		<?php echo '<script src="' . WEBPATH . '/web/js/less.min.js" type="text/javascript"></script>';?>
	</body>
</html>
