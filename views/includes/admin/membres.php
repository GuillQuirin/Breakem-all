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
					//var_dump($joueur->getImg());
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='membre-pseudo-g'>".$joueur->getPseudo()."</span></div></div>";						
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
						    case 0:
						    	echo "Attente de validation";
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

					//Bouton
					echo "<div class='admin-data-ihm-btn hidden align'>";
						echo "<button class='admin-btn-default btn btn-yellow full admin-btn-modify open-form' type='button'><a>Modifier</a></button>";
						if($joueur->getStatus()!==NULL && $joueur->getStatus()==1)
							echo "<button class='admin-btn-default btn btn-white full admin-btn-delete' type='button'><a>Bannir</a></button>";
					echo "</div>"; 
					//Fin Bouton

					//Formulaire
					echo "<div class='index-modal platforms hidden-fade hidden'>";

						echo "<div class='index-modal-this index-modal-login align'>";
							
							echo "<div class='grid-md-6 inscription_rapide animation fade'>";
								echo "<form class='membre-form admin-form' enctype='multipart/form-data' accept-charset='utf-8'>";
									//Title
									echo "<div class='grid-md-12 form-title-wrapper'>";
										echo "<img class='icon icon-size-4' src='" . WEBPATH . "/web/img/icon/icon-profil.png'><span class='form-title'>Membre</span>";
									echo "</div>";
									echo "<div class='grid-md-12'>";
									//Image							    								 
								    	echo "<div class='membre-form-img-size m-a'>";																	
											echo "<img class='img-cover membre-img membre-form-img-size' src='" . $joueur->getImg() . "' title='Image de profil' alt='Image de profil'>";
										echo "</div>";
										echo "<div class='text-center admin-input-file'>";								 
											echo "<input type='file' class='membre-image-p' name='profilpic'>";
										echo "</div>";
									echo "</div>";

								    echo "<div class='grid-md-6'>";
									   	
									   	echo "<div class='grid-md-4 text-left'>";
									   		//Label
									   		echo "<a href='".WEBPATH.'/profil?pseudo='.$joueur->getPseudo()."'><label class='underline pink cursor-pointer' for='pseudo'>Pseudo :</label></a>";
									   		echo "<label for='email'>Email :</label>";
											echo "<label for='birthday'>Birthday :</label>";
										echo "</div>";

										echo "<div class='grid-md-8'>";
											//Input
											echo "<input class='input-default admin-form-input-w membre-pseudo-p' placeholder='pseudo' name='pseudo' type='text' min='2' max='15' placeholder='Pseudo entre 2 et 15 caractères' value='" . $joueur->getPseudo() . "' required>";
										    echo "<input class='input-default admin-form-input-w membre-email-p' placeholder='Email' name='email' type='email' value='" . $joueur->getEmail() . "' required>";

											echo "<input class='input-default admin-form-input-w membre-birthday-D' type='number' name='day' placeholder='dd' min='1' max='31'";
											echo ($joueur->getBirthday()!==NULL) ? " value='".date('d', $joueur->getBirthday())."'>" : ">";
											
											echo "<input class='input-default admin-form-input-w membre-birthday-M' type='number' name='month' placeholder='mm' min='1' max='12'";
											echo ($joueur->getBirthday()!==NULL) ? " value='".date('m', $joueur->getBirthday())."'>" : ">";

											echo "<input class='input-default admin-form-input-w membre-birthday-Y' type='number' name='year' placeholder='yyyy' min='1950' max='".date('Y')."'";
											echo ($joueur->getBirthday()!==NULL) ? " value='".date('Y', $joueur->getBirthday())."'>" : ">";

										echo "</div>";							 
								    echo "</div>";

								    echo "<div class='grid-md-6'>";
										//Label
										echo "<div class='grid-md-5 text-left'>";
											if($joueur->getId()!==$_id)
												echo "<label for='status'>Status :</label>";
											echo "<label for='mailContact'>Me contacter :</label>";
											echo "<label for='description'>Description :</label>";	
										echo "</div>";
										//Input
										echo "<div class='grid-md-7'>";
											echo "<input class='membre-id-p hidden' value='" . $joueur->getId() . "'>";
											
											if($joueur->getId()!==$_id){
												echo "<select class='select-default membre-status-p' placeholder='Status' name='status_".$joueur->getPseudo()."' onChange=setStatut('".$joueur->getPseudo()."',this.value)>";
													echo "<option value='-1'";
														echo ($joueur->getStatus()==-1) ? " selected " : " "; 
													echo ">Banni</option>
													<option value='1'";
														echo ($joueur->getStatus()==1) ? " selected " : " ";
													echo ">Utilisateur</option>
													<option value='3'";
														echo ($joueur->getStatus()==3) ? " selected " : " ";
													echo ">Administrateur</option>";
												echo "</select>";
											}

											echo "<div class='relative'><span class='toggleCheck'><input style='width:23px;bottom:0;top:0;margin:auto;' class='checkbox input-default membre-mailContact-p' name='authorize_mail_contact' required type='checkbox' ";
												echo ($joueur->getAuthorize_mail_contact()!==NULL  && $joueur->getAuthorize_mail_contact()==1) ? "checked=checked>" : ">";
											echo "<label class='ajusted-checkbox-label' for='authorize_mail_contact' style='color: rgba(8,3,37,1);'>.</label></span></div>";
											
											echo "<textarea class='input-default admin-form-input-w membre-description-p' placeholder='Description' name='description'>".$joueur->getDescription()."</textarea>";
										echo "</div>";								   
								    echo "</div>";
								    //Submit
								    echo "<div class='grid-md-12'>";
								    	echo "<button type='submit' class='admin-form-submit membre-submit-form-btn btn btn-pink'><a>Valider</a></button>";
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