<?php 
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Concursos - ';

$mostrador = new es\ucm\fdi\aw\MostradorEventos();
$htmlMostradorEventos = $mostrador->muestra();
$tipo = "Concurso";
$vocal = "o";
if(isset($_GET["tipo"])){
	$tipo = $_GET["tipo"];
	if($tipo == "Subasta"){
		$vocal = "a";
	}
}
$contenidoPrincipal=<<<EOS
<nav id="menu-secundario">
<a href="concursos.php">Concursos</a>
<a href="subastas.php">Subastas</a>
</nav>	

$htmlMostradorEventos
EOS;

require __DIR__.'/includes/plantillas/layout1.php';