<form action="configuration/update" method="post" enctype="multipart/form-data">

	<?php 			
		if(is_array($listejoueur)){							
			echo "<table class='full-width configuration-form-table admin-table' border='1'>";
			echo "<tr>";
			foreach($listejoueur as $ligne => $joueur){

				//@Guillaume : je te laisse mettre les clés (nom, etc)

				echo "<td></td>";
			}
			echo "<td></td>";
			echo "<td>Désactivation</td>";
			echo "</tr>";
			foreach ($listejoueur as $ligne => $joueur) {
				echo "<tr>";
					echo "<td><a href='".WEBPATH."/profil?pseudo=".$joueur->getPseudo()."'>".$joueur->getPseudo()."<a/></td>";
					echo "<td>".$joueur->getEmail()."</td>";
					echo "<td>".$joueur->getStatus()."</td>";
					echo "<td><img src='".$joueur->getImg()."'></td>";
					echo "<td>".$joueur->getIdTeam()."</td>";
					echo "<td>".$joueur->getIsConnected()."</td>";
					echo "<td><input class='checkbox input-default' type='checkbox' name='' id=''><label style='color:transparent' for=''></label></td>";																							
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