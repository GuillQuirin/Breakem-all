<?php
	if(isset($listejeu)){	

		$cat = "<div class='grid-md-10 admin-data-ihm-title align relative grid-centered'>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Image</span></div></div>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Nom</span></div></div>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Année</span></div></div>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Type</span></div></div>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Status</span></div></div>			
		</div>";

		echo $cat;

		if(is_array($listejeu)){			
			foreach ($listejeu as $ligne => $jeu) {
				//Wrapper				
				echo "<div class='grid-md-10 admin-data-ihm align relative grid-centered'>";

					//Affichage
					echo "<div class='grid-md-4'><div class='admin-data-ihm-elem'><div class='admin-data-ihm-elem-img-wrapper membres-img'><img class='admin-img-cover border-round jeu-img-up' src='" . $jeu->getImg() . "'></div></div></div>";
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='capitalize jeu-name-g'>" . $jeu->getName() . "</span></div></div>";
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='jeu-release-g'>" . date('Y', $jeu->getRelease()) . "</span></div></div>";
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='jeu-idType-g'>" . $jeu->getNameType() . "</span></div></div>";
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='capitalize jeu-status-g'><div class='align jeu-status-g-ht'>";
						if($jeu->getStatus() == 1){
							echo "<img class='icon icon-size-4' src='" . WEBPATH . "/web/img/icon/icon-unlock.png'>";
						}else{
							echo "<img class='icon icon-size-4' src='" . WEBPATH . "/web/img/icon/icon-lock.png'>";
						}
					echo "</div></span></div></div>";					

					//Fin 

					//Bouton
					echo "<div class='admin-data-ihm-btn hidden align'>";
						echo "<button class='admin-btn-default btn btn-yellow full admin-btn-modify open-form' type='button'><a>Modifier</a></button>";
/*						echo "<button class='admin-btn-default btn btn-white full admin-btn-delete' type='button'><a>Supprimer</a></button>";
*/					echo "</div>"; 
					//Fin Bouton

					//Formulaire
					echo "<div class='index-modal jeus hidden-fade hidden'>";

						echo "<div class='index-modal-this index-modal-login align'>";
							
							echo "<div class='grid-md-4 inscription_rapide animation fade'>";
								echo "<form class='jeu-form admin-form' enctype='multipart/form-data' accept-charset='utf-8'>";
									//Title
									echo "<div class='grid-md-12 form-title-wrapper'>";
										echo "<img class='icon icon-size-4' src='" . WEBPATH . "/web/img/icon/icon-jeu.png'><span class='form-title'>Jeu</span>";
									echo "</div>";
									//Image
									echo "<div class='grid-md-12'>";
										echo "<div class='membre-form-img-size m-a'>";																	
											echo "<img class='img-cover jeu-img membre-form-img-size' src='" . $jeu->getImg() . "' title='Image de profil' alt='Image de profil'>";										
										echo "</div>";
										echo "<div class='text-center admin-input-file'>";								 
											echo "<input type='file' class='jeu-image-p' name='profilpic'>";
										echo "</div>";
									echo "</div>";
									//Label
									echo "<div class='grid-md-4 text-left'>";
									    echo "<label for='nom'>Nom :</label>";
									    echo "<label for='scription'>Description :</label>";
									    echo "<label for='year'>Année :</label>";
									    echo "<label for='idType'>Type :</label>";
									    echo "<label for='status'>Verrouiller :</label>";
								    echo "</div>";
								    //Input
								    echo "<div class='grid-md-8'>";
										echo "<input type='text' name='id' class='hidden jeu-id-p' value='" . $jeu->getId() . "'>";
										echo "<input class='input-default admin-form-input-w jeu-name-p' name='name' type='text' value='" . $jeu->getName() . "'>";
										echo "<textarea class='input-default admin-form-input-w jeu-description-p' name='description'>" . $jeu->getDescription() . "</textarea>";

										echo "<input class='input-default admin-form-input-w jeu-release-D' type='number' name='day' placeholder='dd' min='1' max='31'";
										echo ($jeu->getRelease()!==NULL) ? " value='".date('d', $jeu->getRelease())."'>" : ">";
										
										echo "<input class='input-default admin-form-input-w jeu-release-M' type='number' name='month' placeholder='mm' min='1' max='12'";
										echo ($jeu->getRelease()!==NULL) ? " value='".date('m', $jeu->getRelease())."'>" : ">";

										echo "<input class='input-default admin-form-input-w jeu-release-Y' type='number' name='year' placeholder='yyyy' min='1950' max='".date('Y')."'";
										echo ($jeu->getRelease()!==NULL) ? " value='".date('Y', $jeu->getRelease())."'>" : ">";
										
										echo "<input type='hidden' class='jeu-nameType-p' value='" . $jeu->getNameType() . "'>";
										echo "<select class='select-default jeu-idType-p' name='idType'>";
											if(isset($listetypejeu)){
												if(is_array($listetypejeu)){			
													foreach ($listetypejeu as $lignetj => $tj) {
														if($tj->getId() == $jeu->getIdType()){
															echo "<option selected value='" . $tj->getId() ."'>" . $tj->getName() . "</option>";
														}else{
															echo "<option value='" . $tj->getId() ."'>" . $tj->getName() . "</option>";
														}
													}
												}
											}else{
												echo "<option value='0'>Non disponnible</option>";
											}
										echo "</select>";

										echo "<div class='relative'><span class='toggleCheck'><input class='checkbox input-default admin-checkbox-ajust jeu-status-p' id='jeu-status-p' name='status' required type='checkbox' ";
											echo ($jeu->getStatus()!==NULL  && $jeu->getStatus()==-1) ? "checked=checked>" : ">";
										echo "<label class='ajusted-checkbox-label' for='status'>.</label></span></div>";								

									echo "</div>";
									//Submit
									echo "<div class='grid-md-12'>"; 
								    	echo "<button type='button' class='admin-form-submit jeu-submit-form-btn btn btn-pink'><a>Valider</a></button>";
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
		echo "<div class='grid-md-12 no-platform align'><span>Aucun jeu enregistré pour le moment.</span></div>";		
	} 
?>		