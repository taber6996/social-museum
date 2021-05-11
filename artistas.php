<?php 
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Artistas - ';

$mostrador = new es\ucm\fdi\aw\MostradorArtistas();
$htmlMostradorArtistas = $mostrador->muestra();

$contenidoPrincipal=<<<EOS
	$htmlMostradorArtistas
EOS;

require __DIR__.'/includes/plantillas/layout1.php';