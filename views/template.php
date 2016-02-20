<!doctype html>
	<html lang="fr">
		<head>
			<meta charset="utf-8">
			<meta name="robots" content="index,follow" />
			<title>Break'em All<?php echo (isset($title)) ? ' - '.$title : '';?></title>
			<meta name="description" content=<?php echo (isset($content)) ? '"'.$content.'"' : 'tournois de jeux vidéos';?>>
			<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
			<link rel="stylesheet" href="web/css/general-stylesheet.css">
			<?php echo (isset($css)) ? '<link rel="stylesheet" href="web/css/'.$css.'-stylesheet.css">' : '';?>
		</head>
		<body>
			<?php
				include $this->view; 
			?>
		</body>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<?php echo (isset($js)) ? '<script src="web/js/'.$js.'.js"></script>' : '';?>
</html>