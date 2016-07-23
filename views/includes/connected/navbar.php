<div class="grid-md-3 hidden-xs hidden-sm navbar-menu">
	<ul class="navbar-menu-ul">		
		<li class="navbar-menu-li">
			<a href="<?php echo WEBPATH.'/profil?pseudo='.$_pseudo; ?>" class="">
			<?php echo '<img class="navbar-profil-img img-circle" src="'.$_img.'"><div class="navbar-connected-online"></div>';?>
			</a>
		</li>
		<li class="navbar-menu-li">
			<a class="navbar-profil-title" href="<?php echo WEBPATH.'/profil?pseudo='.$_pseudo; ?>">
				<?php echo $_pseudo	?>
				<span><?php echo (isset($_totalPoints)) ? $_totalPoints : '0';?> pts</span>
			</a>
		</li>
		<li class="navbar-menu-li navbar-menu-settings">
			<a href="<?php echo WEBPATH.'/configuration'; ?>" class="">
			<?php echo '<img class="icon icon-size-3 navbar-icon" src="' . WEBPATH . '/web/img/icon/icon-settings.png">';?>
			</a>
			<ul class="navbar-menu-tooltip animation fadeUpLow" id="navbar-menu-tooltip-settings">
				<?php 
				if(isset($_isAdmin) && $_isAdmin == 1){
				?>
					<li class="navbar-menu-tooltip-li">
						<a href="<?php echo WEBPATH.'/admin'; ?>">
							Administration
						</a>
					</li>
				<?php
				}
				?>			
				<li class="navbar-menu-tooltip-li">
					<a href="<?php echo WEBPATH.'/configuration'; ?>">
						Mon compte
					</a>
				</li>
				<?php
				if(isset($_nameTeam)){
				?>
					<li class="navbar-menu-tooltip-li">
						<a href="<?php echo WEBPATH.'/detailteam?name='.$_nameTeam; ?>">
							Ma team
						</a>
					</li>
				<?php 
				}
				?>							
				<li class="navbar-menu-tooltip-li">
					<a id="nav-deconnection">
						Deconnexion
					</a>
				</li>
			</ul>
		</li>
	</ul>
</div>


