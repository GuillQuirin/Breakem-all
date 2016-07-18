<?php

if(isset($_isAdmin) && $_isAdmin == 1){

?>





<section class="low-height bg-cover-admin relative">

	<div class="align full-height">
		<div class="align full-height animation fadeLeft">
			<span class="header-title admin-header-title border-full relative">Administration</span>	
		</div>
	</div>	 


	<div class="admin-onglet-wrapper">
		<ul class="admin-onglet-ul">
			<li class="admin-onglet-li" id="admin-onglet-membres">
				<a>Membres</a>
			</li><!--
			--><li class="admin-onglet-li" id="admin-onglet-team">		
				<a>Teams</a>
			</li><!--
			--><li class="admin-onglet-li" id="admin-onglet-platforms">		
				<a>Plateformes</a>
			</li><!--
			--><li class="admin-onglet-li" id="admin-onglet-games">		
				<a>Jeux</a>
			</li><!--
			--><li class="admin-onglet-li" id="admin-onglet-gametype">		
				<a>Types de jeu</a>
			</li><!--
			--><li class="admin-onglet-li" id="admin-onglet-tournament">		
				<a>Tournois</a>
			</li><!--
			--><li class="admin-onglet-li" id="admin-onglet-comment">		
				<a>Commentaires</a>
			</li><!--
			--><li class="admin-onglet-li" id="admin-onglet-reports">		
				<a>Signalements</a>
			</li>
		</ul>
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

<?php 

}

?>
