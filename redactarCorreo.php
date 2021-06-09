<?php 
	require_once __DIR__.'/includes/config.php';

	$tituloPagina = 'Social Museum';
	
	$form = new es\ucm\fdi\aw\FormularioCorreo();
	$htmlFormularioCorreo = $form->gestiona();

	$contenidoPrincipal=<<<EOS
	<nav id="menu-secundario">
	<a href="redactarCorreo.php">Redactar</a>
	<a href="buzon.php?ver=recibidos">Recibidos</a>
	<a href="buzon.php?ver=enviados">Enviados</a>
	</nav>
	$htmlFormularioCorreo
	EOS;

	require __DIR__.'/includes/plantillas/layout2.php';
?>