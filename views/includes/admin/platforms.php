<?php
	if(isset($listeplatform)){	

		$cat = "<div class='admin-data-ihm-title align relative'>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Image</span></div></div>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Nom</span></div></div>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Description</span></div></div>
		</div>";

		echo $cat;

		if(is_array($listeplatform)){			
			foreach ($listeplatform as $ligne => $platform) {
				//Wrapper				
				echo "<div class='admin-data-ihm align relative'>";

					//Affichage
					echo "<div class='grid-md-4'><div class='admin-data-ihm-elem'><div class='admin-data-ihm-elem-img-wrapper'><img class='img-cover platform-img-up' src='" . $platform->getImg() . "'></div></div></div>";
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='capitalize platform-nom-g'>" . $platform->getName() . "</span></div></div>";
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='platform-description-g'>" . $platform->getDescription() . "</span></div></div>";
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
							
							echo "<div class='grid-md-4 inscription_rapide animation fade'>";
								echo "<form class='platform-form admin-form' enctype='multipart/form-data' accept-charset='utf-8'>";
									//Title
									echo "<div class='grid-md-12 form-title-wrapper'>";
										echo "<img class='icon icon-size-4' src='" . WEBPATH . "/web/img/icon/icon-plateforme.png'><span class='form-title'>Plateforme</span>";
									echo "</div>";
									//Image
									echo "<div class='grid-md-12'>";
										echo "<div class='membre-form-img-size m-a'>";																	
											echo "<img class='img-cover platform-img membre-form-img-size' src='" . $platform->getImg() . "' title='Image de profil' alt='Image de profil'>";										
										echo "</div>";
										echo "<div class='text-center admin-input-file'>";								 
											echo "<input type='file' class='platform-image-p' name='profilpic'>";
										echo "</div>";
									echo "</div>";
									//Label
									echo "<div class='grid-md-5 text-left'>";
									    echo "<label for='email'>Nom :</label>";
									    echo "<label for='email'>Description :</label>";
								    echo "</div>";
								    //Input
								    echo "<div class='grid-md-7'>";
										echo "<input type='text' name='id' class='hidden platform-id-p' value='" . $platform->getId() . "'>";
										echo "<input class='input-default admin-form-input-w platform-nom-p' name='nom' type='text' value='" . $platform->getName() . "'>";
									    echo "<textarea class='input-default admin-form-input-w platform-description-p' name='description' type='text'>" . $platform->getDescription() . "</textarea>";							    														   
									echo "</div>";
									//Submit
									echo "<div class='grid-md-12'>"; 
								    	echo "<button type='button' class='admin-form-submit platform-submit-form-btn btn btn-pink'><a>Valider</a></button>";
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
		echo "<div class='grid-md-12 no-platform align'><span>Aucune plateforme enregistrée pour le moment.</span></div>";		
	} 
?>		