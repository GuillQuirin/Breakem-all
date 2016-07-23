<?php
	if(isset($listecomment)){	

		$cat = "<div class='grid-md-10 admin-data-ihm-title align relative grid-centered'>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Date</span></div></div>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Pseudo</span></div></div>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Team</span></div></div>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Statut</span></div></div>
			<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>Message</span></div></div>
		</div>";

		echo $cat;

		if(is_array($listecomment)){			
			foreach ($listecomment as $ligne => $comment) {
				//Wrapper				
				echo "<div class='grid-md-10 admin-data-ihm align relative grid-centered'>";

					//Affichage
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='capitalize comment-date-g'>" . date('d-m-Y \à H\hi',strtotime($comment->getDate())) . "</span></div></div>";
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='capitalize comment-pseudo-g'>" . $comment->getPseudo() . "</span></div></div>";
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='comment-team-g'>" . $comment->getNomTeam() . "</span></div></div>";
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='capitalize comment-status-g'><div class='align comment-status-g-ht'>";
						if($comment->getStatus() == 1){
							echo "<img class='icon icon-size-4' src='" . WEBPATH . "/web/img/icon/icon-unlock.png'>";
						}else{
							echo "<img class='icon icon-size-4' src='" . WEBPATH . "/web/img/icon/icon-lock.png'>";
						}
					echo "</div></span></div></div>";
					echo "<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='comment-message-g'>" . $comment->getComment() . "</span></div></div>";
					//Fin 

					//Bouton
					echo "<div class='admin-data-ihm-btn hidden align'>";
						echo "<button class='admin-btn-default btn btn-yellow full admin-btn-modify open-form' type='button'><a>Modifier</a></button>";
/*						echo "<button class='admin-btn-default btn btn-white full admin-btn-delete' type='button'><a>Verrouiller</a></button>";
*/					echo "</div>"; 
					//Fin Bouton

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
									    echo "<label for='status'>Publié :</label>";
									    echo "<label for='message'>Message :</label>";
								    echo "</div>";
								    //Input
								    echo "<div class='grid-md-8'>";
										echo "<input type='text' name='id' class='hidden comment-id-p' value='" . $comment->getId() . "'>";
										echo "<input class='input-default admin-form-input-w comment-pseudo-p' name='pseudo' type='text' value='" . $comment->getPseudo() . "' disabled>";
										echo "<input class='input-default admin-form-input-w comment-NomTeam-p' name='NomTeam' type='text' value='" . $comment->getNomTeam() . "' disabled>";
										echo "<input class='input-default admin-form-input-w comment-date-p' name='date' type='text' value='" . date('d-m-Y \à H\hi',strtotime($comment->getDate())) . "' disabled>";
										echo "<div class='relative'><span class='toggleCheck'><input class='checkbox input-default comment-status-p admin-checkbox-ajust' id='comment-status-p' name='status' required type='checkbox' ";
											echo ($comment->getStatus()!==NULL  && $comment->getStatus()==-1) ? "checked=checked>" : ">";
										echo "<label class='ajusted-checkbox-label' for='status'>.</label></span></div>";								

										echo "<textarea class='input-default admin-form-input-w comment-message-p' name='message'>". $comment->getComment()."</textarea>";
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