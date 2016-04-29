			<!-- Navbar top -->
			<nav class="navbar full fixed transparent" id="navbar">
				<div class="container resultat-container m-a">

					<!-- MENU -->
					<div class="grid-md-8 hidden-xs hidden-sm navbar-menu">
						<ul class="navbar-menu-ul">
							<li class="navbar-menu-li">
								<a href="<?php echo WEBPATH ?>" class="navbar-logo"><?php echo '<img src="' . WEBPATH . '/web/img/logo-nb-title.png">';?></a>
							</li>
							<li class="navbar-menu-li">
								<a href="<?php echo WEBPATH ?>/tournoi">Utilisateur<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="' . WEBPATH . '/web/img/icon/icon-down.png">';?></a>
							</li>
							<li class="navbar-menu-li">
								<a href="<?php echo WEBPATH ?>/creationtournoi">Jeux<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="' . WEBPATH . '/web/img/icon/icon-down.png">';?></a>
							</li>
							<li class="navbar-menu-li">
								<a href="<?php echo WEBPATH ?>/team">Tournois<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="' . WEBPATH . '/web/img/icon/icon-down.png">';?></a>
							</li>
							<li class="navbar-menu-li">
								<a href="">Teams<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="' . WEBPATH . '/web/img/icon/icon-down.png">';?></a>
							</li>
							<li class="navbar-menu-li">
								<a href="<?php echo WEBPATH ?>/resultat">Commentaire<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="' . WEBPATH . '/web/img/icon/icon-down.png">';?></a>
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
								<a href="<?php echo WEBPATH ?>" class="active">Accueil
									<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="'. WEBPATH . '/web/img/icon/icon-down.png">';?>
								</a>
							</li>
							<li>
								<a href="<?php echo WEBPATH ?>/tournoi">Tournoi
									<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="'. WEBPATH . '/web/img/icon/icon-down.png">';?>
								</a>
							</li>
							<li>
								<a href="<?php echo WEBPATH ?>/creationtournoi">Creer<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="' . WEBPATH . '/web/img/icon/icon-down.png">';?></a>
							</li>
							<li>
								<a href="<?php echo WEBPATH ?>/team">Team 
									<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="'. WEBPATH . '/web/img/icon/icon-down.png">';?>
								</a>
							</li>
							<li>
								<a href="">Joueur
									<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="'. WEBPATH . '/web/img/icon/icon-down.png">';?>
								</a>
							</li>
							<li>
								<a href="<?php echo WEBPATH ?>/resultat">Classement
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
			</nav>