<?php 
require_once __DIR__.'/includes/config.php';

use es\ucm\fdi\aw\Puja;
$form = new es\ucm\fdi\aw\FormularioObra();
$htmlFormObra = $form->gestiona();
$pujas = new es\ucm\fdi\aw\Puja();
$htmlPujas = Puja::muestraSubastas();

$tituloPagina = 'Social Museum';

$contenidoPrincipal = <<<EOS
	<h3>Subir nueva Subasta</h3>
	$htmlFormObra
	<h3>Subastas activas</h3>
	$htmlPujas
	EOS;

require __DIR__.'/includes/plantillas/layout2.php';