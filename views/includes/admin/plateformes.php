<form action="configuration/update" method="post" enctype="multipart/form-data">

	<?php 			
		/*

		//Rajouter une tr/td pour les clés (nom, prenom, etc)

		*/
		if(is_array($listeplatform)){							
			echo "<table class='full-width configuration-form-table admin-table platform' border='1'>";
			foreach ($listeplatform as $ligne => $platform) {
				echo "<tr>";										
					echo "<td>".$platform->getName()."</td>";
					echo "<td>".$platform->getDescription()."</td>";
					echo "<td><img src='".$platform->getImg()."'></td>";				
				echo "</tr>";
			}
			echo "<tr class='text-center'>
				<td colspan='7' class='border-none configuration-form-td-submit'>																	
					<button id='navbar-inscription' type='submit' class='btn btn-pink configuration-form-submit'><a>Valider</a></button>
				</td>
			</tr>";							
			echo "</table>";
		} 
	?>		

</form>	