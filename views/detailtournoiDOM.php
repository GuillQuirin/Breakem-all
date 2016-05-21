<?php if(isset($tournoi)): ?>
	<section class="detailtournoi-infos flex">
		<aside class="ta-center relative">
			<img src="<?php echo $tournoi->getGameImg();?>" alt="Battlefield 3">
			<figcaption class="ta-center italic">Pour les gamers sur <?php echo $tournoi->getPName();?> seulement !</figcaption>
			<?php if($tournoi->getUserPseudo() !== $_pseudo):?>
				<div class="relative ta-right">
					<button class="detailtournoi-btn-inscription relative btn btn-pink"><a>Rejoindre</a></button>
				</div>
			<?php else: ?>
				<div class="relative ta-right">
					<button class="detailtournoi-btn-inscription relative btn btn-pink"><a>Gérer</a></button>
				</div>
			<?php endif; ?>
		</aside>
		<article>
			<div class="ta-center">
				<h3 class="titre1">Tournoi - 
					<span class="capitalize"><?php echo $tournoi->getGameName(); ?></span>
				</h3>
			</div>
			<p class="detailtournoi-description-jeu italic">
				<?php echo $tournoi->getGameDescription(); ?>
				
			</p>
			<div class="detailtournoi-tournoi-regles flex">
				<p class="relative detailtournoi-jeu-mode capitalize">Mode:
					<span class="relative">
						<?php echo $tournoi->getGvName();
							if($tournoi->getMaxPlayerPerTeam() > 1){
								echo " - Equipes";
								if($tournoi->getGuildOnly() > 0)
									echo " de guildes uniquement";
								else if($tournoi->getRandomPlayerMix() > 0)
									echo " aléatoires";
							}
					 	?>						
						<i class="absolute ta-center lowercase"><?php echo $tournoi->getGvDescription(); ?>
						</i>
					</span>
				</p>
				<p class="relative detailtournoi-points-gagnants">À gagner : 
					<span class="relative">XXX points
						<i class="absolute ta-center">??% (XX points) à répartir dans l'équipe gagnante</i>
					</span>
				</p>
				<p class="relative detailtournoi-jeu-console">Console: 
					<span class="capitalize"><?php echo $tournoi->getPName(); ?></span>
				</p>
				<p class="relative detailtournoi-jeu-online">Où: 
					<span class="capitalize">online</span>
				</p>
				<p class="relative detailtournoi-jeu-maxjoueurs">Joueurs max: 
					<span><?php echo $tournoi->getMaxPlayer(); ?></span>
				</p>
				<p class="relative detailtournoi-jeu-minjoueurs">Joueurs min: <span><?php echo $tournoi->getMaxPlayer()/2; ?></span></p>
				<p class="relative detailtournoi-jeu-victoire">Règles: <span>rencontres de XX (3??) manches</span></p>
				<p class="relative detailtournoi-jeu-reglesEquipe">Equipes: 
					<span><?php 						
						if($tournoi->getMaxPlayerPerTeam() > 1){
							echo "Equipes de " . $tournoi->getMaxPlayerPerTeam();
							if($tournoi->getGuildOnly() > 0)
								echo " - Guildes uniquement";
							else if($tournoi->getRandomPlayerMix() > 0)
								echo " - Aléatoires";
							else
								echo " - Au choix";
						}else{
							echo "Solo";
						}
				 	?></span>
				</p>
				<p class="relative detailtournoi-jeu-date">Quand : 
					<span><?php echo date('d-m-Y',$tournoi->getStartDate());?></span>
				</p>
				<p class="relative detailtournoi-jeu-organisateur">Orga : 
					<span class="uppercase"><a href="<?php echo WEBPATH. '/profil?pseudo=' . $tournoi->getUserPseudo(); ?>"><?php echo $tournoi->getUserPseudo(); ?></a></span>
				</p>
			</div>
		</article>
	</section>
	<section class="detailtournoi-participants flex-row">
		<h2 class="titre2">Participants <span class="detailtournoi-nombre-participants">(16)</span></h2>
		<div class="flex detailtournoi-liste-participants">
			<div class="detailtournoi-participant relative flex">
				<p class="detailtournoi-participant-pseudo"><a>Fyjal</a><span class="absolute detailtournoi-stats-joueur">87 victoires, 51%win</span></p>
				<p class="detailtournoi-participant-points absolute">1200</p>
				<button class="detailtournoi-btn-fichejoueur relative"><a></a></button>
			</div>
			<div class="detailtournoi-participant relative flex">
				<p class="detailtournoi-participant-pseudo"><a>dRowiid</a><span class="absolute detailtournoi-stats-joueur">65 victoires, 49%win</span></p>
				<p class="detailtournoi-participant-points absolute">955</p>
				<button class="detailtournoi-btn-fichejoueur relative"><a></a></button>
			</div>	
			<div class="detailtournoi-participant relative flex">
				<p class="detailtournoi-participant-pseudo"><a>Rcan</a><span class="absolute detailtournoi-stats-joueur">90 victoires, 13%win</span></p>
				<p class="detailtournoi-participant-points absolute">892</p>
				<button class="detailtournoi-btn-fichejoueur relative"><a></a></button>
			</div>
			<div class="detailtournoi-participant relative flex">
				<p class="detailtournoi-participant-pseudo"><a>ooBsidian</a><span class="absolute detailtournoi-stats-joueur">112 victoires, 9%win</span></p>
				<p class="detailtournoi-participant-points absolute">865</p>
				<button class="detailtournoi-btn-fichejoueur relative"><a></a></button>
			</div>
			<div class="detailtournoi-participant relative flex">
				<p class="detailtournoi-participant-pseudo"><a>GWlord</a><span class="absolute detailtournoi-stats-joueur">13 victoires, 100%win</span></p>
				<p class="detailtournoi-participant-points absolute">623</p>
				<button class="detailtournoi-btn-fichejoueur relative"><a></a></button>
			</div>
			<div class="detailtournoi-participant relative flex">
				<p class="detailtournoi-participant-pseudo"><a>milky</a><span class="absolute detailtournoi-stats-joueur">58 victoires, 67%win</span></p>
				<p class="detailtournoi-participant-points absolute">601</p>
				<button class="detailtournoi-btn-fichejoueur relative"><a></a></button>
			</div>
			<div class="detailtournoi-participant relative flex">
				<p class="detailtournoi-participant-pseudo"><a>anyTi</a><span class="absolute detailtournoi-stats-joueur">12 victoires, 100%win</span></p>
				<p class="detailtournoi-participant-points absolute">522</p>
				<button class="detailtournoi-btn-fichejoueur relative"><a></a></button>
			</div>
			<div class="detailtournoi-participant relative flex">
				<p class="detailtournoi-participant-pseudo"><a>supYo</a><span class="absolute detailtournoi-stats-joueur">45 victoires, 68%win</span></p>
				<p class="detailtournoi-participant-points absolute">431</p>
				<button class="detailtournoi-btn-fichejoueur relative"><a></a></button>
			</div>
			<div class="detailtournoi-participant relative flex">
				<p class="detailtournoi-participant-pseudo"><a>dHYdo</a><span class="absolute detailtournoi-stats-joueur">76 victoires, 25%win</span></p>
				<p class="detailtournoi-participant-points absolute">431</p>
				<button class="detailtournoi-btn-fichejoueur relative"><a></a></button>
			</div>
			<div class="detailtournoi-participant relative flex">
				<p class="detailtournoi-participant-pseudo"><a>comeAgn</a><span class="absolute detailtournoi-stats-joueur">50 victoires, 51%win</span></p>
				<p class="detailtournoi-participant-points absolute">426</p>
				<button class="detailtournoi-btn-fichejoueur relative"><a></a></button>
			</div>
			<div class="detailtournoi-participant relative flex">
				<p class="detailtournoi-participant-pseudo"><a>headsRoll</a><span class="absolute detailtournoi-stats-joueur">19 victoires, 95%win</span></p>
				<p class="detailtournoi-participant-points absolute">403</p>
				<button class="detailtournoi-btn-fichejoueur relative"><a></a></button>
			</div>
			<div class="detailtournoi-participant relative flex">
				<p class="detailtournoi-participant-pseudo"><a>n_e_day</a><span class="absolute detailtournoi-stats-joueur">10 victoires, 42%win</span></p>
				<p class="detailtournoi-participant-points absolute">386</p>
				<button class="detailtournoi-btn-fichejoueur relative"><a></a></button>
			</div>
			<div class="detailtournoi-participant relative flex">
				<p class="detailtournoi-participant-pseudo"><a>i_c_u</a><span class="absolute detailtournoi-stats-joueur">2 victoires, 90%win</span></p>
				<p class="detailtournoi-participant-points absolute">374</p>
				<button class="detailtournoi-btn-fichejoueur relative"><a></a></button>
			</div>
			<div class="detailtournoi-participant relative flex">
				<p class="detailtournoi-participant-pseudo"><a>pbblyNot</a><span class="absolute detailtournoi-stats-joueur">32 victoires, 12%win</span></p>
				<p class="detailtournoi-participant-points absolute">327</p>
				<button class="detailtournoi-btn-fichejoueur relative"><a></a></button>
			</div>
			<div class="detailtournoi-participant relative flex">
				<p class="detailtournoi-participant-pseudo"><a>irdc</a><span class="absolute detailtournoi-stats-joueur">5 victoires, 3%win</span></p>
				<p class="detailtournoi-participant-points absolute">308</p>
				<button class="detailtournoi-btn-fichejoueur relative"><a></a></button>
			</div>
			<div class="detailtournoi-participant relative flex">
				<p class="detailtournoi-participant-pseudo"><a>rtfm</a><span class="absolute detailtournoi-stats-joueur">21 victoires, 18%win</span></p>
				<p class="detailtournoi-participant-points absolute">308</p>
				<button class="detailtournoi-btn-fichejoueur relative"><a></a></button>
			</div>
		</div>
	</section>
	<!-- <section class="detailtournoi-bracket">
		<h2 class="titre2">Resultats des rounds - Bracket</h2>
	</section> -->
	<section class="detailtournoi-commentaires flex-row">
		<h2 class='titre2'>Commentaires</h2>
		<div class="detailtournoi-container-commentaires">
			<div class="relative detailtournoi-commentaire">
				<div class="detailtournoi-commentaire-date italic ta-right">
					<h5>16/02 09:08</h5>
				</div>
				<div class="detailtournoi-commentaire-pseudo">
					<p><a>dRowiid</a></p>
				</div>
				<div class="detailtournoi-commentaire-userpick">
					<p class="detailtournoi-message">Futura quidem sed Mihi hodie qualis autem futurum ire coepit Mihi sed inferentem quis supplicio.</p>
				</div>
			</div>
			<div class="relative detailtournoi-commentaire">
				<div class="detailtournoi-commentaire-date italic ta-right">
					<h5>Lun 02:00</h5>
				</div>
				<div class="detailtournoi-commentaire-pseudo">
					<p><a>Fyjal</a></p>
				</div>
				<div class="detailtournoi-commentaire-userpick">
					<p class="detailtournoi-message">Futura quidem sed Mihi hodie qualis autem futurum ire coepit Mihi sed inferentem quis supplicio.</p>
				</div>
			</div>
			<div class="relative detailtournoi-commentaire">
				<div class="detailtournoi-commentaire-date italic ta-right">
					<h5>Lun 03:12</h5>
				</div>
				<div class="detailtournoi-commentaire-pseudo">
					<p><a>Ypsos</a></p>
				</div>
				<div class="detailtournoi-commentaire-userpick">
					<p class="detailtournoi-message">Valet amicitiam ad comparandis ferendum potius Quin ad praeceptum quem amicitiam adhiberemus amare ferendum amicitiis.</p>
				</div>
			</div>
			<div class="relative detailtournoi-commentaire">
				<div class="detailtournoi-commentaire-date italic ta-right">
					<h5>Lun 03:17</h5>
				</div>
				<div class="detailtournoi-commentaire-pseudo">
					<p><a>OopsIdian</a></p>
				</div>
				<div class="detailtournoi-commentaire-userpick">
					<p class="detailtournoi-message">Saeculis Damascus quibus Damascus et monti urbibus Berytus Emissa magnis Sidon celebritateque quibus quibus adclinis.</p>
				</div>
			</div>
			<div class="relative detailtournoi-commentaire detailtournoi-commentaire-current-user">
				<div class="detailtournoi-commentaire-date italic ta-right">
					<h5>Mar 19:17</h5>
				</div>
				<div class="detailtournoi-commentaire-pseudo">
					<p><a>Toi</a></p>
				</div>
				<div class="detailtournoi-commentaire-userpick">
					<p class="detailtournoi-message">Saeculis Damascus quibus Damascus et monti urbibus Berytus Emissa magnis Sidon celebritateque quibus quibus adclinis.</p>
				</div>
			</div>
			<div class="relative detailtournoi-commentaire">
				<div class="detailtournoi-commentaire-date italic ta-right">
					<h5>Mar 20:12</h5>
				</div>
				<div class="detailtournoi-commentaire-pseudo">
					<p><a>RxR_d</a></p>
				</div>
				<div class="detailtournoi-commentaire-userpick">
					<p class="detailtournoi-message">Constantio aetatis e atque praefecturae consulares inmaturo et quadriennio ipse.</p>
				</div>
			</div>
		</div>
		<div class="detailtournoi-container-post-commentaire">
			<div class="detailtournoi-post-container">
				<form  method="post">
					<textarea name="commentaire-post" cols="30" rows="10" placeholder="Votre message ici.." maxlength="255"></textarea>
					<input type="submit" value="" hidden>
				</form>
			</div>
		</div>
	</section>
<?php endif; ?>