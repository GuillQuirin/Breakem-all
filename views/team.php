<!-- Liste des tournois en cours -->
<?php   
    if(isset($listeteam)): 
        foreach ($listeteam as $key => $team):
?>  
            <article id='article[]'>
                <div class='contain_article'>
                    <div class='img_article'>
                        <img src='<?php echo $team->getImg(); ?>'>
                    </div>
                    <div class='text_article'>
                        <h2><?php echo $team->getName(); ?></h2>
                        <div class='tags_article'>
                            <h3><?php echo $team->getDescription(); ?></h3>
                        </div>
                        <div class='btn_article'>
                            <h3 class='btn btn-pink'><a href="detailteam?t=<?php echo $team->getName(); ?>">Voir la team</a><h3>
                        </div>
                    </div>
                </div>
            </article>
<?php 
        endforeach;
    endif;
?>
