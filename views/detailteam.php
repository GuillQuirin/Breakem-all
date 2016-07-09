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
		        <table>
                    <tr>
                        <td>Slogan : </td>
                        <td>
                            <input class="input-default" type="text" name="slogan" value="<?php echo $sloganteam; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Description : </td>
                        <td>
                            <textarea  class="desc-default" rows="3" name="description" ><?php echo $descripteam; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Image : </td>
                        <td>
                            <input class="image-default" type=file name="img">
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2>
                            <button id='action-team-modif' type='submit' class='btn btn-pink admin-form-submit'>
                                <a>Modifier ma team</a>
                            </button>
                        </td>
                    </tr>
                </table>                
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
        <?php if(isset($sloganteam)) echo '"'.$sloganteam.'"'; ?>
    </div>

    <!-- Bouton selon le user --> 
     <section class="relative align">
        <form action="<?php echo WEBPATH.'/detailteam/updateUserTeam'; ?>" method="POST"> 
            <div class="align relative button-team">
                <input type="hidden" name="nameTeam" value="<?php echo $nameteam;?>">
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
                            echo "Vous faites déjà parti de la team".$nameUserTeam;
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

    
    <section >
        <div class="grid-md-4 grid-md-offset-8 grid-xs-offset-1 contain-member ">
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
    </section>
    
    <section class="my-content-wrapper team-content-wrapper align full-height">
        <div class=" container m-a content-border team-container">
            <div class="liste_member grid-md-4">
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
            <div class="grid-md-offset-2 grid-xs-offset-5 grid-sm-offset-3 description-team">
                Description de la team : <?php echo $description; ?>
            </div>

            
            <!--Récupèration du dernier match de la team -->
            <div class="grid-md-4 team-tournoi">
                <div class="title_index ">
                    <label for="title3">Prochain tournoi</label>
                </div>
                <div class="fight">

                    <!-- Tournoi à venir de la team -->
                    <?php //echo $fight; ?>
                    <h3>ESL</h3>
                    <p class="date_fight">1er Avril 2016, 17h00</p>
                    <?php echo '<img src="' . WEBPATH . '/web/img/navi.jpg">';?>
                    <?php echo '<img src="' . WEBPATH . '/web/img/fnatic.jpg">';?>
                    <div class="name_fight">
                        <ul>
                            <li>Navi</li>
                            <li>Fnatic</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--Récupèration du dernier match de la team -->
            <div class="grid-md-4 team-tournoi">
                <div class="title_index ">
                    <label for="title3">Prochain tournoi</label>
                </div>
                <div class="fight">

                    <!-- Tournoi à venir de la team -->
                    <?php //echo $fight; ?>
                    <h3>ESL</h3>
                    <p class="date_fight">1er Avril 2016, 17h00</p>
                    <?php echo '<img src="' . WEBPATH . '/web/img/navi.jpg">';?>
                    <?php echo '<img src="' . WEBPATH . '/web/img/fnatic.jpg">';?>
                    <div class="name_fight">
                        <ul>
                            <li>Navi</li>
                            <li>Fnatic</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="grid-md-10 commentaire-team">
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
                                            "<?php echo $commentaire->getComment(); ?>"
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        }
                        ?>
                    </div>
                    <div class="textarea-comment">
                        <form action="<?php echo WEBPATH.'/detailteam/createComment'; ?>" method="post">
                            <h2>Rédiger un commentaire :</h2>
                            <textarea name="comment" placeholder='Mettez votre commentaire ici !'></textarea><br>
                            <button name='action-team-comment' type='submit' class='btn btn-pink team-comment'>
                                <a>Envoyer votre commentaire</a>
                            </button>
                        </form>
                    </div>
                <?php
                }else{
                     echo "Connecte toi pour voir les commentaires de cette team !";
                }
                ?>
            </div>
        </div>   
    </section>
        <?php
/*
		//Espace commentaire: reservé aux membres de la team
	    if(isset($_idTeam) && $_idTeam == $idteam){
         ?>

            <section class="contain align full-height">
                <form id="MAJComment" method="POST">
                    <?php 
                    if(isset($listecomment) && is_array($listecomment)){
                        echo "<table>";
                        foreach($listecomment as $commentaire){

                            echo '<tr><td>';
                                if($commentaire->getStatus()=="0" 
                                    && $commentaire->getIdUser()!==$_id){ //Le mec va pas s'auto-ban
                                    echo '<img class="cursor-pointer signalement" id="comment-report-'.$commentaire->getId().'" src="' . WEBPATH . '/web/img/alert.ico"><a/>';
                                }
                                
                                if($commentaire->getStatus()=="0" 
                                    && $commentaire->getIdUser()==$_id 
                                    && time()-strtotime($commentaire->getDate())<1800){
                                        echo '<img class="cursor-pointer edition" id="comment-edit-'.$commentaire->getId().'" src="' . WEBPATH . '/web/img/edit.png"><a/>';
                                    }
                                    echo '<p>'.$commentaire->getPseudo().'</p>';

                                    echo ($commentaire->getStatus()==-1) ? 
                                            '<p class="italic">Ce commentaire a été modéré.</p>' :
                                            '<p class="message">'.$commentaire->getComment().'</p>';
                                    echo '</td></tr>';
                                
                        }
                        echo "</table>";
                    }
                    ?>
                </form>
            </section>

            <section class="popup-comment-edit">
                <form action="<?php echo WEBPATH.'/detailteam/editComment'; ?>" method="post">
                    <input type="hidden" name="id" value="">
                    <textarea name="comment"></textarea>
                    <input type="submit" value="Mettre à jour">
                    <input type="reset" class="cancel" value="Annuler">
                </form>
            </section>
    </div>
    <?php
        }*/

        ?>
<?php 
} 
?>
