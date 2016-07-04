<div class="index-modal hidden-fade hidden">

	<div class="index-modal-login align">
	<!-- Login Form -->
		<div id="login-form" class="grid-md-4 inscription_rapide animation fadeDown">
			<form id="login-form">			    
			    <label for="email">E-mail :</label>
			    <input class="input-default" type="text" id="email" name="email">

			    <label for="pwd1">Mot de passe : </label>
			    <input class="input-default" type="password" id="pwd1" name="password">			 		
			    <a href="confirmation/lost">Mot de passe oublié ? </a> 
			    <button type="button" class="btn btn-pink"><a>Se connecter</a></button>
	  		</form>
	  	</div>
  	<!-- Fin Login -->

  	<!-- Subscribe Form -->
		<div id="subscribe-form" class="grid-md-4 inscription_rapide animation fadeDown">
			<form id="register-form">
			    <label for="pseudo">Pseudo :</label>
			    <input class="input-default" type="text" id="pseudo" name="pseudo">

			    <label for="email">E-mail :</label>
			    <input class="input-default" type="text" id="email" name="email">

			    <label for="pwd1">Mot de passe : </label>
			    <input class="input-default" type="password" id="pwd1" name="password">
			    <label for="pwd2">Confirmation mot de passe : </label>
			    <input class="input-default" type="password" id="pwd2" name="password_check">
				<p id="naissance">Date de naissance:
					<span class="index-input-default-date">
						<input class="input-default" type="number" name="day"   placeholder="dd" min="1" max="31">
						<input class="input-default" type="number" name="month" placeholder="mm" min="1" max="12">
						<input class="input-default" type="number" name="year"  placeholder="yyyy" min="1980" max="2016">
					</span>
				</p>
			    <input type="checkbox" class="checkbox input-default" id="cgu" name="cgu"><label for="cgu">
			    Vous acceptez les <a href="<?php echo WEBPATH.'/CGU'; ?>" target="_blank">Conditions Générales</a> du site Break'em All</label>
			   
			    <button type="button" class="btn btn-pink index-form-submit"><a>S'inscrire et jouer</a></button>
	  		</form>
	  	</div>
	  	<!-- Fin SF -->
		
	</div>
</div>