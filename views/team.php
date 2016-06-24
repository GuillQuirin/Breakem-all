<!-- Liste des tournois en cours -->
<?php   
    if(isset($listeteam)): 
        foreach ($listeteam as $key => $team):
?>  
            <article style="margin-top:50px" id='article<?php echo $key;?>' >
                <div class='contain_article'>
                    <div class='img_article'>
                        <img style="width:50px" src='<?php echo $team->getImg(); ?>'>
                    </div>
                    <div class='text_article'>
                        <h2><?php echo $team->getName(); ?></h2>
                        <div class='tags_article'>
                            <h3><?php echo $team->getDescription(); ?></h3>
                        </div>
                        <div class='btn_article'>
                            <h3 class='btn btn-pink'><a href="detailteam?name=<?php echo $team->getName(); ?>">Voir la team</a><h3>
                        </div>
                    </div>
                </div>
            </article>
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
