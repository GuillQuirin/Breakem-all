<div class="admin-wrapper" id="admin-onglet-team-wrapper">
 	<form action="admin/updateTeamStatus" method="post" enctype="multipart/form-data">
		<?php 			
			if(isset($listeteam) && is_array($listeteam)){
			?>							
				<table class='full-width admin-form-table admin-table member' border='1'>
				<thead>
					<th>Nom</th>
					<th>Image</th>
					<th>Description</th>
					<th>Statut</th>
					<th>Vérrouiller/Déverrouiller la team</th>
				</thead>

				<?php
				//Rajouter une tr/td pour les clés (nom, prenom, etc)
				foreach ($listeteam as $ligne => $team) {
					echo "<tr>";
						echo "<td><a href='".WEBPATH."/detailteam?name=".$team->getName()."'>".$team->getName()."<a/></td>";
						echo "<td><img src='".$team->getImg()."'></td>";
						echo "<td>".$team->getDescription()."</td>";
						echo "<td>".$team->getStatusName($team->getStatus())."</td>";
						echo "<td>
								<input class='checkbox input-default' type='checkbox' name='checkbox_team[]' id='checkbox_".$team->getName()."' value='".$team->getName()."'>
								<label style='color:transparent' for='checkbox_".$team->getName()."'></label>
							  </td>";																							
					echo "</tr>";
				}
				?>
				<tr class='text-center'>
					<td colspan='7' class='border-none admin-form-td-submit'>								
						<button id='validate-form-team' type='submit' class='btn btn-pink admin-form-submit'>
							<a>Valider</a>
						</button>
					</td>
				</tr>	
				</tbody>					
				</table>
		<?php
			}
			else 
				echo "<p>Aucune team n'est enregistrée.</p>";
		?>		

	</form>	
</div>
