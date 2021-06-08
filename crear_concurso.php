<?php 
require_once __DIR__.'/includes/config.php';

$nombreConcurso="";
if(isset($_GET['concurso'])){
$nombreConcurso = $_GET['concurso'];	
}
$tituloPagina = 'Social Museum';

$form = new es\ucm\fdi\aw\FormularioConcurso($nombreConcurso);
$htmlFormConcurso = $form->gestiona();

$contenidoPrincipal = <<<EOS
	$htmlFormConcurso
	EOS;

require __DIR__.'/includes/plantillas/layout2.php';