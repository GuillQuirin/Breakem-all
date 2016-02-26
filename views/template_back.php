<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script>
	$(document).ready(function(){
		

	});
	</script>
	<style>
		header{
		    background-color: #272822;
		    height: 100px;
		    position: fixed;
		    width: 100%;
		    top: 0;
		    left: 0;
		    font-family: sans-serif;
		    text-align: center;
		}
		header>a{
	        float: left;
		    width: 35px;
		    height: 35px;
		    background-color: #FFFFFF;
		    border-radius: 20px;
		    text-align: left;
		    text-decoration: none;
		    z-index: 2;
    		position: relative;
		    transition: width 1s;
		}
		header>a:hover{
			width: 230px;
		}
		header>a span{
			opacity: 0;
			color: black;
		    text-decoration: none;
		    position: absolute;
		    width: 185px;
		    left: 35px;
		    top: 10px;
		    display: none;
		}
		header>a:hover span{
			opacity: 1;
			display:inline-block;
		}
		header>a img{
		    max-height: 100%;
		    vertical-align: middle;
		}
		header p{
			position: fixed;
		    color: white;
		    font-size: 25px;
		    margin: 10px auto;
		    width: 100%;
		    z-index: 1;
		}
		header ul{
			text-align: center;
		    width: 100%;
		    display: block;
		    position: absolute;
		    bottom: 0;
		    padding: 0;
		    margin: 0;
		}
		header li{
		    width: 20%;
		    display: inline-block;
		    color: black;
		    background-color: #D3D3D3;
		    margin: 0px 2%;
		    font-size: 20px;
		    height: 40px;
		    padding-top:0;
		    border-radius: 6px 6px 0 0;
		    transition:padding 1s, background-color 1s;
		}
		header li:hover{
			padding: 10px 0 0 0;
			background-color: #E5D8C5;
		}
		header li>a{
		    text-decoration: none;
		    color: black;
		    vertical-align: sub;
		    width: 100%;
		    display: inline-block;
		    height: 80%;
		}
		footer{
		    display: block;
		    width: 100%;
		    height: 50px;
		    border-radius: 50px 50px 0 0;
		    background-color: black;
		}
	</style>
</head>
<body>
<header>
<a id="lol" href="#">
	<img src="arrow_left.png">
	<span>Retour à la page d'accueil</span>
</a>
<p>PARTIE ADMINISTRATION</p>
<nav>
	<ul>
		<li><a href="#">Utilisateur</a></li>
		<li><a href="#">Jeux</a></li>
		<li><a href="#">Tournoi</a></li>
		<li><a href="#">Commentaire</a></li>
	</ul>
</nav>
</header>

<footer>
	
</footer>
</body>
</html>