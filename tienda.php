<?php 
require_once __DIR__.'/includes/config.php';

$mostrador = new es\ucm\fdi\aw\MostradorProductos();
$htmlMostradorProductos = $mostrador->muestra();

$tituloPagina = 'Tienda - ';

/* VARIABLES PARA DEJAR MARCADO EL MENU */
$menuArtistas = "";
$menuExpos = "";
$menuTienda = "active";
$menuDibujos = "";
$menuEventos = "";
$menuCuenta = "";

$contenidoPrincipal=<<<EOS
	<div class = "tarjetasProductos">
	$htmlMostradorProductos
	</div>
EOS;

require __DIR__.'/includes/plantillas/layout1.php';