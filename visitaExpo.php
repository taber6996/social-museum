<?php 
require_once __DIR__.'/includes/config.php';

$id_expo = $_GET['expo'];
$tituloPagina = $id_expo." - ";

/* VARIABLES PARA DEJAR MARCADO EL MENU */
$menuArtistas = "";
$menuExpos = "active";
$menuTienda = "";
$menuEventos = "";
$menuCuenta = "";

$mostradorE= new es\ucm\fdi\aw\MostradorExpo($id_expo);
$MostradorExpo = $mostradorE->muestraExpo();

$contenidoPrincipal="";

if (isset($_SESSION["login"]) && $_SESSION["login"]) {	
	if ((isset($_SESSION["esAdmin"]) && $_SESSION["esAdmin"]) || (isset($_SESSION["esArtist"]) && $_SESSION["esArtist"]) || isset($_SESSION["premium"]) && $_SESSION["premium"]) {
		$contenidoPrincipal.=<<<EOS
		$MostradorExpo
EOS;
	}
	else{
		$user = $_SESSION['user'];
		if($user->tieneEntrada($id_expo)){
			$contenidoPrincipal.=<<<EOS
			$MostradorExpo
EOS;
				
		}else{
			header("Location: compraEntrada.php?expo=$id_expo");
		}
	}
} else {
	$contenidoPrincipal .= <<<EOS
	¡Abre sesión para visitar la expo!
EOS;
}

require __DIR__.'/includes/plantillas/layout1.php';