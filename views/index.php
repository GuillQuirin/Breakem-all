<section id="section_inscrip">
	<div id="slider">
		<?php echo '<img src="' . WEBPATH . '/web/img/hereos.png">';?>
		<?php echo '<img src="' . WEBPATH . '/web/img/battlefield.png">';?>
		<?php echo '<img src="' . WEBPATH . '/web/img/link.jpg">';?>
		<?php echo '<img src="' . WEBPATH . '/web/img/lol.jpg">';?>
	</div>
	<div id="inscription_rapide">
		<br>
		<h3>Inscris toi et participe à des<br> tournois seul ou en Equipe !<br></h3>
		<p> Inscription rapide : </p>
		<input id="email" type="text" placeholder="E-mail">
		<input id="pwd1" type="text" placeholder="Rentre ton mot de passe"> 
		<input id="pwd2" type="text" placeholder="Confirme ton mot de passe">
		<div id="btn_sinscrire">
			<button type="submit" id="btn_inscrip_rapide" class="bouton">S'inscrire </button>
		</div>
	</div>
</section>
<div id="connexion">
	<form action=<?php $page=explode('.', $this->view); echo '"'.trim(str_replace('views', '', $page[0]), '/').'/connexion"';?> method="post">
		Connexion
		<input type = "text" id="email" name="email" placeholder="Taper votre e-mail">
		<input type = "password" id="pwd" name="password" placeholder="Taper votre mot de passe">
		<input type="submit" value="connexion">
	</form>
</div>
<div class="separateur">
	<div id="title">
		<hr class="left"> 
		<div class="title">Les tournois</div>
		<hr class="right">
	</div>
</div>


<section id="section_liste_tournoi">
	<article id="liste_tournoi">
		<div class="tournoi">
			<div class="img_tournoi">
				<?php echo '<img src="' . WEBPATH . '/web/img/mk.jpg" alt="Mario Kart" title="Mario Kart" class="img_tournoi">';?>
			</div>
			<div id="description">
				<div class="name_tournoi">
					<a href="#">Mario Kart 8</a>
					<span>, Jeudi 10 Mars 2016 </span>
				</div>
				<div class="nb_inscrit">
					<p> 12/24 Joueurs inscrits / 12 Joueurs minimum / Inscription ouverte</p>
				</div>
				<div class="descrip_tournoi">
					<p> Venez affronter des adversaires venues des quatres coins du monde. Qui va remporte la merveilleuse coupe ? </p>
					<a href="#" class="float_right">En savoir plus...</a>
				</div>
			</div>
		</div>
		<div class="tournoi">
			<div class="img_tournoi">
				<?php echo '<img src="' . WEBPATH . '/web/img/lol_tournoi.png" alt="League Of Legends" title="League Of Legends" class="img_tournoi">';?>
			</div>
			<div id="description">
				<div class="name_tournoi">
					<a href="#"> League Of Legends</a>
					<span>, Mardi 25 Février 2016 </span>
				</div>
				<div class="nb_inscrit">
					<p> 10/10 Equipes inscrites / 5 Equipes minimum / Résultat</p>
				</div>
				<div class="descrip_tournoi">
					<p> Super tournoi affrontant l'équipe des BrasCasser contre Les Boufbollers Masqués ! Retourner voir ce live magnifique.. </p>
					<a href="#" class="float_right">En savoir plus...</a>
				</div>
			</div>
		</div>
		<div class="tournoi">
			<div class="img_tournoi">
				<?php echo '<img src="' . WEBPATH . '/web/img/heroes-of.jpg" alt="Hereos of the Storm" title="Hereos of the Storm" class="img_tournoi">';?>
			</div>
			<div id="description">
				<div class="name_tournoi">
					<a href="#"> Hereos of the Storm</a>
					<span>, Mardi 22 Mars 2016 </span>
				</div>
				<div class="nb_inscrit">
					<p> 15/20 Equipes inscrites / 10 Equipes minimum / En cours</p>
				</div>
				<div class="descrip_tournoi">
					<p> Un combat acherné entre des équipes qui veulent gagner ! </p>
					<a href="#" class="float_right">En savoir plus...</a>
				</div>
			</div>
		</div>
		<div class="tournoi">
			<div class="img_tournoi">
				<?php echo '<img src="' . WEBPATH . '/web/img/rocket.jpeg" alt="Mario Kart" title="Mario Kart" class="img_tournoi">';?>
			</div>
			<div id="description">
				<div class="name_tournoi">
					<a href="#"> Rocket League</a>
					<span>, Mardi 25 Février 2016 </span>
				</div>
				<div class="nb_inscrit">
					<p> 5/10 Joueurs inscris / 5 Joueurs minimum / Inscription</p>
				</div>
				<div class="descrip_tournoi">
					<p> Débutant sur Rocket League ? Tu veux apprendre de nouvelle technique ? Vien jouer avec des maîtres du ballon, il t'expliqueront tout ce que tu as a savoir. Secret à la clé ! </p>
					<a href="#" class="float_right">En savoir plus...</a>
				</div>
			</div>
		</div>
	</article>
</section>