<section id="entete">
	<div id="trophee">
		<img id="inscr_logo" alt="logo" src="https://wiki.teamfortress.com/w/images/thumb/3/3e/Achieved.png/200px-Achieved.png?t=20110424214508">
	</div>	
	<p>BREAK EM ALL</p>
	<div class="colonne">
		Faites-vous de nouveaux coéquipiers....
	</div>
	<div class="colonne">
		....et affrontez-les !
	</div>
</section>
<section id="content">
	<ul class="cb-slideshow">
	    <li><span>Image 01</span></li>
	    <li><span>Image 02</span></li>
	    <li><span>Image 03</span></li>
	</ul>
	<div id="left">
		<p>Créez votre propre tournoi de A à Z <img src="../web/img/mario.png"></p>
		<p>Organisez ou participez à des évènements sur place<img src="../web/img/kirby.gif"></p>
		<p>Montrez vos talents auprès de toute une communauté<img src="../web/img/link.gif"></p>
	</div>
	<div id="right">
		<header><img src="../web/img/arrow.png" id="arrow">REJOIGNEZ-NOUS MAINTENANT</header>
		<form action="inscription.html" method="POST">
			<div id="inscr_coord">
					<p><!--[if IE 9]>Pseudo:<![endif]-->
						<input id="insc_pseudo" type="text" placeholder="Pseudo" autofocus required>
						<span class="bullecontent">Ce pseudo est déjà utilisé.</span>
					</p>
					<p><!--[if IE 9]>Adresse e-mail:<![endif]-->
						<input id="insc_email" type="email" placeholder="Email" class="bulle" required>
						<span class="bullecontent">L'adresse est mal rédigée </span>
					</p>
					<p><!--[if IE 9]>Mot de passe:<![endif]-->
						<input id="insc_pwd" type="password" placeholder="Mot de passe" class="bulle" required>
						<span class="bullecontent">1 majuscule et 6 caractères minimum</span>
					</p>
					<p><!--[if IE 9]>Confirmation de mot de passe:<![endif]-->
						<input id="conf_insc_pwd" type="password" placeholder="Confirmation du mot de passe" class="bulle" required>
						<span class="bullecontent">Les 2 mots de passe doivent être similaires</span>
					</p>
					<p id="naissance">Date de naissance:
						<span>
							<input type="number" name="day"   placeholder="dd" min="1" max="31">
							<input type="number" name="month" placeholder="mm" min="1" max="12">
							<input type="number" name="year"  placeholder="yyyy" min="1950" max="2016">
						</span>
					</p>
					<p>CAPTCHA:</p>
			</div>
			<p id="inscr_cgu">En cliquant sur Enregistrer, vous acceptez <a href="#">les Conditions Générales</a> de Break'em all</p>
			<button id="inscr_envoi" class="bouton" type="submit">Enregistrer</button>
		</form>
	</div>
</section>
