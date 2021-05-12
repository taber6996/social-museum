<?php 
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Eventos - ';

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
<a href="eventos.php?tipo=Concurso">Concursos</a>
<a href="eventos.php?tipo=Subasta">Subastas</a>
</nav>	

$htmlMostradorEventos
EOS;

require __DIR__.'/includes/plantillas/layout1.php';