<?php if(isset($tournois)): ?>
	<section class="tournamentslist-tournoi display-flex-column">
<?php foreach($tournois as $key => $obj):?>	
		<div class="tournamentslist-tournoi-element relative">
			<article>
				<h2 class="title title-2"><?php echo $obj->getName(); ?></h2>
				<p class="title-4"><?php echo $obj->getGameName(); ?></p>
				<p class="title-4"><?php echo $obj->getPName(); ?></p>
				<p class="title-4"><?php echo $obj->getGvName(); ?></p>
				<?php if($obj->getMaxPlayerPerTeam() > 1): ?>
					<p><?php echo $obj->getMaxTeam(); ?> équipes de <?php echo $obj->getMaxPlayerPerTeam(); ?> joueurs</p>
				<?php else: ?>
					<p><?php echo $obj->getMaxPlayer(); ?> joueurs maximum</p>
				<?php endif; ?>
			</article>
			<aside>
				<img class="absolute" src="<?php echo WEBPATH . '/'. $obj->getGameImg(); ?>" alt="">
			</aside>
		</div>
		<h1> <?php  ?></h1>
<?php endforeach; ?>
	</section>
<?php endif; ?>