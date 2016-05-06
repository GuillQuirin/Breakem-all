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
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/template.css" media="screen">';?>

			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/general-stylesheet.css">';?>

			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/animation.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/background.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/body.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/border.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/button.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/caption.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/checkbox.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/cursor.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/display.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/failed-input.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/float.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/fonts.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/grid.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/header.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/hr.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/icon.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/image.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/input-radio.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/input.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/loading.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/margin.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/menu.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/navbar.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/overflow.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/padding.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/position.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/search.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/shadow.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/select.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/size.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/text.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/transform.css">';?>

			
			<?php echo (isset($css)) ? '<link rel="stylesheet" href="'.WEBPATH.'/web/css/'.$css.'-stylesheet.css">' : '';?>

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
