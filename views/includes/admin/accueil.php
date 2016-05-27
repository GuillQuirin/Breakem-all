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
			</li>
			<!--
			--><li class="admin-onglet-li" id="admin-onglet-games">		
				<a>Jeux</a>
			</li>
			<!--
			--><li class="admin-onglet-li" id="admin-onglet-gametype">		
				<a>Types de jeu</a>
			</li>
			<!--
			--><li class="admin-onglet-li" id="admin-onglet-comment">		
				<a>Commentaires</a>
			</li>
			<!--
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

					<!-- @Guillaume : Include a changé genre pour que se soit dynamic, coté controlleurs

					<!-- Membre -->
					<?php include "membres.php"; ?>					
					<!-- Fin Membre -->		

					<!-- Plateformes -->
					<?php include "plateformes.php"; ?>					
					<!-- Fin Plateformes -->						
					
					<!-- Reports -->
					<?php include "reports.php"; ?>	
					<!-- Fin reports -->

					<!-- Team -->
					<?php include "team.php"; ?>	
					<!-- Fin Team -->

					<!-- Gametype -->
					<?php include "gametype.php"; ?>	
					<!-- Fin Gametype -->

					<!-- Comments -->
					<?php include "comments.php"; ?>	
					<!-- Fin Comments -->

				</div>
			</div>				
		</div>

</section>

<?php 

}

?>
