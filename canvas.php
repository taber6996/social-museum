<?php 
require_once __DIR__.'/includes/config.php';

$menuArtistas = "";
$menuExpos = "";
$menuTienda = "";
$menuDibujos = "";
$menuEventos = "";
$menuCuenta = "active";

$tituloPagina = "Dibujo -";
$menuSGeneral = "";
$menuSMecenazgos = "";
$menuSEntradas = "";
$menuSCanvas = "active";
$menuSCompras = "";
$menuSBuzon = "";

$menuSGeneral = "";
$menuSCanvas = "active";
$menuSProducto = "";
$menuSEvento = "";
$menuSSugerencias = "";

$menuSGeneral = "";
$menuSMecenazgos = "";
$menuSEntradas = "";
$menuSCanvas = "active";
$menuSMisObras = "";
$menuSCompras = "";
$menuSBuzon = "";

$contenidoPrincipal=<<<EOS
 <div id="canvas-kit">
 <div id="toolbar-canvas">
 <div class="colorButtons">
    <h3>Colour</h3>
    <input type="color" id="colorpicker" value="#c81464" class="colorpicker">
 </div>
 <div class="colorButtons">
    <h3>Background Color</h3>
    <input type="color" value="#ffffff" id="bgcolorpicker" class="colorpicker">
 </div>

 <div class="toolsButtons">
    <h3>Tools</h3>
    <button id="eraser" class="btn btn-default"><span class="glyphicon glyphicon-erase" aria-hidden="true">eraser</span></button>
    <button id="clear" class="btn btn-danger"> <span class="glyphicon glyphicon-repeat" aria-hidden="true">clear</span></button>
 </div>

 <div class="buttonSize">
    <h3>Size (<span id="showSize">5</span>)</h3>
    <input type="range" min="1" max="50" value="5" step="1" id="controlSize">
 </div>

 <div class="Storage">
    <h3>Storage</h3>
    <input type="button" value="Guardar cambios" class="btn btn-warning" id="save">
    <input type="button" value="Cargar dibujo" class="btn btn-warning" id="load">
    <input type="button" value="Borrar cola" class="btn btn-warning" id="clearCache">
 </div>
 <div class="extra">
    <h3>Extra</h3>
    <a id="saveToImage" class="btn btn-warning">Download</a>
    <a id="sendToServer" class="btn btn-warning">SendTo</a>
 </div>
</div>
<div id="input-name">
   <input type="text" id ="titulo-input" value="Unnamed">
</div>
<script type="text/javascript" src="js/jquery-3.6.0.js"></script>
<script type="text/javascript" src="js/canvas.js"></script>
<noscript>
<p> Esta página requiere JavaScript para su correcto funcionamiento.</p>
</noscript>
</div>
EOS;
require __DIR__.'/includes/plantillas/layout2.php';