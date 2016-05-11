<form action="configuration/update" method="post" enctype="multipart/form-data">

	<?php 			
		/*
		Check si la variable est nulle

		var_dump($listeplateform);
		exit(1);
		*/
		if(is_array($listeplateform)){							
			echo "<table class='full-width configuration-form-table admin-table' border='1'>";
			echo "<tr>";
			foreach($listeplateform as $ligne => $plateform){			

				echo "<td></td>";
			}					
			echo "</tr>";
			foreach ($listeplateform as $ligne => $plateform) {
				echo "<tr>";										
					echo "<td>".$plateform->getName()."</td>";
					echo "<td>".$plateform->getDescription()."</td>";
					echo "<td>".$plateform->getImage()."</td>";					
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