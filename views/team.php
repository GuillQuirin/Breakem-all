<img id="Img" src="web/img/SF4B.jpg" />
<section id ="Info">Rayz<br>
Joueur Smash bros et Street fighter<br>
10 victoire - 4 défaites<br>
team Yes <br></section>
<section id ="Desc"><p>Description de la team blablalbalbalbalba</p></section>
<section id ="List"><p>Liste des membres de la team</p></section>
<div><img id="Balrog" src="web/img/Balrog-gigaton.gif" />
<button id ="Quit">Quitter le groupe</button></div>

<form action=<?php echo getActionPage($this->view, 'verify');?> method="POST">
	<input type="text" name="name" placeholder="nom">
	<input type="text" name="slogan" placeholder="slogan">
	<textarea name="description" placeholder="description"></textarea>
	<input type="submit">
</form>
<footer>
</footer>

</body>
</html>