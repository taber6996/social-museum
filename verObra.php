<?php 
require_once __DIR__.'/includes/config.php';

//$id_obra = $_GET['obra'];

if(isset($_GET['obra'])){
$id_obra = $_GET['obra'];	
}

$tituloPagina = $id_obra." - ";

/* VARIABLES PARA DEJAR MARCADO EL MENU */
$menuArtistas = "active";
$menuExpos = "";
$menuTienda = "";
$menuEventos = "";
$menuCuenta = "";

$mostradorO= new es\ucm\fdi\aw\MostradorObra($id_obra);
$MostradorObra = $mostradorO->muestraObra($id_obra);

$contenidoPrincipal=<<<EOS
$MostradorObra

EOS;

require __DIR__.'/includes/plantillas/layout1.php';