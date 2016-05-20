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
				<img class="configuration-header-profil-image" src="<?php echo $_img; ?>" title="Image de profil" alt="Image de profil">

				<div class="configuration-header-profil-right align">
					<div class="">
						<span class="configuration-header-profil-name"><?php echo (isset($_pseudo)) ? $_pseudo : 'Sans pseudo'; ?></span>
						<span class="configuration-header-profil-description"><?php echo (isset($_description)) ? '"' . $_description . '"' : 'Sans description.'; ?></span>
						<span class="configuration-header-profil-lastconnexion"><?php echo (isset($_lastConnexion)) ? $_lastConnexion : 'Dernière connexion inconnu'; ?></span>
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
						<div class="profil-element profil-match-element">	
							<div class="grid-md-5 profil-match-element-left">
								<?php echo '<img src="' . WEBPATH . '/web/img/navi.jpg">';?>
							</div>
							<div class="grid-md-2 profil-match-element-center">
							</div>
							<div class="grid-md-5 profil-match-element-right">
								<?php echo '<img src="' . WEBPATH . '/web/img/fnatic.jpg">';?>
							</div>
						</div>						
					</div>
					<!-- Fin Dernier match -->

					<!-- Dernier tournoi -->
					<div class="profil-wrapper profil-tournament-wrapper">
						<div class="profil-title profil-tournament-title">	
							<span>Dernier Tournois joués</span>
						</div>
						<div class="profil-element profil-tournament-element">	
							<span>Jeux</span>
						</div>
						<div class="profil-element profil-tournament-element">	
							<span>Jeux</span>
						</div>
						<div class="profil-element profil-tournament-element">	
							<span>Jeux</span>
						</div>
					</div>
					<!-- Fin Dernier tournoi -->

					<!-- Jeux favoris -->
					<div class="profil-wrapper profil-games-wrapper">
						<div class="profil-title profil-games-title">	
							<span>Jeux favoris</span>
						</div>
						<div class="profil-element profil-games-element">	
							<span>Jeux</span>
						</div>
						<div class="profil-element profil-games-element">	
							<span>Jeux</span>
						</div>
						<div class="profil-element profil-games-element">	
							<span>Jeux</span>
						</div>
					</div>
					<!-- Fin Jeux favoris -->

				</div>
				<div class="grid-md-4">
				
				</div>
			</div>				
		</div>

	</section>

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