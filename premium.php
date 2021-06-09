<?php
require_once ("includes/config.php");

$tituloPagina = "Cuenta - ";

$form1 = new es\ucm\fdi\aw\GestionAltaPremium();
$htmlAltaPremium = $form1->gestiona();
$htmlInfoAlta = $form1->infoAlta();
$form2 = new es\ucm\fdi\aw\GestionBajaPremium();
$htmlBajaPremium = $form2->gestiona();
$htmlInfoBaja = $form2->infoBaja();

$contenidoPrincipal = "";

if(isset($_SESSION['premium']) && $_SESSION['premium']){
$contenidoPrincipal .= <<<EOS
$htmlInfoBaja
$htmlBajaPremium
EOS;
}else{
$contenidoPrincipal .= <<<EOS
$htmlInfoAlta
$htmlAltaPremium
EOS;
}

require ("includes/plantillas/layout1.php");