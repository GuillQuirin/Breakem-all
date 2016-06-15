<!DOCTYPE html>
<html lang="fr">
	<head>

		<!-- J'en rajouterais plutard -->
		<!-- <meta http-equiv="Content-Security-Policy" content="default-src 'self'"> -->
		<!-- Fin Security -->
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
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/header.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/size.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/text.css">';?>
			<?php echo '<link rel="stylesheet" href="' . WEBPATH . '/web/css/module/transform.css">';?>

			
			<?php echo (isset($css)) ? '<link rel="stylesheet" href="'.WEBPATH.'/web/css/'.$css.'-stylesheet.css">' : '';?>

	</head>

	<body>
		<div class="search-page hidden-fade hidden">
			<div class="container m-a">
				<div class="grid-md-12">
					<h2>Recherchez n'importe quoi puis appuyez sur entrer.</h2>
					<form method="post" class="">
		                    <!-- Input Search -->
		                    <div class="grid-md-12">
		                        <input class="input-search full-width" type="text" name="searchzone" placeholder="Recherchez" autocomplete="off">
		                    </div>
		            </form>
				</div>
			</div>

			<button class="search-btn btn-default circle-button default btn-close">
		        <span class="circle-greater-than">
		        	<?php echo '<img class="search-close" src="'. WEBPATH . '/web/img/icon/icon-close.png">';?>
		        </span>
		    </button>

		</div>		
		<div id="content">
			<?php include $this->view; ?>
		</div>
		<footer>
			<div id="copyright">
				&#169 Copyright 2016 Break'em All. All right reserved.
			</div>
		</footer>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<?php echo (isset($js)) ? '<script src="'.WEBPATH.'/web/js/'.$js.'.js"></script>' : '';?>
		<?php //ERREUR DANS LA CONSOLE -> echo '<script src="'.WEBPATH.'/web/js/navbar.js"></script>';?>
	</body>
</html>