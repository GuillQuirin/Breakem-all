<?php if(isset($_isConnected) && $_isConnected == 1){ ?>

<section class="low-height bg-cover-mestournois relative">

	<div class="align full-height">
		<div class="align full-height animation fadeLeft">
			<span class="header-title admin-header-title border-full relative">Mes tournois</span>	
		</div>
	</div>	 


	<div class="admin-onglet-wrapper">
		<ul class="admin-onglet-ul">
			<li class="admin-onglet-li active" id="mestournois-onglet-organisateur">
				<a>Organisateur</a>
			</li><!--
			--><li class="admin-onglet-li" id="mestournois-onglet-participant">		
				<a>Participant</a>
			</li>
		</ul>
	</div>
</section>

<section class="team-content-wrapper my-content-wrapper">

	<div class="container m-a border-regular mestournois-container">

		<div class="row team-content-row">

			<div class="grid-md-8 grid-md-offset-2 mestournois-ihm">

			</div>
			
		</div>
		
	</div>

</section>

<?php } ?>