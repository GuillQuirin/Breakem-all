<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script>
	$(document).ready(function(){
		$("li").each(function(){
			$(this).mouseover(function() {
				$(this).css("padding-top", "10px");
				$(this).css("background-color", "#E5D8C5");
			});
			$(this).mouseout(function() {
				$(this).css("padding-top", "0px");
				$(this).css("background-color", "#D3D3D3");
			});
		});
		$("#lol").mouseover(function(){
			$("#lol").css("width", "230px");
			$("header span").fadeIn();
		});
		$("#lol").mouseout(function(){
			$("header span").fadeOut();
			$("#lol").css("width", "30px");
		});
	});
	</script>
	<style>
		header{
		    background-color: #272822;
		    height: 90px;
		    position: fixed;
		    width: 100%;
		    top: 0;
		    left: 0;
		    font-family: sans-serif;
		    text-align: center;
		}
		header a{
	        float: left;
		    width: 30px;
		    height: 35px;
		    background-color: #FFFFFF;
		    border-radius: 20px;
		    text-align: left;
		}
		header a img{
		    max-height: 100%;
		    vertical-align: middle;
		}
		header a span{
			display: none;
			color: black;
		    text-decoration: none;
		}
		header p{
			margin-top: 10px;
			color: white;
			font-size: 25px;
		}
		ul{
			text-align: center;
		    width: 100%;
		    display: block;
		    position: absolute;
		    bottom: 0;
		    padding: 0;
		    margin: 0;
		}
		li{
		    width: 20%;
		    display: inline-block;
		    color: black;
		    background-color: #D3D3D3;
		    margin: 0px 2%;
		    font-size: 20px;
		    height: 40px;
		    border-radius: 6px 6px 0 0;
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
		<li>Utilisateur</li>
		<li>Jeux</li>
		<li>Tournoi</li>
		<li>Commentaire</li>
	</ul>
</nav>
</header>

<footer>
	
</footer>
</body>
</html>