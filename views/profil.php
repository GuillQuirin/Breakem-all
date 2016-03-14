	<section id="presentation">
		<div id="image">
			<img src="" alt="logo">
			<p>PSEUDO</p>
			<p class="off">Vu le: 15/01/16</p>
			<?php if(0) echo '<p class="on">Connecté</p>'; ?>
		</div>
		<button id="configuration">Configurer mon compte</button>
	</section>
	<section id="informations">
		<div id="communication">
			<button id="contact" title="Envoyer un mail au joueur">Contacter</button>
			<button id="signalement">Signaler le joueur</button>
		</div>
		<div id="description">
			<h4>Description</h4>
			<p>Ce joueur n'a pas encore rédigé de description.
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
			<h4>Contacter le joueur</h4>
			<p>Si vous souhaiter communiquer avec ce joueur, Breakemall.com se chargera de transmettre votre message ci-dessous</p>
			<textarea id="mess_contact" placeholder="Merci de ne pas mettre de message offensant ou ne respectant pas les conditions d'utilisation du site"></textarea>
			<button id="btn_contact">Envoyer</button>
		</div>
	</section>