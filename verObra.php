<?php 
require_once __DIR__.'/includes/config.php';


if(isset($_GET['obra'])){
	$id_obra = $_GET['obra'];
	$_SESSION['obra'] = $id_obra;

}else{
	$id_obra = $_SESSION['obra'];
}

$tituloPagina = $id_obra." - ";

/* VARIABLES PARA DEJAR MARCADO EL MENU */
$menuArtistas = "active";
$menuExpos = "";
$menuTienda = "";
$menuEventos = "";
$menuCuenta = "";

$mostradorO= new es\ucm\fdi\aw\MostradorObra($id_obra);
$MostradorObra = $mostradorO->muestraObra();
$htmlComentarios = $mostradorO->muestraComentarios();

$forularioC= new es\ucm\fdi\aw\FormularioComentario($id_obra);
$htmlFormComentario = $forularioC->gestiona();

$contenidoPrincipal=<<<EOS
<div id="verObra">
$MostradorObra
</div>
EOS;
if (isset($_SESSION["login"]) && $_SESSION["login"]) {	
$contenidoPrincipal .=<<<EOS
<div id="espacioComentario">
$htmlFormComentario
</div>
EOS;
}
$contenidoPrincipal .=<<<EOS
<div id="comentarios">
$htmlComentarios
</div>

EOS;

require __DIR__.'/includes/plantillas/layout1.php';