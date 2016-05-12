<div class="configuration-wrapper" id="configuration-onglet-platforms-wrapper">
	<form action="configuration/update" method="post" enctype="multipart/form-data">

		<?php 			

			//Rajouter une tr/td pour les clés (nom, prenom, etc)
			
			if(is_array($listeplatform)){							
				echo "<table class='full-width configuration-form-table admin-table platform'>";
				echo
				"
				<tr> 
					<td>Nom</td>
					<td>Description</td>
					<td>Image</td>
				</tr>
				";
				foreach ($listeplatform as $ligne => $platform) {											
						echo "<td>".$platform->getName()."</td>";
						echo "<td>".$platform->getDescription()."</td>";
						echo "<td><img src='".$platform->getImg()."'></td>";
						// Btn hover	
						echo 
						"	
							<td class='admin-form-button-wrapper'>
								<div class='align full-height'>
									<button type='button' class='admin-form-button'>Modifier</button>
									<button type='button' class='admin-form-button'>Verrouiller</button>
								</div>
							</td>
						";			
						//Fin Btn hover	
					echo "</tr>";
				}						
				echo "</table>";
				/*echo 
				"
					<div class='admin-form-add'>
						Ajouter
					</div>
				";*/
			} 
		?>		

	</form>	
</div>