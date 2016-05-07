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
	<section id="presentation">
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
				echo '<button id="contact" title="Envoyer un mail au joueur">Contacter</button>';
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
			<h4>Signaler un joueur</h4>
			<ul>
				<li>Vous trouvez que ce joueur ne respecte pas les <a href="#">Conditions Générales d'Utilisation</a> ?
				<li>Vous pouvez avertir les administrateurs qui se chargeront d'étudier votre signalement.
				<li>Selectionnez la raison de votre signalement:
					<select id="liste_plainte">
						<option value="0"></option>
						<option value="1">Méchant</option>
					</select>
			</ul>
			<p>
				Veuillez justifier votre plainte (obligatoire):
			</p>
			<textarea id="mess_plainte"></textarea>
			<button id="btn_plainte">Envoyer</button>
		</div>
	</section>
	<section id="formcontact">
		<div>
			<form action="<?php echo 'profil/contact'; ?>" method="post">
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