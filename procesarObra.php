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
			$dir_subida = "img/obras/".$_SESSION["user"]->getEmail()."/";
			if (!file_exists($dir_subida))	//Si es la primera subida de archivo, la carpeta no esta creada todavia
				mkdir($dir_subida, 0777, true);		//Se crea la carpeta
			$id_obra = $_REQUEST["titulo"];
			$fichero_subido = $dir_subida.$id_obra.".jpg";
			if ( !move_uploaded_file($tmp_name, $fichero_subido) ) {
			echo 'Error al mover el archivo';
			
			}else{
				Obra::insertarObra($_REQUEST["titulo"], $_SESSION['user']->getId(), $_REQUEST["descripcion"], $id_obra);
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
	header('Location: mis_obras.php');
?>
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