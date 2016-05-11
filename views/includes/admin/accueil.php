<section id="container_index">
	<div id="contain">
		<div id="contain_left">
			<?php 			
				if(is_array($listejoueur)){
					echo "<h2>Liste des membres inscrits</h2>";
					echo "<table class='admin-table-member' border='1'>";
					foreach ($listejoueur as $ligne => $joueur) {
						echo "<tr>";
							echo "<td>".$joueur->getPseudo()."</td>";
							echo "<td>".$joueur->getEmail()."</td>";
							echo "<td>".$joueur->getStatus()."</td>";
							echo "<td>".$joueur->getImg()."</td>";
							echo "<td>".$joueur->getIdTeam()."</td>";
							echo "<td>".$joueur->getIsConnected()."</td>";
						echo "</tr>";
					}
					echo "</table>";
				} 
			?>
		</div>
		<div id="contain_right">
			
		</div>
	</div>
</section>
