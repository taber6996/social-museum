<?php 
require_once __DIR__.'/includes/config.php';

$form = new es\ucm\fdi\aw\FormularioEvento();
$htmlFormEvento = $form->gestiona();
//$htmlListaEventos = $form->muestraEventos();

$tituloPagina = 'Social Museum';

$contenidoPrincipal = <<<EOS
	<h3>Crear nuevo evento</h3>
	$htmlFormEvento
	<h3>Eventos actuales</h3>
	$htmlListaEventos
	EOS;

require __DIR__.'/includes/plantillas/layout2.php';