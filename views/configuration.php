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
	<section id="avatar">
		<div id="image">
			<img src="<?php echo $img; ?>" alt="logo">
		</div>
	</section>
	<section id="informations">
		<div>
			<form action="configuration/update" method="post">
				<p>Pseudo (non modifiable): <?php echo $pseudo; ?></p>
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
					<h4>Informations personnelles</h4>
					<p>Date de naissance: <?php echo date('d/m/Y', $birthday); ?></p>
					<p><input type="checkbox" name="aff_naissance">Afficher ma date de naissance</input></p>
					<!-- <p>Sexe: 
							<select>
								<option></option>
								<option name="sexe" value="1" <?php echo ($sexe=="1") ? "selected" : ""; ?>>Homme</option>
								<option name="sexe" value="0" <?php echo ($sexe=="0") ? "selected" : ""; ?>>Femme</option>
							</select></p> -->
					<h4>E-mail</h4>
					<p>Adresse e-mail<input type="text" name="email" value="<?php echo $email; ?>"></p>
					<p><input type="checkbox" name="flux_RSS">Je m'abonne au flux RSS du site</p>
					<p><input type="checkbox" name="contact_mail">J'autorise les autres utilisateurs à me contacter par mail (votre adresse restera confidentielle)</p>
				</div>
				<div>
					<h4>Renouveller mon mot de passe</h4>
					<p>Ancien mot de passe: <input type="text"></p>
					<p>Nouveau mot de passe: <input type="text"></p>
				</div>
				<input type="submit">
			</form>
		</div>
	</section>
	<?php
}
?>