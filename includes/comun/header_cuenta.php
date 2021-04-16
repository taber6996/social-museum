<!DOCTYPE html>
<?php

require_once __DIR__.'/../UsuarioBD.php';

if(!isset($_SESSION)){
	session_start();
}
?>
<html>

<header>
	<section id='info usuario'> <img src='img/user.jpg' width='50px' height='50px'> 
	<?php echo $_SESSION['user']->getNombre();
	?> - 
	<?php 
		if($_SESSION['user']->getArtista() == 1) echo "Artista"; else echo "Usuario";
		if($_SESSION['user']->getPremium() == 1) echo " - Premium";
	?></section>
</header>
	
</html>