<div class="admin-wrapper" id="admin-onglet-reports-wrapper">
	<!-- <form action="admin/update" method="post" enctype="multipart/form-data"> -->

		<?php 			
			if(isset($listesignalement) && is_array($listesignalement)){
			?>							
				<table class='full-width admin-form-table admin-table report' border='1'>
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
						echo "<td><a href='".WEBPATH."/profil?pseudo=".$report->getPseudo_indic_user()."'>".$report->getPseudo_indic_user()."<a/></td>";
						echo "<td><a href='".WEBPATH."/profil?pseudo=".$report->getPseudo_signaled_user()."'>".$report->getPseudo_signaled_user()."<a/></td>";
						echo "<td>".$report->getSubject()."</td>";
						echo "<td>".$report->getDescription()."</td>";
						echo "<td>".$report->getDate()."</td>";
						echo "<td><button onclick=deleteReport(".$report->getId().")>Effacer</button></td>";						
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
			else
				echo "<p>Pas de signalements à récupérer</p>";
		?>		

	<!-- </form>	 -->
</div>