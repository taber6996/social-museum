<?php

require_once __DIR__.'/config.php';
require_once __DIR__.'/formlibfile.php';

function formularioUpload() {
  formulario('subir', 'generaFormularioUpload', 'procesaFormularioUpload', 'upload.php', null, 'multipart/form-data');
}

function generaFormularioUpload($datos) {
  $html = <<<EOS
  <p><label for="archivo">Archivo:</label><input type="file" name="archivo" id="archivo" /></p>
  <p><button type="submit" name="subir">Subir</button>
EOS;
  return $html;
}


function procesaFormularioUpload($params) {
  // Solo se pueden definir arrays como constantes en PHP >= 5.6
  global $EXTENSIONES_PERMITIDAS;
  
  $result = array();
  $ok = count($_FILES) == 1 && $_FILES['archivo']['error'] == UPLOAD_ERR_OK;

  if ( $ok ) {
    $archivo = $_FILES['archivo'];
    $nombre = $_FILES['archivo']['name'];
    /* 1.a) Valida el nombre del archivo */
    $ok = check_file_uploaded_name($nombre) && check_file_uploaded_length($nombre) ;
    /* 1.b) Sanitiza el nombre del archivo 
    $ok = sanitize_file_uploaded_name($nombre);
    */

    /* 2. comprueba si la extensión está permitida*/
    $ok = $ok && in_array(pathinfo($nombre, PATHINFO_EXTENSION), $EXTENSIONES_PERMITIDAS);

    /* 3. comprueba el tipo mime del archivo correspode a una imagen image/* */
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $_FILES['archivo']['tmp_name']);
    $ok = preg_match('/image\/*./', $mimeType);
    finfo_close($finfo);

    if ( $ok ) {
      $tmp_name = $_FILES['archivo']['tmp_name'];

      if ( !move_uploaded_file($tmp_name, DIR_ALMACEN.$nombre) ) {
        $result[] = 'Error al mover el archivo';
      }
      return "index.php#img=".urlencode('img/'.$nombre);
    }else {
      $result[] = 'El archivo tiene un nombre o tipo no soportado';
    }
  } else {
    $result[] = 'Error al subir el archivo.';
  }
  return $result;
}


/**
 * Check $_FILES[][name]
 *
 * @param (string) $filename - Uploaded file name.
 * @author Yousef Ismaeil Cliprz
 * @See http://php.net/manual/es/function.move-uploaded-file.php#111412
 */
function check_file_uploaded_name ($filename) {
    return (bool) ((mb_ereg_match('/^[0-9A-Z-_\.]+$/i',$filename) === 1) ? true : false );
}

/**
 * Sanitize $_FILES[][name]. Remove anything which isn't a word, whitespace, number
 * or any of the following caracters -_~,;[]().
 *
 * If you don't need to handle multi-byte characters you can use preg_replace
 * rather than mb_ereg_replace.
 * 
 * @param (string) $filename - Uploaded file name.
 * @author Sean Vieira
 * @see http://stackoverflow.com/a/2021729
 */
function sanitize_file_uploaded_name($filename) {
  /* Remove anything which isn't a word, whitespace, number
   * or any of the following caracters -_~,;[]().
   * If you don't need to handle multi-byte characters
   * you can use preg_replace rather than mb_ereg_replace
   * Thanks @Łukasz Rysiak!
   */
  $newName = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $filename);
  // Remove any runs of periods (thanks falstro!)
  $newName = mb_ereg_replace("([\.]{2,})", '', $newName);

  return $newName;
}

/**
 * Check $_FILES[][name] length.
 *
 * @param (string) $filename - Uploaded file name.
 * @author Yousef Ismaeil Cliprz.
 * @See http://php.net/manual/es/function.move-uploaded-file.php#111412
 */
function check_file_uploaded_length ($filename) {
    return (bool) ((mb_strlen($filename,'UTF-8') < 250) ? true : false);
}
?>
