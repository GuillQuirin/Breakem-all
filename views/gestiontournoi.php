<?php
if(isset($tournoi)){ 
	?>

	<section class="low-height bg-cover-gestiontournoi relative">
	    <div class="align full-height">
	        <div class="align full-height animation fadeLeft">
	            <div class="header-title admin-header-title border-full relative creationtournoi-title-container display-block">                
	                    <h1 class="capitalize title header-title">Gestion du Tournoi</h1>             
	            </div>  
	        </div>
	    </div>      

	    <img class="icon icon-size-3 down-center header-scroll-down" id="team-header-scroll-down" src="web/img/icon/icon-scrollDown.png"> 
	</section>

	<!--
	<div class="configuration-onglet-wrapper">
		<ul class="configuration-onglet-ul">
			<li class="active">
				<a>Gestion d'un tournoi</a>
			</li>		
		</ul>
	</div>
	-->

	</section>

	<section class="configuration-content-wrapper my-content-wrapper">
		<div class="container m-a content-border gestiontournoi-container">

			<div class="row classement-content-row">
				<div class="grid-md-12">
					<span type="submit" class="btn btn-pink btn-gestion-tounoi index-header-btn-pink-width">'
						<a href="<?php echo WEBPATH.'/tournoi?t='.$tournoi->getLink(); ?>">
							Revenir sur le tournoi
						</a>
					</span>
					<div class="configuration-header-profil-wrapper">
						<div class="configuration-header-profil-left">
							
							<img class="gestiontournoi-header-profil-image" src="<?php echo $tournoi->getGameImg(); ?>" title="Page du tournoi" alt="Jeu">
							</a>
						</div>	
					</div>		
	

					<?php 
					if(trim($verrouillage)!=="disabled")
						echo '<form action="gestiontournoi/update" method="post" enctype="multipart/form-data">';
					?>
						<table class="full-width configuration-form-table">
							<tr>
								<td colspan='2' id="result" class='MAJ text-center'></td>
							</tr>
							<?php 
								if(isset($MAJ))
									echo "<tr class='MAJ text-center'><td colspan='2'>Mise à jour correctement effectuée.</td></tr>";
								
								if(isset($ErrorExpiration))
									echo "<tr class='MAJ text-center'><td colspan='2'>Erreur de mise à jour.<br>Attention: Il n'est pas possible de modifier le tournoi à 48h de son lancement.</td></tr>";

								if(isset($ErrorDatas))
									echo "<tr class='MAJ text-center'><td colspan='2'>Erreur de mise à jour.<br>Des erreurs sont survenues lors de la modification.</td></tr>";

								if(isset($ErrorDate))
									echo "<tr class='MAJ text-center'><td colspan='2'>Erreur de mise à jour.<br>La date envoyée est incorrecte.</td></tr>";

								if(trim($verrouillage)==="disabled")
									echo "<tr class='text-center'><td colspan='2'>Ce tournoi est terminé ou verrouillé</td></tr>";
							?> 
							<tr class="text-center">
								<td colspan="2">
									<?php echo '<img class="icon icon-size-3 navbar-icon" src="' . WEBPATH . '/web/img/icon/icon-profil.png">';?>
										<span class="configuration-form-menu-tr">Informations du tournoi</span>
								</td>
							</tr>
							<tr>						
								<td><span>Nom du tournoi : </span></td>
								<td><input class="input-default" type="text" id="nomTournoi" name="name" value="<?php echo $tournoi->getName(); ?>" <?php echo $verrouillage; ?>></td>
							</tr>
							<tr>
								<td><span>Description : </span></td>
								<td>
									<textarea class="configuration-input-default textarea-default" name="description" maxlength="200" rows="3"placeholder="Veuillez ne pas mettre de message pouvant offenser les autres joueurs ou ne pas respecter les CGU" <?php echo $verrouillage; ?>><?php echo $tournoi->getDescription(); ?></textarea>
								</td>							
							</tr>
							<?php
								if(trim($verrouillage)!=="disabled"){
							?>
								<tr>						
									<td>
										<span>Clôturer le tournoi : </span>
									</td>
									<td>
										<p class="warning">Attention : cette action est définitive !</p>
										<button id="btn-shut-down" class="btn btn-pink index-header-btn-pink-width btn-config">
											<a>Verrouiller le tournoi</a>
										</button>
									</td>
								</tr>
							<?php 
								}
							?>
							<tr>
								<td>
									<span>Règles :</span>
								</td>
								<td>
									<p>Il vous est impossible de modifier le jeu ou les règles composant le tournoi.<br> Il vous faut pour cela verrouiller celui-ci et en recréer un.</p>
								</td>
							</tr>
							<tr>
								<td>
									<span>Date du début de tournoi :</span>					
								</td>
								<td>
									<span class="index-input-default-date">
										<input class="input-default" type="number" name="Dday"   placeholder="dd" min="1" max="31" value="<?php echo  date('d', $tournoi->getStartDate()); ?>" <?php echo $verrouillage; ?>>
										<input class="input-default" type="number" name="Dmonth" placeholder="mm" min="1" max="12" value="<?php echo  date('m', $tournoi->getStartDate()); ?>" <?php echo $verrouillage; ?>>
										<input class="input-default" type="number" name="Dyear"  placeholder="yyyy" min="1950" max="<?php echo date('Y'); ?>" value="<?php echo  date('Y', $tournoi->getStartDate()); ?>" <?php echo $verrouillage; ?>>
									</span>
								</td>
							</tr>
							<tr>
								<td>
									<span>Date de fin de tournoi :</span>					
								</td>
								<td>
									<?php echo  date('d / m / Y', $tournoi->getEndDate()); ?>
								</td>
							</tr>
						</table>
					<?php 
					if(trim($verrouillage)!=="disabled"){
						echo "<input type='hidden' name='link' value='".$_GET['t']."'>";
						echo '<button type="submit" id="MAJ-submit" class="btn btn-pink index-header-btn-pink-width btn-config">';
							echo '<a>Mettre à jour</a>';
						echo '</button>'; 
						echo '</form>';
					}
					?>
					<!--<div>
						<h3 class="configuration-form-menu-tr">Membres</h3>

						<p>Liste des inscrits</p>
						<table id="listmembers">
							<?php 
							/*
								if(isset($allRegistered) and is_array($allRegistered)){
									foreach ($allRegistered as $key => $value) {
										echo "<tr><td><a href='".WEBPATH."/profil?pseudo=".$value->getPseudo()."'>".$value->getPseudo()."</a></td></tr>";
									}
								}
							?>
						</table>

						<?php /*if(trim($verrouillage)!=="disabled"){ ?>
							<p>Message à destination des inscrits :</p>
							<textarea id="msg_tournament" class="configuration-input-default textarea-default" name="description" placeholder="Veuillez ne pas mettre de message pouvant offenser les autres joueurs ou ne pas respecter les CGU" <?php echo $verrouillage; ?>>
							</textarea>
							<button id="btn_member_tournament" class="btn btn-pink index-header-btn-pink-width">
								<a>Envoyer le mail</a>
							</button> 
						<?php 

						}*/
						?>
					<!--</div>	-->					
				</div>
			</div>				
		</div>
	</section>
<?php 
}
?>