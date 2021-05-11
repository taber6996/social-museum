<?php 
require_once __DIR__.'/includes/config.php';

$mostrador = new es\ucm\fdi\aw\MostradorProductos();
$htmlMostradorProductos = $mostrador->muestra();

$tituloPagina = 'Tienda - ';

$contenidoPrincipal=<<<EOS
	$htmlMostradorProductos
EOS;

require __DIR__.'/includes/plantillas/layout1.php';