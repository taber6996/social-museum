<?php 
    require_once __DIR__.'/includes/ObraBD.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Social Museum</title>
	<link rel="stylesheet" type="text/css" href="css/estilo.css" />
</head>

<body>

	<?php
	require('header.php');
	require('aside.php');
	?>
	
	<main>
	 
	 <?php
		require('header_cuenta.php');
		require('aside_artista.php');
	?>
	
	<?php
	
	global $EXTENSIONES_PERMITIDAS;
	$ok = count($_FILES) == 1 && $_FILES['archivo']['error'] == UPLOAD_ERR_OK;
	if ( $ok ) {
		$archivo = $_FILES['archivo'];
		$nombre = $_FILES['archivo']['name'];
		$ok = check_file_uploaded_name($nombre) && check_file_uploaded_length($nombre) ;
		$ok = $ok && in_array(pathinfo($nombre, PATHINFO_EXTENSION), $EXTENSIONES_PERMITIDAS);
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$mimeType = finfo_file($finfo, $_FILES['archivo']['tmp_name']);
		$ok = preg_match('/image\/*./', $mimeType);
		finfo_close($finfo);
		if ( $ok ) {
			$tmp_name = $_FILES['archivo']['tmp_name'];
			$dir_subida = 'img/obras/';
			$id_obra = "1"; //para pruebas
			$fichero_subido = $dir_subida.$id_obra.".jpg";
			if ( !move_uploaded_file($tmp_name, $fichero_subido) ) {
			echo 'Error al mover el archivo';
			
			}else{
				Obra::insertarObra($_REQUEST["titulo"],$_REQUEST["descripcion"]);
			}
		}else {
      echo 'El archivo tiene un nombre o tipo no soportado';
		}
	} else {
		echo 'Error al subir el archivo.';
	}
	
	?>	
	</main>
	
	<footer>
		
	</footer>

</body>
</html>

<?php
function check_file_uploaded_name ($filename) {
    return (bool) ((mb_ereg_match('/^[0-9A-Z-_\.]+$/i',$filename) === 1) ? true : false );
}
function check_file_uploaded_length ($filename) {
    return (bool) ((mb_strlen($filename,'UTF-8') < 250) ? true : false);
}
function sanitize_file_uploaded_name($filename) {
  $newName = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $filename);
  $newName = mb_ereg_replace("([\.]{2,})", '', $newName);
  return $newName;
}
?>