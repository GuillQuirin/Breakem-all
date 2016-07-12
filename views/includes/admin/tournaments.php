<?php
	if(isset($listetournament)){	

		$cat = "<div class='grid-md-10 admin-data-ihm-title align relative grid-centered'>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Début</span></div></div>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Fin</span></div></div>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Nom</span></div></div>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Nombre de match</span></div></div>
		</div>";

		echo $cat;

		if(is_array($listetournament)){			
			foreach ($listetournament as $ligne => $tournament) {
				//Wrapper				
				echo "<div class='grid-md-10 admin-data-ihm align relative grid-centered'>";

					//Affichage
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='capitalize tournament-datedebut-g'>" . date('d-m-Y', $tournament->getStartDate()) . "</span></div></div>";
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='tournament-datefin-g'>" . date('d-m-Y', $tournament->getEndDate()) . "</span></div></div>";
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='tournament-nom-g'>" . $tournament->getName() . "</span></div></div>";
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='tournament-nbmatch-g'>" . $tournament->getNbMatch() . "</span></div></div>";
					//Fin 

					//Boutton
					echo "<div class='admin-data-ihm-btn hidden align'>";
						echo "<button class='admin-btn-default btn btn-yellow full admin-btn-modify open-form' type='button'><a>Modifier</a></button>";
						echo "<button class='admin-btn-default btn btn-white full admin-btn-delete' type='button'><a>Supprimer</a></button>";
					echo "</div>"; 
					//Fin Boutton

					//Formulaire
					echo "<div class='index-modal tournaments hidden-fade hidden'>";

						echo "<div class='index-modal-this index-modal-login align'>";
							
							echo "<div class='grid-md-4 inscription_rapide animation fade'>";
								echo "<form class='tournament-form admin-form' enctype='multipart/form-data' accept-charset='utf-8'>";
									//Title
									echo "<div class='grid-md-12 form-title-wrapper'>";
										echo "<img class='icon icon-size-4' src='" . WEBPATH . "/web/img/icon/icon-tournament.png'><span class='form-title'>Tournoi</span>";
									echo "</div>";
									//Label
									echo "<div class='grid-md-4 text-left'>";
									    echo "<label for='datedebut'>Début :</label>";
									    echo "<label for='datefin'>Fin :</label>";
									    echo "<label for='nom'>Nom :</label>";
								   		echo "<label for='description'>Description :</label>";
								   		echo "<label for='status'>Status :</label>";
								   echo "</div>";
								    //Input
								    echo "<div class='grid-md-8'>";
										echo "<input type='text' name='id' class='hidden tournament-id-p' value='" . $tournament->getId() . "'>";

										echo "<input class='input-default admin-form-input-w tournament-datedebut-p' name='datedebut' type='number' placeholder='dd' min='1' max='31' value='" . date('d',$tournament->getStartDate()) . "'>";
										echo "<input class='input-default admin-form-input-w tournament-datedebut-p' name='datedebut' type='number' placeholder='mm' min='1' max='12' value='" . date('m',$tournament->getStartDate()) . "'>";
										echo "<input class='input-default admin-form-input-w tournament-datedebut-p' name='datedebut' type='number' placeholder='YYYY'  min='1950' max='".date('Y')."' value='" . date('Y',$tournament->getStartDate()) . "'>";
										
										echo "<br>";

										echo "<input class='input-default admin-form-input-w tournament-datefin-p' name='datefin' type='number' placeholder='dd' min='1' max='31' value='" . date('d',$tournament->getEndDate()) . "'>";
										echo "<input class='input-default admin-form-input-w tournament-datefin-p' name='datefin' type='number' placeholder='mm' min='1' max='12' value='" . date('m',$tournament->getEndDate()) . "'>";
										echo "<input class='input-default admin-form-input-w tournament-datefin-p' name='datefin' type='number' placeholder='YYYY' min='1950' max='".date('Y')."' value='" . date('Y',$tournament->getEndDate()) . "'>";

										echo "<input class='input-default admin-form-input-w tournament-nom-p' name='nom' type='text' value='" . $tournament->getName() . "'>";
										echo "<input class='input-default admin-form-input-w tournament-description-p' name='description' type='text' value='" . $tournament->getDescription() . "'>";
										echo "<input class='input-default admin-form-input-w tournament-status-p' name='status' type='number' min='-5' max='3' value='" . $tournament->getStatus() . "'>";
									echo "</div>";
									//Submit
									echo "<div class='grid-md-12'>"; 
								    	echo "<button type='button' class='admin-form-submit tournament-submit-form-btn btn btn-pink'><a>Valider</a></button>";
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
		echo "<div class='grid-md-12 no-platform align'><span>Aucun tournoi enregistré pour le moment.</span></div>";		
	} 
?>		