<?php 
require_once __DIR__.'/includes/config.php';

$id_expo = $_GET['expo'];
$tituloPagina = $id_expo." - ";

$mostradorE = new es\ucm\fdi\aw\MostradorExpos();
if($id_expo != NULL){
$htmlExpo = $mostradorE->muestraInfoExpo($id_expo);	
}

$formCompraEntrada = new es\ucm\fdi\aw\GestionCompraEntrada($id_expo);
$htmlCompraEntrada = $formCompraEntrada->gestiona();

/* VARIABLES PARA DEJAR MARCADO EL MENU */
$menuArtistas = "";
$menuExpos = "active";
$menuTienda = "";
$menuEventos = "";
$menuCuenta = "";

$contenidoPrincipal=<<<EOS
$htmlExpo
$htmlCompraEntrada
EOS;

require __DIR__.'/includes/plantillas/layout1.php';