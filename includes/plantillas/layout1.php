<?php 
    require_once __DIR__.'/../config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title><?= $tituloPagina ?>Social Museum</title>
	<link rel="stylesheet" type="text/css" href="<?= 'css/estilo.css' ?>" />
	<meta charset="UTF-8">
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Girassol&family=Oswald&display=swap');
	</style>
</head>

<body>

	<?php
    require("includes/comun/header.php");
    
       
    // require('aside.php');
   
	?>

	<main>
            <?= $contenidoPrincipal ?>
	</main>
	
	<?php
	require("includes/comun/footer.php");
	?>
</body>

</html>