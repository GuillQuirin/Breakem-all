<div class="admin-wrapper membres" id="admin-onglet-membres-wrapper">
	<?php 			
		if(is_array($listejoueur)){
		?>								

			<div class='admin-data-ihm-title align'>		
				<div class='admin-test'><div class='admin-data-ihm-elem-title'><span>Pseudo</span></div></div>
				<div class='admin-test'><div class='admin-data-ihm-elem-title'><span>E-mail</span></div></div>
				<div class='admin-test'><div class='admin-data-ihm-elem-title'><span>Image</span></div></div>
				<div class='admin-test'><div class='admin-data-ihm-elem-title'><span>Team</span></div></div>
				<div class='admin-test'><div class='admin-data-ihm-elem-title'><span>Signalements</span></div></div>
				<div class='admin-test'><div class='admin-data-ihm-elem-title'><span>En ligne</span></div></div>
				<div class='admin-test'><div class='admin-data-ihm-elem-title'><span>Status de l'utilisateur</span></div></div>				
			</div>							

			<?php
			?>
	
				<?php 
				foreach ($listejoueur as $ligne => $joueur) {
					echo "<div class='admin-data-ihm align'>";
						//Pseudo
						echo "<div class='admin-test'><div class='admin-data-ihm-elem'><span class='capitalize tournament-nom-g'><a href='".WEBPATH."/profil?pseudo=".$joueur->getPseudo()."'>".$joueur->getPseudo()."<a/></span></div></div>";						
						//Email
						echo "<div class='admin-test'><div class='admin-data-ihm-elem'><span class='capitalize tournament-nom-g'>" .$joueur->getEmail(). "</span></div></div>";						
						//Image
						echo "<div class='admin-test'><div class='admin-data-ihm-elem'><div class='admin-data-ihm-elem-img-wrapper'><img class='img-cover' src='" .$joueur->getImg(). "'></div></div></div>";						
						//Team
						echo "<div class='admin-test'><div class='admin-data-ihm-elem'><span class='tournament-nom-g'>";							
							echo $joueur->getIdTeam() ? $joueur->getIdTeam() : "Pas de team";
						echo "</span></div></div>";
						//Report Number
						echo "<div class='admin-test'><div class='admin-data-ihm-elem'><span class='capitalize tournament-nom-g'>" .$joueur->getReportNumber(). "</span></div></div>";
						//Is Connected
						echo "<div class='admin-test'><div class='admin-data-ihm-elem'>";
							if($joueur->getIsConnected())
								echo "<span class='green'>Connecté</span>";						
							else
								echo "<span class='red'>Deconnecté</span>";
							echo "</div></div>";
						//Status
						echo "<div class='admin-test'><div class='admin-data-ihm-elem'><span class='capitalize tournament-nom-g'>";
							echo "<select class='select-default select-default-w' name='status_".$joueur->getPseudo()."' onChange=setStatut('".$joueur->getPseudo()."',this.value)>";
								echo "<option value='-1'";
									echo ($joueur->getStatus()==-1) ? " selected " : " "; 
								echo ">Banni</option>
								<option value='1'";
									echo ($joueur->getStatus()==1) ? " selected " : " ";
								echo ">Utilisateur</option>
								<option value='3'";
									echo ($joueur->getStatus()==3) ? " selected " : " ";
								echo ">Admin</option>";
							echo "</select>";
						echo "</span></div></div>";
					echo "</div>";
				}
				?>						

				<div class='admin-data-ihm-btn hidden relative'>
					<button class='admin-btn-default admin-btn-delete platform-btn-delete" + i + "' type='button'><span>Supprimer</span></button> 						
				</div>					
	<?php
		} 
	?>		
</div>