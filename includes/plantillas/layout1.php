<?php 
    require_once __DIR__.'/../config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title><?= $tituloPagina ?>Social Museum</title>
	<link rel="stylesheet" type="text/css" href="<?= RUTA_CSS.'/estilo.css'?>" />
	<meta charset="UTF-8">
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