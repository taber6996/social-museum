<?php 
require_once __DIR__.'/includes/config.php';

if(isset($_GET['id_subasta'])){
    $id_subasta = $_GET['id_subasta'];
}
else{
    echo "ERROR 404";
}
$mostradorO = new es\ucm\fdi\aw\MostradorSubastas();
$MostradorSubasta = $mostradorO->muestraPujaId($id_subasta);

$contenidoPrincipal=<<<EOS
<div id="verSubasta">
$MostradorSubasta
</div>
EOS;
$contenidoPrincipal .=<<<EOS
<form method="POST" action="realizarPuja.php" id="form$id_subasta">
        <fieldset>
			<p><label>Precio a pujar:</label> <input type="number" step="0.5" min="0" name="precio"/></p>
            <input type="hidden" name="id_puja" value=$id_subasta>
        	<button type="submit" id="submit$id_subasta">Pujar</button>
        </fieldset>
		</div>
EOS;

require __DIR__.'/includes/plantillas/layout1.php';
