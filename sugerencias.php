<?php 
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Sugerencias - ';

$menuArtistas = "";
$menuExpos = "";
$menuTienda = "";
$menuDibujos = "";
$menuEventos = "";
$menuCuenta = "active";

$menuSGeneral = "";
$menuSCanvas = "";
$menuSProducto = "";
$menuSEvento = "";
$menuSSugerencias = "active";

$mostrador = new es\ucm\fdi\aw\MostradorSugerencias();
$html = $mostrador->muestra();

$contenidoPrincipal = $html;

require ("includes/plantillas/layout2.php");