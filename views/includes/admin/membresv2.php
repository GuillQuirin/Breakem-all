<?php 			
	if(isset($listejoueurs)){	

		echo "<div class='admin-data-ihm-title align relative'>";
			echo "<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Pseudo</span></div></div>";
			echo "<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Mail</span></div></div>";
			echo "<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Avatar</span></div></div>";
			echo "<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Team</span></div></div>";
			echo "<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Report</span></div></div>";
			echo "<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Connecté</span></div></div>";
			echo "<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Status</span></div></div>";

		echo "</div>";

		if(is_array($listejoueurs)){			
			foreach ($listejoueurs as $ligne => $joueur) {
				//Wrapper				
				echo "<div class='admin-data-ihm align relative'>";

					//Affichage
					//Pseudo
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='membre-pseudo-g'><a href='".WEBPATH."/profil?pseudo=".$joueur->getPseudo()."'>".$joueur->getPseudo()."<a/></span></div></div>";						
					//Email
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='membre-email-g'>" .$joueur->getEmail(). "</span></div></div>";						
					//Image
					echo "<div class='grid-md-4'><div class='admin-data-ihm-elem'><div class='admin-data-ihm-elem-img-wrapper membres-img'><img class='img-cover' src='" .$joueur->getImg(). "'></div></div></div>";						
					//Team
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='membre-idteam-g'>"; 
						if($joueur->getIdTeam()){
							echo $joueur->getIdTeam();
						}
					echo "</span></div></div>";
					//Report Number
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='capitalize membre-reportnumber-g'>" .$joueur->getReportNumber(). "</span></div></div>";
					//Is Connected
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'>";
						if($joueur->getIsConnected()){
							echo "<span class='capitalize membre-isconnected-g green'>Connecté</span>";
						}else{
							echo "<span class='capitalize membre-isconnected-g red'>Déconnecté</span>";
						}
						echo "</div></div>";
					//Status
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='capitalize membre-status-g'>";
						echo "<span class='capitalize membre-status-g'>";
						switch ($joueur->getStatus()) {
						    case -1:
						        echo "Banni";
						        break;
						    case 1:
						        echo "Utilisateur";
						        break;
						    case 3:
						        echo "Administrateur";
						        break;
						}
						/*echo "<select name='status_".$joueur->getPseudo()."' onChange=setStatut('".$joueur->getPseudo()."',this.value)>";
							echo "<option value='-1'";
								echo ($joueur->getStatus()==-1) ? " selected " : " "; 
							echo ">Banni</option>
							<option value='1'";
								echo ($joueur->getStatus()==1) ? " selected " : " ";
							echo ">Utilisateur</option>
							<option value='3'";
								echo ($joueur->getStatus()==3) ? " selected " : " ";
							echo ">Admin</option>";
						echo "</select>";*/
					echo "</span></div></div>";
					//Fin Affichage

					//Boutton
					echo "<div class='admin-data-ihm-btn hidden align'>";
						echo "<button class='admin-btn-default btn btn-yellow full admin-btn-modify open-form' type='button'><a>Modifier</a></button>";
						echo "<button class='admin-btn-default btn btn-white full admin-btn-delete' type='button'><a>Bannir</a></button>";
					echo "</div>"; 
					//Fin Boutton

					//Formulaire
					echo "<div class='index-modal platforms hidden-fade hidden'>";

						echo "<div class='index-modal-this index-modal-login align'>";
							
							echo "<div id='login-form' class='grid-md-4 inscription_rapide animation fade'>";
								echo "<form class='membre-form' enctype='multipart/form-data' accept-charset='utf-8'>";
									echo "<div class='grid-md-12'>";
										//Image							    								 
								    	echo "<div class='admin-avatar-wrapper m-a'>";																	
											echo "<img class='admin-avatar img-cover membre-img' src='" . $joueur->getImg() . "' title='Image de profil' alt='Image de profil'>";
										echo "</div>";
										echo "<div class='text-center admin-input-file'>";								 
											echo "<input type='file' class='membre-image-p' name='profilpic'>";
										echo "</div>";
									echo "</div>";

									echo "<div class='grid-md-6'>";
										//Id
										echo "<input type='text' name='id' class='hidden membre-id-p' value='" . $joueur->getId() . "'>";
										//Nom
									    echo "<div class='membre-input-wrapper'><label for='nom'>Nom :</label>";
									    echo "<input class='input-default admin-form-input-w membre-nom-p' name='nom' type='text' value='" . $joueur->getName() . "'></div>";
									    //Prenom
									    echo "<div class='membre-input-wrapper'><label for='prenom'>Prénom :</label>";
									    echo "<input class='input-default admin-form-input-w membre-prenom-p' name='prenom' type='text' value='" . $joueur->getFirstname() . "'></div>";
										//Pseudo
									    echo "<div class='membre-input-wrapper'><label for='pseudo'>Pseudo :</label>";
									    echo "<input class='input-default admin-form-input-w membre-pseudo-p' name='nom' type='text' value='" . $joueur->getPseudo() . "'></div>";
									    //Birthday
									    echo "<div class='membre-input-wrapper'><label for='birthday'>Date de naissance :</label>";
									    echo "<input class='input-default admin-form-input-w membre-birthday-p' name='birthday' type='text' value='" . $joueur->getBirthday() . "'></div>";
									    //Report
									    echo "<div class='membre-input-wrapper'><label for='report'>Report :</label>";
									    echo "<input class='input-default admin-form-input-w membre-report-p' name='report' type='text' value='" . $joueur->getReportNumber() . "'></div>";	
								    echo "</div>";

								    echo "<div class='grid-md-6'>";
									    //Kind
									    echo "<div class='membre-input-wrapper'><label for='kind'>Genre :</label>";
									    echo "<input class='input-default admin-form-input-w membre-kind-p' name='kind' type='text' value='" . $joueur->getKind() . "'></div>";
								    	//Description
									    echo "<div class='membre-input-wrapper'><label for='description'>Description :</label>";
									    echo "<input class='input-default admin-form-input-w membre-description-p' name='description' type='text' value='" . $joueur->getDescription() . "'></div>";
									    //Email
									    echo "<div class='membre-input-wrapper'><label for='email'>Email :</label>";
									    echo "<input class='input-default admin-form-input-w membre-email-p' name='email' type='text' value='" . $joueur->getEmail() . "'></div>";
									    //Team
									    echo "<div class='membre-input-wrapper'><label for='team'>Team :</label>";
									    echo "<input class='input-default admin-form-input-w membre-team-p' name='team' type='text' value='" . $joueur->getIdTeam() . "'></div>";
									    //Status
									    echo "<div class='membre-input-wrapper'><label for='status'>Status :</label>";
									    echo "<select class='select-default membre-status-p' name='status_".$joueur->getPseudo()."' onChange=setStatut('".$joueur->getPseudo()."',this.value)>";
											echo "<option value='-1'";
												echo ($joueur->getStatus()==-1) ? " selected " : " "; 
											echo ">Banni</option>
											<option value='1'";
												echo ($joueur->getStatus()==1) ? " selected " : " ";
											echo ">Utilisateur</option>
											<option value='3'";
												echo ($joueur->getStatus()==3) ? " selected " : " ";
											echo ">Admin</option>";
										echo "</select></div>";									 
								    echo "</div>";

								    echo "<div class='grid-md-12'>";
								    	echo "<button type='button' class='membre-submit-form-btn btn btn-pink'><a>Valider</a></button>";
								    echo "</div>";
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
		echo "<div class='grid-md-12 no-platform align'><span>Aucun membre enregistré pour le moment.</span></div>";		
	} 
?>		