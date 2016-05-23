<?php

if(isset($err)){
	?>
	<section id="absfiche">
		<div>
			ERREUR 404, utilisateur introuvable
			<p><a href="index">Retour à l'accueil</a></p>
		</div>
	</section>
	<?php
}
else{
	?>

	<section class="middle-height bg-cover-configuration relative">

	<div class="align full-height">
		<div class="configuration-header-profil-wrapper">
			<div class="configuration-header-profil-left">
				<img class="configuration-header-profil-image" src="<?php echo $img; ?>" title="Image de profil" alt="Image de profil">

				<div class="configuration-header-profil-right align">
					<div class="">
						<span class="configuration-header-profil-name"><?php echo (isset($pseudo)) ? $pseudo : 'Sans pseudo'; ?></span>
						<span class="configuration-header-profil-description"><?php echo (isset($description)) ? '"' . $description . '"' : 'Sans description.'; ?></span>
						<span class="configuration-header-profil-lastconnexion"><?php echo (isset($isConnected)) ? "Connecté" : date('\l\e d/m \à H:i', $lastConnexion); ?></span>
					</div>
				</div>
			</div>			
		</div>
	</div>
	 
	<img class="icon icon-size-3 down-center header-scroll-down" id="classement-header-scroll-down" src="web/img/icon/icon-scrollDown.png"> 

	</section>

		<section class="configuration-content-wrapper my-content-wrapper">

		<div class="container m-a content-border classement-container" style="border:none;">

			<div class="row classement-content-row">
				<div class="grid-md-8">	

					<!-- Navbar hori -->
					<div class="menu_hori">
						<ul class="profil-menu-hori-ul">
							<nav class="nav_hori">
								<ul>
									<!-- Liste des types de game -->
									<?php //echo $typeJeux; ?>
								 	<li class="border_menu active_menu menu_separ"><a href="#">Equipe</a></li>
									<li class="border_menu menu_separ"><a href="#">Solo</a></li>
									<li class="border_menu menu_separ"><a href="#">5vs5</a></li>
									<li class="border_menu menu_separ"><a href="#">2vs2</a></li>
									<li class="border_menu menu_separ"><a href="#">Plus...</a></li>
								</ul>
							</nav>
							
						</ul>
					</div>
					<!-- Fin navbar hori -->


					<!-- Dernier match -->
					<div class="profil-wrapper profil-match-wrapper">
						<div class="profil-title profil-match-title">	
							<span>Dernier Matchs</span>
						</div>
						<div class="profil-match-wrapper-this">
							<div class="profil-element profil-match-element align">	
								<div class="profil-match-element-left">
									<?php echo '<img src="' . WEBPATH . '/web/img/navi.jpg">';?>
									<span class="profil-match-element-title-this winner-color">Navi</span>
								</div>
								<div class="profil-match-element-center">
									<span>VS</span>
								</div>
								<div class="profil-match-element-right">
									<?php echo '<img src="' . WEBPATH . '/web/img/fnatic.jpg">';?>
									<span class="profil-match-element-title-this looser-color">Fnatic</span>
								</div>
							</div>		
							<div class="profil-watch">
								<button type="button" class="btn btn-pink"><a>Regarder</a></button>
							</div>				
						</div>
						
					<!-- Fin Dernier match -->

					<!-- Dernier tournoi -->
					<div class="profil-wrapper profil-tournament-wrapper">
						<div class="profil-title profil-tournament-title">	
							<span>Dernier Tournois joués</span>
						</div>
						<div class="text-center align">
							<div class="profil-element profil-tournament-element">	
								<?php echo '<img class="img-cover" src="' . WEBPATH . '/web/img/heroes-of.jpg">';?>
								<span class="profil-match-element-title-this">Heroes of the Storm</span>
							</div>
							<div class="profil-element profil-tournament-element">	
								<?php echo '<img class="img-cover" src="' . WEBPATH . '/web/img/rocket.jpeg">';?>
								<span class="profil-match-element-title-this">Rocket League</span>
							</div>
							<div class="profil-element profil-tournament-element">	
								<?php echo '<img class="img-cover" src="' . WEBPATH . '/web/img/ssb-bg.jpg">';?>
								<span class="profil-match-element-title-this">Super Smash Bros</span>
							</div>
						</div>
					</div>
					<!-- Fin Dernier tournoi -->

					<!-- Jeux favoris -->
					<div class="profil-wrapper profil-tournament-wrapper">
						<div class="profil-title profil-tournament-title">	
							<span>Mes Jeux favoris</span>
						</div>
						<div class="text-center align">
							<div class="profil-element profil-tournament-element">	
								<?php echo '<img class="img-cover" src="' . WEBPATH . '/web/img/heroes-of.jpg">';?>
								<span class="profil-match-element-title-this">Heroes of the Storm</span>
							</div>
							<div class="profil-element profil-tournament-element">	
								<?php echo '<img class="img-cover" src="' . WEBPATH . '/web/img/lol-bg.jpg">';?>
								<span class="profil-match-element-title-this">League of Legends</span>
							</div>
							<div class="profil-element profil-tournament-element">	
								<?php echo '<img class="img-cover" src="' . WEBPATH . '/web/img/mk.jpg">';?>
								<span class="profil-match-element-title-this">Mario Kart</span>
							</div>
						</div>
					</div>
					<!-- Fin Jeux favoris -->

				</div>							
			</div>				
			<div class="grid-md-4">
				<div id="contain_right">

			<div id="contain_search">
				<label for="search">Rechercher :</label>
			    <input class="input-default" type="text" name="search" placeholder="Tournois, teams, joueurs">
			</div>

			<div class="title_index">
				<label for="title1">Prochain match</label>
			</div>
			<div class="fight">

				<!-- Match à venir -->
				<?php //echo $fight; ?>
				<h3>ESL</h3>
				<p class="date_fight">1er Avril 2016, 17h00</p>
				<?php echo '<img src="' . WEBPATH . '/web/img/navi.jpg">';?>
				<?php echo '<img src="' . WEBPATH . '/web/img/fnatic.jpg">';?>
				<div class="name_fight">
					<ul>
						<li>Navi</li>
						<li>Fnatic</li>
					</ul>
				</div>
			</div>
			<div class="tab">
				<ul>
					<nav class="tab_hori">
						<ul>
							<!-- Liste des jeux -->
							<?php //echo $Jeux; ?>
							<li class=" active_tab"><a href="#">Tous</a></li>
							<li class=""><a href="#">HOT</a></li>
							<li class=""><a href="#">DOTA2</a></li>
							<li class=""><a href="#">LoL</a></li>
						</ul>
					</nav>
				</ul>
			</div>

			<!-- Liste des matchs -->
			<div id="match">
				<?php //echo $listematchs; ?>
				<div id="match1" class="margin_match">
					<div class="statut">En cours</div>
					<?php echo '<img src="' . WEBPATH . '/web/img/navi.jpg">';?>
					<div class="versus">VS</div>
					<?php echo '<img name="img2" src="' . WEBPATH . '/web/img/fnatic.jpg">';?>
					<p class="date_match">20 Janvier 2016, 20h00</p>
					<hr>
				</div>
				<div id="match2" class="margin_match">
					<div class="statut">A venir</div>
					<?php echo '<img src="' . WEBPATH . '/web/img/fnatic.jpg">';?>
					<div class="versus">VS</div>
					<?php echo '<img name="img2" src="' . WEBPATH . '/web/img/secret.jpg">';?>
					<p class="date_match">20 Janvier 2016, 20h00</p>
					<hr>
				</div>
				<div id="match3" class="margin_match">
					<div class="statut">30 : 90</div>
					<?php echo '<img src="' . WEBPATH . '/web/img/ehome.jpg">';?>
					<div class="versus">VS</div>
					<?php echo '<img name="img2" src="' . WEBPATH . '/web/img/secret.jpg">';?>
					<p class="date_match">20 Janvier 2016, 20h00</p>
					<hr>
				</div>
				<div id="match4" class="margin_match">
					<div class="statut">60 : 90</div>
					<?php echo '<img src="' . WEBPATH . '/web/img/navi.jpg">';?>
					<div class="versus">VS</div>
					<?php echo '<img name="img2" src="' . WEBPATH . '/web/img/virtus.jpg">';?>
					<p class="date_match">20 Janvier 2016, 20h00</p>
					<hr>
				</div>
				<div id="match5" class="margin_match">
					<div class="statut">120 : 10</div>
					<?php echo '<img src="' . WEBPATH . '/web/img/virtus.jpg">';?>
					<div class="versus">VS</div>
					<?php echo '<img name="img2" src="' . WEBPATH . '/web/img/secret.jpg">';?>
					<p class="date_match">20 Janvier 2016, 20h00</p>
					<hr>
				</div>
			</div>
			
			<!-- Classement des 3 premiers jeux -->
			<div id="game">
				<div class="title_index">
					<label for="title2">Jeux les plus utlisés</label>
				</div>
				<?php 
					if(isset($bestGames)):
						foreach ($bestGames as $key => $value):
				?>			
							<div class='game'><img src="echo .WEBPATH. '/web/img/band.jpg'">
								<p><?php echo $value['name']; ?></p>
							</div>
				<?php
						endforeach;
					endif;
				?>
			</div>

			<!-- Liste des catégories  -->
			<div id="categorie">
				<div class="title_index">
					<label for="title3">Catégories</label>
				</div>
				<?php
					// if(isset($categorie)): 
					// 	foreach ($categorie as $key => $value):
					// 		$catego = new typegame($value);
				?>
							<div class='categorie'>
								<p><?php // echo $catego->getName(); ?></p><br>
							</div>
				<?php 
					// 	endforeach;
					// endif;
				?>
			</div>
		</div>
	</div>
			</div>
		</div>

	</section>

<!-- CODE BACK GUILLAUME -->

	<!--<section id="presentation">
		<div id="image">
			<img src="<?php echo $img; ?>" alt="logo">
			<p><?php echo $pseudo; ?></p>
			<?php 
				if(isset($isConnected))
					echo '<p class="on">Connecté</p>'; 
				else
					echo '<p class="off">Dernière connexion: '.date('d/m/Y \à\ G:i',$lastConnexion).'</p>';
			?>
		</div>
	</section>
	<section id="informations">
		<div id="communication">
		<?php 
			//N'apparaissent que si le visiteur est connecté et n'est pas sur sa propre page
			if(isset($_isConnected) && !isset($myAccount)){
				if(isset($authorize_mail_contact) && $authorize_mail_contact==1)
					echo '<button id="contact" title="Envoyer un mail au joueur">Contacter</button>';

				if(isset($already_signaled) && $already_signaled==1)
					echo '<p id="signalementnope">Vous avez déjà signalé ce joueur</p>';
				else 
					echo '<button id="signalement">Signaler le joueur</button>';
			}
			else if(isset($myAccount))
				echo '<a href="configuration" id="configuration">Configurer mon compte</a>';
		?>
		</div>
		<div id="description">
			<h4>Description</h4>
			<p>
				<?php 
					echo (isset($description)) ? $description : "Ce joueur n'a pas encore rédigé de description.";
				?>
			</p>
		</div>
		<div id="statistiques">
			<h4>Statistiques</h4>
			<ul>
				<li>Matchs gagnés: 78
				<li>Matchs perdus: 92
				<li>Ratio : 0.78
				<li>Points : 1072
			</ul>
		</div>
	</section>
	<section id="tableaux">
		<div>
			<h4>Derniers tournois joués</h4>
			<ul>
				<li>
					<a href="#">Nom Tournoi</a>
					<span>Jeux</span>  
					<span>Position</span>  
				<li>
					<a href="#">Nom Tournoi</a>
					<span>Jeux</span>  
					<span>Position</span>
				<li>
					<a href="#">Nom Tournoi</a>
					<span>Jeux</span>  
					<span>Position</span>
			</ul>
		</div>
		<div>
			<h4>Jeux favoris</h4>
			<a href="#"><img src="web/img/css-bg.png" alt="" title=""></a>  
			<a href="#"><img src="web/img/css-bg.png" alt="" title=""></a>
			<a href="#"><img src="web/img/css-bg.png" alt="" title=""></a>
		</div>
		<div>
			<h4>Derniers matchs</h4>
			<ul>
				<li>
					<a href="#">Adversaire</a>
					<span>Jeux</span>  
					<span class="win">Victoire</span>  
				<li>
					<a href="#">Adversaire</a>
					<span>Jeux</span>  
					<span class="loo">Defaite</span>
				<li>
					<a href="#">Adversaire</a>
					<span>Jeux</span>  
					<span class="win">Victoire</span>
			</ul>
		</div>
	</section>
	<section id="formplainte">
		<div>
			<form action="profil/report" method="post">
				<h4>Signaler un joueur</h4>
				<ul>
					<li>Vous trouvez que ce joueur ne respecte pas les <a href="#">Conditions Générales d'Utilisation</a> ?
					<li>Vous pouvez avertir les administrateurs qui se chargeront d'étudier votre signalement.
					<li>Selectionnez la raison de votre signalement:
						<input type="text" name="subject" required>
				</ul>
				<p>
					Veuillez justifier votre plainte (obligatoire):
				</p>
				<textarea id="mess_plainte" name="description" required></textarea>
				<input type="submit" id="btn_plainte" value="Envoyer">
			</form>
		</div>
	</section>
	<section id="formcontact">
		<div>
			<form action="profil/contact" method="post">
				<h4>Contacter le joueur</h4>
				<p>Si vous souhaiter communiquer avec ce joueur, Breakemall.com se chargera de transmettre votre message ci-dessous</p>
				<textarea id="mess_contact" name="msg" placeholder="Merci de ne pas mettre de message offensant ou ne respectant pas les conditions d'utilisation du site">
				</textarea>
				<input type="submit" id="btn_contact" value="Envoyer">
			</form>
		</div>
	</section>
	<?php
}
?>-->