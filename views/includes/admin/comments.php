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
				<th>Modéré</th>
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
					echo "<td>";
						if($comment->getStatus()==1)
							echo "X";
					echo "</td>";
					echo "<td>";
						echo "<button onclick=deleteComment(".$comment->getId().")>";
							echo ($comment->getStatus()!=1) ? "Modérer" : "Déverrouiller";
					echo "</td>";
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