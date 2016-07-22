<?php 
	if(isset($tournamentOrg)):
		foreach ($tournamentOrg as $key => $tournament):
		?>
		<!-- Tournament -->
		<div class="article-wrapper">
			<div class="row">
				<!-- Image wrapper -->
				<div class="grid-md-2">
					<div class='article-img'><img class="img-cover" src='<?php echo $tournament->getGameImg(); ?>'></div>
				</div>
				<!-- Fin Image Wrapper -->
				<!-- Content wrapper -->
				<div class="grid-md-8">
					<div class='article-content'>
						<span class="display-block"><span class="article-content-title"><?php echo $tournament->getName(); ?><span class="article-date"><?php echo date('d-m-Y', $tournament->getStartDate()); ?></span></span></span>
						<?php //if($tournament->getStatus()===-1){echo '<span class="red">VERROUILLE</span>';}?>
						<span class="article-content-description"><?php echo $tournament->getDescription(); ?></span>
						<div class='article-content-btn-wrapper'>
							<?php if($tournament->getStatus()===-1){
								echo "<img class='icon icon-size-4' src='" . WEBPATH . "/web/img/icon/icon-lock.png'><span class='article-lock'>Tournoi Vérouillé</span>";
							}else{ ?>
								<span class='btn btn-pink article-content-btn'><a href="<?php echo WEBPATH.'/tournoi?t='.$tournament->getLink(); ?>">Regarder</a></span>
							<?php } ?>
						</div>	
					</div>
				</div>
				<!-- Fin content wrapper -->
			</div>
		</div>
		<!-- Fin Tournament -->
		<?php
		endforeach;
	else:
		echo "<span class='display-block text-center'>Vous n'organisez aucun tournoi pour le moment.</span>";
	endif;
?>	