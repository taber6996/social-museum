<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/formUpload.php';

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Mi estudio</title>
		<link rel="stylesheet" type="text/css" href="css/estilo.css" />
    <script type="text/javascript" src="utils.js"></script>
	</head>
  <body>
  
	<?php
	require('header.php');
	?>
	
	<?php
	require('aside.php');
	?>
	
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
<?php formularioUpload(); ?>

  </body>
</html>