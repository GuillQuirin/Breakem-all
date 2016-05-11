<div class="configuration-wrapper" id="configuration-onglet-reports-wrapper"
	<form action="configuration/update" method="post" enctype="multipart/form-data">

		<?php 			
			if(is_array($listesignalement)){
			?>							
				<table class='full-width configuration-form-table admin-table report' border='1'>
				<thead>
					<th>Emetteur</th>
					<th>Accusé</th>
					<th>Motif</th>
					<th>Description</th>
					<th>Date</th>
					<th>Supprimer</th>
				</thead>

				<?php
				//Rajouter une tr/td pour les clés (nom, prenom, etc)
				foreach ($listesignalement as $ligne => $report) {
					echo "<tr>";
						echo "<td><a href='".WEBPATH."/profil?pseudo=".$report->getId_indic_user()."'><a/></td>";
						echo "<td>".$report->getId_signaled_user()."</td>";
						echo "<td>".$report->getSubject()."</td>";
						echo "<td><img src='".$report->getDescription."'></td>";
						echo "<td>".$report->getDate()."</td>";
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