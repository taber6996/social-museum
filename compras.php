<?php 
	require_once __DIR__.'/includes/config.php';
	
	$producto = false;
	if(isset($_GET['producto'])){
		$producto = $_GET['producto'];
	}
	

	if(isset($_POST["compra"]) && $_POST["compra"]){
		$user = $_SESSION["user"];
		$user->compra($producto);
		header("Location: compras.php");
	}

	$tituloPagina = 'Compras -';

	$mostrador = new es\ucm\fdi\aw\MostradorProductos();
	$html = $mostrador->muestraMisCompras($_SESSION["user"]);
	
	$contenidoPrincipal = $html;
	
	require ("includes/plantillas/layout2.php");
