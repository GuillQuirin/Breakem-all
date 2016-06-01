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
					
					<div class="admin-navbar membres-navbar">		
						<div class="row align">
							<div class="grid-md-3 platform-search-wrapper">
								<form id="platform-search-form">
									<input type="text" class="platform-search-input input-default" id="platform-search-input" name="platform-search-input" placeholder="Rechercher">
								</form>
							</div>
							<div class="grid-md-3 platform-add-wrapper">
								<button type="button" class="btn btn-pink full open-form" id="platform-add-btn"><a>Ajouter</a></button>
							</div>
						</div>
					</div>

					<!-- Default Layout -->
					<div id="admin-container">

					</div>
					<!-- Fin Default Layout -->					

				</div>
			</div>				
		</div>

</section>

<?php 

}

?>
