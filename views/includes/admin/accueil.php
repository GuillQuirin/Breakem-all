
<section class="full-height bg-cover-index relative">
	
	<div class="align full-height">
		<span class="header-title border-full relative animation fade">Le Meilleur se cache parmi vous!
			<div class="index-header-btn"> 			
				<button type="button" class="btn btn-pink index-header-btn-pink-width"><a>Tournoi du moment</a></button>				
				<button type="button" class="btn btn-pink index-header-btn-pink-width"><a>Nos Jeux</a></button>			
			</div>
		</span>	

	</div>
	 
	<?php echo '<img class="icon icon-size-3 down-center header-scroll-down" src="' . WEBPATH . '/web/img/icon/icon-scroll-down.png">';?>

</section>

<section id="container_index">
	<div id="contain">
		<div id="contain_left">
			<div class="menu_hori">
				<ul>
					<nav class="nav_hori">
						<ul>
							<li class="border_menu active_menu"><a href="#">Equipe</a></li>
							<li class="border_menu"><a href="#">Solo</a></li>
							<li class="border_menu"><a href="#">5vs5</a></li>
							<li class="border_menu"><a href="#">2vs2</a></li>
							<li class="border_menu"><a href="#">Plus...</a></li>
						</ul>
					</nav>

					<li class="tri">
						<label>Trier par :</label>
						<div>
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
			<div class="page_article">
				<ul>
					<nav class="nav_hori page">
						<ul>
							<li class="border_menu active_menu"><a href="#">1</a></li>
							<li class="border_menu"><a href="#">2</a></li>
							<li class="border_menu"><a href="#">3</a></li>
							<li class="border_menu"><a href="#">4</a></li>
							<li class="border_menu"><a href="#">5</a></li>
							<li class="border_menu"><a href="#">--></a></li>
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
			<div class="title">
				<label for="title1">Prochain match</label>
			</div>
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
		</div>
	</div>
</section>
