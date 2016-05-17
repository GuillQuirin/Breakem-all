<?php

<<<<<<< HEAD
    <div id="ID" class=" ">
        <img id="profil" class="grid-md-5 align full-height" src="<?php echo $img; ?>">
        <span class="header-title align full-height" id="name">Rayz</span>
    </div>
</section>

<section class="classement-content-wrapper  align full-height" id ="onglet">

    <div class="container m-a content-border " id="container">
        <div id="container1">
            <div class="activite ">

                <div class="border"><img class="img" src="web/img/logo-esgi.png"><div><p class="team">ESGI</br></br></br>Il y a 3 mois</br></br></br>ESGI team ssb, mk</p></div></div>
                <div class="border"><img class="img" src="web/img/logo-esgi.png"><div><p class="team">ESGI</br></br></br>Il y a 3 mois</br></br></br>ESGI team ssb, mk</p></div></div>
                <div class="border"><img class="img" src="web/img/logo-esgi.png"><div><p class="team">ESGI</br></br></br>Il y a 3 mois</br></br></br>ESGI team ssb, mk</p></div></div>
            </div>
=======
if(isset($err)){
    ?>
    <section class="absfiche">
        <div>
            ERREUR 404, utilisateur introuvable
            <p><a href="index">Retour à l'accueil</a></p>
>>>>>>> 6ffa5909b9aa1c2d39f708d77fe56a2d7a6df8a1
        </div>
    </section>
    <?php
}
else{
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
        Slogan : <?php echo $sloganteam; ?> <br>
        Description : <?php echo $descripteam; echo $_idTeam; ?><br>

       
            <button id='action-user-team' type='submit' class='btn btn-pink'>
                 <?php 
                    if(isset($_idTeam) && $_idTeam == 0){
                        echo "<a>Rejoindre la guide !</a>";
                    }elseif($_idTeam == $idteam) {
                        echo "<a>Quitter la guilde !</a>";
                    } ?> 
            </button>      
        
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
<?php } ?>
