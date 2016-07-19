<section class="low-height bg-cover-mestournois relative">

	<div class="align full-height">
		<div class="align full-height animation fadeLeft">
			<span class="header-title admin-header-title border-full relative">Mes tournois</span>	
		</div>
	</div>	 


	<div class="admin-onglet-wrapper">
		<ul class="admin-onglet-ul">
			<li class="admin-onglet-li" id="admin-onglet-membres">
				<a>Organisateur</a>
			</li><!--
			--><li class="admin-onglet-li" id="admin-onglet-team">		
				<a>Participant</a>
			</li>
		</ul>
	</div>
</section>

<section class="my-content-wrapper">

	<div class="container m-a content-border">

		<div class="row">
			<div class="grid-md-8 grid-md-offset-2">
				<!-- Liste des tournois en cours -->
			<?php 	
				if(isset($listeTournois)): 
					foreach ($listeTournois as $key => $tournoi):
			?> 	
						<article id='article<?php echo $key?>'>
							<div class='contain_article'>
								<div class='img_article'>
									<img class="img-cover" src='<?php echo $tournoi->getGameImg(); ?>'>
								</div>
								<div class='date_article'>
									<i class='icon'></i>
									<h3><?php echo date('d-m-Y', $tournoi->getStartDate()); ?></h3>
								</div>
								<div class='text_article'>
									<h2 class="title-4"><?php echo $tournoi->getName(); ?></h2>
									<div class='tags_article'>
										<h3><?php echo $tournoi->getDescription(); ?></h3>
									</div>
									<div class='btn_article'>
										<h3 class='btn btn-pink'>
											<a href="<?php echo WEBPATH.'/tournoi?t='.$tournoi->getLink(); ?>">Regarder</a>
										<h3>
									</div>
								</div>
							</div>
						</article>
			<?php 
					endforeach;
				endif;
			?>
			</div>
		</div>
		
	</div>

</section>