<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="robots" content="index,follow" />
			<title>Break'em All<?php echo (isset($title)) ? ' - '.$title : '';?></title>
			<?php echo '<link rel="shortcut icon" href="' . WEBPATH . '/web/img/icon/logo-full.ico" type="image/x-icon">';?>
			<meta name="description" content=<?php echo (isset($content)) ? '"'.$content.'"' : 'tournois de jeux vidéos';?>>
			<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<?php echo '<link rel="stylesheet/less" href="' . WEBPATH . '/web/css/template.less" media="screen">';?>
		<?php echo '<link rel="stylesheet/less" href="' . WEBPATH . '/web/css/module/main.less" media="screen">';?>
		
		<?php echo (isset($css)) ? '<link rel="stylesheet/less" href="'.WEBPATH.'/web/css/'.$css.'-stylesheet.less">' : '';?>

	</head>

	<body>
	<header>
			 <!-- Navbar top -->
			  <nav class="navbar full fixed transparent" id="navbar">
			    <div class="container resultat-container m-a">

			    <!-- MENU -->
			      <div class="grid-md-12 hidden-xs hidden-sm navbar-menu">
			      		<ul>
			      			<li class="hover-none">
					        	<a href="<?php echo WEBPATH; ?>" class="navbar-logo">
				      				<img src="web/img/logo-nb-title.png">
				      			</a>
			      			</li>		   				     
				        </ul>
			       </div>
			       <!-- FIN MENU -->
			    </div>
			  </nav>
		</header>
		<div id="background">
		</div>
		<div id="fail">
			<h1>FAIL</h1>
			<h2>Aucune page n'a pu être trouvée</h2>
			<a href=<?php echo WEBPATH; ?>>Retour à l'accueil</a>
		</div>
	</body>
</html>
