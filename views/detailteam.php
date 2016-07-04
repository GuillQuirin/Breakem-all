<?php

if(isset($err)){
    ?>
    <section class="absfiche">
        <div>
            ERREUR 404, team introuvable
            <p><a href="index">Retour à l'accueil</a></p>
        </div>
    </section>
    <?php
}
else{
?>  
     <section class="popup">
        <div class="popup-contain">
            <h2>Modifie ta Team</h2>
            <form action="detailteam/updateTeam" method="POST" enctype="multipart/form-data">
                Slogan : <input type="text" name="slogan" value="<?php echo $sloganteam; ?>"> <br>
                Description : <input type="text" name="description" value="<?php echo $descripteam; ?>"><br>
                Image :
                <input class="" type=file name="img"><br>
                <input type="submit">
            </form>
        </div>
        <div class="popup-fond"></div>
    </section> 

    <section class="middle-height bg-cover-detailteam relative  align full-height">
        <div class="team-title">
            <img class="grid-md-5 align full-height" src="<?php if(isset($img))echo WEBPATH."/web/img/upload/".$img ?>">
            <span class="header-title align full-height"><?php echo $nameteam;?></span>
        </div>

        <img class="icon icon-size-3 down-center header-scroll-down" id="classement-header-scroll-down" src="web/img/icon/icon-scrollDown.png"> 
    </section>

     <section class="relative align">
        <form action="detailteam/updateUserTeam" method="POST"> 
            <div class="align relative button-team">
                <input type="hidden" name="nameTeam" value="<?php echo $nameteam;?>">
                <?php 
                    if(empty($_isConnected)){
                        echo "Connecte toi pour rejoindre cette guilde !";
                    }
                    elseif(!empty($_idTeam)){
                        if(isset($idcreator) && isset($_id) && $_id == $idcreator){
                        ?>
                            <button name='action-team-dissoudre' type='submit' class='btn btn-pink'>
                                <a>Dissoudre la Team !</a>
                            </button>
                            <button class="main btn btn-pink">
                                <a href="#" class="btn-modif-team">Modifier Team</a>
                            </button>
                        <?php
                        }elseif($_idTeam == $idteam) {
                         ?>
                            <button name='action-team-exit' type='submit' class='btn btn-pink'>
                                <a>Quitter la Team !</a>
                            </button>
                        <?php
                        }else{
                            echo "Vous faites déjà parti de la team ".$nameUserTeam;
                        } 
                    }else{ ?>
                        <button name='action-team-rejoin' type='submit' class='btn btn-pink'>
                            <a>Rejoindre la Team !</a>
                        </button>
                <?php } ?>     
            </div>
        </form>
    </section>

                Slogan : <?php echo $sloganteam; ?>
                Description : <?php echo $descripteam; ?>

    <section class="contain-team align full-height">

          <div class="grid-md-4 grid-md-offset-8 contain-member team-select shadow-bottom-full">
            <div class="title_index">
                <label for="title1">Membres : <?php if(isset($listemember)) echo count($listemember);else echo "Aucun membre dans cette team" ?></label>
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
    </section>

    <section class="contain align full-height">
            <div class="grid-md-4">
                <div class="title_index">
                    <label for="title1">Prochain match</label>
                </div>
                <div class="fight">

                    <!-- Match à venir -->
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

<!--
        <div class="container m-a content-border " id="container">
            <div id="container1">
                <div class="activite ">

                    <div class="border"><img class="img" src="web/img/logo-esgi.png"><div><p class="team">ESGI</br></br></br>Il y a 3 mois</br></br></br>ESGI team ssb, mk</p></div></div>
                    <div class="border"><img class="img" src="web/img/logo-esgi.png"><div><p class="team">ESGI</br></br></br>Il y a 3 mois</br></br></br>ESGI team ssb, mk</p></div></div>
                    <div class="border"><img class="img" src="web/img/logo-esgi.png"><div><p class="team">ESGI</br></br></br>Il y a 3 mois</br></br></br>ESGI team ssb, mk</p></div></div>
                </div>
            </div>
          

            <!--
            <div id="container2">
                <div id="member">
               
                    <p id="member1">Membres</p>
                </div>
                        <div id="member2" >
                            <img id="profil1" class="grid-md-5 " src="web/img/Rayz.jpg">
                            <span class=" name" >Rayz</span>
                            <img id="profil1" class="grid-md-5 " src="web/img/Rayz.jpg">
                            <span class=" name" >Rayz</span>
                            <img id="profil1" class="grid-md-5 " src="web/img/Rayz.jpg">
                            <span class="name"  >Rayz</span>
                        </div>
            </div>


            <div id="container3">
                <div id="match">
                    <p id="match1">Prochain matchs</p>
                </div>
                <div id="match2">
                    <p id ="match3">Navi VS Fnatic</p>
                </div>
            </div>

        </div>-->

    </section>
<?php 
} 
?>
