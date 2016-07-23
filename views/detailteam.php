<?php

if(isset($err)){
    ?>
    <section class="absfiche">
        <div>
            ERREUR 404, team introuvable
            <p><a href="<?php echo WEBPATH.'/index'; ?>">Retour à l'accueil</a></p>
        </div>
    </section>
    <?php
}
else{
?>  
    <!-- Popup modification de la team -->
    <section class="popup">
        <div class="popup-contain">
            <h2>Modifie ta Team</h2>
            <form class="formteam" action="<?php echo WEBPATH.'/detailteam/updateTeam'; ?>" method="POST" enctype="multipart/form-data">
		        <div>
                    <p>Slogan <input class="input-default" type="text" name="slogan" value="<?php if(isset($sloganteam)) echo $sloganteam; ?>"></p>
                    <p>Description  <textarea  class="desc-default" rows="3" name="description" ><?php if(isset($description)) echo $description; ?></textarea>
                        </p>
                    <p>Image  <input class="image-default" type="file" name="img"></p>
                    <p>
                        <button id='action-team-modif' type='submit' class='btn btn-pink admin-form-submit'>
                            <a>Modifier ma team</a>
                        </button>
                    </p>
                </div> 
                <input type="hidden" value="<?php if(isset($nameteam)) echo $nameteam;?>"name="nameTeam">               
            </form>
        </div>
        <div class="popup-fond"></div>
    </section> 

    <!-- Titre : Nom de la team -->
    <section class="middle-height bg-cover-detailteam relative  align full-height">
        <div class="team-title">
            <img class="grid-md-5 align full-height" src="<?php if(isset($img)) echo $img; ?>">
            <span class="header-title align full-height"><?php if(isset($nameteam)) echo $nameteam;?></span>
        </div>
    </section>

    <!-- Slogan -->
    <div class="slogan-title align">
        <?php if(isset($sloganteam)){echo '"'.$sloganteam.'"';}else{echo '"Slogan de la Team"';} ?>
    </div>
    <section>
        <div class="msg-team text-center">
            <?php
                if(isset($rejoin_team))
                    echo 'Vous avez bien rejoint la team.';
                if(isset($exit_team))
                    echo 'Vous avez bien quitté la team.';
                if(isset($create_comment))
                    echo 'Votre commentaire a bien été ajouté.';
                ?>
                <p id="msg-error" class="error-img"></p>
                <?php
                if(isset($error_create_comment))
                    echo '<p class="error-img"> Vous ne pouvez pas envoyer un commentaire vide.</p>';
                if(isset($modif_team) && isset($img_error)){
                    echo '<p class="error-img"> Votre image est trop lourde. Elle doit faire moins de 1MB.</p>';
                }else if(isset($modif_team)){
                    echo 'Vous avez bien modifié la team.';
                }
                
                    
            ?>
        </div>
    </section>
    <!-- Bouton selon le user --> 
     <section class="relative align">
        
        <form action="<?php echo WEBPATH.'/detailteam/updateUserTeam'; ?>" method="POST"> 
            <div class="align relative button-team">
                <input type="hidden" name="nameTeam" value="<?php if(isset($nameteam)) echo $nameteam;?>">
                <?php 
                    //Si le user n'est pas connecté
                    if(empty($_isConnected)){
                        echo "Connecte toi pour rejoindre cette team !";
                    }
                    elseif(!empty($_idTeam)){
                        //Si le user est le créateur de la team
                        if(isset($idcreator) && isset($_id) && $_id == $idcreator){
                        ?>
                            <button name='action-team-dissoudre' type='submit' class='btn btn-pink'>
                                <a>Dissoudre la Team !</a>
                            </button>
                            <button class="main btn btn-pink">
                                <a class="btn-modif-team">Modifier Team</a>
                            </button>
                        <?php
                        //Si le user est dans la team
                        }elseif($_idTeam == $idteam) {
                         ?>
                            <button name='action-team-exit' type='submit' class='btn btn-pink'>
                                <a>Quitter la Team !</a>
                            </button>
                        <?php
                        //Si le user appartient à une autre team
                        }else{
                            echo "Vous faites déjà parti de la team ".$nameUserTeam.".";
                        } 
                    //Si le user n'a pas de team
                    }else{ ?>
                        <button name='action-team-rejoin' type='submit' class='btn btn-pink'>
                            <a>Rejoindre la Team !</a>
                        </button>
                <?php } ?>     
            </div>
        </form>
    </section>


    
    <section class="my-content-wrapper team-content-wrapper align full-height">
        <div class="container m-a content-border team-container">
            <div class="grid-md-3 ontain-member ">
                <div class="title_index">
                    <!-- Récupération de tous les membres de la team -->
                    <label for="title1">Membres : <?php if(isset($listemember)) echo count($listemember);else echo "Aucun membre dans cette team" ?></label>
                </div>
                <?php   
                    if(isset($listemember)): 
                        foreach ($listemember as $key => $user):
                ?>  
                            <div class="liste_member"> 
                                <ul class="grid-md-12 team-select-ul">  
                                    <li>
                                        <img src='<?php echo $user->getImg(); ?>'>
                                        <ul class="pseudo_member pseudo">
                                            <span><a href="<?php echo WEBPATH.'/profil?pseudo='.$user->getPseudo();?>">
                                                <?php echo $user->getPseudo(); ?></a>
                                            </span>
                                            <?php 
                                            if($idcreator == $user->getId()){ ?>
                                                <img class="crown" src="<?php echo WEBPATH.'/web/img/crown.png';?>">
                                            <?php  
                                            } ?>
                                        </ul>
                                        
                                    </li>                     
                                </ul>   
                            </div>  
                <?php
                        endforeach;
                    endif;
                ?>
            </div>  
            <div class="grid-md-7 grid-md-offset-3 description-team" >
                <div class="liste_member">
                    <?php   
                        if(isset($listemember)): 
                            foreach ($listemember as $key => $user):
                                if($idcreator == $user->getId()){ ?>
                                    <div class="leader_member"> 
                                        <div class="title_index">
                                            <label for="title-leader">Leader </label>
                                        </div>
                                        <ul class="grid-md-12 team-select-ul">  
                                            <li>
                                                <img src='<?php echo $user->getImg(); ?>'>
                                            </li>                 
                                            <li>
                                                <ul class="pseudo pseudo-leader">
                                                    <span><a href="<?php echo WEBPATH.'/profil?pseudo='.$user->getPseudo();?>">
                                                        <?php echo $user->getPseudo(); ?></a>
                                                    </span>
                                                </ul>
                                            </li>    
                                        </ul>   
                                    </div>  
                    <?php 
                                }
                            endforeach;
                        endif;
                    ?>
                </div>
                <div class="text-descrip break-word">
                    Description de la team :<br> <?php if(isset($description)) echo $description; ?>
                </div>
            </div>
            <div class="grid-md-5 grid-md-offset-1 commentaire-team">
                <div class="title_index">
                    <label for="title3">Commentaire</label>
                </div>

                <?php
                if(!empty($_isConnected)){
                ?>
                    <div class="contain full-height">
                        <?php 
                        if(isset($listecomment) && is_array($listecomment)){
                            foreach($listecomment as $commentaire){
                            ?>
                                <div class='container-comment'>
                                    <div class='comment-img'>
                                        <?php echo '<img src="' .$commentaire->getImg().'">'; ?>
                                    </div>
                                    <div class='contain-text-comment'>
                                        <div class='comment-user pseudo'>
                                            <span><a href="<?php echo WEBPATH.'/profil?pseudo='.$commentaire->getPseudo();?>">
                                                    <?php echo $commentaire->getPseudo(); ?></a>
                                            </span>
                                        </div>
                                        <div class='comment'>
                                            <?php
                                            echo ($commentaire->getStatus()==-1) ? 
                                                '<p class="italic">Ce commentaire a été modéré.</p>' :
                                                $commentaire->getComment();
                                            ?>
                                        </div>
                                        <div class="contain-button">
                                        <?php
                                            if($commentaire->getStatus()=="0" && $commentaire->getIdUser()!==$_id)  
                                                //Le mec va pas s'auto-ban
                                                echo "<p class='cursor- pointer' id='comment-report-".$commentaire->getId()."'><a>Signaler</a></p>";
                                            
                                            if($commentaire->getStatus()=="0" && $commentaire->getIdUser()==$_id && time()-strtotime($commentaire->getDate())<1800)
                                                //Commentaire modifiable à 30 min
                                                echo "<p class='cursor-pointer' id='comment-edit-".$commentaire->getId()."'><a>Modifier</a></p>";
                                        ?>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        }
                        ?>
                    </div>
                    <div class="textarea-comment">
                    <h2>Rédiger un commentaire :</h2>
                    <?php 
                    if(isset($_idTeam) && $_idTeam == $idteam){
                    ?>
                            <form action="<?php echo WEBPATH.'/detailteam/createComment'; ?>" method="post">
                             
                                <textarea name="comment" placeholder='Mettez votre commentaire ici !'></textarea><br>
                                <button name='action-team-comment' type='submit' class='btn btn-pink team-comment'>
                                    <a>Envoyer votre commentaire</a>
                                </button>
                            </form>
                        </div>
                    <?php
                    }else{
                        echo "Vous ne pouvez pas rédiger de commentaire car vous n'êtes pas dans cette Team.";
                    }
                }else{
                     echo "Connecte toi pour voir les commentaires de cette Team !";
                }
                ?>
            </div>
        </div>   
    </section>
    <section class="popup-comment-edit">
        <form action="<?php echo WEBPATH.'/detailteam/editComment'; ?>" method="post">
            <input type="hidden" name="id" value="">
            <p>Editer mon commentaire</p>
            <textarea name="comment" class="desc-default"></textarea>
            <button class="btn btn-pink" type="submit" value="Mettre à jour">
                <a>Mettre à jour</a>
            </button>
        </form>
    </section>
<?php 
} 
?>
