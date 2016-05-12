<?php

if(isset($_isAdmin) && $_isAdmin == 1){

?>

<section class="low-height bg-cover-configuration relative">

	<div class="align full-height">
		<div class="align full-height animation fadeLeft">
			<span class="header-title admin-header-title border-full relative">Administration</span>	
		</div>
	</div>
	 
	<img class="icon icon-size-3 down-center header-scroll-down" id="classement-header-scroll-down" src="web/img/icon/icon-scrollDown.png"> 

	<div class="configuration-onglet-wrapper">
		<ul class="configuration-onglet-ul">
			<li class="active configuration-onglet-li" id="configuration-onglet-membres">
				<a>Membres</a>
			</li><!--
			--><li class="configuration-onglet-li" id="configuration-onglet-platforms">		
				<a>Plateformes</a>
			</li><!--
			--><li class="configuration-onglet-li" id="configuration-onglet-reports">		
				<a>Signalements</a>
			</li>
		</ul>
	</div>

	</section>

	<section class="configuration-content-wrapper my-content-wrapper">

		<div class="container m-a content-border classement-container" style="border:none;">

			<div class="row classement-content-row">
				<div class="grid-md-12">

					<!-- @Guillaume : Include a changé genre pour que se soit dynamic, coté controlleurs

					<!-- Membre -->
			
					<?php include "membres.php"; ?>					

					<!-- Fin Membre -->		

					<!-- Plateformes -->

					<?php include "plateformes.php"; ?>					

					<!-- Fin Plateformes -->						
				<?php include "reports.php"; ?>	
				</div>
			</div>				
		</div>

</section>

<?php 

}

?>
