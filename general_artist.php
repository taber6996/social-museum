<?php 
require_once __DIR__.'/includes/config.php';

$tituloPagina = "Cuenta - ";

$contenidoPrincipal = <<<EOS
<h1>Mi cuenta</h1>
<p>Aquí estarían contenido de la cuenta de un artista</p>
EOS;
		
require ("includes/plantillas/layout2.php");