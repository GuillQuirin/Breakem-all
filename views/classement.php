<section class="low-height bg-cover-classement relative">

	<div class="align full-height">
		<div class="align full-height animation fadeLeft">
			<span class="header-title admin-header-title border-full relative">Administration</span>	
		</div>
	</div>	 

	</section>

	<section class="admin-content-wrapper my-content-wrapper">

		<div class="container m-a classement-container">

			<div class="row classement-content-row">
				<div class="grid-md-12">	
					<!-- Default Layout -->
					<div id="admin-board" class="admin-board text-center border-regular">
						<!-- Row -->
						<div class="row">
							<!-- Dashboard Title -->
							<div class="grid-md-12 admin-board-title-wrapper">
								<span class="admin-board-title">Tableau de bord</span>
							</div>
							<!-- Fin Dashboard Title -->
							<!-- Dashboard Introduction -->
							<div class="grid-md-12 admin-board-intro-wrapper">
								<span class="admin-board-intro">Bienvenue <span class="font-bold capitalize"><?php echo $_pseudo?></span>, vous vous trouvez actuellement sur l'interface d'administration.</span>
							</div>
							<!-- Fin Dashbard Introduction -->
							<!-- Dashboard Content -->
							<div class="grid-md-12">
								<div class="grid-md-12">
									<div class="grid-md-4">
										<span class="display-block admin-board-section-text">Cliquez sur la section qui vous intérèsse.</span>
									</div>
									<div class="grid-md-4">
										<span class="display-block admin-board-section-text">Vous pouvez ajouter des éléments!</span>
									</div>
									<div class="grid-md-4">
										<span class="display-block admin-board-section-text">En survolant les éléments, vous avez le choix entre la modification ou la suppression.</span>
									</div>
								</div>
								<div class="grid-md-12">
									<div class="grid-md-4">
										<?php echo "<img class='border-pink' src='" . WEBPATH . "/web/img/admin-howto1.png'>";?>
									</div>
									<div class="grid-md-4">
										<?php echo "<img class='border-pink' src='" . WEBPATH . "/web/img/admin-howto2.png'>";?>
									</div>
									<div class="grid-md-4">
										<?php echo "<img class='border-pink' src='" . WEBPATH . "/web/img/admin-howto3.png'>";?>
									</div>
								</div>
								<div class="grid-md-12">
									<span class="display-block admin-board-section-text">En cliquant sur modifier, vous avez accès au formulaire.</span>
									<?php echo "<img class='border-pink' src='" . WEBPATH . "/web/img/admin-howto4.png'>";?>
								</div>
							</div>
							<!-- Fin Dashboard Content -->
						</div>
						<!-- Fin Row -->
					</div>
					<!-- Fin Default Layout -->

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
									
									<div class="grid-md-3 admin-add-wrapper" style="padding:25px 0;">
									</div>

									<!-- Formulaire d'ajout -->
									<div class='index-modal admin-add-form-wrapper hidden-fade hidden text-center'>
									</div>
									<!-- Fin Formulaire d'ajout -->

								</div>
							</div>
							<!-- Fin admin search -->

							<!-- Admin title -->
							<div class='admin-data-ihm-title align'>
							</div>
							<!-- Fin admin title -->

							<!-- Admin Data -->
							<div class="admin-data-re">
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