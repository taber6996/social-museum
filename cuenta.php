<?php
require_once ("includes/config.php");

$formL = new es\ucm\fdi\aw\FormularioLogin();
$htmlFormLogin = $formL->gestiona();
$formR = new es\ucm\fdi\aw\FormularioRegistro();
$htmlFormRegistro = $formR->gestiona();

$tituloPagina = "Cuenta - ";

/* VARIABLES PARA DEJAR MARCADO EL MENU */
$menuArtistas = "";
$menuExpos = "";
$menuTienda = "";
$menuEventos = "";
$menuCuenta = "active";

$contenidoPrincipal = "";

if (isset($_SESSION["login"]) && $_SESSION["login"]) {	
	if (isset($_SESSION["esAdmin"]) && $_SESSION["esAdmin"]) {
		header('Location: general_admin.php');
	}
	elseif (isset($_SESSION["esArtist"]) && $_SESSION["esArtist"]) {
		header('Location: general_artist.php');
	}
	else{
	header('Location: general_user.php');
	}
} else {
	/*$contenidoPrincipal .= <<<EOS
	<a href="login.php"><h1>INICIA SESIÓN</h1></a>
	<a href="signup.php"><h1>REGÍSTRATE</h1></a>
	EOS;*/
	$contenidoPrincipal .= <<<EOS
	Tu sesión ha caducado
EOS;
}
		
require ("includes/plantillas/layout1.php");