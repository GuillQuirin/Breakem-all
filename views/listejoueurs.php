<?php 
if(isset($liste) && is_array($liste)){
	foreach ($liste as $key => $joueur) {
	?>
		<div class="classement-select background-wrapper shadow-bottom-full">	
			<ul class="grid-md-6 grid-md-offset-1 classement-select-ul classement-header-select-ul">	
				<li>
					<?php echo '<img class="classement-select-image" src="' . WEBPATH . '/web/img/upload/'.$joueur->getId().'.jpg">';?>
				</li>
				<li>
					<span><?php echo $joueur->getPseudo(); ?></span>
				</li>
				<li class="classement-select-li-quote">
					<button><a href="">Profil</a></button>
				</li>
				<?php 
					if($joueur->getIdTeam()){
						?>
							<li class="classement-select-pts">
								<button><a href="">Team</a></button>
							</li>
						<?php
					}
				?>																			
			</ul>																						
		</div>	
	<?php
	}
}
else
	echo "Pas de joueurs trouvés.";
?>
