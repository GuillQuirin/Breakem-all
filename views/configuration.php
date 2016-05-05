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
		<form action="configuration/update" method="post">
			<div>
				<h4>Présentation</h4>
				<p>Pseudo (non modifiable): <?php echo (isset($pseudo)) ? $pseudo : ''; ?></p>
				<p>Petite description de vous:
					<textarea name="description" value="<?php echo (isset($description)) ? $description :''; ?>"></textarea>
				</p>
			</div>
			<div>
				<h4>Vos Jeux</h4>
				<div>
					<h4>Jeux</h4>
					<p>Jeu préféré: 
							<select>
								<option></option>
								<option></option>
								<option></option>
							</select>
					</p>
					<p>Team associé actuellement: 
						<?php echo (isset($nomTeam)) ? '<a href="team?nom='.$nomTeam.'">'.$nomTeam.'</a>' : 'Vous n\'appartenez à aucune team'; ?></p>
				</div>
				<div>
					<h4>Informations personnelles</h4>
					<p>Date de naissance: <?php echo (isset($birthday)) ? date('d/m/Y', $birthday) : 'dd/mm/YYYY' ; ?></p>
					<p><input type="checkbox" name="aff_naissance">Afficher ma date de naissance</input></p>
					<h4>E-mail</h4>
					<p>Adresse e-mail<input type="text" name="email" value="<?php echo (isset($email)) ? $email : ''; ?>"></p>
					<p><input type="checkbox" name="flux_RSS">Je m'abonne au flux RSS du site</p>
					<p><input type="checkbox" name="contact_mail">J'autorise les autres utilisateurs à me contacter par mail (votre adresse restera confidentielle)</p>
				</div>
				<div>
					<h4>Renouveller mon mot de passe</h4>
					<p>Ancien mot de passe: <input type="password" name="password"></p>
					<p>Nouveau mot de passe: <input type="password" name="password_new"></p>
				</div>
				<input type="submit">
			</div>
		</form>
	</section>
	<?php
}
?>