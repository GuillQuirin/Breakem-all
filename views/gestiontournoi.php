<?php
if(isset($tournoi)){
	if(isset($MAJ))
		echo "<div>Mise à jour correctement effectuée.</div>";
	?>

	<section class="middle-height bg-cover-configuration relative">

	<div class="align full-height">
		<div class="configuration-header-profil-wrapper">
			<div class="configuration-header-profil-left">
				<img class="configuration-header-profil-image" src="<?php echo $tournoi->getGameImg(); ?>" title="Jeu" alt="Jeu">
			</div>			
		</div>
	</div>
	 
	<img class="icon icon-size-3 down-center header-scroll-down" id="classement-header-scroll-down" src="web/img/icon/icon-scrollDown.png"> 

	<div class="configuration-onglet-wrapper">
		<ul class="configuration-onglet-ul">
			<li class="active">
				<a>Profil</a>
			</li>		
		</ul>
	</div>

	</section>

	<section class="configuration-content-wrapper my-content-wrapper">

		<div class="container m-a content-border classement-container" style="border:none;">

			<div class="row classement-content-row">
				<div class="grid-md-12">
				
					<form action="configuration/update" method="post" enctype="multipart/form-data">

						<table class="full-width configuration-form-table">
							<tr class="text-center">
								<td colspan="2">
									<?php echo '<img class="icon icon-size-3 navbar-icon" src="' . WEBPATH . '/web/img/icon/icon-profil.png">';?>
										<span class="configuration-form-menu-tr">Informations du tournoi</span>
								</td>
							</tr>
							<tr>						
								<td><span>Nom du tournoi : </span></td>
								<td><input type="text" value="<?php echo $tournoi->getName(); ?>"></td>
							</tr>
							<tr>
								<td><span>Description : </span></td>
								<td>
									<textarea class="configuration-input-default textarea-default" name="description" placeholder="Veuillez ne pas mettre de message pouvant offenser les autres joueurs ou ne pas respecter les CGU">
										<?php echo $tournoi->getDescription(); ?>
									</textarea>
								</td>							
							</tr>
							<tr>						
								<td>
									<span>Cloturer le tournoi : </span>
								</td>
								<td>
									<p>Attention: cette action est définitive !</p>
									<button>Verrouiller le tournoi</button>
								</td>
							</tr>
							<tr>
								<td>
									<p>Il vous est impossible de modifier le jeu ou les règles composant le tournoi. Il vous faut pour cela verrouiller celui-ci et en recréer un.</p>
								</td>
							</tr>
							<tr>						
								<td>
									<span>Modifier le nombre de participant maximum (pas < au nombre de participant actuel): </span>
								</td>
								<td class="configuration-form-email">
									<div> 

										<input type="number" value="<?php echo $tournoi->getMaxPlayer(); ?>" min="<?php echo $tournoi->getNumberRegistered(); ?>">
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<span>Date du début de tournoi (non modifiable):</span>					
								</td>
								<td>
									<p><?php echo date('d/m/Y \à H:i', $tournoi->getStartDate()); ?></p>
								</td>
							</tr>
							<tr>
								<td>
									<span>Date de fin de tournoi :</span>					
								</td>
								<td>
									<span class="index-input-default-date">
										<input class="input-default" type="number" name="day"   placeholder="dd" min="1" max="31" value="<?php echo  date('d', $tournoi->getEndDate()); ?>">
										<input class="input-default" type="number" name="month" placeholder="mm" min="1" max="12" value="<?php echo  date('m', $tournoi->getEndDate()); ?>">
										<input class="input-default" type="number" name="year"  placeholder="yyyy" min="1950" max="2016" value="<?php echo  date('Y', $tournoi->getEndDate()); ?>">
									</span>
								</td>
							</tr>
						</table>
						<div>
							<h3 class="configuration-form-menu-tr">Membres</h3>

							<p>Liste des inscrits</p>
							<select>
								<?php 
									if(isset($allRegistered) and is_array($allRegistered)){
										foreach ($allRegistered as $key => $value) {
											echo "<option value='".$value->getPseudo()."'>".$value->getPseudo()."</option>";
										}
									}
								?>
							</select>

							<p>Message à destination des inscrits :</p>
							<textarea class="configuration-input-default textarea-default" name="description" placeholder="Veuillez ne pas mettre de message pouvant offenser les autres joueurs ou ne pas respecter les CGU">
									<?php echo (isset($_description)) ? $_description : ''; ?>
							</textarea>

						</div>		
					</form>				
				</div>
			</div>				
		</div>
	</section>
<?php 
}
?>