<!-- Header de la page index -->
<section class="full-height bg-cover-index relative">
	
	<div class="align full-height animation fadeLeft">
		<span class="header-title border-full relative">Le Meilleur se cache parmi vous!
			<div class="index-header-btn">
				<button type="button" class="btn btn-pink index-header-btn-pink-width" id="currentTournament"><a>Tournoi du moment</a></button>
				<span type="button" class="btn btn-pink index-header-btn-pink-width">
					<a href="<?php echo WEBPATH.'/team'; ?>">Nos Teams</a>
				</span>			
			</div>
		</span>	

	</div>
	 
	<?php echo '<img class="icon down-center header-scroll-down" src="' . WEBPATH . '/web/img/icon/icon-scrollDown.png">';?>

</section>

<section id="container_index" class="my-content-wrapper">
	<div id="contain">
		<div id="contain_left">
			<div class="title_index_left">
				<label for="title">Prochains tournois</label>
			</div>
			<div>
				<ul>
					<nav class="nav_hori page">
						<ul id='page_navigation'>
						</ul>
					</nav>
				</ul>
			</div>
			<input type='hidden' id='current_page' />  
			<input type='hidden' id='show_per_page' />  
			
			<div id="liste-derniers-tournois">
				<!-- Liste des tournois en cours -->
				<?php 	
					if(isset($listeTournois)): 
						foreach ($listeTournois as $key => $tournoi):
				?> 	
							<article id='article<?php echo $key?>'>
								<div class='contain_article'>
									<div class='date_article'>
										<i class='icon'></i>
										<h3><?php echo date('d-m-Y', $tournoi->getStartDate()); ?></h3>
									</div>
									<div class='text_article'>
										<h2 class="title-4"><?php echo $tournoi->getName(); ?></h2>
										<?php 
											if($tournoi->getStatus()===-1)
												echo '<h3 class="red">VERROUILLE</h3>';
										?>
										<div class='tags_article'>
											<h3><?php echo $tournoi->getDescription(); ?></h3>
										</div>
										<div class='btn_article'>
											<h3 class='btn btn-pink'>
												<a href="<?php echo WEBPATH.'/tournoi?t='.$tournoi->getLink(); ?>">Regarder</a>
											</h3>
										</div>
									</div>
									<div class='img_article'>
										<img class="img-cover" src='<?php echo $tournoi->getGameImg(); ?>'>
									</div>									
								</div>
							</article>
				<?php 
						endforeach;
					endif;
				?>
			</div>
		</div>
		<!-- <li class="border_menu active_menu"><a href="#">1</a></li> -->
		<div id="contain_right">

			<!-- <div id="contain_search">
				<label for="search">Rechercher :</label>
			    <input class="input-default" type="text" name="search" placeholder="Tournois, teams, joueurs">
			</div> -->

			<div class="title_index">
				<label for="title1">Prochains matchs</label>
			</div>
			<!--
			<div class="fight">
				<h3>ESL</h3>
				<p class="date_fight">1er Avril 2016, 17h00</p>
				<?php echo '<img src="' . WEBPATH . '/web/img/navi.jpg">';?>
				<?php echo '<img src="' . WEBPATH . '/web/img/fnatic.jpg">';?>
				<div class="name_fight">
					<ul>
						<li>Navi</li>
						<li>Fnatic</li>
					</ul>
				</div>
			</div>
			
			<div class="tab">
				<ul>
					<nav class="tab_hori">
						<ul>
							
							<li class=" active_tab"><a href="#">Tous</a></li>-->
							<?php 
							/*
							if(isset($listeJeux) && is_array($listeJeux)){
								foreach($listeJeux as $jeu){
									echo '<li class=""><a>'.$jeu->getName().'</a></li>';
								}
							}*/
							?>
						<!--</ul>
					</nav>
				</ul>
			</div>-->

			<!-- Liste des matchs -->
			<div id="match">
				<?php 
				if(isset($listeMatchs) && is_array($listeMatchs)){
					//var_dump($listeMatchs);
					foreach ($listeMatchs as $key => $value) {
						echo '<div class="margin_match">';
							echo '<img src="'.$value->gtImgJeu().'">';
							echo '<a href="'.WEBPATH.'/tournoi?t='.$value->gtLink().'">'.$value->gtNameTournament().' sur '.$value->gtNomJeu().'</a>';
							echo '<p class="date_match">'.date("D, d M Y H:i",$value->getStartDate()).'</p>';
							echo '<hr>';
						echo '</div>';
					}
				}
				else{
					echo '<div class="margin_match">';
						echo "<p>Pas de prochains matchs à venir.</p>";
					echo "</div>";
				}
				?>				
			</div>
			
			<!-- Classement du jeu le plus utilisé -->
			<div id="game">
				<div class="title_index">
					<label for="title2">Jeu le plus utlisé</label>
				</div>
				<?php 
					if(isset($bestGames) && !empty($bestGames) && is_array($bestGames)){
						foreach ($bestGames as $key => $value){	
							echo "<div class='game'>";
								echo "<img src='".WEBPATH.'/web/img/upload/jeux/'.$value['img']."'>";
								echo "<p>".$value['name']."</p>";
							echo "</div>";
						}
					}
					else{
						echo "<div class='game'>";
							echo "<p>Aucun jeu utilisé jusqu'à présent.</p>";
						echo "</div>";
					}
				?>
			</div>
		</div>
	</div>
</section>

<section id="section_social_media">
	<div id="reseaux_sociaux">
		<div class="title_social">
			<p>Nos réseaux sociaux : Breakem'All</p>
		</div>
		<?php //echo $socials; ?>
		<div class="nw_social fb">
			<a href="https://facebook.com/breakemaall"><?php echo '<img src="' . WEBPATH . '/web/img/icon/fb.png">';?></a>
			<p> Facebook </p>
		</div>
		<div class="nw_social tw">
			<a href="https://twitter.com/Breakem_all"><?php echo '<img src="' . WEBPATH . '/web/img/icon/twitter.png">';?></a>
			<p> Twitter </p>
		</div>
		<div class="nw_social st">
			<a href="https://www.twitch.tv/breakem_all"><?php echo '<img src="' . WEBPATH . '/web/img/icon/twitch.png">';?></a>
			<p> Twitch </p>
		</div>
		<div class="nw_social yo">
			<a href="https://www.youtube.com/channel/UCnVPB635znITQ8t2_v7P0SQ"><?php echo '<img src="' . WEBPATH . '/web/img/icon/youtube.png">';?></a>
			<p> Youtube </p>
		</div>
	</div>
</section>

<section id="wrapperCurrentTournament">
	<h4>Prochain tournoi d'organisé:</h4>
	<div id="contentCurrentTournament">

	</div>
</section>