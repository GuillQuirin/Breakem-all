<?php if(isset($tournoi)): ?>
	<section class="detailtournoi detailtournoi-infos display-flex-column">
		<article class="display-flex-column m-a">
			<h3 class="titre1 border-full ta-center">Tournoi -
				<span class="capitalize"><?php echo $tournoi->getGameName(); ?></span>
				<input id="sJeton" type="hidden" name="sJeton" value="<?php echo $_SESSION['sJeton'];?>">
			</h3>
			
				<p></p>
			<p class="detailtournoi-description-jeu italic <?php echo ($tournoi->getStatus() == -1) ? 'bg-pink title title-2': '' ?>">
				<?php if ($tournoi->getStatus() != -1): ?>
					<?php echo $tournoi->getGameDescription(); ?>
				<?php else:?>
					Ce tournoi est verrouillé
				<?php endif ?>
			</p>
			<div class="detail-tournoi-main-infos align display-flex-row">
				<div class="detail-tournoi-aside ta-center relative">
					<img src="<?php echo $tournoi->getGameImg();?>" alt="Battlefield 3">
					<figcaption class="ta-center italic">Pour les gamers sur <?php echo $tournoi->getPName();?> seulement !</figcaption>
					<?php if( isset($_isConnected) && !$tournoi->doesTournamentHaveWinner() ): ?>
						<?php if($tournoi->getUserPseudo() !== $_pseudo):?>
							<?php if((int) $tournoi->getMaxPlayer() - (int) $tournoi->getNumberRegistered() > 0 && $tournoi->getStatus() > -1): ?>
								<div class="relative ta-right">
									<?php if(isset($userAlrdyRegistered)):?>
									
									<?php else:?>
									<button class="detailtournoi-btn-inscription<?php echo ((bool)$tournoi->getRandomPlayerMix()) ? '' : '-choisie ' ?> relative btn btn-green"><a>Rejoindre</a></button>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						<?php else: ?>
							<div class="relative ta-right">
								<button class="detailtournoi-btn-gestion relative btn btn-pink">
									<a href="<?php echo WEBPATH.'/gestiontournoi?t='.$tournoi->getLink(); ?>">Gérer</a>
								</button>
								<?php if ($tournoi->isUserRegistered($_user)): ?>
									<button class="detailtournoi-btn-desinscription relative btn btn-pink"><a>Quitter</a></button>
								<?php else: ?>
									<button class="detailtournoi-btn-inscription<?php echo ((bool)$tournoi->getRandomPlayerMix()) ? '' : '-choisie ' ?> relative btn btn-green"><a>Rejoindre</a></button>
								<?php endif ?>
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
					<?php 
						if($tournoi->getStatus()=="-1")
							$restant=0;
						else
							$restant = ((int) $tournoi->getMaxPlayer()) - ((int) $tournoi->getNumberRegistered());
						if ( !$tournoi->doesTournamentHaveWinner() && !$tournoi->gtAllMatchs() ): 
					?>
						<p class="relative detailtournoi-jeu-mode capitalize bg-<?php if($restant > 0) echo 'green'; else echo 'pink'; ?>">places restantes:
							<span class="relative">
								<?php 
								echo $restant;
							 	?>
							</span>
						</p>
					<?php elseif( !$tournoi->doesTournamentHaveWinner() && is_array($tournoi->gtAllMatchs()) ) : ?>
						<p class="relative detailtournoi-jeu-mode bg-green">Le tournoi a commencé !</p>
					<?php else: ?>
						<p class="relative detailtournoi-jeu-mode bg-pink">Tournoi clôturé !</p>
					<?php endif ?>
					
					<!-- <p class="relative detailtournoi-points-gagnants">À gagner : 
						<span class="relative">XXX points
							<i class="absolute ta-center">??% (XX points) à répartir dans l'équipe gagnante</i>
						</span>
					</p> -->
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
					<!-- Si le tournoi a débuté -->
					<?php if (is_array($tournoi->gtAllMatchs())): ?>
						<?php $numberOfParticipatingTeams = count($tournoi->gtParticipatingTeams()); ?>
						<p class="relative detailtournoi-jeu-victoire">Règles: <span>en <?php echo $tournoi->gtNumberOfRoundsPlanned() ;?> manches</span></p>
					<?php endif ?>
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
					<p class="relative detailtournoi-jeu-organisateur">Organisateur : 
						<span class="uppercase"><a href="<?php echo WEBPATH. '/profil?pseudo=' . $tournoi->getUserPseudo(); ?>"><?php echo $tournoi->getUserPseudo(); ?></a></span>
					</p>
				</div>
			</div>			
		</article>
		<div class="detailtournoi-tournament-description display-flex-column m-a">
			<?php 
				if($tournoi->getStatus()=="-1")
					echo '<p class="title title-3 text-center m-a">Ce tournoi est cloturé.</p>';
				else{
					if(strlen(trim($tournoi->getDescription())) > 0)
						echo '<p class="m-a text-center title-2">'.trim($tournoi->getDescription()).'</p>';
					else
						echo "<p class='title title-3 text-center m-a'>Aucune description n'a été fournie pour ce tournoi</p>";
				}
			?>
		</div>
	</section>
	<?php if ($tournoi->doesTournamentHaveWinner()): ?>
		<?php $winningTeam = $tournoi->gtWinningTeam(); ?>
		<section class="detailtournoi detailtournoi-winner display-flex-column">
			<?php if ($tournoi->getMaxPlayerPerTeam() > 1): ?>
				<h3 class="title-2 border-full ta-center m-a bg-green">Remporté par l'équipe <?php echo $tournoi->gtPublicTeamIdToPrint($winningTeam); ?></h3>
				<div class="detailtournoi-winner-details display-flex-column">
					<h4 class="title-4 ta-center m-a">Les membres</h4>
					<?php foreach ($winningTeam->getUsers() as $key => $user): ?>
						<p class="detailtournoi-winner-users">
							<a href="<?php echo WEBPATH.'/profil?pseudo='.$user->getPseudo(); ?>"><?php echo $user->getPseudo();?></a>
						</p>
					<?php endforeach ?>
				</div>
			<?php else: ?>
				<h3 class="title-2 border-full ta-center m-a bg-green">Remporté par <a href="<?php echo WEBPATH.'/profil?pseudo='.$winningTeam->getUsers()[0]->getPseudo(); ?>"><?php echo $winningTeam->getUsers()[0]->getPseudo(); ?></a></h3>
			<?php endif ?>			
		</section>
	<?php endif ?>
	<section class="detailtournoi detailtournoi-matchs display-flex-column">
		<?php $availableMatchedAllPlayed = true;?>
		<?php if(!!$tournoi->gtAllMatchs()): ?>
			<h3 class="titre1 border-full ta-center">Les matchs</h3>
			<div class="detailtournoi-matchs-container full-width display-flex-column">
			<!-- On affiche les matchs par niveau -->
			<?php foreach ($tournoi->gtMatchesSortedByRank() as $rank => $arrayOfMatchedInRank): ?>
				<h3 class="detailtournoi-rank-number titre2 m-a ta-center capitalize"><!-- 
					 --><?php echo 
					 ( (!!getRoundNameFromMatchesInRank(count($arrayOfMatchedInRank)) 
					 					 && $rank > 1 
					 					 && ( $rank < $tournoi->gtNumberOfRoundsPlanned() && count($arrayOfMatchedInRank) != 1 )) 
					 	|| count($arrayOfMatchedInRank) == 1 && $rank == $tournoi->gtNumberOfRoundsPlanned()
					 ) 
					 ? 
					 getRoundNameFromMatchesInRank(count($arrayOfMatchedInRank)) 
					 : getIntInLetters($rank).' tour'; ?><!-- 
				--></h3>
				<div class="detailtournoi-matches-in-rank-container display-flex-row" id="detailtournoi-rank-<?php echo $rank; ?>">
					<!-- Matchs du niveau rank -->
					<?php foreach ($arrayOfMatchedInRank as $key => $match): ?>
						<!-- Matchs déjà joués -->
						<?php if (is_numeric($match->getIdWinningTeam())): ?>
							<div class="detailtournoi-match detailtournoi-finished-match display-flex-column m-a">
								<h3 class="title-4 ta-center m-a border-full bg-green">Match <?php echo $tournoi->gtPublicMatchIdToPrint($match); ?></h3>
								<div class="detailtournoi-match-teams m-a display-flex-row">
									<!-- Equipes du match  -->
									<?php $maxTCount= count($match->gtAllTeamsTournament())-1; $teamcount=0; ?>
									<?php foreach ($match->gtAllTeamsTournament() as $key => $teamInMatch): ?>
										<div class="detailtournoi-match-team m-a display-flex-column">
											<?php if ($teamInMatch->getId() == $match->getIdWinningTeam()): ?>
											<h4 class="detailtournoi-match-team-number bg-green">Equipe <?php echo $tournoi->gtPublicTeamIdToPrint($teamInMatch); ?></h4>
											<?php else: ?>
											<h4 class="detailtournoi-match-team-number">Equipe <?php echo $tournoi->gtPublicTeamIdToPrint($teamInMatch); ?></h4>
											<?php endif ?>
											<!-- Detail d'une équipe -->
											<div class="detailtournoi-match-team-detail m-a display-flex-column">
												<p class="detailtournoi-match-team-number-users"><?php echo $teamInMatch->getTakenPlaces(); ?> joueur<?php echo ($teamInMatch->getTakenPlaces() > 1) ? 's': ''; ?></p>
												<div class="detailtournoi-match-team-users-container display-flex-column">
													<?php foreach ($teamInMatch->getUsers() as $key => $userInTeam): ?>
														<a class="full-width m-a text-center" href="<?php echo WEBPATH.'/profil?pseudo='.$userInTeam->getPseudo(); ?>"><?php echo $userInTeam->getPseudo();?></a>
													<?php endforeach ?>
												</div>
											</div>
											
										</div>
										<!-- Séparateur de teams (VERSUS) -->
										<?php if ( $teamcount < $maxTCount ): ?>
											<img class="detailtournoi-match-team-separator" src="<?php echo WEBPATH;?>/web/img/icon/logo.ico" alt="versus">
										<?php endif ?>
										<?php $teamcount++; ?>
									<?php endforeach ?>
								</div>
							</div>
						<!-- Matchs non joués -->
						<?php else: ?>
							<?php $availableMatchedAllPlayed = false;?>
							<div class="detailtournoi-match detailtournoi-unfinished-match display-flex-column">
								<h3 class="titre3 ta-center m-a ">Match <?php echo $tournoi->gtPublicMatchIdToPrint($match); ?></h3>
								<div class="detailtournoi-match-teams display-flex-row">
									<!-- Equipes du match  -->
									<?php $maxTCount= count($match->gtAllTeamsTournament())-1; $teamcount=0; ?>
									<?php foreach ($match->gtAllTeamsTournament() as $key => $teamInMatch): ?>
										<div class="detailtournoi-match-team display-flex-column">
											<h4 class="detailtournoi-match-team-number">Equipe <?php echo $tournoi->gtPublicTeamIdToPrint($teamInMatch); ?></h4>
											<?php if (isset($_id) && $tournoi->getIdUserCreator() == $_id): ?>
												<button data-m="<?php echo $tournoi->gtPublicMatchIdToPrint($match); ?>" data-tt="<?php echo $tournoi->gtPublicTeamIdToPrint($teamInMatch); ?>" class="detailtournoi-btn-match-select-winner relative btn btn-pink m-a"><a>A gagné !</a></button>
											<?php endif ?>
											<!-- Detail d'une équipe -->
											<div class="detailtournoi-match-team-detail m-a display-flex-column">
												<p class="detailtournoi-match-team-number-users"><?php echo $teamInMatch->getTakenPlaces(); ?> joueur<?php echo ($teamInMatch->getTakenPlaces() > 1) ? 's': ''; ?></p>
												<div class="detailtournoi-match-team-users-container display-flex-column">
													<?php foreach ($teamInMatch->getUsers() as $key => $userInTeam): ?>
														<a class="full-width m-a text-center" href="<?php echo WEBPATH.'/profil?pseudo='.$userInTeam->getPseudo(); ?>"><?php echo $userInTeam->getPseudo();?></a>
													<?php endforeach ?>
												</div>
											</div>
											
										</div>
										<!-- Séparateur de teams (VERSUS) -->
										<?php if ( $teamcount < $maxTCount ): ?>
											<img class="detailtournoi-match-team-separator" src="<?php echo WEBPATH;?>/web/img/icon/logo.ico" alt="versus">
										<?php endif ?>										
										<?php $teamcount++; ?>
									<?php endforeach ?>
								</div>
							</div>
						<?php endif ?>
					<?php endforeach ?>
				</div>				
				<?php if (isset($tournoi->gtMatchesSortedByRank()[$rank+1])): ?>
					<div class="full-width m-a detailtournoi-rank-separator"></div>
				<?php endif ?>
			<?php endforeach ?>
			</div>
		<!-- Cas où aucun match n'a été joué -->
		<?php else: ?>
			<?php if (isset($_isConnected) && $tournoi->getUserPseudo() == $_pseudo ){
					if ($tournoi->getNumberRegistered() >= $tournoi->getMaxPlayer()/2)
						echo '<button id="detailtournoi-btn-create-matchs" class="relative btn btn-pink m-a"><a>Créer les premières rencontres !</a></button>';
					else{
					$placesRestantesRequises = $tournoi->getMaxPlayer()/2 - $tournoi->getNumberRegistered();
					if($tournoi->getStatus()!="-1")
						echo '<h3 class="title-4 border-full ta-center">Il vous faut encore '.$placesRestantesRequises.' participants pour lancer le tournoi !</h3>';

					}
				} 
			 endif; ?>
		<!-- Cas indépendant où le(s) premier(s) match(s) a/ont été joué(s) -->	
		<?php if(!!$tournoi->gtAllMatchs() && $availableMatchedAllPlayed ): ?>
			<?php if (!$tournoi->doesTournamentHaveWinner()): ?>
				<?php if (isset($_isConnected) && $tournoi->getUserPseudo() == $_pseudo ): ?>
					<button id="detailtournoi-btn-create-next-matchs" class="relative btn btn-pink m-a"><a>Créer les prochaines rencontres !</a></button>
				<?php else: ?>				
					<p class="title-4 m-a ta-center">En attente de <?php echo $tournoi->getUserPseudo(); ?> pour lancer les prochains matchs</p>
				<?php endif ?>
			<?php else: ?>
				<p class="detailtournoi-match-winner-announcement title-4 m-a ta-center"><span class="bg-green">L'équipe <?php echo $tournoi->gtPublicTeamIdToPrint($tournoi->gtWinningTeam()); ?></span> a gagné ce tournoi !</p>
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
	<!-- Si le match a commencé -->
	<?php if (is_array($tournoi->gtAllMatchs())): ?>
		<section class="detailtournoi full-width m-a detailtournoi-equipescompletes-section">
			<?php $participatingTeams = $tournoi->gtParticipatingTeams(); $numberOfParticipatingTeams = count($participatingTeams); ?>
				<div class="full-width m-a display-flex-column max-width-1260">
					<h2 class="titre2 border-full">Equipes participantes
						<span class="detailtournoi-nombre-equipeslibres bg-pink"><?php echo $numberOfParticipatingTeams;?></span>
					</h2>
					<div class="full-width detailtournoi-equipeslibres-container display-flex-row">
						<?php foreach($participatingTeams as $key => $team):?>
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
	<?php else: ?>
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
											<a>Rejoindre <?php echo $tournoi->gtPublicTeamIdToPrint($team);?></a>
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
	<?php endif ?>
<?php endif; ?>