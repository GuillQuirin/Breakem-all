<div class="admin-wrapper" id="admin-onglet-comment-wrapper">
	<?php 		
		if(isset($listecomment) && is_array($listecomment)){
		?>							
			<table class='full-width admin-form-table admin-table comment' border='1'>
			<thead>
				<th>Utilisateur</th>
				<th>Team</th>
				<th>Message</th>
				<th>Date</th>
				<th>Supprimer</th>
			</thead>

			<?php
			//Rajouter une tr/td pour les clés (nom, prenom, etc)
			foreach ($listecomment as $ligne => $comment){
				echo "<tr>";
					echo "<td>";
						echo "<a href='".WEBPATH."/profil?pseudo=".$comment->getPseudo()."'>";
							echo $comment->getPseudo();
						echo "<a/></td>";
					echo "<td>";
						echo "<a href='".WEBPATH."/detailteam?name=".$comment->getNomTeam()."'>";
							echo $comment->getNomTeam();
						echo "<a/></td>";
					echo "<td>".$comment->getMessage()."</td>";
					echo "<td>".$comment->getDate()."</td>";
					echo "<td><button onclick=deleteComment(".$comment->getId().")>Effacer</button></td>";
				echo "</tr>";
			}
			?>	
			</tbody>					
			</table>
	<?php
		}
		else
			echo "<p>Pas de commentaires à récupérer</p>"; 
	?>		
</div>