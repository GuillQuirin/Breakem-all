<?php if(isset($tournoi)): ?>
	<section class="detailtournoi-infos flex">
		<article class="display-flex-column">			
			<h3 class="titre1 border-full ta-center">Tournoi - 
				<span class="capitalize"><?php echo $tournoi->getGameName(); ?></span>
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
							<?php if((int) $tournoi->getMaxPlayer() - (int) $tournoi->getNumberRegistered() > 0 && !isset($userAlrdyRegistered)): ?>
								<div class="relative ta-right">
									<button class="detailtournoi-btn-inscription relative btn btn-green"><a>Rejoindre</a></button>
									<input id="sJeton" type="hidden" name="sJeton" value="<?php echo $sJeton;?>">
								</div>
							<?php endif; ?>
						<?php else: ?>
							<div class="relative ta-right">
								<button class="detailtournoi-btn-inscription relative btn btn-pink"><a>Gérer</a></button>
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
					<?php $restant = (int) $tournoi->getMaxPlayer() - (int) $tournoi->getNumberRegistered();?>
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
	<?php if(isset($allRegistered)):?>
		<section class="detailtournoi-participants">
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
	<?php $teamNumber = 1;?>
	<?php if(isset($freeTeams)): ?>
		<section class="full-width m-a detailtournoi-equipeslibres-section">
			<div class="full-width m-a display-flex-column max-width-1260">
				<h2 class="titre2 border-full">Equipes rejoignables
					<span class="detailtournoi-nombre-equipeslibres bg-green"><?php echo count($freeTeams);?></span>
				</h2>
				<div class="full-width detailtournoi-equipeslibres-container display-flex-row">				
					<?php foreach($freeTeams as $key => $team):?>
						<?php $placesLeft = (int) $tournoi->getMaxPlayerPerTeam() - count($team->getUsers());?>
						<div class="detailtournoi-equipelibre overflow-hidden relative">
							<h5 class="relative m-a text-center capitalize overflow-hidden">equipe <?php echo $teamNumber;?>
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
					<?php  $teamNumber++; endforeach; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>
	<?php if(isset($fullTeams)): ?>
		<section class="full-width m-a detailtournoi-equipescompletes-section">
			<div class="full-width m-a display-flex-column max-width-1260">
				<h2 class="titre2 border-full">Equipes complètes
					<span class="detailtournoi-nombre-equipeslibres bg-pink"><?php echo count($fullTeams);?></span>
				</h2>
				<div class="full-width detailtournoi-equipeslibres-container display-flex-row">
					<?php foreach($fullTeams as $key => $team):?>
						<div class="detailtournoi-equipecomplete overflow-hidden relative">
							<h5 class="relative m-a text-center capitalize overflow-hidden">equipe <?php echo $teamNumber;?>
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
					<?php  $teamNumber++; endforeach; ?>
				</div>
			</div>			
		</section>
	<?php endif; ?>
	<!-- <section class="detailtournoi-bracket">
		<h2 class="titre2">Resultats des rounds - Bracket</h2>
	</section> -->
<?php endif; ?>