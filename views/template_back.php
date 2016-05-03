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
			<style>
		
		#content{
			padding-top: 300px;
		}
	</style>
	</head>

	<body>
		<header>
			<?php include("views/includes/admin/navbar.php");?>
		</header>

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