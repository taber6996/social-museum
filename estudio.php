<?php 
	require_once __DIR__.'/includes/config.php';

	$tituloPagina = 'Social Museum';

	$contenidoPrincipal=<<<EOS
	<h3>Estudio</h3>
		<p>aqui se mostrara el estudio del usuario</p>
	EOS;

	require __DIR__.'/includes/plantillas/layout1.php';