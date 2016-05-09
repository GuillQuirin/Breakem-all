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
	if(isset($MAJ))
		echo "<div>Mise à jour correctement effectuée.</div>";
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
						<span class="configuration-header-profil-lastconnexion"><?php echo (isset($_lastConnexion)) ? $_lastConnexion : 'Jamais connecté.'; ?></span>
					</div>
				</div>
			</div>			
		</div>
	</div>
	 
	<img class="icon icon-size-3 down-center header-scroll-down" id="classement-header-scroll-down" src="web/img/icon/icon-scroll-down.png"> 

</section>

	<!-- 

	<form action="configuration/update" method="post" enctype="multipart/form-data">
		<section id="avatar">
			<div id="image">
				<img src="<?php echo $_img; ?>" title="Image de profil" alt="Image de profil">
				<input type="file" name="profilpic">
			</div>
		</section>
		<section id="informations">
			<div>
				<h4>Présentation</h4>
				<p>Pseudo (non modifiable): <?php echo (isset($_pseudo)) ? $_pseudo : 'Pseudo inexistant'; ?></p>
				<p>Petite description de vous:
					<textarea name="description" placeholder="Veuillez ne pas mettre de message pouvant offenser les autres joueurs ou ne pas respecter les CGU">
						<?php echo (isset($_description)) ? $_description : ''; ?>
					</textarea>
				</p>
			</div>
			<div>
				<div>
					<h4>Jeux</h4>
					<p>Jeu préféré: 
						<select>
						<?php 
							if(isset($listeJeux)){
								foreach ($listeJeux as $key => $value) {
									echo "<option value='".$value['name']."'>".$value['name']."</option>";
								}
							}
						?>
						</select>
					</p>
					<p>Team associé actuellement: 
						<?php echo (isset($nomTeam)) ? '<a href="team?nom='.$nomTeam.'">'.$nomTeam.'</a>' : 'Vous n\'appartenez à aucune team'; ?></p>
				</div>
				<div>
					<h4>Informations personnelles</h4>
					<p>Date de naissance: <?php echo (isset($_birthday)) ? date('d/m/Y', $_birthday) : 'Date de naissance non indiquée' ; ?></p>
					<!-- <p><input type="checkbox" name="aff_naissance">Afficher ma date de naissance</input></p> -->
					<!-- <h4>E-mail</h4>
					<p>
						Adresse e-mail
						<input type="email" name="email" 
								value="<?php echo (isset($_email)) ? $_email : 'Adresse email non fournie'; ?>" required>
					</p>
					<p>
						<label><input type="checkbox" name="authorize_mail_contact" 
							<?php 
							echo (isset($_authorize_mail_contact) && $_authorize_mail_contact==1) ? 
								'checked=checked' : 
								'' ; ?>
							>
							J'autorise les autres utilisateurs à me contacter par mail (votre adresse restera confidentielle)
						</label>
					</p>
					<p>
						<label><input type="checkbox" name="rss"
							<?php 
							echo (isset($_rss) && $_rss==1) ? 'checked=checked' : '' ; ?>
							>
							Je m'abonne au flux RSS du site
						</label>
					</p>
				</div>
				<div>
					<h4>Changer mon mot de passe</h4>
					<p>Nouveau mot de passe: <input type="password" name="new_password"></p>
					<p>Resaisir le nouveau mot de passe: <input type="password" name="new_password_check"></p>
				</div>
				<div>
					<h4>OBLIGATOIRE</h4>
					<p>Il est obligatoire de saisir son mot de passe afin de procéder à toute modification</p>
					<p>Mot de passe actuel: <input type="password" name="password" required></p>
				</div>
				<input type="submit">
			</div>
		</section>
	</form>
	<?php
}
?>
-->