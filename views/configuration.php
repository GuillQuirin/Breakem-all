	<section class="middle-height bg-cover-configuration relative">

	<div class="align full-height">
		<div class="configuration-header-profil-wrapper">
			<div class="configuration-header-profil-left">
				<img class="configuration-header-profil-image" src="<?php echo $_img; ?>" title="Image de profil" alt="Image de profil">

				<div class="configuration-header-profil-right align">
					<div class="">
						<span class="configuration-header-profil-name"><?php echo (isset($_pseudo)) ? $_pseudo : 'Sans pseudo'; ?></span>
						<span class="configuration-header-profil-description"><?php echo (isset($_description)) ? '"' . $_description . '"' : 'Sans description.'; ?></span>
					</div>
				</div>
			</div>			
		</div>
	</div>
	 
	<img class="icon icon-size-3 down-center header-scroll-down" id="classement-header-scroll-down" src="web/img/icon/icon-scrollDown.png"> 

	<div class="configuration-onglet-wrapper">
		<ul class="configuration-onglet-ul">
			<li class="active">
				Profil
			</li>			
		</ul>
	</div>

	</section>

	<section class="configuration-content-wrapper my-content-wrapper">

		<div class="container m-a content-border classement-container" style="border:none;">

			<div class="row classement-content-row">
				<div class="grid-md-12">
				
					<form action="configuration/update" method="post" enctype="multipart/form-data">

						<table class="full-width configuration-form-table">
							<?php 

							if(isset($MAJ))
								echo '<tr class="success text-center"><td colspan="2">Modifications enregistrées.</td></tr>';

							if(isset($err_img_upload))
								echo '<tr class="error text-center"><td colspan="2">Erreur dans le téléchargement de votre image.</td></tr>';

							if(isset($err_img_size))
								echo '<tr class="error text-center"><td colspan="2">Attention votre fichier ne doit pas excéder 3MB.</td></tr>';

							if(isset($fail_date))
								echo '<tr class="error text-center"><td colspan="2">La date de naissance n\'est pas correcte.</td></tr>';

							if(isset($fail_email))
								echo '<tr class="error text-center"><td colspan="2">Une adresse email valide est obligatoire</td></tr>';

							if(isset($double_email))
								echo '<tr class="error text-center"><td colspan="2">Cette adresse email est déjà utilisée</td></tr>';

							if(isset($fail_password))
								echo '<tr class="error text-center"><td colspan="2">Le nouveau mot de passe doit faire entre 2 et 15 caractères</td></tr>';

							if(isset($empty_password))
								echo '<tr class="error text-center"><td colspan="2">Veuillez saisir votre mot de passe pour toute modification.</td></tr>';
							?>

							<tr class="text-center">
								<td colspan="2">
									<?php echo '<img class="icon icon-size-3 navbar-icon" src="' . WEBPATH . '/web/img/icon/icon-profil.png">';?><span class="configuration-form-menu-tr">Mes informations personnelles</span>
								</td>
							</tr>
							<tr>
								<td colspan="2" class="">	
									<div class="configuration-first-avatar-wrapper text-center">
										<div class="configuration-avatar-wrapper m-a">																	
											<img class="configuration-avatar img-cover" src="<?php echo $_img; ?>" title="Image de profil" alt="Image de profil">										
										</div>									
										<input class="" type="file" name="profilpic">									
									</div>
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
										<input class="input-default configuration-input-default" type="email" name="email" value="<?php echo (isset($_email)) ? $_email : 'Adresse email non fournie'; ?>" required>
									</div>
									<div>
										 

										<label><input class="checkbox input-default" type="checkbox" name="authorize_mail_contact" id="authorize_mail_contact" 
											<?php 
											echo (isset($_authorize_mail_contact) && $_authorize_mail_contact==1) ? 'checked=checked' : '';?>>
											<label for="authorize_mail_contact">
											Autoriser les utilisateurs a me contacter.																					
											</label>
										</label>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<span>Date de naissance :</span>					
								</td>
								<td>
									<span class="index-input-default-date">
										<input class="input-default" type="number" name="day"   placeholder="dd" min="1" max="31" value="<?php echo (isset($_birthday)) ? date('d', $_birthday) : '' ?>">
										<input class="input-default" type="number" name="month" placeholder="mm" min="1" max="12" value="<?php echo (isset($_birthday)) ? date('m', $_birthday) : '' ?>">
										<input class="input-default" type="number" name="year"  placeholder="yyyy" min="1950" max="2016" value="<?php echo (isset($_birthday)) ? date('Y', $_birthday) : '' ?>">
									</span>
								</td>
							</tr>
							<tr>
								<td>
									<span>Description : </span>
								</td>
								<td>
									<textarea class="configuration-textarea-description textarea-default" name="description" placeholder="Veuillez ne pas mettre de message pouvant offenser les autres joueurs ou ne pas respecter les CGU">
										<?php echo (isset($_description)) ? $_description : ''; ?>
									</textarea>
								</td>							
							</tr>
							<tr class="text-center">
								<td colspan="2">
									<?php echo '<img class="icon icon-size-3 navbar-icon" src="' . WEBPATH . '/web/img/icon/icon-game.png">';?><span class="configuration-form-menu-tr">Team</span>
								</td>
							</tr>
							<?php /* 
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
							*/
							?>
							<tr>
								<?php 
								if(isset($_nameTeam)){
									echo "<td class='text-center'>";
										echo '<a href="detailteam?name='.$_nameTeam.'">';
											if(isset($imgTeam) && $imgTeam!==NULL)
												echo '<img class="configuration-team navbar-icon" src="'.$imgTeam.'">';
										echo '</a>';
									echo "</td>";
									echo "<td>";
										echo '<a href="detailteam?name='.$_nameTeam.'">'.$_nameTeam.'</a>';
									echo "</td>";
								}
								else{
									echo "<td class='text-center' colspan='2'>Vous n'appartenez à aucune team.</td>";
								}
								?>
							</tr>
							<tr class="text-center">
								<td colspan="2">
									<?php echo '<img class="icon icon-size-3 navbar-icon" src="' . WEBPATH . '/web/img/icon/icon-safe.png">';?><span class="configuration-form-menu-tr">Mot de passe</span>
								</td>
							</tr>	
							<tr>
								<td>
									<span>Mot de passe actuel</span><span class="configuration-input-required p-width-small">*</span>
								</td>
								<td>
									<input class="input-default configuration-input-default" type="password" name="password" required>
								</td>						
							</tr>	
							<tr>
								<td>
									<span>Nouveau mot de passe</span>
								</td>
								<td>
									<input class="input-default configuration-input-default" type="password" name="new_password">
								</td>						
							</tr>	
							<tr>
								<td>
									<span>Ressaisir le nouveau mot de passe:</span>
								</td>
								<td>
									<input class="input-default configuration-input-default" type="password" name="new_password_check">
								</td>						
							</tr>
							<tr class="text-center">
								<td colspan="2" class="border-none configuration-form-td-submit">																	
									<button type="submit" class="btn btn-pink configuration-form-submit"><a>Envoyer</a></button>
								</td>
							</tr>	
						</table>
						<div class="text-center"><span class="configuration-input-required irhack">*</span>
							<span class="relative">Champ obligatoire</span>
						</div>				

					</form>				

				</div>
			</div>				
		</div>

	</section>