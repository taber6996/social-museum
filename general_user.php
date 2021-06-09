<?php 
require_once __DIR__.'/includes/config.php';

$usuario = $_SESSION['user'];
$mostradorU= new es\ucm\fdi\aw\MostradorUsuario($usuario);
$htmlDatosPersonales = $mostradorU->datosPersonales();
$htmlPremium = $mostradorU->premium();

//$htmlDatosPersonales = $usuario->datosPersonales();

$tituloPagina = "Cuenta - ";

$menuArtistas = "";
$menuExpos = "";
$menuTienda = "";
$menuEventos = "";
$menuDibujos = "";
$menuCuenta = "active";

$menuSGeneral = "active";
$menuSMecenazgos = "";
$menuSEntradas = "";
$menuSCanvas = "";
$menuSCompras = "";
$menuSBuzon = "";

$contenidoPrincipal = <<<EOS
<h1>Mi cuenta</h1>
EOS;
$contenidoPrincipal .=$htmlDatosPersonales;
$contenidoPrincipal .= $htmlPremium;

		
require ("includes/plantillas/layout2.php");
