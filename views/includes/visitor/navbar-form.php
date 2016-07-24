<div class="index-modal hidden-fade hidden">

	<div class="index-modal-login align">
	<!-- Login Form -->
		<div id="login-form" class="grid-md-4 inscription_rapide animation fadeDown">
			<form id="login-form">			    
			    <label for="email">E-mail :</label>
			    <input class="input-default" type="email" id="email" name="email" required>

			    <label for="pwd1">Mot de passe : </label>
			    <input class="input-default" type="password" id="pwd1" name="password" required>			 		
			    <a href="<?php echo WEBPATH; ?>/confirmation/lost">Mot de passe oublié ?</a>

			    <button type="submit" class="btn btn-pink"><a>Se connecter</a></button>
	  		</form>
	  	</div>
  	<!-- Fin Login -->

  	<!-- Subscribe Form -->
		<div id="subscribe-form" class="grid-md-4 inscription_rapide animation fadeDown">
			<form id="inscription-form">
			    <label for="pseudo">Pseudo :</label>
			    <input class="input-default" type="text" id="pseudo" name="pseudo" maxlength="15" placeholder="Champ limité à 15 caractères" required>
			    <label for="email">E-mail :</label>
			    <input class="input-default" type="email" id="email" name="email" placeholder="Un email de confirmation vous sera envoyé." required>

			    <label for="pwd1">Mot de passe : </label>
			    <input class="input-default" type="password" id="pwd1" name="password" placeholder="6 caractères minimums" required>
			    <label for="pwd2">Confirmation mot de passe : </label>
			    <input class="input-default" type="password" id="pwd2" name="password_check" required>
				<p id="naissance">Date de naissance:
					<span class="index-input-default-date">
						<input class="input-default" type="number" name="day" placeholder="dd" min="1" max="31" required>
						<input class="input-default" type="number" name="month" placeholder="mm" min="1" max="12" required>
						<input class="input-default" type="number" name="year" placeholder="yyyy" min="1950" max="<?php echo date('Y'); ?>" required>
					</span>
				</p>
			    <input type="checkbox" class="checkbox input-default" id="cgu" name="cgu" required><label for="cgu">
			    J'accepte les <a class="CGU" href="<?php echo WEBPATH.'/CGU'; ?>" target="_blank">Conditions Générales</a> du site Break'em All</label>
			   
			    <button type="submit" class="btn btn-pink index-form-submit"><a>S'inscrire</a></button>
	  		</form>
	  	</div>
	  	<!-- Fin SF -->
		
	</div>
</div>