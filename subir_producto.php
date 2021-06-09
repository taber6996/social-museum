<?php 
require_once __DIR__.'/includes/config.php';

$form = new es\ucm\fdi\aw\FormularioProducto();
$htmlFormProducto = $form->gestiona();

$tituloPagina = 'Social Museum';

$menuArtistas = "";
$menuExpos = "";
$menuTienda = "";
$menuEventos = "";
$menuCuenta = "active";

$menuSGeneral = "";
$menuSProducto = "active";
$menuSEvento = "";
$menuSSugerencias = "";

$contenidoPrincipal = <<<EOS
	<h3>Subir nuevo producto</h3>
	$htmlFormProducto
	EOS;

require __DIR__.'/includes/plantillas/layout2.php';
