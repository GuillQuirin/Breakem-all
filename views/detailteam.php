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
            <form action="detailteam/updateTeam" method="POST" enctype="multipart/form-data">
                Slogan : <input type="text" name="slogan" value="<?php echo $sloganteam; ?>"> <br>
                Description : <input type="text" name="description" value="<?php echo $descripteam; ?>"><br>
                Image :
                <input class="" type="file" name="img"><br>
                <input type="submit">
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
        <form action="detailteam/updateUserTeam" method="POST"> 
            <div class="align relative button-team">
                <input type="hidden" name="nameTeam" value="<?php echo $nameteam;?>">
                <?php 
                    //Si le user n'est pas connecté
                    if(empty($_isConnected)){
                        echo "Connecte toi pour rejoindre cette guilde !";
                    }
                    elseif(!empty($_idTeam)){
                        //Si le user est le créateur de la team
                        if(isset($idcreator) && isset($_id) && $_id == $idcreator){
                        ?>
                            <button name='action-team-dissoudre' type='submit' class='btn btn-pink'>
                                <a>Dissoudre la Team !</a>
                            </button>
                            <button class="main btn btn-pink">
                                <a class="btn-modif-team">Modifier la Team</a>
                            </button>
                        <?php
                        //Si le user est dans la guilde
                        }elseif($_idTeam == $idteam) {
                         ?>
                            <button name='action-team-exit' type='submit' class='btn btn-pink'>
                                <a>Quitter la Team !</a>
                            </button>
                        <?php
                        //Si le user appartient à une autre guilde
                        }else{
                            echo "Vous faites déjà parti de la team".$nameUserTeam;
                        } 
                    //Si le user n'a pas de guilde
                    }else{ ?>
                        <button name='action-team-rejoin' type='submit' class='btn btn-pink'>
                            <a>Rejoindre la Team !</a>
                        </button>
                <?php } ?>     
            </div>
        </form>
    </section>

    
    <section class="my-content-wrapper team-content-wrapper align full-height">
        <div class=" container m-a content-border team-container">
            <div class="grid-md-4 grid-md-offset-8 contain-member ">
                <div class="title_index">
                    <!-- Récupération de tous les membres de la guilde -->
                    <label for="title1">Membres : 
                    <?php if(isset($listemember)) 
                            echo count($listemember);
                          else 
                            echo "Aucun membre dans cette team"; 
                    ?>            
                    </label>
                </div>
                 <?php   
                    if(isset($listemember)): 
                        foreach ($listemember as $key => $user):
                ?>  
                            <div class=""> 
                                <ul class="grid-md-12 team-select-ul">  
                                    <li>
                                        <img class="" src='<?php echo $user->getImg(); ?>'>
                                    </li>
                                    <li class="team-select-li-name">
                                        <ul><span><?php echo $user->getPseudo(); ?></span>
                                        </ul>
                                    </li>                        
                                </ul>                                                                                       
                            </div>  
                <?php 
                        endforeach;
                    endif;
                ?>
            </div>
            <!--Récupèration du dernier match de la guilde -->
            <div class="grid-md-4 grid-md-offset-8 team-tournoi">
                <div class="title_index ">
                    <label for="title1">Prochain tournoi</label>
                </div>
                <div class="fight">

                    <!-- Tournoi à venir de la guilde -->
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
        </section>

 <?php
    if(isset($_idTeam) && $_idTeam == $idteam){
        ?>
        <section class="contain align full-height">
        <form id="MAJComment" method="POST">
            <?php 
            if(isset($listecomment) && is_array($listecomment)){
                echo "<table>";
                foreach($listecomment as $commentaire){
                    echo '<tr><td>';
                        if($commentaire->getStatus()=="0" && $commentaire->getIdUser()!==$_id) //Le mec va pas s'auto-ban
                            echo '<img class="cursor-pointer signalement" id="comment-report-'.$commentaire->getId().'" src="' . WEBPATH . '/web/img/alert.ico"><a/>';
                        
                        if($commentaire->getStatus()=="0" 
                            && $commentaire->getIdUser()==$_id
                            && time()-strtotime($commentaire->getDate())<1800)
                            echo '<img class="cursor-pointer edition" id="comment-edit-'.$commentaire->getId().'" src="' . WEBPATH . '/web/img/edit.png"><a/>';
                                
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
        Création d'un commentaire:<br>
        <form action="<?php echo WEBPATH.'/detailteam/createComment'; ?>" method="post">
        <textarea name="comment"></textarea>
        <button name='action-comment-write' type='submit' class='btn btn-pink'>
            <a>Rédiger un commentaire</a>
        </button>
        </form>

        <section class="popup-comment-edit">
            <form action="<?php echo WEBPATH.'/detailteam/editComment'; ?>" method="post">
                <input type="hidden" name="id" value="">
                <textarea name="comment"></textarea>
                <input type="submit" value="Mettre à jour">
                <input type="reset" class="cancel" value="Annuler">
            </form>
        </section>

        <?php
    }
} 
?>
