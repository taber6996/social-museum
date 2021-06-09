<?php 
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Social Museum';

$mostradorEntradas = $mostrador = new es\ucm\fdi\aw\MostradorExpos();
$htmlEntradas = $mostradorEntradas->muestraMisEntradas();

$contenidoPrincipal=<<<EOS
<h3>Entradas Compradas</h3>
	$htmlEntradas
EOS;

require __DIR__.'/includes/plantillas/layout2.php';