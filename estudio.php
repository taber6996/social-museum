<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/formUpload.php';


	$contenidoPrincipal=<<<EOS
    <div id="contenedor"></div>
    <script type="text/javascript">
      var params = parseHashParams();
      // Compruebo si hay un parámetro img dentro del objeto que devuelve parseHashParams()
      if ( 'img' in params ) {
        var parent = document.getElementById('contenedor');
        var img = document.createElement('img');
        img.src = decodeURI(params.img);
        parent.appendChild(img);
      }
    </script>
EOS;

require __DIR__.'/includes/comun/layout.php';
formularioUpload(); 
