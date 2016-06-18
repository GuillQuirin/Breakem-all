<!-- Header de la page index -->
<section class="full-height bg-cover-index relative">
	
	<div class="align full-height animation fadeLeft">
		<span class="header-title border-full relative">Le Meilleur se cache parmi vous!
			<div class="index-header-btn"> 			
				<button type="button" class="btn btn-pink index-header-btn-pink-width"><a>Tournoi du moment</a></button>				
				<button type="button" class="btn btn-pink index-header-btn-pink-width"><a>Nos Jeux</a></button>			
			</div>
		</span>	

	</div>
	 
	<?php echo '<img class="icon down-center header-scroll-down" src="' . WEBPATH . '/web/img/icon/icon-scrollDown.png">';?>

</section>

<section id="container_index" class="my-content-wrapper">
	<div id="contain">
		<div id="contain_left">

			<div class="menu_hori">
				<ul>
					<nav class="nav_hori">
						<ul>
							<!-- Liste des types de game -->
							<?php //echo $typeJeux; ?>
						 	<li class="border_menu active_menu menu_separ"><a href="#">Equipe</a></li>
							<li class="border_menu menu_separ"><a href="#">Solo</a></li>
							<li class="border_menu menu_separ"><a href="#">5vs5</a></li>
							<li class="border_menu menu_separ"><a href="#">2vs2</a></li>
							<li class="border_menu menu_separ"><a href="#">Plus...</a></li>
						</ul>
					</nav>

					<li class="tri">
						<label>Trier par :</label>
						<div>
							<?php //echo $tri; ?>
							<select class="select-default">
								<option>Tout</option>
								<option>Jeux</option>
								<option>Catégorie</option>
								<option>Meilleur joueur</option>
							</select>
						</div>
					</li>
				</ul>
			</div>

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
										<h3 class='btn btn-pink'><a href="tournoi?t=<?php echo $tournoi->getLink(); ?>">Regarder</a><h3>
									</div>
								</div>
							</div>
						</article>
			<?php 
					endforeach;
				endif;
			?>

			<div class="page_article">
				<ul>
					<nav class="nav_hori page">
						<ul>

							<!-- Pagination -->

							<?php 
								if(isset($pagination)):
									//$nbpages = new tournoi($pagination);
									$nbpages =5;
									for($cpt=1; $cpt<=$nbpages; $cpt++):
										echo ($cpt==1) ? '<li class="border_menu active_menu"><a href="#">1</a></li>' :
										 '<li class="border_menu"><a href="#">'.$cpt.'</a></li>';
									endfor;
								endif;
							?>
						</ul>
					</nav>
				</ul>
			</div>
		</div>
		<div id="contain_right">

			<div id="contain_search">
				<label for="search">Rechercher :</label>
			    <input class="input-default" type="text" name="search" placeholder="Tournois, teams, joueurs">
			</div>

			<div class="title_index">
				<label for="title1">Prochain match</label>
			</div>
			<div class="fight">

				<!-- Match à venir -->
				<?php //echo $fight; ?>
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
							<!-- Liste des jeux -->
							<?php //echo $Jeux; ?>
							<li class=" active_tab"><a href="#">Tous</a></li>
							<li class=""><a href="#">HOT</a></li>
							<li class=""><a href="#">DOTA2</a></li>
							<li class=""><a href="#">LoL</a></li>
						</ul>
					</nav>
				</ul>
			</div>

			<!-- Liste des matchs -->
			<div id="match">
				<?php //echo $listematchs; ?>
				<div id="match1" class="margin_match">
					<div class="statut">En cours</div>
					<?php echo '<img src="' . WEBPATH . '/web/img/navi.jpg">';?>
					<div class="versus">VS</div>
					<?php echo '<img name="img2" src="' . WEBPATH . '/web/img/fnatic.jpg">';?>
					<p class="date_match">20 Janvier 2016, 20h00</p>
					<hr>
				</div>
				<div id="match2" class="margin_match">
					<div class="statut">A venir</div>
					<?php echo '<img src="' . WEBPATH . '/web/img/fnatic.jpg">';?>
					<div class="versus">VS</div>
					<?php echo '<img name="img2" src="' . WEBPATH . '/web/img/secret.jpg">';?>
					<p class="date_match">20 Janvier 2016, 20h00</p>
					<hr>
				</div>
				<div id="match3" class="margin_match">
					<div class="statut">30 : 90</div>
					<?php echo '<img src="' . WEBPATH . '/web/img/ehome.jpg">';?>
					<div class="versus">VS</div>
					<?php echo '<img name="img2" src="' . WEBPATH . '/web/img/secret.jpg">';?>
					<p class="date_match">20 Janvier 2016, 20h00</p>
					<hr>
				</div>
				<div id="match4" class="margin_match">
					<div class="statut">60 : 90</div>
					<?php echo '<img src="' . WEBPATH . '/web/img/navi.jpg">';?>
					<div class="versus">VS</div>
					<?php echo '<img name="img2" src="' . WEBPATH . '/web/img/virtus.jpg">';?>
					<p class="date_match">20 Janvier 2016, 20h00</p>
					<hr>
				</div>
				<div id="match5" class="margin_match">
					<div class="statut">120 : 10</div>
					<?php echo '<img src="' . WEBPATH . '/web/img/virtus.jpg">';?>
					<div class="versus">VS</div>
					<?php echo '<img name="img2" src="' . WEBPATH . '/web/img/secret.jpg">';?>
					<p class="date_match">20 Janvier 2016, 20h00</p>
					<hr>
				</div>
			</div>
			
			<!-- Classement des 3 premiers jeux -->
			<div id="game">
				<div class="title_index">
					<label for="title2">Jeux les plus utlisés</label>
				</div>
				<?php 
					if(isset($bestGames)){
						foreach ($bestGames as $key => $value){	
							echo "<div class='game'>";
								echo "<img src='".WEBPATH.'/web/img/'.$value['img']."'>";
								echo "<p>".$value['name']."</p>";
							echo "</div>";
						}
					}
				?>
			</div>

			<!-- Liste des catégories  -->
			<div id="categorie">
				<div class="title_index">
					<label for="title3">Catégories</label>
				</div>
				<?php
					// if(isset($categorie)): 
					// 	foreach ($categorie as $key => $value):
					// 		$catego = new typegame($value);
				?>
							<div class='categorie'>
								<p><?php // echo $catego->getName(); ?></p><br>
							</div>
				<?php 
					// 	endforeach;
					// endif;
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