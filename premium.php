<?php
require_once ("includes/config.php");

$formC = new es\ucm\fdi\aw\FormularioCambiaDatosUsuario();
$htmlFormC = $formC->gestiona();
$formA = new es\ucm\fdi\aw\FormularioAvatar();
$htmlFormA = $formA->gestiona();

$tituloPagina = "Cuenta - ";

$contenidoPrincipal = "";

$contenidoPrincipal .= <<<EOS
<h1>Premium</h1>
EOS;



require ("includes/plantillas/layout1.php");