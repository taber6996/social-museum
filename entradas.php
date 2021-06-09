<?php 
require_once __DIR__.'/includes/config.php';

$tituloPagina = "Mis entradas - ";

$menuArtistas = "";
$menuExpos = "";
$menuTienda = "";
$menuDibujos = "";
$menuEventos = "";
$menuCuenta = "active";

$menuSGeneral = "";
$menuSMecenazgos = "";
$menuSEntradas = "active";
$menuSMisObras = "";
$menuSCompras = "";
$menuSBuzon = "";

$menuSGeneral = "";
$menuSMecenazgos = "";
$menuSEntradas = "active";
$menuSCanvas = "";
$menuSCompras = "";
$menuSBuzon = "";
		
$mostradorEntradas = $mostrador = new es\ucm\fdi\aw\MostradorExpos();
$htmlEntradas = $mostradorEntradas->muestraMisEntradas();

$contenidoPrincipal=<<<EOS
<h3>Entradas Compradas</h3>
	$htmlEntradas
EOS;

require __DIR__.'/includes/plantillas/layout2.php';