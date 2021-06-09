<?php 
require_once __DIR__.'/includes/config.php';

$tituloPagina = "Cuenta - ";

$usuario = $_SESSION['user'];
$mostradorU= new es\ucm\fdi\aw\MostradorUsuario($usuario);
$htmlDatosPersonales = $mostradorU->datosPersonales();

$tituloPagina = "Cuenta - ";

$menuArtistas = "";
$menuExpos = "";
$menuTienda = "";
$menuDibujos = "";
$menuEventos = "";
$menuCuenta = "active";

$menuSGeneral = "active";
$menuSCanvas = "";
$menuSProducto = "";
$menuSEvento = "";
$menuSSugerencias = "";

$contenidoPrincipal = <<<EOS
<h1>Mi cuenta</h1>
EOS;
$contenidoPrincipal .=$htmlDatosPersonales;
		
require ("includes/plantillas/layout2.php");
