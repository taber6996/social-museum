<?php 
require_once __DIR__.'/includes/config.php';

$form = new es\ucm\fdi\aw\FormularioEvento();
$htmlFormEvento = $form->gestiona();
//$mostrador = new es\ucm\fdi\aw\MostradorEventos();
//$htmlListaEventos = $mostrador->muestra();

$tituloPagina = 'Social Museum';

$contenidoPrincipal = <<<EOS
	<h3>Crear nuevo evento</h3>
	$htmlFormEvento
	EOS;

require __DIR__.'/includes/plantillas/layout1.php';