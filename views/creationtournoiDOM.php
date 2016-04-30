<!-- <div class="max-container ov-hidden">
	<div class="fixed creationtournoi-first-image-background">
		<img class="absolute" src="web/img/second-bg.jpg" alt="epic-fights">
	</div>
	<h1 class="titre1 ta-left">Organise ton propre tournoi !</h2>	
	<section class="creationtournoi-section-formulaire">
		<form class="creationtournoi-form" action="">
			<div class="creationtournoi-form-row creationtournoi-form-basic ta-center flex-column-space-between">
				<div class="flex-row">
					<h3 class="titre2 ta-center">Donne lui un nom</h3>
					<div class="creationtournoi-input-group dis-block">
						<label for="nom-tournoi">Nom du tournoi : </label>
						<input class="creationTournoi-input skew-8 ta-center" type="text" name="nom-tournoi" required placeholder="REQUIRED">
					</div>
					<div class="creationtournoi-input-group dis-block">
						<label for="date-tournoi">Date du tournoi : </label>
						<input class="creationTournoi-input skew-8 ta-center" type="text" name="date-tournoi" required placeholder="REQUIRED">
					</div>
				</div>
				<div class="flex-row">
					<h3 class="titre2 ta-center">Limite participants</h3>
					<div class="creationtournoi-input-group dis-block">
						<label for="min-joueurs">Min joueurs : </label>
						<input class="creationTournoi-input" type="number" min="8" max="48" name="min-joueurs" required placeholder="8">
					</div>
					<div class="creationtournoi-input-group dis-block">
						<label for="max-joueurs">Max joueurs : </label>
						<input class="creationTournoi-input" type="number" min="16" max="48" name="max-joueurs" required placeholder="16">
					</div>
				</div>			
			</div>
			<div class="creationtournoi-form-row creationtournoi-form-jeu ta-center flex-column-space-between">
				<div class="flex-row flex-column-50">
					<h3 class="titre2 ta-center dis-block margin-auto">Choisis ton jeu</h3>
					<div class="creationtournoi-input-group dis-block margin-auto">
						<label for="jeu">Ton choix</label>
						<input class="creationTournoi-input skew-8 ta-center" type="text" name="jeu" value="Battlefield 3" readonly>
					</div>
					<div class="flex caroussel-container relative ov-hidden margin-auto">
						<div class="caroussel absolute flex-column">
							<div class="caroussel-element relative flex-row ov-hidden skew-8">
								<p>Jeu</p>
							</div>
							<div class="caroussel-element relative flex-row ov-hidden skew-8">
								<p>Jeu</p>
							</div>
							<div class="caroussel-element relative flex-row ov-hidden skew-8">
								<p>Jeu</p>
							</div>
							<div class="caroussel-element relative flex-row ov-hidden skew-8">
								<p>Jeu</p>
							</div>
							<div class="caroussel-element relative flex-row ov-hidden skew-8">
								<p>Jeu</p>
							</div>
							<div class="caroussel-element relative flex-row ov-hidden skew-8">
								<p>Jeu</p>
							</div>
							<div class="caroussel-element relative flex-row ov-hidden skew-8">
								<p>Jeu</p>
							</div>
							<div class="caroussel-element relative flex-row ov-hidden skew-8">
								<p>Jeu</p>
							</div>
						</div>
					</div>
				</div>
				<div class="flex-row flex-column-50">
					<h3 class="titre2 ta-center dis-block margin-auto">Choisis la console</h3>
					<div class="creationtournoi-input-group dis-block margin-auto">
						<label for="console">Ton choix</label>
						<input class="creationTournoi-input skew-8 ta-center" type="text" name="console" value="PC" readonly>
					</div>
					<div class="flex caroussel-container ov-hidden relative margin-auto">
						<div class="caroussel absolute flex-column">
							<div class="caroussel-element relative flex-row ov-hidden skew-8">
								<p>xbox 360</p>
							</div>
							<div class="caroussel-element relative flex-row ov-hidden skew-8">
								<p>playstation 3</p>
							</div>
							<div class="caroussel-element relative flex-row ov-hidden skew-8">
								<p>pc</p>
							</div>
							<div class="caroussel-element relative flex-row ov-hidden skew-8">
								<p>nintendo 64</p>
							</div>
							<div class="caroussel-element relative flex-row ov-hidden skew-8">
								<p>playstation 4</p>
							</div>
							<div class="caroussel-element relative flex-row ov-hidden skew-8">
								<p>xbox one</p>
							</div>
						</div>
					</div>
				</div>
			</div>		
			<div class="creationtournoi-form-row creationtournoi-form-modejeu ta-center">
				<h3 class="titre2 ta-left">Mode de jeu</h3>
				<div class="creationtournoi-input-group">
					<label for="modejeu">Ton choix</label>
					<input class="creationTournoi-input skew-8 ta-center" type="text" name="modejeu" value="Ruée" readonly>
				</div>
				<div class="flex caroussel-container ov-hidden relative margin-auto">
					<div class="caroussel absolute flex-column">
						<div class="caroussel-element relative flex-row ov-hidden skew-8">
							<p>Ruée</p>
						</div>
						<div class="caroussel-element relative flex-row ov-hidden skew-8">
							<p>Conquête</p>
						</div>
						<div class="caroussel-element relative flex-row ov-hidden skew-8">
							<p>Domination</p>
						</div>
						<div class="caroussel-element relative flex-row ov-hidden skew-8">
							<p>Match à mort</p>
						</div>
					</div>
				</div>
			</div>
			<div class="creationtournoi-form-row creationtournoi-form-equipe ta-center">
				<h3 class="titre2 ta-left">Mode d'équipes</h3>
				<div class="creationtournoi-input-group">
					<label for="equipe">Ton choix</label>
					<input class="creationTournoi-input skew-8 ta-center" type="text" name="equipe" value="Equipe-random" readonly>
				</div>
				<div class="flex caroussel-container ov-hidden relative margin-auto">
					<div class="caroussel absolute flex-column">
						<div class="caroussel-element relative flex-row ov-hidden skew-8">
							<p>Equipe - random</p>
						</div>
						<div class="caroussel-element relative flex-row ov-hidden skew-8">
							<p>Equipe - libre</p>
						</div>
						<div class="caroussel-element relative flex-row ov-hidden skew-8">
							<p>Equipe - Guilde</p>
						</div>
						<div class="caroussel-element relative flex-row ov-hidden skew-8">
							<p>Individuel - Libre</p>
						</div>
						<div class="caroussel-element relative flex-row ov-hidden skew-8">
							<p>Individuel - Random</p>
						</div>
					</div>
				</div>
			</div>
			<div class="creationtournoi-form-row creationtournoi-form-online ta-center">
				<h3 class="titre2 ta-left">Online / Offline</h3>
				<div class="creationtournoi-input-group">
					<label for="online">Ton choix</label>
					<input class="creationTournoi-input skew-8 ta-center" type="text" name="online" value="Online" readonly>
				</div>
				<div class="creationtournoi-off-on-container flex-column">
					<div class="skew-8 ov-hidden relative flex-row creationtournoi-off-on">
						<div class="flex-row">
							<h3 class="titre3 uppercase">offline</h3>
						</div>
						<img class="absolute img-responsiv-width img-absolute-bg opacity-05" src="web/img/offline-mode-bg.jpg" alt="mode">
					</div>
					<div class="skew-8 ov-hidden relative flex-row creationtournoi-off-on">
						<div class="flex-row">
							<h3 class="titre3 uppercase">online</h3>
						</div>
						<img class="absolute img-responsiv-width img-absolute-bg opacity-05" src="web/img/online-bw-mode-bg.jpg" alt="mode">
					</div>
				</div>
			</div>
			<div class="creationtournoi-form-row creationtournoi-form-visibilité ta-center">
				<h3 class="titre2 ta-left">Visibilité et publication</h3>
				<div class="">
					<p class="titre3 ta-center dis-block">Votre tournoi sera</p>
					<div class="creationtournoi-input-group flex-column">			
						<div>
							<label>Visible</label>
							<input class="creationTournoi-input skew-8 ta-center" type="radio" name="visibilité" value="visible">				
						</div>
						<div>
							<label>Publication Programmée</label>
							<input class="creationTournoi-input skew-8 ta-center" type="radio" name="visibilité" checked value="programmee">
						</div>						
					</div>
				</div>
				<div class="flex-row">
					<div class="creationtournoi-input-group">
						<label for="date-visibilit">Tournoi visible le :</label>
						<input class="creationTournoi-input skew-8 ta-center" type="date" name="date-visibilité" required>
					</div>
				</div>
			</div>
			<div class="creationtournoi-form-row creationtournoi-form-participants ta-center">
			
			</div>
			<div class="creationtournoi-form-row flex-row">
				<button class="classic-btn relative"><a>Créer</a></button>
			</div>
		</form>
	</section>
</div>

 -->

<div class="creationtournoi-title-container display-block">
	<h1 class="capitalize title header-title">My title</h1>
</div>
<div class="creationtournoi-element-container">
	<div class="relative creationtournoi-element-choice">
		<img class="" src="web/img/typegame-fps.jpg" alt="">
		<h2 class="absolute title title-2 uppercase">fps</h2>
	</div>
	<div class="relative creationtournoi-element-choice">
		<img class="" src="web/img/typegame-fps.jpg" alt="">
		<h2 class="absolute title title-2 uppercase">fps</h2>
	</div>
	<div class="relative creationtournoi-element-choice">
		<img class="" src="web/img/typegame-fps.jpg" alt="">
		<h2 class="absolute title title-2 uppercase">fps</h2>
	</div>
	<div class="relative creationtournoi-element-choice">
		<img class="" src="web/img/typegame-fps.jpg" alt="">
		<h2 class="absolute title title-2 uppercase">fps</h2>
	</div>
	<div class="relative creationtournoi-element-choice">
		<img class="" src="web/img/typegame-fps.jpg" alt="">
		<h2 class="absolute title title-2 uppercase">fps</h2>
	</div>
	<div class="relative creationtournoi-element-choice">
		<img class="" src="web/img/typegame-fps.jpg" alt="">
		<h2 class="absolute title title-2 uppercase">fps</h2>
	</div>
</div>
<div class="creationtournoi-validation-container grid-xs-12 display-flex-column ">
	<button id="creationtournoi-valider" type="button" class="btn btn-pink"><a class="uppercase">suivant</a></button>
</div>

