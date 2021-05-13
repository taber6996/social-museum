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
	<link rel="stylesheet" type="text/css" href="<?= 'css/estilo.css' ?>" />
	<meta charset="UTF-8">
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Girassol&family=Oswald&display=swap');
	</style>
</head>

<body>

	<?php
    require("includes/comun/header.php");
	?>

	<main>
            <?= $contenidoPrincipal ?>
	</main>
	
	<?php
	require("includes/comun/footer.php");
	?>
</body>

</html>