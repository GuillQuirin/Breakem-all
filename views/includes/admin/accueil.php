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
			--><li class="admin-onglet-li" id="admin-onglet-platforms">		
				<a>Plateformes</a>
			</li><!--
			--><li class="admin-onglet-li" id="admin-onglet-reports">		
				<a>Signalements</a>
			</li><!--
			--><li class="admin-onglet-li" id="admin-onglet-team">		
				<a>Team</a>
			</li><!--
			--><li class="admin-onglet-li" id="admin-onglet-games">		
				<a>Jeux</a>
			</li><!--
			--><li class="admin-onglet-li" id="admin-onglet-gametype">		
				<a>Types de jeu</a>
			</li><!--
			--><li class="admin-onglet-li" id="admin-onglet-comment">		
				<a>Commentaires</a>
			</li><!--
			--><li class="admin-onglet-li" id="admin-onglet-tournament">		
				<a>Tournois</a>
			</li>
		</ul>
	</div>

	</section>

	<section class="admin-content-wrapper my-content-wrapper">

		<div class="container m-a classement-container">

			<div class="row classement-content-row">
				<div class="grid-md-12">	
					<!-- Default Layout -->
					<div id="admin-board">
						<div class="grid-md-12 text-center">
							<span class="grid-md-12 admin-board-title">How To</span>
							<span class="grid-md-12 admin-board-intro">Hello <span class="capitalize font-bold"><?php echo $_pseudo ?></span>, vous vous trouvez sur l'interface d'administration du site.</span>
						</div>
						<div class="grid-md-4">
							<?php echo "<img src='" . WEBPATH . "/web/img/admin-howto1.png'>";?>
							<!-- <span>Cliquez sur un des onglets pour accéder a une des données</span> -->
						</div>
						<div class="grid-md-4">
							<?php echo "<img src='" . WEBPATH . "/web/img/admin-howto2.png'>";?>
							<!-- <span>Placez votre curseur sur l'élément souhaité</span> -->
						</div>
						<div class="grid-md-4">
							<?php echo "<img src='" . WEBPATH . "/web/img/admin-howto3.png'>";?>
							<!-- <span>Complétez les champs du formulaire</span> -->
						</div>
					</div>
					<!-- Fin Default Layout -->

					<!-- Admin Layout -->
					<div id="admin-container">
						<!-- Admin wrapper -->
						<div class="admin-wrapper">
							<!-- Admin search -->
							<div class="admin-navbar">		
								<div class="row align">
									<!--<div class="grid-md-3 admin-search-wrapper">
										<form id="admin-search-form">
											<input type="text" class="admin-search-input input-default" id="admin-search-input" name="admin-search-input" placeholder="Rechercher">
										</form>
									</div>
									-->
									<div class="grid-md-3 admin-add-wrapper" style="padding:25px 0;">
										<button type="button" class="btn btn-pink full open-form admin-add-btn admin-btn-insert" id="admin-add-btn"><a>Ajouter</a></button>
									</div>

									<!-- Formulaire d'ajout -->
									<div class='index-modal admin-add-form-wrapper hidden-fade hidden'>
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
