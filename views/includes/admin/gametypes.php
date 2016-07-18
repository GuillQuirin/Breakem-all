<?php
	if(isset($listetypejeu)){	

		$cat = "<div class='grid-md-10 admin-data-ihm-title align relative grid-centered'>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Image</span></div></div>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Nom</span></div></div>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Description</span></div></div>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Status</span></div></div>
		</div>";

		echo $cat;

		if(is_array($listetypejeu)){			
			foreach ($listetypejeu as $ligne => $typejeu) {
				//Wrapper				
				echo "<div class='grid-md-10 admin-data-ihm align relative grid-centered'>";

					//Affichage
					echo "<div class='grid-md-4'><div class='admin-data-ihm-elem'><div class='admin-data-ihm-elem-img-wrapper membres-img'><img class='admin-img-cover border-round typejeu-img-up' src='" . $typejeu->getImg() . "'></div></div></div>";
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='capitalize typejeu-nom-g'>" . $typejeu->getName() . "</span></div></div>";
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='typejeu-description-g'>" . $typejeu->getDescription() . "</span></div></div>";
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='capitalize platform-status-g'><div class='align platform-status-g-ht'>";
						if($typejeu->getStatus() == 1){
							echo "<img class='icon icon-size-4' src='" . WEBPATH . "/web/img/icon/icon-unlock.png'>";
						}else{
							echo "<img class='icon icon-size-4' src='" . WEBPATH . "/web/img/icon/icon-lock.png'>";
						}
					echo "</div></span></div></div>";
					//Fin 

					//Bouton
					echo "<div class='admin-data-ihm-btn hidden align'>";
						echo "<button class='admin-btn-default btn btn-yellow full admin-btn-modify open-form' type='button'><a>Modifier</a></button>";
					echo "</div>"; 
					//Fin Bouton

					//Formulaire
					echo "<div class='index-modal typejeus hidden-fade hidden'>";

						echo "<div class='index-modal-this index-modal-login align'>";
							
							echo "<div class='grid-md-4 inscription_rapide animation fade'>";
								echo "<form class='typejeu-form admin-form' enctype='multipart/form-data' accept-charset='utf-8'>";
									//Title
									echo "<div class='grid-md-12 form-title-wrapper'>";
										echo "<img class='icon icon-size-4' src='" . WEBPATH . "/web/img/icon/icon-typejeu.png'><span class='form-title'>Type de jeu</span>";
									echo "</div>";
									//Image
									echo "<div class='grid-md-12'>";
										echo "<div class='membre-form-img-size m-a'>";																	
											echo "<img class='img-cover typejeu-img membre-form-img-size' src='" . $typejeu->getImg() . "' title='Image de profil' alt='Image de profil'>";										
										echo "</div>";
										echo "<div class='text-center admin-input-file'>";								 
											echo "<input type='file' class='typejeu-image-p' name='profilpic'>";
										echo "</div>";
									echo "</div>";
									//Label
									echo "<div class='grid-md-4 text-left'>";
									    echo "<label for='nom'>Nom :</label>";
									    echo "<label for='description'>Description :</label>";
									    echo "<label for='status'>Status :</label>";
								    echo "</div>";
								    //Input
								    echo "<div class='grid-md-8'>";
										echo "<input type='text' name='id' class='hidden typejeu-id-p' value='" . $typejeu->getId() . "'>";
										echo "<input class='input-default admin-form-input-w typejeu-nom-p' name='nom' type='text' value='" . $typejeu->getName() . "'>";
										echo "<textarea class='input-default admin-form-input-w typejeu-description-p' name='description' type='text' >".$typejeu->getDescription()."</textarea>";
									
										echo "<div class='relative'><span class='toggleCheck'><input class='checkbox input-default typejeu-status-p admin-checkbox-ajust' id='platform-status-p' name='status' required type='checkbox' ";
											echo ($typejeu->getStatus()!==NULL  && $typejeu->getStatus()==-1) ? "checked=checked>" : ">";
										echo "<label class='ajusted-checkbox-label' for='status'>.</label></span></div>";								

									echo "</div>";
									//Submit
									echo "<div class='grid-md-12'>"; 
								    	echo "<button type='submit' class='admin-form-submit typejeu-submit-form-btn btn btn-pink'><a>Valider</a></button>";
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
		echo "<div class='grid-md-12 no-platform align'><span>Aucun type de jeu enregistré pour le moment.</span></div>";		
	} 
?>		