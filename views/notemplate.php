<!DOCTYPE html>
<html lang="fr">
	<head>		
		<meta charset="UTF-8">
		<meta name="robots" content="index,follow" />
		<title>Break'em All</title>
		<link rel="icon" href="<?php echo WEBPATH.'/web/img/icon/logo-full.ico'; ?>" type="image/x-icon">
		<meta name="description" content=<?php echo (isset($content)) ? '"'.$content.'"' : 'tournois de jeux vidéos';?>>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	</head>

	<body>
		<?php include $this->view; ?>
	</body>
</html>
