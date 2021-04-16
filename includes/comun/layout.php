<?php 
    require_once __DIR__.'/../config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title><?= $tituloPagina ?></title>
	<link rel="stylesheet" type="text/css" href="<?= RUTA_CSS.'/estilo.css'?>" />
	<meta charset="UTF-8">
</head>

<body>

	<?php
     require('header.php');
    
       
     require('aside.php');
   
	?>

	<main>
            <?= $contenidoPrincipal ?>
	</main>
	
	<?php
	require('footer.php');
	?>
</body>

</html>