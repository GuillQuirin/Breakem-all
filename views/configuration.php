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
}else{
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
						<span class="configuration-header-profil-lastconnexion"><?php echo (isset($_lastConnexion)) ? $_lastConnexion : 'Dernière connexion inconnu'; ?></span>
					</div>
				</div>
			</div>			
		</div>
	</div>
	 
	<img class="icon icon-size-3 down-center header-scroll-down" id="classement-header-scroll-down" src="web/img/icon/icon-scroll-down.png"> 

	</section>

	<section class="classement-content-wrapper">

		<div class="container m-a content-border classement-container" style="border:none;">

			<div class="row classement-content-row">
				<div class="grid-md-12">
				
					<form action="configuration/update" method="post" enctype="multipart/form-data">

						<table class="full-width configuration-form-table">
							<tr class="text-center">
								<td colspan="2">
									<span>Mes informations personnels</span>
								</td>
							</tr>
							<tr>						
								<td>
									<span>Pseudo : </span>
								</td>
								<td>
									<span class="capitalize"><?php echo (isset($_pseudo)) ? $_pseudo : 'Pseudo inexistant'; ?></span>	
								</td>
							</tr>
							<tr>						
								<td>
									<span>Email : </span>
								</td>
								<td class="configuration-form-email">
									<div> 
										<input type="email" name="email" value="<?php echo (isset($_email)) ? $_email : 'Adresse email non fournie'; ?>" required>
									</div>
									<div>
										<label><input type="checkbox" name="authorize_mail_contact" 
											<?php 
											echo (isset($_authorize_mail_contact) && $_authorize_mail_contact==1) ? 'checked=checked' : '';?>>
											Autoriser les utilisateurs a me contacter.
										</label>
									</div>
									<div>								
										<label><input type="checkbox" name="rss"
											<?php 
											echo (isset($_rss) && $_rss==1) ? 'checked=checked' : '';?>>
											Activation du flux RSS.
										</label>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<span>Date de naissance :</span>					
								</td>
								<td>
									<span><?php echo (isset($_birthday)) ? date('d/m/Y', $_birthday) : 'Date de naissance non indiquée.' ; ?></span>
								</td>
							</tr>
							<tr>
								<td>
									<span>Description : </span>
								</td>
								<td>
									<textarea name="description" placeholder="Veuillez ne pas mettre de message pouvant offenser les autres joueurs ou ne pas respecter les CGU">
										<?php echo (isset($_description)) ? $_description : ''; ?>
									</textarea>
								</td>							
							</tr>
							<tr class="text-center">
								<td colspan="2">
									<span>Jeux</span>
								</td>
							</tr>
							<tr>
								<td>
									<span>Jeux préféré</span>
								</td>
								<td>
									<select>
									<?php 
										if(isset($listeJeux)){
											foreach ($listeJeux as $key => $value) {
												echo "<option value='".$value['name']."'>".$value['name']."</option>";
											}
										}
									?>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<span>Team</span>
								</td>
								<td>
									<?php echo (isset($nomTeam)) ? '<a href="team?nom='.$nomTeam.'">'.$nomTeam.'</a>' : 'Vous n\'appartenez à aucune team.'; ?></p>
								</td>
							</tr>
							<tr class="text-center">
								<td colspan="2">
									<span>Mot de passe</span>
								</td>
							</tr>	
							<tr>
								<td>
									<span>Ancien mot de passe</span>
								</td>
								<td>
									<input class="input-required" type="password" name="password" required>
								</td>						
							</tr>	
							<tr>
								<td>
									<span>Nouveau mot de passe</span>
								</td>
								<td>
									<input type="password" name="new_password">
								</td>						
							</tr>	
							<tr>
								<td>
									<span>Ressaisir le nouveau mot de passe:</span>
								</td>
								<td>
									<input type="password" name="new_password_check">
								</td>						
							</tr>
							<tr class="text-center">
								<td colspan="2">																	
									<button id="navbar-inscription" type="submit" class="btn btn-pink configuration-form-submit"><a>Envoyer</a></button>
								</td>
							</tr>	
						</table>				

					</form>				

				</div>
			</div>				
		</div>

	</section>
<?php 
} 
?>