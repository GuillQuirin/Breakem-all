<?php
	if(isset($listecomment)){	

		echo "<div class='admin-data-ihm-title align relative'>";
			echo "<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Date</span></div></div>";
			echo "<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Pseudo</span></div></div>";
			echo "<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Team</span></div></div>";
			echo "<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Message</span></div></div>";
		echo "</div>";

		if(is_array($listecomment)){			
			foreach ($listecomment as $ligne => $comment) {
				//Wrapper				
				echo "<div class='admin-data-ihm align relative'>";

					//Affichage
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='capitalize comment-date-g'>" . $comment->getDate() . "</span></div></div>";
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='capitalize comment-pseudo-g'>" . $comment->getPseudo() . "</span></div></div>";
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='comment-team-g'>" . $comment->getNomTeam() . "</span></div></div>";
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='comment-message-g'>" . $comment->getMessage() . "</span></div></div>";
					//Fin 

					//Boutton
					echo "<div class='admin-data-ihm-btn hidden align'>";
						echo "<button class='admin-btn-default btn btn-yellow full admin-btn-modify open-form' type='button'><a>Modifier</a></button>";
						echo "<button class='admin-btn-default btn btn-white full admin-btn-delete' type='button'><a>Supprimer</a></button>";
					echo "</div>"; 
					//Fin Boutton

					//Formulaire
					echo "<div class='index-modal comments hidden-fade hidden'>";

						echo "<div class='index-modal-this index-modal-login align'>";
							
							echo "<div class='grid-md-4 inscription_rapide animation fade'>";
								echo "<form class='comment-form admin-form' enctype='multipart/form-data' accept-charset='utf-8'>";
									//Title
									echo "<div class='grid-md-12 form-title-wrapper'>";
										echo "<img class='icon icon-size-4' src='" . WEBPATH . "/web/img/icon/icon-comment.png'><span class='form-title'>Commentaire</span>";
									echo "</div>";
									//Label
									echo "<div class='grid-md-4 text-left'>";
									    echo "<label for='pseudo'>Pseudo :</label>";
									    echo "<label for='NomTeam'>Team :</label>";
									    echo "<label for='date'>Date :</label>";
									    echo "<label for='message'>Message :</label>";
									    echo "<label for='status'>Status :</label>";
								    echo "</div>";
								    //Input
								    echo "<div class='grid-md-8'>";
										echo "<input type='text' name='id' class='hidden comment-id-p' value='" . $comment->getId() . "'>";
										echo "<input class='input-default admin-form-input-w comment-pseudo-p' name='pseudo' type='text' value='" . $comment->getPseudo() . "'>";
										echo "<input class='input-default admin-form-input-w comment-NomTeam-p' name='NomTeam' type='text' value='" . $comment->getNomTeam() . "'>";
										echo "<input class='input-default admin-form-input-w comment-date-p' name='date' type='text' value='" . $comment->getDate() . "'>";
										echo "<input class='input-default admin-form-input-w comment-message-p' name='message' type='text' value='" . $comment->getMessage() . "'>";
										echo "<input class='input-default admin-form-input-w comment-status-p' name='status' type='text' value='" . $comment->getStatus() . "'>";
									echo "</div>";
									//Submit
									echo "<div class='grid-md-12'>"; 
								    	echo "<button type='button' class='admin-form-submit comment-submit-form-btn btn btn-pink'><a>Valider</a></button>";
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
		echo "<div class='grid-md-12 no-platform align'><span>Aucun commentaire enregistré pour le moment.</span></div>";		
	} 
?>		