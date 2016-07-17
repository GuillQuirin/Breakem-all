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
							<p><a href="<?php echo WEBPATH.'/index'; ?>">Retour à l'accueil</a></p>
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
						<p><a href="<?php echo WEBPATH.'/index'; ?>">Retour à l'accueil</a></p>
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
					<div class="configuration-header-profil-contain-desc">
						<span class="configuration-header-profil-name"><?php echo (isset($pseudo)) ? $pseudo : 'Sans pseudo'; ?></span>
						<span class="configuration-header-profil-description"><?php echo (isset($description)) ? '"' . $description . '"' : 'Sans description.'; ?></span>
						<span class="configuration-header-profil-lastconnexion">
						<?php 
							if(isset($isConnected))
								echo "Connecté";
							elseif(isset($lastConnexion))
							 	echo strftime('le %e %B à %H:%M', $lastConnexion);
							else 
								echo "Pas de dernière connexion.";
						 ?>
						 </span>
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
						<span>Derniers Tournois joués</span>
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
					<div class="title_index">
						<label for="title1">Team</label>
					</div>
				    <div id="team" class="team">
						<?php 
							if(isset($nameTeamProfil) && $nameTeamProfil!==null){
								echo '<a href="'.WEBPATH.'/detailteam?name='.$nameTeamProfil.'">';
									echo '<figure>';
										if(isset($imgTeamProfil) && $imgTeamProfil!==null){
											echo '<img src="'.$imgTeamProfil.'" alt="Team du joueur">';
										}
										echo '<figcaption>'.$nameTeamProfil.'</figcaption>';
									echo '</figure>';
								echo '</a>';
							}
							else
								echo "<p>Ce joueur n'appartient à aucune team.</p>";
						?>
					</div>
					<div class="title_index">
						<label for="title1">Statistiques</label>
					</div>
				    <div id="statistiques" class="fight">
						<ul>
							<li>Matchs gagnés: 78
							<li>Matchs perdus: 92
							<li>Ratio : 0.78
							<li>Points : 1072
						</ul>
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
									echo '<button id="contact" type="button" class="btn btn-pink" title="Envoyer un mail au joueur">	<a>Envoyer un message</a></button>';

								echo "<span id='gestionplainte'>";
									if(isset($already_signaled) && $already_signaled==1)
										echo '<p id="signalementnope">Vous avez déjà signalé ce joueur</p>';
									else 
										echo '<button id="signalement" type="button" class="btn btn-pink"><a>Signaler le joueur</a></button>';
								echo "</span>";
							}
							else if(isset($myAccount)){
								echo '<button type="button" class="btn btn-pink">';
									echo '<a href="'.WEBPATH.'/configuration" id="configuration">Configurer mon compte</a>';
								echo '</button>';
							}
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
		<h4>Signaler un joueur</h4>
		<ul>
			<li>Vous trouvez que ce joueur ne respecte pas les <a href="<?php echo WEBPATH.'/CGU'; ?>" target="_blank">Conditions Générales</a> ?
			<li>Vous pouvez avertir les administrateurs qui se chargeront d'étudier votre signalement.
			<li>Selectionnez la raison de votre signalement:
				<input type="text" id="suj_plainte" name="subject" required>
		</ul>
		<p>
			Veuillez justifier votre plainte (obligatoire):
		</p>
		<textarea id="mess_plainte" name="description" required></textarea>
		<p class="sendOk">Votre message a correctement été envoyé</p>
		<p class="sendError">Une erreur est survenue lors de l'envoi de votre message</p>
		<input type="submit" id="btn_plainte" value="Envoyer">
	</div>
</section>
<section id="formcontact">
	<div>
		<h4>Contacter le joueur</h4>
		<p>Si vous souhaiter communiquer avec ce joueur, Breakemall.com se chargera de transmettre votre message ci-dessous</p>
		<textarea id="mess_contact" name="msg" placeholder="Merci de ne pas mettre de message offensant ou ne respectant pas les conditions d'utilisation du site">
		</textarea>
		<p class="sendOk">Votre message a correctement été envoyé</p>
		<p class="sendError">Une erreur est survenue lors de l'envoi de votre message</p>
		<input type="submit" id="btn_contact" value="Envoyer">
	</div>
</section>
	<?php
}
?>