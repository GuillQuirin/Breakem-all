<!-- Titre de la section -->
<section class="low-height bg-cover-team relative">
    <div class="align full-height">
        <div class="align full-height animation fadeLeft">
            <div class="header-title admin-header-title border-full relative creationtournoi-title-container display-block">                
                    <h1 class="capitalize title header-title">Choisis ta Team</h1>             
            </div>  
        </div>
    </div>      

    <img class="icon icon-size-3 down-center header-scroll-down" id="team-header-scroll-down" src="web/img/icon/icon-scrollDown.png"> 
</section>
<!-- Liste des teams -->
<section class="team-content-wrapper my-content-wrapper">

	<div class="container m-a content-border team-container">

		<div class="row team-content-row">
			<div class="grid-md-8 grid-md-offset-2">				

			<?php   
                if(isset($listeteam)): 
	                foreach ($listeteam as $key => $team):
	        ?>  
						<div class="team-select background-wrapper shadow-bottom-full">	
							<ul class="grid-md-12 team-select-ul">	
								<li>
									<img class="team-select-image" src='<?php echo $team->getImg(); ?>'>
								</li>
								<li class="team-select-li-name">
									<span><?php echo $team->getName(); ?></span>
								</li>
								<li class="team-select-li-quote">
									<span>"<?php echo $team->getDescription(); ?>"</span>
								</li>
								<li class="team-select-btn">
									<h3 class='btn btn-pink'>
										<a href="<?php echo WEBPATH.'/detailteam?name='.$team->getName(); ?>">Voir la team</a>
									<h3>
								</li>																		
							</ul>																						
						</div>	
			<?php 
                    endforeach;
                endif;
            ?>

			<div class="grid-md-11 grid-md-offset-1">
				<ul>
		            <nav class="nav_hori page">
		                <ul>
		                    <!-- Pagination -->
		                    <?php 
		                        if(isset($pagination)):
		                            //$nbpages = new team($pagination);
		                            $nbpages =5;
		                            for($cpt=1; $cpt<=$nbpages; $cpt++):
		                                echo ($cpt==1) ? '<li class="border_menu active_menu"><a href="#">1</a></li>' :
		                                 '<li class="border_menu"><a href="#">'.$cpt.'</a></li>';
		                            endfor;
		                        endif;
		                    ?>
		                </ul>
		            </nav>
		        </ul>
			</div>
		</div>
	</div>
</section>