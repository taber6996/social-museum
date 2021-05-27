<?php
require_once ("includes/config.php");

$formL = new es\ucm\fdi\aw\FormularioLogin();
$htmlFormLogin = $formL->gestiona();


$tituloPagina = "Log In - ";

$contenidoPrincipal = <<<EOS
    <h1>INICIA SESIÓN</h1>
    $htmlFormLogin
EOS;
require ("includes/plantillas/layout1.php");