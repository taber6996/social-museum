<?php 
require_once __DIR__.'/includes/config.php';

$usuario = $_SESSION['user'];
$htmlDatosPersonales = $usuario->datosPersonales();

$tituloPagina = "Cuenta - ";

$menuArtistas = "";
$menuExpos = "";
$menuTienda = "";
$menuEventos = "";
$menuCuenta = "active";

$contenidoPrincipal = <<<EOS
<h1>Mi cuenta</h1>
EOS;
$contenidoPrincipal .=$htmlDatosPersonales;
		
require ("includes/plantillas/layout2.php");
