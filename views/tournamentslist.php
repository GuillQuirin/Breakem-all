	<div class="tournamentslist-title-container display-flex-column">
		<h2 class="title title-2">
			<?php if(isset($tournois)): ?>
				Liste des tournois
			<?php else: ?>
				Aucun tournoi correspondant
			<?php endif; ?>
		</h2>
	</div>

	<section class="tournamentslist-tournoi display-flex-column">
<?php if(isset($tournois)): ?>
<?php foreach($tournois as $key => $obj):?>	
		<div class="tournamentslist-tournoi-element relative">
			<article>
				<h2 class="title title-2"><?php echo $obj->getName(); ?></h2>
				<p class="title-4"><?php echo $obj->getPName(); ?></p>
				<?php if($obj->getMaxPlayerPerTeam() > 1): ?>
					<p><?php echo $obj->getMaxTeam() . ' équipes de ' . $obj->getMaxPlayerPerTeam(); ?> joueurs</p>
				<?php else: ?>
					<p><?php echo $obj->getMaxPlayer(); ?> joueurs maximum</p>
				<?php endif; ?>
			</article>
			<aside class="relative display-flex-column">
				<figure class="absolute">
					<img src="<?php echo WEBPATH . '/'. $obj->getGameImg(); ?>" alt="">
					<figcaption><?php echo date('d-m-Y', $obj->getStartDate()); ?></figcaption>
				</figure>				
				<p class="title title-4"><?php echo $obj->getGameName(); ?></p>
				<p class="title-4"><?php echo $obj->getGvName(); ?></p>
				<legend></legend>
			</aside>
		</div>
		<h1> <?php  ?></h1>
<?php endforeach; ?>
<?php endif; ?>
	</section>