<?php 
	require_once __DIR__.'/includes/config.php';
	
	$tituloPagina = "Mis compras - ";

	$menuArtistas = "";
	$menuExpos = "";
	$menuTienda = "";
	$menuEventos = "";
	$menuCuenta = "active";
	
	$menuSGeneral = "";
	$menuSMecenazgos = "";
	$menuSEntradas = "";
	$menuSMisObras = "";
	$menuSCompras = "active";
	$menuSBuzon = "";
	
	$menuSGeneral = "";
	$menuSMecenazgos = "";
	$menuSEntradas = "";
	$menuSCanvas = "";
	$menuSCompras = "active";
	$menuSBuzon = "";

	$producto = false;
	if(isset($_GET['producto'])){
		$producto = $_GET['producto'];
	}
	

	if(isset($_POST["compra"]) && $_POST["compra"]){
		$user = $_SESSION["user"];
		$user->compra($producto);
		header("Location: compras.php");
	}

	$mostrador = new es\ucm\fdi\aw\MostradorProductos();
	$html = $mostrador->muestraMisCompras($_SESSION["user"]);
	
	$contenidoPrincipal = $html;
	
	require ("includes/plantillas/layout2.php");
