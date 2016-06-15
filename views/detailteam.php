<?php
/*
if(isset($err)){
    ?>
    <section class="absfiche">
        <div>
            ERREUR 404, utilisateur introuvable
            <p><a href="index">Retour à l'accueil</a></p>
        </div>
    </section>
    <?php
}
else{*/
?>
    <section class="middle-height bg-cover-classement relative  align full-height">

        <div id="ID" class=" ">
            <img id="profil" class="grid-md-5 align full-height" src="<?php echo (isset($imgteam)) ? $imgteam : $img; ?>">
            <span class="header-title align full-height" id="name"><?php echo $nameteam;?></span>
        </div>
    </section>

    <div style="margin-top:100px"class="inscription_team">
        Nom de la team : <?php echo $nameteam; ?><br>
        Nombre de membre : <br>
        
        <?php 
            if(isset($idcreator) && $idcreator == $_id){ ?>
                <form action="detailteam/updateTeam" method="POST" >
                    Slogan : <input type="text" name="slogan" value="<?php echo $sloganteam; ?>"> <br>
                    Description : <input type="text" name="description" value="<?php echo $descripteam; ?>"><br>
                    <input type="submit">
                 </form>
      <?php }else{ ?>
                Slogan : <?php echo $descripteam; ?>
                Description : <?php echo $descripteam; ?>
      <?php } ?>
       

        <form action="detailteam/updateUserTeam" method="POST">  
            <input type="hidden" name="nameTeam" value="<?php echo $nameteam;?>">
            <?php 
                if(empty($_isConnected)){
                    echo "Connecte toi pour rejoindre cette guilde !";
                }
                elseif(!empty($_idTeam)){
        
                    if($_idTeam == $idteam) {
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
        </form>
    </div>
    <section class="classement-content-wrapper  align full-height" id ="onglet">

        <div class="container m-a content-border " id="container">
            <div id="container1">
                <div class="activite ">

                    <div class="border"><img class="img" src="web/img/logo-esgi.png"><div><p class="team">ESGI</br></br></br>Il y a 3 mois</br></br></br>ESGI team ssb, mk</p></div></div>
                    <div class="border"><img class="img" src="web/img/logo-esgi.png"><div><p class="team">ESGI</br></br></br>Il y a 3 mois</br></br></br>ESGI team ssb, mk</p></div></div>
                    <div class="border"><img class="img" src="web/img/logo-esgi.png"><div><p class="team">ESGI</br></br></br>Il y a 3 mois</br></br></br>ESGI team ssb, mk</p></div></div>
                </div>
            </div>
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

        </div>

    </section>
<?php //} ?>
