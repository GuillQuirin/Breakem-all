<section class="low-height bg-cover-classement relative">

	<div class="align full-height">
		<div class="align full-height animation fadeLeft">
			<span class="header-title admin-header-title border-full relative">Classement</span>	
		</div>
	</div>	 

	<img class="icon icon-size-3 down-center header-scroll-down" id="classement-header-scroll-down" src="web/img/icon/icon-scrollDown.png"> 

	</section>

	<section class="admin-content-wrapper my-content-wrapper">

		<div class="container m-a classement-container">

			<div class="row classement-content-row">
				<div class="grid-md-12">	

					<!-- Admin Layout -->
					<div id="admin-container" class="admin-container">
						<!-- Admin wrapper -->
						<div class="admin-wrapper">
							<!-- Admin search -->
							<div class="admin-navbar">		
								<div class="row align">
									<div class="grid-md-3 admin-search-wrapper">
										<form id="admin-search-form">
											<input type="text" class="admin-search-input input-default" autocomplete="off" id="admin-search-input" name="admin-search-input" placeholder="Rechercher">
										</form>
									</div>
								</div>
							</div>
							<!-- Fin admin search -->

							<!-- Admin title -->
							<div class='admin-data-ihm-title align'>
							</div>
							<!-- Fin admin title -->

							<!-- Admin Data -->
							<div class="admin-data-re">
								<div class="text-center">
									<ul>
										<nav class="nav_hori page">
											<ul id='page_navigation'>
											</ul>
										</nav>
									</ul>
								</div>
								<input type='hidden' id='current_page' />  
								<input type='hidden' id='show_per_page' /> 
								<div id="liste-derniers-classement">
								<?php if(isset($userData)){
										$cat = "<div class='grid-md-10 admin-data-ihm-title align relative grid-centered'>
											<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Avatar</span></div></div>
											<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Pseudo</span></div></div>
											<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Team</span></div></div>
											<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Points</span></div></div>
										</div>";

										echo $cat;

									foreach ($userData as $key => $joueur) {
										//Wrapper				
										echo "<div class='grid-md-10 classement-data-ihm align relative grid-centered'>";

											//Affichage
											//Image
											//Je met un timestamp après l'image pour ne pas la sauvegarder dans le cache si jamais on la modifie (fichier avec le meme nom) voir : http://stackoverflow.com/questions/728616/disable-cache-for-some-images
											echo "<div class='grid-md-4'><div class='admin-data-ihm-elem'><div class='admin-data-ihm-elem-img-wrapper membres-img'><img class='admin-img-cover border-round membre-img-up' src='" .$joueur->getImg(). "?lastmod=" . date('Y-m-d H:i:s') . "'></div></div></div>";						
											//Pseudo
											//var_dump($joueur->getImg());
											echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='membre-pseudo-g'><a href='".WEBPATH."/profil?pseudo=".$joueur->getPseudo()."'>".$joueur->getPseudo()."</a></span></div></div>";						
											//Team
											echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='membre-nameTeam-g'>"; 
												if($joueur->getNameTeam()){
													echo "<a href='".WEBPATH."/detailteam?name=".$joueur->getNameTeam()."'>".$joueur->getNameTeam()."</a>";
												}
											echo "</span></div></div>";
											//Points
											echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='membre-point-g'>".$joueur->gtTotalPoints()."</span></div></div>";						

											//Fin Affichage
											//Fin Bouton
										echo "</div>";
										//Fin Wrapper
									}
								}else{
									echo "<div class='grid-md-12 no-platform align'><span>Aucun joueur enregistré pour le moment.</span></div>";								}
								?>
								</div>
							</div>
							<!-- Fin admin Data -->

						</div>
						<!-- Fin admin wrapper -->
					</div>
					<!-- Fin Admin Layout -->					

				</div>
			</div>				
		</div>

</section>



<!-- <section class="middle-height bg-cover-classement relative">
	
	<div class="align full-height">
		<div class="classement-header-left text-center animation fadeLeft">
			<div class="classement-header-image-wrapper">
				<?php echo '<img class="classement-header-image" src="' . WEBPATH . '/web/img/game-mk.png">';?>
			</div>
			<div class="classement-header-title header-title border-full">
				<span>Classement</span>			
			</div>
			<div class="classement-header-left-sub">
				<span>Découvrez les meilleurs joueurs de vos jeux préférés!</span>
			</div>
			<div class="">
							
			</div>				
		</div>
		<div class="classement-header-right animation fadeRight">
			<div class="classement-select background-wrapper shadow-bottom-full">	
				<ul class="grid-md-12 classement-select-ul classement-header-select-ul">	
					<li>
						<?php echo '<img class="classement-select-image" src="' . WEBPATH . '/web/img/ehome.jpg">';?>
					</li>
					<li>
						<span>EHOME</span>
					</li>
					<li class="classement-select-li-quote">
						<span>"J'aime les moches."</span>
					</li>
					<li class="classement-select-pts">
						<span>8098 PTS</span>
					</li>					
					<span class="classement-ranking-icon">1</span>														
				</ul>																						
			</div>	
				<div class="classement-select background-wrapper shadow-bottom-full">	
				<ul class="grid-md-12 classement-select-ul classement-header-select-ul">	
					<li>
						<?php echo '<img class="classement-select-image" src="' . WEBPATH . '/web/img/fnatic.jpg">';?>
					</li>
					<li>
						<span>Fnatic</span>
					</li>
					<li class="classement-select-li-quote">
						<span>"La victoire se fait grâce au travail d'équipe."</span>
					</li>
					<li class="classement-select-pts">
						<span>6000 PTS</span>
					</li>					
					<span class="classement-ranking-icon">2</span>														
				</ul>																						
			</div>	
				<div class="classement-select background-wrapper shadow-bottom-full">	
				<ul class="grid-md-12 classement-select-ul classement-header-select-ul">	
					<li>
						<?php echo '<img class="classement-select-image" src="' . WEBPATH . '/web/img/navi.jpg">';?>
					</li>
					<li>
						<span>Navi</span>
					</li>
					<li class="classement-select-li-quote">
						<span>"Dylan jte bz pd"</span>
					</li>
					<li class="classement-select-pts">
						<span>3000 PTS</span>
					</li>					
					<span class="classement-ranking-icon">3</span>														
				</ul>																						
			</div>					
		</div>
	</div>
	 
	<img class="icon icon-size-3 down-center header-scroll-down" id="classement-header-scroll-down" src="web/img/icon/icon-scrollDown.png"> 

</section>
<section class="classement-content-wrapper my-content-wrapper">

	<div class="container m-a content-border classement-container">

		<div class="row classement-content-row">
			<div class="grid-md-8 grid-md-offset-2">				

				
			<div class="classement-select background-wrapper shadow-bottom-full">	
				<ul class="grid-md-12 classement-select-ul">	
					<li>
						<?php echo '<img class="classement-select-image" src="' . WEBPATH . '/web/img/ehome.jpg">';?>
					</li>
					<li>
						<span>EHOME</span>
					</li>
					<li class="classement-select-li-quote">
						<span>"J'aime les moches."</span>
					</li>
					<li class="classement-select-pts">
						<span>8098 PTS</span>
					</li>					
					<span class="classement-ranking-icon">4</span>														
				</ul>																						
			</div>	
				<div class="classement-select background-wrapper shadow-bottom-full">	
				<ul class="grid-md-12 classement-select-ul">	
					<li>
						<?php echo '<img class="classement-select-image" src="' . WEBPATH . '/web/img/fnatic.jpg">';?>
					</li>
					<li>
						<span>Fnatic</span>
					</li>
					<li class="classement-select-li-quote">
						<span>"La victoire se fait grâce au travail d'équipe."</span>
					</li>
					<li class="classement-select-pts">
						<span>6000 PTS</span>
					</li>					
					<span class="classement-ranking-icon">5</span>														
				</ul>																						
			</div>	
				<div class="classement-select background-wrapper shadow-bottom-full">	
				<ul class="grid-md-12 classement-select-ul">	
					<li>
						<?php echo '<img class="classement-select-image" src="' . WEBPATH . '/web/img/navi.jpg">';?>
					</li>
					<li>
						<span>Navi</span>
					</li>
					<li class="classement-select-li-quote">
						<span>"Dylan jte bz pd"</span>
					</li>
					<li class="classement-select-pts">
						<span>3000 PTS</span>
					</li>					
					<span class="classement-ranking-icon">6</span>														
				</ul>																						
			</div>	
			<div class="classement-select background-wrapper shadow-bottom-full">	
				<ul class="grid-md-12 classement-select-ul">	
					<li>
						<?php echo '<img class="classement-select-image" src="' . WEBPATH . '/web/img/ehome.jpg">';?>
					</li>
					<li>
						<span>EHOME</span>
					</li>
					<li class="classement-select-li-quote">
						<span>"J'aime les moches."</span>
					</li>
					<li class="classement-select-pts">
						<span>8098 PTS</span>
					</li>					
					<span class="classement-ranking-icon">7</span>														
				</ul>																						
			</div>	
				<div class="classement-select background-wrapper shadow-bottom-full">	
				<ul class="grid-md-12 classement-select-ul">	
					<li>
						<?php echo '<img class="classement-select-image" src="' . WEBPATH . '/web/img/fnatic.jpg">';?>
					</li>
					<li>
						<span>Fnatic</span>
					</li>
					<li class="classement-select-li-quote">
						<span>"La victoire se fait grâce au travail d'équipe."</span>
					</li>
					<li class="classement-select-pts">
						<span>6000 PTS</span>
					</li>					
					<span class="classement-ranking-icon">8</span>														
				</ul>																						
			</div>	
				<div class="classement-select background-wrapper shadow-bottom-full">	
				<ul class="grid-md-12 classement-select-ul">	
					<li>
						<?php echo '<img class="classement-select-image" src="' . WEBPATH . '/web/img/navi.jpg">';?>
					</li>
					<li>
						<span>Navi</span>
					</li>
					<li class="classement-select-li-quote">
						<span>"Dylan jte bz pd"</span>
					</li>
					<li class="classement-select-pts">
						<span>3000 PTS</span>
					</li>					
					<span class="classement-ranking-icon">9</span>														
				</ul>																						
			</div>				
			<div class="classement-select background-wrapper shadow-bottom-full">	
				<ul class="grid-md-12 classement-select-ul">	
					<li>
						<?php echo '<img class="classement-select-image" src="' . WEBPATH . '/web/img/navi.jpg">';?>
					</li>
					<li>
						<span>Navi</span>
					</li>
					<li class="classement-select-li-quote">
						<span>"Dylan jte bz pd"</span>
					</li>
					<li class="classement-select-pts">
						<span>3000 PTS</span>
					</li>					
					<span class="classement-ranking-icon">9</span>														
				</ul>																						
			</div>	


			<div class="grid-md-2 grid-md-offset-4">
				<button type="button" class="btn btn-pink"><a>Voir plus</a></button>											
			</div>
						
			</div>

		
		</div>

	</div>

</section>


 -->