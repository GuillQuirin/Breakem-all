<?php
	if(isset($listeteam)){	
	
		$cat = "<div class='grid-md-10 admin-data-ihm-title align relative grid-centered'>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Image</span></div></div>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Nom</span></div></div>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Slogan</span></div></div>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Status</span></div></div>
			
		</div>";

		echo $cat;

		if(is_array($listeteam)){			
			foreach ($listeteam as $ligne => $team) {
				//Wrapper				
				echo "<div class='grid-md-10 admin-data-ihm align relative grid-centered'>";

					//Affichage
					echo "<div class='grid-md-4'><div class='admin-data-ihm-elem'><div class='admin-data-ihm-elem-img-wrapper membres-img'><img class='admin-img-cover border-round team-img-up' src='" . $team->getImg() . "'></div></div></div>";
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='capitalize team-nom-g'>" . $team->getName() . "</span></div></div>";
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='capitalize team-slogan-g'>" . $team->getSlogan() . "</span></div></div>";
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='capitalize team-status-g'><div class='align'>";
						if($team->getStatus() == 0){
							echo "<img class='icon icon-size-4' src='" . WEBPATH . "/web/img/icon/icon-lock.png'>";
						}else{
							echo "<img class='icon icon-size-4' src='" . WEBPATH . "/web/img/icon/icon-unlock.png'></div>";
						}
					echo "</div></span></div></div>";
					//Fin Affichage

					//Boutton
					echo "<div class='admin-data-ihm-btn hidden align'>";
						echo "<button class='admin-btn-default btn btn-yellow full admin-btn-modify open-form' type='button'><a>Modifier</a></button>";
						echo "<button class='admin-btn-default btn btn-white full admin-btn-delete' type='button'><a>Supprimer</a></button>";
					echo "</div>"; 
					//Fin Boutton

					//Formulaire
					echo "<div class='index-modal teams hidden-fade hidden'>";

						echo "<div class='index-modal-this index-modal-login align'>";
							
							echo "<div class='grid-md-4 inscription_rapide animation fade'>";
								echo "<form class='team-form admin-form' enctype='multipart/form-data' accept-charset='utf-8'>";
									//Title
									echo "<div class='grid-md-12 form-title-wrapper'>";
										echo "<img class='icon icon-size-4' src='" . WEBPATH . "/web/img/icon/icon-team.png'><span class='form-title'>Team</span>";
									echo "</div>";
									//Image
									echo "<div class='grid-md-12'>";
										echo "<div class='membre-form-img-size m-a'>";																	
											echo "<img class='img-cover team-img membre-form-img-size' src='" . $team->getImg() . "' title='Image de profil' alt='Image de profil'>";										
										echo "</div>";
										echo "<div class='text-center admin-input-file'>";								 
											echo "<input type='file' class='team-image-p' name='profilpic'>";
										echo "</div>";
									echo "</div>";
									echo "<div class='grid-md-12'>";
										//Label
										echo "<div class='grid-md-4 text-left'>";
										    echo "<label for='nom'>Nom :</label>";
										    echo "<label for='slogan'>Slogan :</label>";
										    echo "<label for='description'>Description :</label>";
										    echo "<label for='status'>Status :</label>";
									    echo "</div>";
									    //Input
									    echo "<div class='grid-md-8'>";
											echo "<input type='text' name='id' class='hidden team-id-p' value='" . $team->getId() . "'>";
											echo "<input class='input-default admin-form-input-w team-nom-p' name='nom' type='text' value='" . $team->getName() . "'>";
											echo "<input class='input-default admin-form-input-w team-slogan-p' name='slogan' type='text' value='" . $team->getSlogan() . "'>";
											echo "<input class='input-default admin-form-input-w team-description-p' name='description' type='text' value='" . $team->getDescription() . "'>";
											echo "<input class='input-default admin-form-input-w team-status-p' name='status' type='text' value='" . $team->getStatus() . "'>";
										echo "</div>";
									echo "</div>";
									//Submit
									echo "<div class='grid-md-12'>"; 
								    	echo "<button type='button' class='admin-form-submit team-submit-form-btn btn btn-pink'><a>Valider</a></button>";
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
		echo "<div class='grid-md-12 no-platform align'><span>Aucune team enregistrée pour le moment.</span></div>";		
	} 
?>		