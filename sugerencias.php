<?php 
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Sugerencias - ';

$mostrador = new es\ucm\fdi\aw\MostradorSugerencias();
$html = $mostrador->muestra();

$contenidoPrincipal = $html;

require ("includes/plantillas/layout2.php");