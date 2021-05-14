<?php 
require_once __DIR__.'/includes/config.php';

$form = new es\ucm\fdi\aw\FormularioObra();
$htmlFormObra = $form->gestiona();
$mostrador = new es\ucm\fdi\aw\MostradorObras($_SESSION['correo']);
$htmlListaObras = $mostrador->muestra();

$tituloPagina = 'Social Museum';

$contenidoPrincipal = <<<EOS
	<h3>Subir nueva obra</h3>
	$htmlFormObra
	<h3>Mis obras</h3>
	$htmlListaObras
	EOS;

require __DIR__.'/includes/plantillas/layout2.php';