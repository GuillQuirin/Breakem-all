<?php 
	if(isset($tournamentOrg)):
		foreach ($tournamentOrg as $key => $tournament):
		?>
		<!-- Tournament -->
		<article>
			<div class='contain_article'>
				<div class='img_article'>
					<img class="img-cover" src='<?php echo $tournament->getGameImg(); ?>'>
				</div>
				<div class='date_article'>
					<i class='icon'></i>
					<h3><?php echo date('d-m-Y', $tournament->getStartDate()); ?></h3>
				</div>
				<div class='text_article'>
					<h2 class="title-4"><?php echo $tournament->getName(); ?></h2>
					<?php 
						if($tournament->getStatus()===-1)
							echo '<h3 class="red">VERROUILLE</h3>';
					?>
					<div class='tags_article'>
						<h3><?php echo $tournament->getDescription(); ?></h3>
					</div>
					<div class='btn_article'>
						<h3 class='btn btn-pink'>
							<a href="<?php echo WEBPATH.'/tournoi?t='.$tournament->getLink(); ?>">Regarder</a>
						<h3>
					</div>
				</div>
			</div>
		</article>
		<!-- Fin Tournament -->
		<?php
		endforeach;
	endif;
?>	