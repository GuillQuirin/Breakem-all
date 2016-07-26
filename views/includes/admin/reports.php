<?php
	if(isset($listesignalement)){	

		$cat = "<div class='grid-md-10 admin-data-ihm-title align relative grid-centered'>
			<div class='grid-md-4 grid-sm-4 grid-xs-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Emetteur</span></div></div>
			<div class='grid-md-4 grid-sm-4 grid-xs-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Accusé</span></div></div>
			<div class='grid-md-4 grid-sm-4 grid-xs-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Motif</span></div></div>
			<div class='grid-md-4 grid-sm-4 hidden-xs'><div class='admin-data-ihm-elem'><span class='capitalize'>Description</span></div></div>
			<div class='grid-md-4 grid-sm-4 grid-xs-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Date</span></div></div>
		</div>";

		echo $cat;

		if(is_array($listesignalement)){			
			foreach ($listesignalement as $ligne => $signalement) {
				//Wrapper				
				echo "<div class='grid-md-10 admin-data-ihm align relative grid-centered'>";

					//Affichage
					echo "<div class='grid-md-4 grid-sm-4 grid-xs-4 overflow-hidden hidden'><div class='admin-data-ihm-elem'><span class='report-accuseId-g'>" . $signalement->getId_signaled_user() . "</span></div></div>";
					echo "<div class='grid-md-4 grid-sm-4 grid-xs-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='capitalize report-emetteur-g'>" . $signalement->gtPseudo_indic_user() . "</span></div></div>";
					echo "<div class='grid-md-4 grid-sm-4 grid-xs-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='report-accuse-g'>" . $signalement->gtPseudo_signaled_user() . "</span></div></div>";
					echo "<div class='grid-md-4 grid-sm-4 grid-xs-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='capitalize report-subject-g'>" . $signalement->getSubject() . "</span></div></div>";
					echo "<div class='grid-md-4 grid-sm-4 hidden-xs overflow-hidden'><div class='admin-data-ihm-elem'><span class='report-description-g'>" . $signalement->getDescription() . "</span></div></div>";
					echo "<div class='grid-md-4 grid-sm-4 grid-xs-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='capitalize report-date-g'>" . $signalement->getDate() . "</span></div></div>";	
					//Fin Affichage

					//Bouton
					echo "<div class='admin-data-ihm-btn hidden align'>";
/*						echo "<button class='admin-btn-default btn btn-yellow full admin-btn-modify open-form' type='button'><a>Modifier</a></button>";
*/						echo "<button class='admin-btn-default btn btn-white full admin-btn-delete' type='button'><a>Supprimer</a></button>";
					echo "</div>"; 
					//Fin Bouton

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

										//Input
										echo "<div class='grid-md-7'>";

										echo "<div class='align'>";
											echo "<input type='text' name='id' class='hidden report-id-p' value='" . $signalement->getId() . "'>";
											echo "<label for='subject'>Motif :</label>";
										    echo "<input class='input-default admin-form-input-w report-subject-p' name='subject' type='text' value='" . $signalement->getSubject() . "'>";					
									    echo "</div>";

									    echo "<div class='align'>";
										    echo "<label for='description'>Description :</label>";				    
										    echo "<input class='input-default admin-form-input-w report-description-p' name='description' type='text' value='" . $signalement->getDescription() . "'>";
									    echo '</div>';
										echo "</div>";								   
								    echo "</div>";

								    //Submit
								    echo "<div class='grid-md-12'>";
								    	echo "<button type='submit' class='admin-form-submit report-submit-form-btn btn btn-pink'><a>Valider</a></button>";
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