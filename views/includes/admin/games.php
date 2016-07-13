<?php
	if(isset($listejeu)){	

		$cat = "<div class='grid-md-10 admin-data-ihm-title align relative grid-centered'>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Image</span></div></div>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Nom</span></div></div>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Année</span></div></div>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Type</span></div></div>
		</div>";

		echo $cat;

		if(is_array($listejeu)){			
			foreach ($listejeu as $ligne => $jeu) {
				//Wrapper				
				echo "<div class='grid-md-10 admin-data-ihm align relative grid-centered'>";

					//Affichage
					echo "<div class='grid-md-4'><div class='admin-data-ihm-elem'><div class='admin-data-ihm-elem-img-wrapper membres-img'><img class='admin-img-cover border-round jeu-img-up' src='" . $jeu->getImg() . "'></div></div></div>";
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='capitalize jeu-nom-g'>" . $jeu->getName() . "</span></div></div>";
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='jeu-year-g'>" . date('Y', $jeu->getYear()) . "</span></div></div>";
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='jeu-type-g'>" . $jeu->getNameType() . "</span></div></div>";
					//Fin 

					//Boutton
					echo "<div class='admin-data-ihm-btn hidden align'>";
						echo "<button class='admin-btn-default btn btn-yellow full admin-btn-modify open-form' type='button'><a>Modifier</a></button>";
						echo "<button class='admin-btn-default btn btn-white full admin-btn-delete' type='button'><a>Supprimer</a></button>";
					echo "</div>"; 
					//Fin Boutton

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
									    echo "<label for='type'>Type :</label>";
								    echo "</div>";
								    //Input
								    echo "<div class='grid-md-8'>";
										echo "<input type='text' name='id' class='hidden jeu-id-p' value='" . $jeu->getId() . "'>";
										echo "<input class='input-default admin-form-input-w jeu-nom-p' name='nom' type='text' value='" . $jeu->getName() . "'>";
										echo "<textarea class='input-default admin-form-input-w jeu-description-p' name='description'>" . $jeu->getDescription() . "</textarea>";
										echo "<input class='input-default admin-form-input-w jeu-year-p' name='year' type='text' value='" . date('Y', $jeu->getYear()) . "'>";
										echo "<select>";
										echo "<option class='input-default admin-form-input-w jeu-type-p' name='type' type='text' value='" . $jeu->getIdType() . "'>";
										echo "</select>";
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