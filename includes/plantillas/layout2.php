<?php 
    require_once __DIR__.'/../config.php';
	
	if (isset($_SESSION["login"]) && $_SESSION["login"]) {	
	if (isset($_SESSION["esAdmin"]) && $_SESSION["esAdmin"]) {
		$aside = "aside_admin";
	}
	elseif (isset($_SESSION["esArtist"]) && $_SESSION["esArtist"]) {
		$aside = "aside_artist";
	}
	else{
		$aside = "aside_user";
	}
} 
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
<?php
	require('includes/comun/'.$aside.'.php');
	?>
	<main>
            <?= $contenidoPrincipal ?>
	</main>
	
	<?php
	require("includes/comun/footer.php");
	?>
</body>

</html>