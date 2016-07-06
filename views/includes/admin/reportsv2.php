<?php
	if(isset($listesignalement)){	

		$cat = "<div class='admin-data-ihm-title align relative'>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Emetteur</span></div></div>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Accusé</span></div></div>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Motif</span></div></div>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Description</span></div></div>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Date</span></div></div>
		</div>";

		echo $cat;

		if(is_array($listesignalement)){			
			foreach ($listesignalement as $ligne => $signalement) {
				//Wrapper				
				echo "<div class='admin-data-ihm align relative'>";

					//Affichage
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='capitalize platform-emetteur-g'>" . $signalement->getPseudo_indic_user() . "</span></div></div>";
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='platform-accuse-g'>" . $signalement->getPseudo_signaled_user() . "</span></div></div>";
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='capitalize platform-subject-g'>" . $signalement->getSubject() . "</span></div></div>";
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='platform-description-g'>" . $signalement->getDescription() . "</span></div></div>";
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='capitalize platform-date-g'>" . $signalement->getDate() . "</span></div></div>";	
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
								echo "<form class='report-form admin-form' enctype='multipart/form-data' accept-charset='utf-8'>";
									//Title
									echo "<div class='grid-md-12 form-title-wrapper'>";
										echo "<img class='icon icon-size-4' src='" . WEBPATH . "/web/img/icon/icon-report.png'><span class='form-title'>Signalement</span>";
									echo "</div>";
									echo "<div class='grid-md-12'>";
										//Label
										echo "<div class='grid-md-5 text-left'>";
											echo "<input type='text' name='id' class='hidden report-id-p' value='" . $signalement->getId() . "'>";
											echo "<label for='objet'>Objet :</label>";
											echo "<label for='description'>Description :</label>";
											echo "<label for='date'>Date :</label>";
											echo "<label for='indic'>Emétteur :</label>";
											echo "<label for='signaled'>Accusé :</label>";
										echo "</div>";
										//Input
										echo "<div class='grid-md-7'>";
										    echo "<input class='input-default admin-form-input-w report-objet-p' name='objet' type='text' value='" . $signalement->getSubject() . "'>";									    
										    echo "<input class='input-default admin-form-input-w report-description-p' name='description' type='text' value='" . $signalement->getDescription() . "'>";
										    echo "<input class='input-default admin-form-input-w report-date-p' name='date' type='text' value='" . $signalement->getDate() . "'>";
										    echo "<input class='input-default admin-form-input-w report-indic-p' name='indic' type='text' value='" . $signalement->getPseudo_indic_user() . "'>";
										    echo "<input class='input-default admin-form-input-w report-signaled-p' name='signaled' type='text' value='" . $signalement->getPseudo_signaled_user() . "'>";	
										echo "</div>";								   
								    echo "</div>";

								    //Submit
								    echo "<div class='grid-md-12'>";
								    	echo "<button type='button' class='admin-form-submit report-submit-form-btn btn btn-pink'><a>Valider</a></button>";
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
		echo "<div class='grid-md-12 no-platform align'><span>Aucun signalement enregistré pour le moment.</span></div>";		
	} 
?>		