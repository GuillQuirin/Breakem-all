<div class="admin-wrapper" id="admin-onglet-team-wrapper"
	<form action="admin/update" method="post" enctype="multipart/form-data">

		<?php 			
			if(is_array($listeteam)){
			?>							
				<table class='full-width admin-form-table admin-table member' border='1'>
				<thead>
					<th>Nom</th>
					<th>Image</th>
					<th>Description</th>
					<th>Statut</th>
					<th>Verrouiller la team</th>
				</thead>

				<?php
				//Rajouter une tr/td pour les clés (nom, prenom, etc)
				foreach ($listeteam as $ligne => $team) {
					echo "<tr>";
						echo "<td><a href='".WEBPATH."/team?name=".$team->getTeam()."'>".$team->getTeam()."<a/></td>";
						echo "<td><img src='".$team->getImg()."'></td>";
						echo "<td>".$joueur->getDescription()."</td>";
						echo "<td>".$joueur->getStatut()."</td>";
						echo "<td><input class='checkbox input-default' type='checkbox' name='' id=''><label style='color:transparent' for=''></label></td>";																							
					echo "</tr>";
				}
				?>
				<tr class='text-center'>
					<td colspan='7' class='border-none admin-form-td-submit'>								
						<button id='navbar-inscription' type='submit' class='btn btn-pink admin-form-submit'>
							<a>Valider</a>
						</button>
					</td>
				</tr>	
				</tbody>					
				</table>
		<?php
			} 
		?>		

	</form>	
</div>