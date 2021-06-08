<?php 
require_once __DIR__.'/includes/config.php';

$nombreExpo="";
if(isset($_GET['expo'])){
$nombreExpo = $_GET['expo'];	
}
$tituloPagina = 'Social Museum';

$form = new es\ucm\fdi\aw\FormularioExpo($nombreExpo);
$htmlFormExpo = $form->gestiona();

$contenidoPrincipal = <<<EOS
	$htmlFormExpo
	EOS;

require __DIR__.'/includes/plantillas/layout2.php';
