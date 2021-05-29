
<?php

require_once __DIR__.'/includes/config.php';

$form = new es\ucm\fdi\aw\FormularioSugerencias();
$htmlFormSugerencias = $form->gestiona();
$tituloPagina = 'Contacto - ';
$contenidoPrincipal=<<<EOS
$htmlFormSugerencias
EOS;

require __DIR__.'/includes/plantillas/layout1.php';
