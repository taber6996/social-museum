<?php
require_once ("includes/config.php");

$formR = new es\ucm\fdi\aw\FormularioRegistro();
$htmlFormRegistro = $formR->gestiona();


$tituloPagina = "Sign Up - ";

$contenidoPrincipal = <<<EOS
<h1>REGÍSTRATE</h1>
$htmlFormRegistro

EOS;

require ("includes/plantillas/layout1.php");