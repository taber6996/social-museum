<?php 
require_once __DIR__.'/includes/config.php';

$form = new es\ucm\fdi\aw\FormularioEvento();
$htmlFormEvento = $form->gestiona();

$tituloPagina = 'Social Museum';

$menuArtistas = "";
$menuExpos = "";
$menuTienda = "";
$menuDibujos = "";
$menuEventos = "";
$menuCuenta = "active";

$menuSGeneral = "";
$menuSCanvas = "";
$menuSProducto = "";
$menuSEvento = "active";
$menuSSugerencias = "";

$contenidoPrincipal = <<<EOS
	<h3>Crear nuevo evento</h3>
	$htmlFormEvento
	EOS;

require __DIR__.'/includes/plantillas/layout2.php';
