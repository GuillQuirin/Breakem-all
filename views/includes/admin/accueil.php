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
			<li class="active admin-onglet-li" id="admin-onglet-membres">
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
					<div id="admin-container">
						<!-- Admin wrapper -->
						<div class="admin-wrapper">
							<!-- Admin search -->
							<div class="admin-navbar">		
								<div class="row align">
									<div class="grid-md-3 admin-search-wrapper">
										<form id="admin-search-form">
											<input type="text" class="admin-search-input input-default" id="admin-search-input" name="admin-search-input" placeholder="Rechercher">
										</form>
									</div>
									<div class="grid-md-3 admin-add-wrapper">
										<button type="button" class="btn btn-pink full open-form admin-add-btn admin-btn-insert" id="admin-add-btn"><a>Ajouter</a></button>
									</div>

									<!-- Formulaire d'ajout -->
									<div class='index-modal hidden-fade hidden'>

										<div class='index-modal-this index-modal-login align'>
										
											<div id='login-form' class='grid-md-3 inscription_rapide animation fade'>
												<form class='platform-form' enctype='multipart/form-data' accept-charset='utf-8'>
													<!--<input type='text' name='id' class='hidden platform-id-p' value=''>
												    <label for='email'>Nom :</label>
												    <input class='input-default admin-form-input-w platform-nom-p' name='nom' type='text' value=''>
												    <label for='email'>Description :</label>
												    <textarea class='input-default admin-form-input-w platform-description-p' name='description' type='text'></textarea>							    						
												    <div class='admin-avatar-wrapper m-a'>																	
														<img class='admin-avatar img-cover platform-img' src='' title='Image de profil' alt='Image de profil'>										
													</div>
													<div class='text-center admin-input-file'>								 
													<input type='file' class='platform-image-p' name='profilpic'>
													</div>
												    <button type='button' class='platform-submit-form-btn btn btn-pink'><a>Valider</a></button>-->
										  		</form>
										  	</div>
										</div>
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
					<!-- Fin Default Layout -->					

				</div>
			</div>				
		</div>

</section>

<?php 

}

?>
