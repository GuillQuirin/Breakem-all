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
								<a href="<?php echo WEBPATH ?>/tournoi">Tournoi<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="' . WEBPATH . '/web/img/icon/icon-down.png">';?></a>
							</li>
							<li class="navbar-menu-li">
								<a href="<?php echo WEBPATH ?>/creationtournoi">Creer<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="' . WEBPATH . '/web/img/icon/icon-down.png">';?></a>
							</li>
							<li class="navbar-menu-li">
								<a href="<?php echo WEBPATH ?>/team">Team<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="' . WEBPATH . '/web/img/icon/icon-down.png">';?></a>
							</li>
							<li class="navbar-menu-li">
								<a href="">Joueur<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="' . WEBPATH . '/web/img/icon/icon-down.png">';?></a>
							</li>
							<li class="navbar-menu-li">
								<a href="<?php echo WEBPATH ?>/resultat">Classement<?php echo '<img class="icon icon-size-1-demi navbar-icon" src="' . WEBPATH . '/web/img/icon/icon-down.png">';?></a>
							</li>		   				     
						</ul>
					</div>
					<div class="grid-md-4 hidden-xs hidden-sm navbar-menu">
						<ul class="navbar-menu-ul">
							<li class="hidden" style="width:220px;">
							   <button id="deconnection-btn" type="button" class="btn btn-pink"><a>Deconnexion</a></button>
							</li>
							<li class="navbar-menu-li">
								<a href="" class="">
								<?php echo '<img class="navbar-profil-img img-circle" src="' . WEBPATH . '/web/img/avatar3.jpg"><div class="navbar-connected-online"></div>';?>
								</a>
							</li>
							<li class="navbar-menu-li">
								<a class="navbar-profil-title" href="<?php echo WEBPATH ?>/account">Brucew<span>105 PTS</span></a>
							</li>
							<li class="navbar-menu-li">
								<a href="" class="">
								<?php echo '<img class="icon icon-size-3 navbar-icon" src="' . WEBPATH . '/web/img/icon/icon-settings.png">';?>
								</a>
								<ul class="navbar-menu-tooltip">
									<li class="navbar-menu-tooltip-li">
										<a>
											Mon compte
										</a>
									</li>
									<li class="navbar-menu-tooltip-li">
										<a>
											Ma team
										</a>
									</li>
									<li class="navbar-menu-tooltip-li">
										<a>
											Mes points
										</a>
									</li>
									<li class="navbar-menu-tooltip-li">
										<a>
											Mes points
										</a>
									</li>
									<li class="navbar-menu-tooltip-li">
										<a>
											Deconnexion
										</a>
									</li>
								</ul>
							</li>
							<li class="navbar-menu-li">
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