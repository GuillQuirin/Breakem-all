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
			<input type="hidden" name="webpath" id="webpath" value="<?php echo WEBPATH;?>">
			<!-- Navbar top -->
			<nav class="navbar full fixed transparent" id="navbar">
				<div class="container resultat-container m-a">

					<!-- MENU -->
					<div class="grid-md-9 hidden-xs hidden-sm navbar-menu">
						<ul class="navbar-menu-ul">
							<li class="navbar-menu-li">
								<a href="<?php echo WEBPATH.'/index'; ?>" class="navbar-logo"><?php echo '<img src="' . WEBPATH . '/web/img/logo-nb-title.png">';?></a>
							</li>
							<li class="navbar-menu-li navbar-menu-tournoi">
								<a class="cursor-default">Tournois<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="' . WEBPATH . '/web/img/icon/icon-down.png">';?></a>
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
										<a href="<?php echo WEBPATH; ?>/tournoi">
											Liste
										</a>
									</li>																	
								</ul>
							</li>
							<li class="navbar-menu-li navbar-menu-joueur">
								<a href="<?php echo WEBPATH; ?>/listejoueurs">Joueurs</a>
							</li>							
							<li class="navbar-menu-li navbar-menu-team">
								<a class="cursor-default">Teams<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="' . WEBPATH . '/web/img/icon/icon-down.png">';?></a>
								<ul class="navbar-menu-tooltip animation fadeUpLow" id="navbar-menu-tooltip-team">
									<?php 
										if(isset($_isConnected)){
											echo '<li class="navbar-menu-tooltip-li">';

											if(!empty($_idTeam))
												echo "<a href='".WEBPATH."/detailteam?name=".$_nameTeam."'>Ma team</a>";

											
											echo "</li>";
										}
									?>
									<li class="navbar-menu-tooltip-li">
										<a href="<?php echo WEBPATH; ?>/team">
											Liste des teams
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
								<a href="<?php echo WEBPATH.'/index'; ?>" class="active">Accueil</a>
							</li>
							<li class="navbar-menu-li">
								<a href="<?php echo WEBPATH; ?>/tournoi">Tournois
									<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="'. WEBPATH . '/web/img/icon/icon-down.png">';?>
								</a>
							</li>
							<li class="navbar-menu-li">
								<a href="<?php echo WEBPATH; ?>/creationtournoi">Creer mon tournoi</a>
							</li>
							<li class="navbar-menu-li">
								<a href="<?php echo WEBPATH ?>/team">Teams</a>
							</li>
							<li class="navbar-menu-li">
								<a href="<?php echo WEBPATH.'/listejoueurs'; ?>">Joueurs</a>
							</li>
							<li class="navbar-menu-li">
								<a href="<?php echo WEBPATH ?>/classement">Classement
								<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="'. WEBPATH . '/web/img/icon/icon-down.png">';?>
								</a>
							</li>
							<?php 
								if(isset($_isConnected)){
									?>
										<li class="navbar-menu-li">
											<a href="">
											<?php echo '<img class="icon icon-size-3 navbar-icon" src="'. WEBPATH . '/web/img/icon/icon-profil.png">';?>
											</a>
										</li>
									<?php 
								}
								else{
									?>

								<?php } ?>
							<li class="navbar-menu-li">
								<!--<button type="button" class="search-toggle" style="padding:0 35px;">
									<img src="<?php echo WEBPATH . '/web/img/icon/icon-search.png'; ?>">
								</button>-->
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

		<section id="wrapperAdmin">
			<div>
				<h4>Contacter les administrateurs du site.</h4>
				<p>Rappel: Pour signaler un joueur, vous devez le faire depuis sa fiche publique.</p>
				<p>Votre adresse email : <input type="email" name="expediteur" id="expediteurContactAdmin" placeholder="E-mail"></p>
				Contenu du message: <textarea id="mess_contactAdmin" name="msg" placeholder="Merci de ne pas mettre de message offensant ou ne respectant pas les conditions d'utilisation du site">
				</textarea>
				<p class="sendOk">Votre message a correctement été envoyé</p>
				<p class="sendError">Une erreur est survenue lors de l'envoi de votre message</p>
				<input type="submit" id="btn_contactAdmin" value="Envoyer">
			</div>
		</section>

		<!-- Footer des pages -->
		<footer class="relative">
		<div class="footer">
		    <div class="footer_wrap display-flex-column">
		        <div class="footer_content">
		            <h3 class="footer_title">Break'em All</h3>
		            <ul>
		                <li><a href="<?php echo WEBPATH.'/index' ; ?>" title="accueil">Accueil</a></li>
		                <li><a href="<?php echo WEBPATH.'/tournoi'; ?>" title="Liste des tournois">Tournois</a></li>
		                <li><a href="<?php echo WEBPATH.'/team'; ?>" title="Ensemble des teams">Teams</a></li>
		                <li><a href="<?php echo WEBPATH.'/classement'; ?>" title="Podium du site">Classement</a></li>
		            </ul>
		        </div>
		        <div class="footer_content">
		            <h3 class="footer_title">Nous rejoindre</h3>
		            <ul>
		        <?php 
				if(isset($_isConnected)){
					?>
	                <li><a href="<?php echo WEBPATH.'/creationtournoi'; ?>" title="Créer mon tournoi">Créer un tournoi</a></li>
					<li>
						<?php
						if(!empty($_idTeam))
							echo "<a href='".WEBPATH."/detailteam?name=".$_nameTeam."' title='Ma team'>Ma team</a>";
						else
							echo "<a href='".WEBPATH."/creationteam' title='Créer sa team'>Créerm</a>";
						?>
					</li>
			        <?php 
		        }
		        ?>
		                <li><a href="<?php echo WEBPATH.'/listejoueurs'; ?>" title="Nos joueurs">Les joueurs</a></li>
		            </ul>
		        </div>
		        <div class="footer_content">
		            <h3 class="footer_title">Help</h3>
		            <ul>
		                <?php 
		                if(isset($_isConnected))
		                	echo "<li><a href='".WEBPATH."/profil?pseudo=".$_pseudo."' title='Acceder à ma page'>Profil</a></li>";
		                ?>
		                <li><a class="cursor-pointer" id="contactAdmin" title="Joindre les admins">Nous contacter</a></li>
		                <li><a href="<?php echo WEBPATH.'/CGU'; ?>" title="Conditions d'utilisation">CGU</a></li>
		                <li><a href="<?php echo WEBPATH.'/RSS'; ?>" title="Flux RSS">RSS</a></li>
		            </ul>
		        </div>
		    </div>
		</div>

		<div class="copy">
			<div class="copy_wrap">Copyright &copy; ESGI Break'em All. All right reserved. 2016</div>
		</div>
		</footer>


		<!-- Barre de Cookie -->
		<?php 
		if(isset($popupCookie)){ ?>
			<div id='cookie_info' class="barre-cookie">
	    		En continuant à naviguer sur notre site, vous acceptez l'utilisation des cookies. <a href="https://www.google.com/intl/fr_fr/policies/technologies/types/">En savoir plus</a>
	    		<p id='cookieaccept' class="accepter">J'accepte</p>
			</div>
		<?php 
		} ?>

		<?php echo '<script src="'.WEBPATH.'/web/js/jquery-1.12.2.min.js"></script>';?>
		<?php echo '<script src="'.WEBPATH.'/web/js/navbar.js"></script>';?>
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
		
		
		
	</body>
</html>
