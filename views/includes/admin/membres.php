<div class="configuration-wrapper" id="configuration-onglet-membres-wrapper"
	<form action="configuration/update" method="post" enctype="multipart/form-data">

		<?php 			
			if(is_array($listejoueur)){
			?>							
				<table class='full-width configuration-form-table admin-table member' border='1'>
				<thead>
					<th>Pseudo</th>
					<th>E-mail</th>
					<th>Statut</th>
					<th>Image</th>
					<th>Team</th>
					<th>En ligne</th>
					<th>Verrouiller le compte</th>
				</thead>

				<?php
				//Rajouter une tr/td pour les clés (nom, prenom, etc)
				foreach ($listejoueur as $ligne => $joueur) {
					echo "<tr>";
						echo "<td><a href='".WEBPATH."/profil?pseudo=".$joueur->getPseudo()."'>".$joueur->getPseudo()."<a/></td>";
						echo "<td>".$joueur->getEmail()."</td>";
						echo "<td>".$joueur->getStatus()."</td>";
						echo "<td><img src='".$joueur->getImg()."'></td>";
						echo "<td>".$joueur->getIdTeam()."</td>";
						echo "<td>";
 							if($joueur->getIsConnected()) echo "X";
 						echo "</td>";
						echo "<td><input class='checkbox input-default' type='checkbox' name='' id=''><label style='color:transparent' for=''></label></td>";																							
					echo "</tr>";
				}
				?>
				<tr class='text-center'>
					<td colspan='7' class='border-none configuration-form-td-submit'>								
						<button id='navbar-inscription' type='submit' class='btn btn-pink configuration-form-submit'>
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