<?php 
require_once __DIR__.'/includes/config.php';

$tituloPagina = "Mis mecenazgos - ";

$menuArtistas = "";
$menuExpos = "";
$menuTienda = "";
$menuDibujos = "";
$menuEventos = "";
$menuCuenta = "active";

$menuSGeneral = "";
$menuSMecenazgos = "active";
$menuSEntradas = "";
$menuSCanvas = "";
$menuSMisObras = "";
$menuSCompras = "";
$menuSBuzon = "";

$menuSGeneral = "";
$menuSMecenazgos = "active";
$menuSEntradas = "";
$menuSCanvas = "";
$menuSCompras = "";
$menuSBuzon = "";
		
$mostrador = new es\ucm\fdi\aw\MostradorArtistas();
$htmlMostradorArtistas = $mostrador->muestraMisArtistas($_SESSION["user"]);

$contenidoPrincipal=<<<EOS
<h3>Mecenazgos</h3>
		$htmlMostradorArtistas
EOS;

require __DIR__.'/includes/plantillas/layout2.php';
