<?php
	if(isset($listetypejeu)){	

		$cat = "<div class='grid-md-10 admin-data-ihm-title align relative grid-centered'>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Image</span></div></div>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Nom</span></div></div>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Description</span></div></div>
		</div>";

		echo $cat;

		if(is_array($listetypejeu)){			
			foreach ($listetypejeu as $ligne => $typejeu) {
				//Wrapper				
				echo "<div class='grid-md-10 admin-data-ihm align relative grid-centered'>";

					//Affichage
					echo "<div class='grid-md-4'><div class='admin-data-ihm-elem'><div class='admin-data-ihm-elem-img-wrapper membres-img'><img class='admin-img-cover border-round typejeu-img-up' src='" . $typejeu->getImg() . "'></div></div></div>";
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='capitalize typejeu-nom-g'>" . $typejeu->getName() . "</span></div></div>";
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='capitalize typejeu-description-g'>" . $typejeu->getDescription() . "</span></div></div>";
					//Fin 

					//Boutton
					echo "<div class='admin-data-ihm-btn hidden align'>";
						echo "<button class='admin-btn-default btn btn-yellow full admin-btn-modify open-form' type='button'><a>Modifier</a></button>";
						echo "<button class='admin-btn-default btn btn-white full admin-btn-delete' type='button'><a>Supprimer</a></button>";
					echo "</div>"; 
					//Fin Boutton

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
									    echo "<label for='scription'>Description :</label>";
								    echo "</div>";
								    //Input
								    echo "<div class='grid-md-8'>";
										echo "<input type='text' name='id' class='hidden typejeu-id-p' value='" . $typejeu->getId() . "'>";
										echo "<input class='input-default admin-form-input-w typejeu-nom-p' name='nom' type='text' value='" . $typejeu->getName() . "'>";
										echo "<input class='input-default admin-form-input-w typejeu-description-p' name='description' type='text' value='" . $typejeu->getDescription() . "'>";
									echo "</div>";
									//Submit
									echo "<div class='grid-md-12'>"; 
								    	echo "<button type='button' class='admin-form-submit typejeu-submit-form-btn btn btn-pink'><a>Valider</a></button>";
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