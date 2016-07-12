<?php 			
	if(isset($listejoueurs)){	

		$cat = "<div class='grid-md-10 admin-data-ihm-title align relative grid-centered'>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Avatar</span></div></div>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Pseudo</span></div></div>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Mail</span></div></div>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Team</span></div></div>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Report</span></div></div>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Status</span></div></div>

		</div>";

		echo $cat;

		if(is_array($listejoueurs)){			
			foreach ($listejoueurs as $ligne => $joueur) {
				//Wrapper				
				echo "<div class='grid-md-10 admin-data-ihm align relative grid-centered'>";

					//Affichage
					//Image
					echo "<div class='grid-md-4'><div class='admin-data-ihm-elem'><div class='admin-data-ihm-elem-img-wrapper membres-img'><img class='admin-img-cover border-round membre-img-up' src='" .$joueur->getImg(). "'></div></div></div>";						
					//Pseudo
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='membre-pseudo-g'><a href='".WEBPATH."/profil?pseudo=".$joueur->getPseudo()."'>".$joueur->getPseudo()."<a/></span></div></div>";						
					//Email
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='membre-email-g'>" .$joueur->getEmail(). "</span></div></div>";						
					//Team
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='membre-nameTeam-g'>"; 
						if($joueur->getNameTeam()){
							echo $joueur->getNameTeam();
						}
					echo "</span></div></div>";
					//Report Number
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='capitalize membre-reportnumber-g'>" .$joueur->getReportNumber(). "</span></div></div>";
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
							
							echo "<div class='grid-md-6 inscription_rapide animation fade'>";
								echo "<form class='membre-form admin-form' enctype='multipart/form-data' accept-charset='utf-8'>";
									//Title
									echo "<div class='grid-md-12 form-title-wrapper'>";
										echo "<img class='icon icon-size-4' src='" . WEBPATH . "/web/img/icon/icon-profil.png'><span class='form-title'>Membre</span>";
									echo "</div>";
									echo "<div class='grid-md-6' style='height:130px;'>";
									//Image							    								 
								    	echo "<div class='membre-form-img-size m-a'>";																	
											echo "<img class='img-cover membre-img membre-form-img-size' src='" . $joueur->getImg() . "' title='Image de profil' alt='Image de profil'>";
										echo "</div>";
										echo "<div class='text-center admin-input-file'>";								 
											echo "<input type='file' class='membre-image-p' name='profilpic'>";
										echo "</div>";
									echo "</div>";
									echo "<div class='grid-md-6'>";
										//Label
										echo "<div class='grid-md-5 text-left'>";
											echo "<label for='description'>Description :</label>";
											echo "<label for='city'>Ville :</label>";
										echo "</div>";
										//Input
										echo "<div class='grid-md-7'>";
									 		echo "<input class='input-default admin-form-input-w membre-description-p' placeholder='Description' name='description' type='text' value='" . $joueur->getDescription() . "'>";			    
											echo "<input class='input-default admin-form-input-w membre-city-p' placeholder='Ville' name='city' type='text' value='" . $joueur->getCity() . "'>";									    
										echo "</div>";
									echo "</div>";
									echo "<div class='grid-md-6'>";
										//Label
										echo "<div class='grid-md-5 text-left'>";
											echo "<label for='nom'>Nom :</label>";
											echo "<label for='prenom'>Prénom :</label>";
											echo "<label for='pseudo'>Pseudo :</label>";
											echo "<label for='birthday'>Birthday :</label>";
										echo "</div>";
										//Input
										echo "<div class='grid-md-7'>";
											echo "<input class='membre-id-p hidden' value='" . $joueur->getId() . "'>";
										    echo "<input class='input-default admin-form-input-w membre-nom-p' placeholder='Nom' name='nom' type='text' value='" . $joueur->getName() . "'>";									    
										    echo "<input class='input-default admin-form-input-w membre-prenom-p' placeholder='Prénom' name='prenom' type='text' value='" . $joueur->getFirstname() . "'>";
										    echo "<input class='input-default admin-form-input-w membre-pseudo-p' placeholder='pseudo' name='pseudo' type='text' value='" . $joueur->getPseudo() . "'>";
										    echo "<input class='input-default admin-form-input-w membre-birthday-p' placeholder='Date de naissance' name='birthday' type='text' value='" . $joueur->getBirthday() . "'>";
										echo "</div>";								   
								    echo "</div>";

								    echo "<div class='grid-md-6'>";
									   	
									   	echo "<div class='grid-md-5 text-left'>";
									   		//Label
										    echo "<label for='kind'>Genre :</label>";
											echo "<label for='email'>Email :</label>";
											echo "<label for='mailContact'>Me contacter :</label>";
											echo "<label for='status'>Status :</label>";
										echo "</div>";

										echo "<div class='grid-md-7'>";
											//Input
											echo "<select class='select-default membre-kind-p'>";
												echo "<option value='Homme'>Homme</option>";
												echo "<option value='Femme'>Femme</option>";
											echo "</select>";
										    echo "<input class='input-default admin-form-input-w membre-email-p' placeholder='Email' name='email' type='text' value='" . $joueur->getEmail() . "'>";
										 	echo "<select class='select-default membre-mailContact-p'>";
												echo "<option value='1'>Oui</option>";
												echo "<option value='0'>Non</option>";
											echo "</select>";
										    echo "<select class='select-default membre-status-p' placeholder='Status' name='status_".$joueur->getPseudo()."' onChange=setStatut('".$joueur->getPseudo()."',this.value)>";
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
										echo "</div>";							 
								    echo "</div>";
								    //Submit
								    echo "<div class='grid-md-12'>";
								    	echo "<button type='button' class='admin-form-submit membre-submit-form-btn btn btn-pink'><a>Valider</a></button>";
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