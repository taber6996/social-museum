<?php 
    require_once __DIR__.'/includes/formlogin.php';
   // session_start();
    //formularioLogin();
	require_once __DIR__.'/includes/formsignup.php';
    //formularioSignup();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Social Museum</title>
	<link rel="stylesheet" type="text/css" href="css/estilo.css" />
	<meta charset="UTF-8">
</head>

<body>
	<?php
	require('header.php');
	require('aside.php');
	?>

	<main>
			<h3>¿Tienes una cuenta?</h3>
			<?php formularioLogin(); ?>
			
			<h3>¡Hazte miembro de Social Museum!</h3>
			<?php formularioSignup(); ?>
			
	</main>
	
</body>

</html>
