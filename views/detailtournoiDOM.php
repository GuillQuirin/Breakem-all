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
							<?php if((int) $tournoi->getMaxPlayer() - (int) $tournoi->getNumberRegistered() > 0): ?>
								<div class="relative ta-right">
									<button class="detailtournoi-btn-inscription relative btn btn-pink"><a>Rejoindre</a></button>
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
					<p class="relative detailtournoi-jeu-mode capitalize <?php if($restant > 0) echo 'place-a-prendre'; else echo 'aucune-place-restante'; ?>">places restantes:
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
		<section class="detailtournoi-participants flex-row">
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
		</section>
	<?php endif; ?>
	<?php if(isset($freeTeams)): ?>
		<section class="detailtournoi-equipeslibres display-flex-column">
			<h2 class="titre2 border-full">Equipes rejoignables</h2>
			<div class="detailtournoi-equipeslibres-container display-flex-row">
				<?php foreach($freeTeams as $key => $team):?>
					<div class="detailtournoi-equipelibre">
						<h5>equipe libre mon frere</h5>
					</div>
				<?php endforeach; ?>
			</div>
		</section>
	<?php endif; ?>
	<?php if(isset($fullTeams)): ?>
		<section class="detailtournoi-equipeslibres display-flex-column">
			<h2 class="titre2 border-full">Equipes complètes</h2>
			<div class="detailtournoi-equipeslibres-container display-flex-row">
				<?php foreach($fullTeams as $key => $team):?>
					<div class="detailtournoi-equipecomplete">
						<h5>equipe complete mon frere</h5>
					</div>
				<?php endforeach; ?>
			</div>
		</section>
	<?php endif; ?>
	<!-- <section class="detailtournoi-bracket">
		<h2 class="titre2">Resultats des rounds - Bracket</h2>
	</section> -->
	<!-- <section class="detailtournoi-commentaires flex-row">
		<h2 class='titre2'>Commentaires</h2>
		<div class="detailtournoi-container-commentaires">
			<div class="relative detailtournoi-commentaire">
				<div class="detailtournoi-commentaire-date italic ta-right">
					<h5>16/02 09:08</h5>
				</div>
				<div class="detailtournoi-commentaire-pseudo">
					<p><a>dRowiid</a></p>
				</div>
				<div class="detailtournoi-commentaire-userpick">
					<p class="detailtournoi-message">Futura quidem sed Mihi hodie qualis autem futurum ire coepit Mihi sed inferentem quis supplicio.</p>
				</div>
			</div>
			<div class="relative detailtournoi-commentaire">
				<div class="detailtournoi-commentaire-date italic ta-right">
					<h5>Lun 02:00</h5>
				</div>
				<div class="detailtournoi-commentaire-pseudo">
					<p><a>Fyjal</a></p>
				</div>
				<div class="detailtournoi-commentaire-userpick">
					<p class="detailtournoi-message">Futura quidem sed Mihi hodie qualis autem futurum ire coepit Mihi sed inferentem quis supplicio.</p>
				</div>
			</div>
			<div class="relative detailtournoi-commentaire">
				<div class="detailtournoi-commentaire-date italic ta-right">
					<h5>Lun 03:12</h5>
				</div>
				<div class="detailtournoi-commentaire-pseudo">
					<p><a>Ypsos</a></p>
				</div>
				<div class="detailtournoi-commentaire-userpick">
					<p class="detailtournoi-message">Valet amicitiam ad comparandis ferendum potius Quin ad praeceptum quem amicitiam adhiberemus amare ferendum amicitiis.</p>
				</div>
			</div>
			<div class="relative detailtournoi-commentaire">
				<div class="detailtournoi-commentaire-date italic ta-right">
					<h5>Lun 03:17</h5>
				</div>
				<div class="detailtournoi-commentaire-pseudo">
					<p><a>OopsIdian</a></p>
				</div>
				<div class="detailtournoi-commentaire-userpick">
					<p class="detailtournoi-message">Saeculis Damascus quibus Damascus et monti urbibus Berytus Emissa magnis Sidon celebritateque quibus quibus adclinis.</p>
				</div>
			</div>
			<div class="relative detailtournoi-commentaire detailtournoi-commentaire-current-user">
				<div class="detailtournoi-commentaire-date italic ta-right">
					<h5>Mar 19:17</h5>
				</div>
				<div class="detailtournoi-commentaire-pseudo">
					<p><a>Toi</a></p>
				</div>
				<div class="detailtournoi-commentaire-userpick">
					<p class="detailtournoi-message">Saeculis Damascus quibus Damascus et monti urbibus Berytus Emissa magnis Sidon celebritateque quibus quibus adclinis.</p>
				</div>
			</div>
			<div class="relative detailtournoi-commentaire">
				<div class="detailtournoi-commentaire-date italic ta-right">
					<h5>Mar 20:12</h5>
				</div>
				<div class="detailtournoi-commentaire-pseudo">
					<p><a>RxR_d</a></p>
				</div>
				<div class="detailtournoi-commentaire-userpick">
					<p class="detailtournoi-message">Constantio aetatis e atque praefecturae consulares inmaturo et quadriennio ipse.</p>
				</div>
			</div>
		</div>
		<div class="detailtournoi-container-post-commentaire">
			<div class="detailtournoi-post-container">
				<form  method="post">
					<textarea name="commentaire-post" cols="30" rows="10" placeholder="Votre message ici.." maxlength="255"></textarea>
					<input type="submit" value="" hidden>
				</form>
			</div>
		</div>
	</section> -->
<?php endif; ?>