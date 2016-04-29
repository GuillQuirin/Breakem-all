

<section id="container_index">
	<div id="contain">
		<div id="contain_left">
			<?php 
				if(is_array($listejoueur)){
					echo "<h2>Liste des membres inscrits</h2>";
					echo "<table border='1'>";
					foreach ($listejoueur as $ligne => $joueur) {
						echo "<tr>";
						foreach ($joueur as $key => $value) {
							echo "<td>".$value."</td>";
						}
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
