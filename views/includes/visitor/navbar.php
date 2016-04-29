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
							<li class="navbar-menu-li" style="width:80px;">
								<button id="navbar-inscription" type="button" class="btn btn-pink"><a>Subscribe</a></button>
							</li>
							<li class="navbar-menu-li" style="width:80px;margin-left:35px;">
								<button id="navbar-login" type="button" class="btn btn-pink"><a>Login</a></button>
							<!-- <form id="connection-form">
								<input type="email" name="email" placeholder="email">
								<input type="password" name="password" placeholder="mot de passe">
								<input type="submit">
							</form> -->
							</li>							
							<li class="navbar-menu-li">
								<button type="button" class="search-toggle" style="width:80px;margin-left:20px;">
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
								   
								    <button type="button" class="btn btn-pink index-form-submit"><a>S'inscrire et jouer</a></button>
						  		</form>
						  	</div>
						  	<!-- Fin SF -->
							
						</div>
					</div>
