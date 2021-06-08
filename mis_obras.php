<?php 
require_once __DIR__.'/includes/config.php';

$form = new es\ucm\fdi\aw\FormularioObra();
$htmlFormObra = $form->gestiona();
$mostradorA= new es\ucm\fdi\aw\MostradorArtista($_SESSION['nick']);
$htmlListaObras = $mostradorA->muestraObras();

$tituloPagina = 'Social Museum';

$contenidoPrincipal = <<<EOS
	<h3>Subir nueva obra</h3>
	$htmlFormObra
	<h3>Mis obras</h3>
	$htmlListaObras
	EOS;

require __DIR__.'/includes/plantillas/layout2.php';