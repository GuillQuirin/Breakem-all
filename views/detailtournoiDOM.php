<?php if(isset($tournoi)): ?>
	<section class="detailtournoi detailtournoi-infos flex">
		<article class="display-flex-column">
			<h3 class="titre1 border-full ta-center">Tournoi -
				<span class="capitalize"><?php echo $tournoi->getGameName(); ?></span>
				<input id="sJeton" type="hidden" name="sJeton" value="<?php echo $_SESSION['sJeton'];?>">
			</h3>
			<p class="detailtournoi-description-jeu italic">
				<?php echo $tournoi->getGameDescription(); ?>
			</p>
			<div class="detail-tournoi-main-infos align display-flex-row">
				<div class="detail-tournoi-aside ta-center relative">
					<img src="<?php echo $tournoi->getGameImg();?>" alt="Battlefield 3">
					<figcaption class="ta-center italic">Pour les gamers sur <?php echo $tournoi->getPName();?> seulement !</figcaption>
					<?php if(isset($_isConnected)): ?>
						<?php if($tournoi->getUserPseudo() !== $_pseudo):?>
							<?php if((int) $tournoi->getMaxPlayer() - (int) $tournoi->getNumberRegistered() > 0): ?>
								<div class="relative ta-right">
									<?php if(isset($userAlrdyRegistered)):?>
									<button class="detailtournoi-btn-desinscription relative btn btn-pink"><a>Quitter</a></button>
									<?php else:?>
									<button class="detailtournoi-btn-inscription<?php echo ((bool)$tournoi->getRandomPlayerMix()) ? '' : '-choisie ' ?> relative btn btn-green"><a>Rejoindre</a></button>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						<?php else: ?>
							<div class="relative ta-right">
								<button class="detailtournoi-btn-inscription relative btn btn-pink">
									<a href="<?php echo WEBPATH.'/gestiontournoi?t='.$tournoi->getLink(); ?>">Gérer</a>
								</button>
							</div>
						<?php endif; ?>
					<?php endif; ?>
				</div>
				<div class="detailtournoi-tournoi-regles flex">
					<p class="relative detailtournoi-jeu-mode capitalize">Mode:
						<span class="relative">
							<?php echo $tournoi->getGvName();
								if($tournoi->getMaxPlayerPerTeam() > 1){
									echo " - Equipes";
									if($tournoi->getGuildOnly() > 0)
										echo " de guildes uniquement";
									else if($tournoi->getRandomPlayerMix() > 0)
										echo " aléatoires";
								}
						 	?>
							<i class="absolute ta-center lowercase"><?php echo $tournoi->getGvDescription(); ?>
							</i>
						</span>
					</p>
					<?php $restant = ((int) $tournoi->getMaxPlayer()) - ((int) $tournoi->getNumberRegistered());?>
					<p class="relative detailtournoi-jeu-mode capitalize bg-<?php if($restant > 0) echo 'green'; else echo 'pink'; ?>">places restantes:
						<span class="relative">
							<?php 
							echo $restant;
						 	?>
						</span>
					</p>
					<p class="relative detailtournoi-points-gagnants">À gagner : 
						<span class="relative">XXX points
							<i class="absolute ta-center">??% (XX points) à répartir dans l'équipe gagnante</i>
						</span>
					</p>
					<p class="relative detailtournoi-jeu-console">Console: 
						<span class="capitalize"><?php echo $tournoi->getPName(); ?></span>
					</p>
					<p class="relative detailtournoi-jeu-online">Où: 
						<span class="capitalize">online</span>
					</p>
					<p class="relative detailtournoi-jeu-maxjoueurs">Joueurs max: 
						<span><?php echo $tournoi->getMaxPlayer(); ?></span>
					</p>
					<p class="relative detailtournoi-jeu-minjoueurs">Joueurs min: <span><?php echo $tournoi->getMaxPlayer()/2; ?></span></p>
					<p class="relative detailtournoi-jeu-victoire">Règles: <span>rencontres de XX (3??) manches</span></p>
					<p class="relative detailtournoi-jeu-reglesEquipe">Equipes: 
						<span><?php 						
							if($tournoi->getMaxPlayerPerTeam() > 1){
								echo "Equipes de " . $tournoi->getMaxPlayerPerTeam();
								if($tournoi->getGuildOnly() > 0)
									echo " - Guildes uniquement";
								else if($tournoi->getRandomPlayerMix() > 0)
									echo " - Aléatoires";
								else
									echo " - Au choix";
							}else{
								echo "Solo";
							}
					 	?></span>
					</p>
					<p class="relative detailtournoi-jeu-date">Quand : 
						<span><?php echo date('d-m-Y',$tournoi->getStartDate());?></span>
					</p>
					<p class="relative detailtournoi-jeu-organisateur">Orga : 
						<span class="uppercase"><a href="<?php echo WEBPATH. '/profil?pseudo=' . $tournoi->getUserPseudo(); ?>"><?php echo $tournoi->getUserPseudo(); ?></a></span>
					</p>
				</div>
			</div>			
		</article>
	</section>
	<?php if ($tournoi->doesTournamentHaveWinner()): ?>
		<section class="detailtournoi detailtournoi-winner">
			<h3 class="titre2 border-full ta-center">Remporté par l'équipe X</h3>
		</section>
	<?php endif ?>
	<section class="detailtournoi detailtournoi-matchs display-flex-column">
		<?php if(!!$tournoi->gtAllMatchs()): ?>
		<?php  ?>
			<h3 class="titre1 border-full ta-center">Les matchs</h3>
			<div class="detailtournoi-matchs-container full-width display-flex-column">
			<!-- On affiche les matchs par niveau -->
			<?php foreach ($tournoi->gtMatchesSortedByRank() as $rank => $arrayOfMatchedInRank): ?>
				<div class="detailtournoi-matches-in-rank-container display-flex-row" id="detailtournoi-rank-<?php echo $rank; ?>">
					<!-- Matchs du niveau rank -->
					<?php foreach ($arrayOfMatchedInRank as $key => $match): ?>
						
						<!-- Matchs déjà joués -->
						<?php if (is_numeric($match->gtWinningTeam())): ?>
							<div class="detailtournoi-match detailtournoi-finished-match display-flex-column">
								<h3 class="titre4 ta-center m-a border-full bg-success">Match <?php echo $tournoi->gtPublicMatchIdToPrint($match); ?></h3>
								<div class="detailtournoi-match-teams display-flex-column">
									
								</div>
							</div>
						<!-- Matchs non joués -->
						<?php else: ?>
							<div class="detailtournoi-match detailtournoi-unfinished-match">
								<h3 class="titre4 ta-center m-a border-full bg-pink">Match <?php echo $tournoi->gtPublicMatchIdToPrint($match); ?></h3>
								<div class="detailtournoi-match-teams display-flex-column">
									<!-- Equipes du match  -->
									<?php foreach ($match->gtAllTeamsTournament() as $key => $teamInMatch): ?>
										<div class="detailtournoi-match-team display-flex-column">
											<h4 class="detailtournoi-match-team-number">Equipe <?php echo $tournoi->gtPublicTeamIdToPrint($teamInMatch); ?></h4>
											<!-- Detail d'une équipe -->
											<div class="detailtournoi-match-team-detail display-flex-column">
												<p class="detailtournoi-match-team-number-users"><?php echo $teamInMatch->getTakenPlaces(); ?> joueur<?php echo ($teamInMatch->getTakenPlaces() > 1) ? 's': ''; ?></p>
												<div class="detailtournoi-match-team-users-container display-flex-column">
													<?php foreach ($teamInMatch->getUsers() as $key => $userInTeam): ?>
														<a class="full-width m-a text-center" href="<?php echo WEBPATH.'/profil?pseudo='.$userInTeam->getPseudo(); ?>"><?php echo $userInTeam->getPseudo();?></a>
													<?php endforeach ?>
												</div>
											</div>
											
										</div>
										<!-- Séparateur de teams (VERSUS) -->
										<?php if (isset($match->gtAllTeamsTournament()[$key+1])): ?>
											<p class="detailtournoi-match-team-separator uppercase title-7">versus</p>
										<?php endif ?>
									<?php endforeach ?>
								</div>
							</div>
						<?php endif ?>
					<?php endforeach ?>
				</div>
				
				
			<?php endforeach ?>
			</div>
		<?php else: ?>
			<?php if (isset($_isConnected) && $tournoi->getUserPseudo() == $_pseudo ): ?>
				<?php if ($tournoi->getNumberRegistered() >= $tournoi->getMaxPlayer()/2): ?>
					<button id="detailtournoi-btn-create-matchs" class="relative btn btn-pink m-a"><a>Créer les premières rencontres !</a></button>
				<?php else: ?>
					<?php $placesRestantesRequises = $tournoi->getMaxPlayer()/2 - $tournoi->getNumberRegistered();?>
					<h3 class="titre4 border-full ta-center">Il vous faut encore <?php echo $placesRestantesRequises;?> participants pour lancer le tournoi !</h3>
				<?php endif ?>
			<?php endif ?>
		<?php endif; ?>
	</section>
	<?php if(isset($allRegistered)):?>
		<section class="detailtournoi detailtournoi-participants">
			<div class="full-width m-a display-flex-row max-width-1260">
				<?php $cntReg = count($allRegistered); ?>
				<h2 class="titre2 border-full">Participant<?php if($cntReg > 1)echo's';?>
					<span class="detailtournoi-nombre-participants bg-pink"><?php echo $cntReg;?></span>
				</h2>
				<div class="flex detailtournoi-liste-participants">
				<?php foreach ($allRegistered as $key => $user): ?>			
					<div class="detailtournoi-participant relative flex">
						<p class="detailtournoi-participant-pseudo"><a href="<?php echo WEBPATH.'/profil?pseudo='.$user->getPseudo(); ?>"><?php echo $user->getPseudo();?></a><span class="absolute detailtournoi-stats-joueur">XX victoires, XX%win</span></p>
						<p class="detailtournoi-participant-points absolute">XXXX points</p>
					</div>
				<?php endforeach; ?>				
				</div>
			</div>
		</section>
	<?php endif; ?>
	<?php if(isset($freeTeams)): ?>
		<section class="detailtournoi full-width m-a detailtournoi-equipeslibres-section">
			<div class="full-width m-a display-flex-column max-width-1260">
				<h2 class="titre2 border-full">Equipes rejoignables
					<span class="detailtournoi-nombre-equipeslibres bg-green"><?php echo count($freeTeams);?></span>
				</h2>
				<div class="full-width detailtournoi-equipeslibres-container display-flex-row">
					<?php foreach($freeTeams as $key => $team):?>
						<?php $placesLeft = (int) $tournoi->getMaxPlayerPerTeam() - count($team->getUsers());?>
						<div class="detailtournoi-equipelibre overflow-hidden relative">
							<h5 class="relative m-a text-center capitalize overflow-hidden">equipe <?php echo $tournoi->gtPublicTeamIdToPrint($team); ?>
								<span class="equipelibre-espace bg-green absolute absolute-0-100"><?php echo $placesLeft;?></span>
							</h5>
							<div class="full-width full-height m-a display-flex-column flex-end absolute absolute-0-0">
								<?php if(count($team->getUsers()) > 0):?>
									<div class="full-width m-a equipelibre-joueurs-container display-flex-column">
										<?php foreach($team->getUsers() as $key => $user):?>
											<a class="full-width m-a text-center" href="<?php echo WEBPATH.'/profil?pseudo='.$user->getPseudo(); ?>"><?php echo $user->getPseudo();?></a>
										<?php endforeach;?>
									</div>
								<?php else: ?>
									<div class="full-width m-a">
										<p class="text-center m-a">Aucun joueur dans cette équipe</p>
									</div>
								<?php endif; ?>
								<?php if( isset($_isConnected) && !((bool)$tournoi->getRandomPlayerMix()) && canUserRegisterToTournament($_user, $tournoi) && canUserRegisterToTeamTournament($_user, $tournoi, $team) ):?>
									<input type="hidden" class="equipelibre-tt-id" value="<?php echo $team->getId() ;?>" name="ttId">
									<button class="equipelibre-btn-inscription relative btn btn-green inverse-border-full">
										<a>Rejoindre <?php echo $teamNumber;?></a>
									</button>
								<?php endif; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>
	<?php if(isset($fullTeams)): ?>
		<section class="detailtournoi full-width m-a detailtournoi-equipescompletes-section">
			<div class="full-width m-a display-flex-column max-width-1260">
				<h2 class="titre2 border-full">Equipes complètes
					<span class="detailtournoi-nombre-equipeslibres bg-pink"><?php echo count($fullTeams);?></span>
				</h2>
				<div class="full-width detailtournoi-equipeslibres-container display-flex-row">
					<?php foreach($fullTeams as $key => $team):?>
						<div class="detailtournoi-equipecomplete overflow-hidden relative">
							<h5 class="relative m-a text-center capitalize overflow-hidden">equipe <?php echo $tournoi->gtPublicTeamIdToPrint($team); ?>
								<span class="equipecomplete-espace bg-pink absolute absolute-0-100"><?php echo count($team->getUsers());?></span>
							</h5>
							<div class="full-width full-height m-a display-flex-column flex-end absolute absolute-0-0">							
								<div class="full-width m-a equipecomplete-joueurs-container display-flex-column">
									<?php foreach($team->getUsers() as $key => $user):?>
										<a class="m-a text-center" href="<?php echo WEBPATH.'/profil?pseudo='.$user->getPseudo(); ?>"><?php echo $user->getPseudo();?></a>
									<?php endforeach;?>
								</div>					
							</div>						
						</div>
					<?php endforeach; ?>
				</div>
			</div>			
		</section>
	<?php endif; ?>
	<!-- <section class="detailtournoi-bracket">
		<h2 class="titre2">Resultats des rounds - Bracket</h2>
	</section> -->
<?php endif; ?>