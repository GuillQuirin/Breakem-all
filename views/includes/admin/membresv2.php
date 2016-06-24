<?php 			
	if(isset($listejoueurs)){	
		if(is_array($listejoueurs)){			
			foreach ($listejoueurs as $ligne => $joueur) {
				//Wrapper				
				echo "<div class='admin-data-ihm align relative'>";

					//Affichage
					//Pseudo
					echo "<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize membre-pseudo-g'><a href='".WEBPATH."/profil?pseudo=".$joueur->getPseudo()."'>".$joueur->getPseudo()."<a/></span></div></div>";						
					//Email
					echo "<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize membre-email-g'>" .$joueur->getEmail(). "</span></div></div>";						
					//Image
					echo "<div class='grid-md-4'><div class='admin-data-ihm-elem'><div class='admin-data-ihm-elem-img-wrapper'><img class='img-cover' src='" .$joueur->getImg(). "'></div></div></div>";						
					//Team
					echo "<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize membre-idteam-g'>" .$joueur->getIdTeam(). "</span></div></div>";
					//Report Number
					echo "<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize membre-reportnumber-g'>" .$joueur->getReportNumber(). "</span></div></div>";
					//Is Connected
					echo "<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize membre-isconnected-g'>";
						if($joueur->getIsConnected())
							echo "X";
						echo "</span></div></div>";
					//Status
					echo "<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize membre-status-g'>";
						echo "<select name='status_".$joueur->getPseudo()."' onChange=setStatut('".$joueur->getPseudo()."',this.value)>";
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
					//Fin Affichage

					//Boutton
					echo "<div class='admin-data-ihm-btn hidden align'>";
						echo "<button class='admin-btn-default btn btn-yellow full admin-btn-modify open-form' type='button'><a>Modifier</a></button>";
						echo "<button class='admin-btn-default btn btn-white full admin-btn-delete' type='button'><a>Supprimer</a></button>";
					echo "</div>"; 
					//Fin Boutton

					//Formulaire
					echo "<div class='index-modal platforms hidden-fade hidden'>";

						echo "<div class='index-modal-this index-modal-login align'>";
							
							echo "<div id='login-form' class='grid-md-3 inscription_rapide animation fade'>";
								echo "<form class='platform-form' enctype='multipart/form-data' accept-charset='utf-8'>";
									echo "<input type='text' name='id' class='hidden platform-id-p' value='" . $joueur->getId() . "'>";
								    echo "<label for='email'>Nom :</label>";
								    echo "<input class='input-default admin-form-input-w platform-nom-p' name='nom' type='text' value='" . $joueur->getName() . "'>";								    								 
								    echo "<div class='admin-avatar-wrapper m-a'>";																	
										echo "<img class='admin-avatar img-cover platform-img' src='" . $joueur->getImg() . "' title='Image de profil' alt='Image de profil'>";										
									echo "</div>";
									echo "<div class='text-center admin-input-file'>";								 
									echo "<input type='file' class='platform-image-p' name='profilpic'>";
									echo "</div>";
								    echo "<button type='button' class='platform-submit-form-btn btn btn-pink'><a>Valider</a></button>";
						  		echo "</form>";
						  	echo "</div>";
						echo "</div>";
					echo "</div>";
					//Fin Formulaire
				echo "</div>";
				//Fin Wrapper
			}					
		}
	}else{
		echo "<div class='grid-md-12 no-platform align'><span>Aucun joueur enregistré pour le moment.</span></div>";		
	} 
?>		