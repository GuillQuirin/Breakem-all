<div class="admin-wrapper" id="admin-onglet-gametype-wrapper">
	<?php 			
		if(is_array($listetypejeu)){
		?>							
			<table class='full-width admin-form-table admin-table member' border='1'>
			<thead>
				<th>Image</th>
				<th>Nom</th>
				<th>Description</th>
				<th>Modifier</th>
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
							echo "<button onclick=getTypeGame(".$type->getId().")>Modifier</button>";
					echo "</td>";
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
						<a>Créer</a>
					</button>
				</td>
			</tr>	
			</tbody>					
			</table>
	<?php
		} 
	?>

	<!-- <div class='admin-data-ihm align'>
		<div class='index-modal platforms hidden-fade hidden'>
			<div class='index-modal-this index-modal-login align'>
				<div id='login-form' class='grid-md-3 inscription_rapide animation fade'> -->
					<div id="typegameForm">
						<form id='platform-form'>			    
						    <label for='email'>Nom :
						    	<input class='input-default admin-form-input-w' id='nom' name='nom' type='text'>
						    </label>
						    <textarea class='input-default admin-form-input-w' id='description' name='description' type='text'></textarea>							    							  
						    <div class='admin-avatar-wrapper m-a'>
								<img class='admin-avatar img-cover' id="img" title='Image de profil' alt='Image de profil'>
							</div>
							<div class='text-center admin-input-file'>								 
								<input type='file' name='profilpic'>
							</div>
						    <button id='platform-submit-form-btn' type='button' class='btn btn-pink'><a>Valider</a></button>
				  		</form>
				  	</div>
	<!-- 		</div> 
			</div>
		</div>
	<div> -->

</div>