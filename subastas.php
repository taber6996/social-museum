<?php 
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Subastas - ';

/* VARIABLES PARA DEJAR MARCADO EL MENU */
$menuArtistas = "";
$menuExpos = "";
$menuTienda = "";
$menuEventos = "active";
$menuCuenta = "";

$mostrador = new es\ucm\fdi\aw\MostradorSubastas();
$htmlMostradorSubastas = $mostrador->muestra();

$contenidoPrincipal=<<<EOS
<nav id="menu-secundario">
<a href="concursos.php">Concursos</a>
<a href="subastas.php">Subastas</a>
</nav>
<div class="tarjetasSubastas">
$htmlMostradorSubastas
</div>
EOS;

require __DIR__.'/includes/plantillas/layout1.php';
