<?php 
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Concursos - ';

/* VARIABLES PARA DEJAR MARCADO EL MENU */
$menuArtistas = "";
$menuExpos = "";
$menuTienda = "";
$menuDibujos = "";
$menuEventos = "active";
$menuCuenta = "";

$mostrador = new es\ucm\fdi\aw\MostradorConcursos();
$htmlMostradorConcursos = $mostrador->muestra();

$contenidoPrincipal=<<<EOS
<nav id="menu-secundario">
<a href="concursos.php">Concursos</a>
<a href="subastas.php">Subastas</a>
</nav>	
$htmlMostradorConcursos
EOS;

require __DIR__.'/includes/plantillas/layout1.php';
