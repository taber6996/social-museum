<?php 
require_once __DIR__.'/includes/config.php';

$form = new es\ucm\fdi\aw\FormularioProducto();
$htmlFormProducto = $form->gestiona();
$mostrador = new es\ucm\fdi\aw\MostradorProductos();
$htmlMostradorProductos = $mostrador->muestra();

$tituloPagina = 'Social Museum';

$contenidoPrincipal = <<<EOS
	<h3>Subir nuevo producto</h3>
	$htmlFormProducto
	<h3>Productos en la tienda</h3>
	$htmlMostradorProductos
	EOS;

require __DIR__.'/includes/plantillas/layout2.php';