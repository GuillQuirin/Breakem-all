	<div class="tournamentslist-title-container display-flex-column">
		<h2 class="title title-2 m-a text-center">
			<?php if(isset($tournois)): ?>
				Liste des tournois
			<?php else: ?>
				Aucun tournoi ne correspond à votre recherche
			<?php endif; ?>
		</h2>
		<?php if(isset($tournois)): ?>
			<?php $count = count($tournois); ?>
			<p class="tournamentslist-number-fetched-tournaments m-a text-center title-4"><?php echo ($count > 1) ? $count. ' tournois correspondent' : $count . ' tournoi correspond';  ?> à votre recherche</p>
			<?php if(isset($userCanRegisterTournaments)): ?>
				<?php $count = count($userCanRegisterTournaments); ?>
				<p class="tournamentslist-number-fetched-tournaments-accesible m-a text-center italic title-7"><?php echo ($count > 1) ? $count. ' tournois vous sont accessibles' : $count . 'tournoi vous est accessible';  ?></p>
			<?php else: ?>
				<?php if (!isset($ownedTournaments) && isset($_isConnected) ): ?>
					<p class="tournamentslist-number-fetched-tournaments-accesible tournamentslist-number-fetched-tournaments-accesible-none m-a text-center italic title-7 bg-pink">Aucun tournoi ne vous est accessible</p>
				<?php endif ?>
			<?php endif; ?>
		<?php endif; ?>
	</div>
	<?php if (isset($ownedTournaments)): ?>
		<section class="tournamentslist-tournoi-owner display-flex-column">
			<?php if (count($ownedTournaments) > 1): ?>
				<h3 class="tournamentslist-bigdiv-title tournamentslist-owner-title title title-1 m-a text-center capitalize">vos tournois</h3>
			<?php else: ?>
				<h3 class="tournamentslist-bigdiv-title tournamentslist-owner-title title title-1 m-a text-center capitalize">votre tournoi</h3>
			<?php endif ?>
			
			<div class="m-a display-flex-column">
				<?php foreach ($ownedTournaments as $key => $t): ?>
					<?php if ($t->doesTournamentHaveWinner()): ?>
						<div class="tournamentslist-tournoi-element relative display-flex-row">
							<div class="relative display-flex-row full-width">
								<aside class="full-height relative display-flex-column m-a">
									<p class="m-a text-center title-7 italic"><?php echo $t->getName(); ?></p>
									<img class="m-a text-center full-width" src="<?php echo $t->getGameImg(); ?>" alt="">
									<figcaption class="m-a title-7 italic">Le <?php echo date('d-m-Y', $t->getStartDate()) . ' par <a href="'. WEBPATH. '/profil?pseudo=' . $t->getUserPseudo().'">' . $t->getUserPseudo() .'</a>'; ?></figcaption>
								</aside>
								<article class="m-a display-flex-column">
									<h2 class="m-a text-center title title-1 capitalize"><a href="<?php echo WEBPATH.'/tournoi?t=' .$t->getLink();?>"><?php echo $t->getGameName(); ?></a></h2>
									<p class="m-a text-center title-3"><?php echo $t->getPName(); ?></p>
									<p class="m-a text-center title-3"><?php echo $t->getGvName(); ?></p>
									<?php if($t->getMaxPlayerPerTeam() > 1): ?>
										<p class="title-3"><?php echo $t->getMaxTeam() . ' équipes de ' . $t->getMaxPlayerPerTeam(); ?> joueurs</p>
									<?php else: ?>
										<p class="title-3 capitalize">solo</p>
									<?php endif; ?>
									<p class="tournamentslist-p-over-statement m-a text-center title title-5 bg-pink">Fini</p>
								</article>
							</div>
							<span type="button" class="btn btn-pink"><a href="<?php echo WEBPATH.'/tournoi?t=' .$t->getLink();?>">Gérer</a></span>
						</div>
					<?php else: ?>
						<div class="tournamentslist-tournoi-element relative display-flex-row">
							<div class="relative display-flex-row full-width">
								<aside class="full-height relative display-flex-column m-a">
									<p class="m-a text-center title-7 italic"><?php echo $t->getName(); ?></p>
									<img class="m-a text-center full-width" src="<?php echo $t->getGameImg(); ?>" alt="">
									<figcaption class="m-a title-7 italic">Le <?php echo date('d-m-Y', $t->getStartDate()) . ' par <a href="'. WEBPATH. '/profil?pseudo=' . $t->getUserPseudo().'">' . $t->getUserPseudo() .'</a>'; ?></figcaption>
								</aside>
								<article class="m-a display-flex-column">
									<h2 class="m-a text-center title title-1 capitalize"><a href="<?php echo WEBPATH.'/tournoi?t=' .$t->getLink();?>"><?php echo $t->getGameName(); ?></a></h2>
									<p class="m-a text-center title-3"><?php echo $t->getPName(); ?></p>
									<p class="m-a text-center title-3"><?php echo $t->getGvName(); ?></p>
									<?php if($t->getMaxPlayerPerTeam() > 1): ?>
										<p class="title-3"><?php echo $t->getMaxTeam() . ' équipes de ' . $t->getMaxPlayerPerTeam(); ?> joueurs</p>
									<?php else: ?>
										<p class="title-3 capitalize">solo</p>
									<?php endif; ?>
								</article>
							</div>
							<span type="button" class="btn btn-pink"><a href="<?php echo WEBPATH.'/tournoi?t=' .$t->getLink();?>">Gérer</a></span>	
						</div>
					<?php endif ?>
					
				<?php endforeach; ?>
			</div>
		</section>
	<?php endif ?>

<?php if(isset($tournois) || (isset($userCanRegisterTournaments) || isset($closedToUserTournaments) || isset($joinedTournament) ) ): ?>
	<section class="tournamentslist-tournoi display-flex-row">
	<?php if (isset($userCanRegisterTournaments)): ?>
		<div class="tournamentslist-accessible-tournaments-container display-flex-column m-a">
			<h3 class="tournamentslist-bigdiv-title title title-1 m-a text-center">Tournois accessibles</h3>
			<?php foreach ($userCanRegisterTournaments as $key => $t): ?>
				<div class="tournamentslist-tournoi-element relative display-flex-row">
					<div class="tournamentslist-tournoi-element relative display-flex-row">
						<div class="relative display-flex-row full-width">
							<aside class="full-height relative display-flex-column m-a">
								<p class="m-a text-center title-7 italic"><?php echo $t->getName(); ?></p>
								<img class="m-a text-center full-width" src="<?php echo $t->getGameImg(); ?>" alt="">
								<figcaption class="m-a title-7 italic">Le <?php echo date('d-m-Y', $t->getStartDate()) . ' par <a href="'. WEBPATH. '/profil?pseudo=' . $t->getUserPseudo().'">' . $t->getUserPseudo() .'</a>'; ?></figcaption>
							</aside>
							<article class="m-a display-flex-column">
								<h2 class="m-a text-center title title-1 capitalize"><a href="<?php echo WEBPATH.'/tournoi?t=' .$t->getLink();?>"><?php echo $t->getGameName(); ?></a></h2>
								<p class="m-a text-center title-3"><?php echo $t->getPName(); ?></p>
								<p class="m-a text-center title-3"><?php echo $t->getGvName(); ?></p>
								<?php if($t->getMaxPlayerPerTeam() > 1): ?>
									<p class="title-3"><?php echo $t->getMaxTeam() . ' équipes de ' . $t->getMaxPlayerPerTeam(); ?> joueurs</p>
								<?php else: ?>
									<p class="title-3 capitalize">solo</p>
								<?php endif; ?>
								<?php $restant = ((int) $t->getMaxPlayer()) - ((int) $t->getNumberRegistered());?>
								<p class="tournamentslist-left-places title-4 bg-green"><?php echo ($restant > 1) ? $restant.' places restantes' : $restant.' place restante';?> </p>
							</article>
						</div>
						<span type="button" class="btn btn-pink"><a href="<?php echo WEBPATH.'/tournoi?t=' .$t->getLink();?>">Voir</a></span>	
					</div>
				</div>
			<?php endforeach; ?>
		</div>		
	<?php endif ?>
	<?php if (isset($closedToUserTournaments)): ?>
		<div class="tournamentslist-closedToUser-tournaments-container display-flex-column m-a">
			<h3 class="tournamentslist-bigdiv-title title title-1 m-a text-center"><!--
			--><?php if (count($closedToUserTournaments) > 1): ?><!--
				-->Tournois fermés<!--
			--><?php else: ?><!--
				-->Tournoi fermé<!--
			--><?php endif ?><!--
			--></h3>
			<?php foreach ($closedToUserTournaments as $key => $t): ?>
				<div class="tournamentslist-tournoi-element relative display-flex-row">
					<aside class="full-height relative display-flex-column m-a">
						<p class="m-a text-center title-7 italic"><?php echo $t->getName(); ?></p>
						<img class="m-a text-center full-width" src="<?php echo $t->getGameImg(); ?>" alt="">
						<figcaption class="m-a title-7 italic">Le <?php echo date('d-m-Y', $t->getStartDate()) . ' par <a href="'. WEBPATH. '/profil?pseudo=' . $t->getUserPseudo().'">' . $t->getUserPseudo() .'</a>'; ?></figcaption>
					</aside>
					<article class="m-a display-flex-column">
						<h2 class="m-a text-center title title-1 capitalize"><a href="<?php echo WEBPATH.'/tournoi?t=' .$t->getLink();?>"><?php echo $t->getGameName(); ?></a></h2>
						<p class="m-a text-center title-3"><?php echo $t->getPName(); ?></p>
						<p class="m-a text-center title-3"><?php echo $t->getGvName(); ?></p>
						<?php if($t->getMaxPlayerPerTeam() > 1): ?>
							<p class="title-3"><?php echo $t->getMaxTeam() . ' équipes de ' . $t->getMaxPlayerPerTeam(); ?> joueurs</p>
						<?php else: ?>
							<p class="title-3 capitalize">solo</p>
						<?php endif; ?>
						<?php if ($t->doesTournamentHaveWinner()): ?>
							<p class="tournamentslist-p-over-statement m-a text-center title title-5 bg-pink">Fini</p>
						<?php endif; ?>
					</article>
				</div>
			<?php endforeach; ?>
		</div>		
	<?php endif ?>
	<?php if (isset($joinedTournament)): ?>
		<div class="tournamentslist-closedToUser-tournaments-container display-flex-column m-a">
			<h3 class="tournamentslist-bigdiv-title title title-1 m-a text-center"><!--
			--><?php if (count($joinedTournament) > 1): ?><!--
				-->Tournois rejoints<!--
			--><?php else: ?><!--
				-->Tournoi rejoint<!--
			--><?php endif ?><!--
			--></h3>
			<?php foreach ($joinedTournament as $key => $t): ?>
				<div class="tournamentslist-tournoi-element relative display-flex-row">
					<div class="tournamentslist-tournoi-element relative display-flex-row">
							<div class="relative display-flex-row full-width">
								<aside class="full-height relative display-flex-column m-a">
									<p class="m-a text-center title-7 italic"><?php echo $t->getName(); ?></p>
									<img class="m-a text-center full-width" src="<?php echo $t->getGameImg(); ?>" alt="">
									<figcaption class="m-a title-7 italic">Le <?php echo date('d-m-Y', $t->getStartDate()) . ' par <a href="'. WEBPATH. '/profil?pseudo=' . $t->getUserPseudo().'">' . $t->getUserPseudo() .'</a>'; ?></figcaption>
								</aside>
								<article class="m-a display-flex-column">
									<h2 class="m-a text-center title title-1 capitalize"><a href="<?php echo WEBPATH.'/tournoi?t=' .$t->getLink();?>"><?php echo $t->getGameName(); ?></a></h2>
									<p class="m-a text-center title-3"><?php echo $t->getPName(); ?></p>
									<p class="m-a text-center title-3"><?php echo $t->getGvName(); ?></p>
									<?php if($t->getMaxPlayerPerTeam() > 1): ?>
										<p class="title-3"><?php echo $t->getMaxTeam() . ' équipes de ' . $t->getMaxPlayerPerTeam(); ?> joueurs</p>
									<?php else: ?>
										<p class="title-3 capitalize">solo</p>
									<?php endif; ?>									
								</article>
							</div>
							<span type="button" class="btn btn-pink"><a href="<?php echo WEBPATH.'/tournoi?t=' .$t->getLink();?>">Voir</a></span>
						</div>
				</div>
			<?php endforeach; ?>
		</div>		
	<?php endif ?>
	<?php if (!isset($_isConnected) || (isset($tournois) && ((!isset($userCanRegisterTournaments) || !isset($closedToUserTournaments) || !isset($joinedTournament)) )) ): ?>
		<div class="tournamentslist-closedToUser-tournaments-container display-flex-column m-a">
			<h3 class="tournamentslist-bigdiv-title title title-1 m-a text-center"><!--
			--><?php if (count($tournois) > 1): ?><!--
				-->Tournois<!--
			--><?php else: ?><!--
				-->Tournoi<!--
			--><?php endif ?><!--
			--></h3>
			<?php foreach ($tournois as $key => $t): ?>
				<div class="tournamentslist-tournoi-element relative display-flex-row">
					<div class="relative display-flex-row full-width">
						<aside class="full-height relative display-flex-column m-a">
							<p class="m-a text-center title-7 italic"><?php echo $t->getName(); ?></p>
							<img class="m-a text-center full-width" src="<?php echo $t->getGameImg(); ?>" alt="">
							<figcaption class="m-a title-7 italic">Le <?php echo date('d-m-Y', $t->getStartDate()) . ' par <a href="'. WEBPATH. '/profil?pseudo=' . $t->getUserPseudo().'">' . $t->getUserPseudo() .'</a>'; ?></figcaption>
						</aside>
						<article class="m-a display-flex-column">
							<h2 class="m-a text-center title title-1 capitalize"><a href="<?php echo WEBPATH.'/tournoi?t=' .$t->getLink();?>"><?php echo $t->getGameName(); ?></a></h2>
							<p class="m-a text-center title-3"><?php echo $t->getPName(); ?></p>
							<p class="m-a text-center title-3"><?php echo $t->getGvName(); ?></p>
							<?php if($t->getMaxPlayerPerTeam() > 1): ?>
								<p class="title-3"><?php echo $t->getMaxTeam() . ' équipes de ' . $t->getMaxPlayerPerTeam(); ?> joueurs</p>
							<?php else: ?>
								<p class="title-3 capitalize">solo</p>
							<?php endif; ?>
							<?php if (isset($_isConnected)): ?>
								<p class="tournamentslist-inaccessible-p m-a text-center border-full bg-pink capitalize title-3">inaccessible</p>
							<?php endif ?>								
						</article>
					</div>
span					<span type="button" class="btn btn-pink"><a href="<?php echo WEBPATH.'/tournoi?t=' .$t->getLink();?>">Voir</a></span>
				</div>
			<?php endforeach; ?>
		</div>		
	<?php endif ?>
	</section>
<?php endif; ?>