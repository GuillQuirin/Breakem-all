<div class="admin-wrapper" id="admin-onglet-gametype-wrapper">
	<?php 			
		if(is_array($listetypejeu)){
		?>							
			<table class='full-width admin-form-table admin-table member' border='1'>
			<thead>
				<th>Image</th>
				<th>Nom</th>
				<th>Description</th>
				<th>Supprimer</th>
			</thead>

			<?php
			foreach ($listetypejeu as $ligne => $type) {
				echo "<tr>";
					echo "<td><img src='".$type->getImg()."'></td>";
					echo "<td>".$type->getName()."</td>";
					echo "<td>".$type->getDescription()."</td>";
					echo "<td>";
						if($type->getId()!=-1)
							echo "<button onclick=deleteTypeGame(".$type->getId().")>Effacer</button>";
					echo "</td>";					
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
	?>		
</div>