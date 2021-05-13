<?php
namespace es\ucm\fdi\aw;

class FormularioAvatar extends Form
{
	const EXTENSIONES_PERMITIDAS = array('gif','jpg','jpe','jpeg','png');
	
    public function __construct() {
        parent::__construct('formAvatar');
    }
	
    protected function generaCamposFormulario($datos, $errores = array())
    {
        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);
        $errorArchivo = self::createMensajeError($errores, 'archivo', 'span', array('class' => 'error'));

        $html = <<<EOF
        <fieldset>
            $htmlErroresGlobales
            <p><label for="archivo">Archivo: </label><input type="file" name="archivo" id="archivo" />$errorArchivo</p>
            <button type="submit" name="subir_obra">Aceptar</button>
        </fieldset>
EOF;
        return $html;
    }
	

    protected function procesaFormulario($datos)
    {
		$user = $_SESSION['user'];
		$id = $user->id();
		
        $result = array();
		$ok = count($_FILES) == 1 && $_FILES['archivo']['error'] == UPLOAD_ERR_OK;
		
		if($ok){
			$archivo = $_FILES['archivo'];
			$nombre = $_FILES['archivo']['name'];
			$ok = $this->check_file_uploaded_name($nombre) && $this->check_file_uploaded_length($nombre);
			
			$ok = $ok && in_array(pathinfo($nombre,PATHINFO_EXTENSION), self:: EXTENSIONES_PERMITIDAS);
			
			$finfo = new\finfo(FILEINFO_MIME_TYPE);
			$mimeType = $finfo->file($_FILES['archivo']['tmp_name']);
			$ok = preg_match('/image\/*./', $mimeType);
			
			  if ( $ok ) {
        $tmp_name = $_FILES['archivo']['tmp_name'];
		$dir_subida = "img/avatares/";
		$fichero_subido = $dir_subida.$id.".jpg";

        if ( !move_uploaded_file($tmp_name, $fichero_subido) ) {
          $result[] = 'Error al mover el archivo';
        }

      /*  if ( !copy(DIR_ALMACEN. "/{$nombre}", DIR_ALMACEN_PROTEGIDO. "/{$nombre}") ) {
          $result[] = 'Error al mover el archivo';
        }*/
        // 4. Si fuese necesario guardar en la base de datos la ruta relativa $nombre del archivo

       if($_SESSION['avatar']==false){
		$_SESSION['avatar'] = true;
		$user->cambiaAvatar();
		Usuario:: actualiza($user);  
	}			  
	   return "cuenta.php";
      }else {
        $result[] = 'El archivo tiene un nombre o tipo no soportado';
      }
    } else {
      $result[] = 'Error al subir el archivo.';
    }
    return $result;
	}

	
    
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
}
