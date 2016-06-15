<?php

if(isset($err)){
	?>
	<section class="middle-height bg-cover-configuration relative">
		<div class="align full-height">
			<div class="configuration-header-profil-wrapper">
				<div class="configuration-header-profil-left">
					<div class="unfound_user">
						<div class="">
							<span class="configuration-header-profil-name">Utilisateur introuvable</span>	
							<p><a href="index">Retour à l'accueil</a></p>
						</div>
					</div>
				</div>			
			</div>
		</div>
	</section>
	<?php
}
else if(isset($banni) && $banni==1){
	?>
	<section class="middle-height bg-cover-configuration relative">
		<div class="align full-height">
			<div class="configuration-header-profil-wrapper">
				<div class="configuration-header-profil-left">
					<div class="unfound_user">
						<p class="configuration-header-profil-name">	
							Cet utilisateur a été banni pour non respect de la charte de bonne conduite.
						</p>
						<p><a href="index">Retour à l'accueil</a></p>
					</div>
				</div>			
			</div>
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
						<span class="configuration-header-profil-lastconnexion"><?php echo (isset($isConnected)) ? "Connecté" : strftime('le %e %B à %H:%M', $lastConnexion); ?></span>
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
				<!-- Dernier tournoi -->
				<div class="profil-wrapper profil-tournament-wrapper">
					<div class="profil-title profil-tournament-title">	
						<span>Dernier Tournois joués</span>
					</div>
					<div class="text-center align">
					<?php 
						if(isset($listeTournoi) && is_array($listeTournoi)){
							foreach ($listeTournoi as $key => $value) {
								?>
								<div class="profil-element profil-tournament-element">	
									<?php 
										echo '<a href="'.WEBPATH.'/tournoi?t='.$value->getLink().'">';
										  echo '<img class="img-cover" src="' . WEBPATH . '/web/img/';
											echo $value->getImgJeu();
										  echo '">';
										echo '</a>';
									?>
									<span class="profil-match-element-title-this">
										<?php 
											echo $value->getNomJeu();
										?>
									</span>
								</div>
								<?php 		
							}
						}
						else{
							echo '<div class="profil-element profil-tournament-element">';
								echo 'Pas de tournoi participé.';
							echo '</div>';
						}
					?>
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

			<div class="grid-md-4">
				<div id="contain_right">

					<div id="contain_search">
						<label for="search">Rechercher :</label>
					    <input class="input-default" type="text" name="search" placeholder="Tournois, teams, joueurs">
					    <div id="statistiques">
							<h4>Statistiques</h4>
							<ul>
								<li>Matchs gagnés: 78
								<li>Matchs perdus: 92
								<li>Ratio : 0.78
								<li>Points : 1072
							</ul>
						</div>
					</div>

					<div class="title_index">
						<label for="title1">Dernier match</label>
					</div>
					<div class="fight">

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
			
					<!-- Boutons Contact / Report / Config -->
					<div id="game">
						<?php 
						if(isset($_isConnected)):
						?> 
						<div class="title_index">
							<label for="title2">Interactions avec ce joueur</label>
						</div>
						<?php endif; ?>
						<div id="communication">
						<?php 
							//N'apparaissent que si le visiteur est connecté et n'est pas sur sa propre page
							if(isset($_isConnected) && !isset($myAccount)){
								if(isset($authorize_mail_contact) && $authorize_mail_contact==1)
									echo '<button id="contact" type="button" class="btn btn-pink" title="Envoyer un mail au joueur">	<a href="#">Envoyer un message</a></button>';
								if(isset($already_signaled) && $already_signaled==1)
									echo '<p id="signalementnope">Vous avez déjà signalé ce joueur</p>';
								else 
									echo '<button id="signalement" type="button" class="btn btn-pink"><a href="#">Signaler le joueur</a></button>';
							}
							else if(isset($myAccount))
								echo '<button type="button" class="btn btn-pink"><a href="configuration" id="configuration">Configurer mon compte</a></button>';
						?>
						</div>
					</div>
				</div>
			</div>
		</div>				
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
?>