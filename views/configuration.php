	<section id="avatar">
		<div id="image">
			<img src="" alt="logo">
		</div>
	</section>
	<section id="informations">
		<div>
			<form>
				<p>Pseudo (non modifiable): kikoolol</p>
				<div>
					<h4>Jeux</h4>
					<p>Jeu préféré: 
							<select>
								<option></option>
								<option></option>
								<option></option>
							</select>
					</p>
					<p>Team associé: <a href="#">Team</a></p>
				</div>
				<div>
					<h4>Date de naissance</h4>
					<p>Date de naissance: 1 Jan 1995</p>
					<p><input type="checkbox" name="aff_naissance">Afficher ma date de naissance</input></p>
				</div>
				<div>
					<h4>E-mail</h4>
					<p>Adresse e-mail<input type="text"></p>
					<p><input type="checkbox" name="flux_RSS">Je m'abonne au flux RSS du site</p>
					<p><input type="checkbox" name="contact_mail">J'autorise les autres utilisateurs à me contacter par mail (votre adresse restera confidentielle)</p>
				</div>
				<div>
					<h4>Mot de passe</h4>
					<p>Ancien mot de passe: <input type="text"></p>
					<p>Nouveau mot de passe: <input type="text"></p>
				</div>
			</form>
		</div>
	</section>
	<section id="suppression">
		<div>
			<h4>Supprimer mon mot de passe</h4>
			<p class="warning">Attention, toute suppression est définitive</p>
			<p>Saisissez votre mot de passe: <input type="text" id="mdp"></p>
			<button id="btn_suppr">Supprimer le compte</button>
		</div>
	</section>