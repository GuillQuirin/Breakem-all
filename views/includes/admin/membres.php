<div class="admin-wrapper" id="admin-onglet-membres-wrapper">
	<form action="admin/update" method="post" enctype="multipart/form-data">

		<?php 			
			if(is_array($listejoueur)){
			?>							
				<table class='full-width admin-form-table admin-table member' border='1'>
				<thead>
					<th>Pseudo</th>
					<th>E-mail</th>
					<!--<th>Statut</th>-->
					<th>Image</th>
					<th>Team</th>
					<th>Signalements</th>
					<th>En ligne</th>
					<th>Statut de l'utilisateur</th>
				</thead>

				<?php
				//Rajouter une tr/td pour les clés (nom, prenom, etc)
				foreach ($listejoueur as $ligne => $joueur) {
					echo "<tr>";
						echo "<td><a href='".WEBPATH."/profil?pseudo=".$joueur->getPseudo()."'>".$joueur->getPseudo()."<a/></td>";
						echo "<td>".$joueur->getEmail()."</td>";
						//echo "<td>".$joueur->getStatusName($joueur->getStatus())."</td>";
						echo "<td><img src='".$joueur->getImg()."'></td>";
						echo "<td>".$joueur->getIdTeam()."</td>";
						echo "<td>".$joueur->getReportNumber()."</td>";
						echo "<td>";
 							if($joueur->getIsConnected()) 
 								echo "X";
 						echo "</td>";
						echo "<td>
								<select name='status_".$joueur->getPseudo()."' onChange=setStatut('".$joueur->getPseudo()."',this.value)>
									<option value='-1'";
										echo ($joueur->getStatus()==-1) ? " selected " : " "; 
									echo ">Banni</option>
									<option value='1'";
										echo ($joueur->getStatus()==1) ? " selected " : " ";
									echo ">Utilisateur</option>
									<option value='3'";
										echo ($joueur->getStatus()==3) ? " selected " : " ";
									echo ">Admin</option>
								</select>
							</td>";							
						echo "</tr>";
				}
				?>
				<tr class='text-center'>
					<td colspan='12' class='border-none admin-form-td-submit'>								
						<button id='validate-form-membre' type='submit' class='btn btn-pink admin-form-submit'>
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