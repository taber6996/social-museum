<?php 
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Subastas - ';

$mostrador = new es\ucm\fdi\aw\MostradorSubastas();
$htmlMostradorSubastas = $mostrador->muestra();


$contenidoPrincipal=<<<EOS
<nav id="menu-secundario">
<a href="concursos.php">Concursos</a>
<a href="subastas.php">Subastas</a>
</nav>	
$htmlMostradorSubastas
EOS;

require __DIR__.'/includes/plantillas/layout1.php';
