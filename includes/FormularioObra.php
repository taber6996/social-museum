<?php
namespace es\ucm\fdi\aw;

class FormularioObra extends Form
{
    public function __construct() {
        parent::__construct('formObra');
    }
	
    protected function generaCamposFormulario($datos, $errores = array())
    {
       $titulo = $datos['titulo'] ?? '';
       $descripcion = $datos['descripcion'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);
        $errorTitulo = self::createMensajeError($errores, 'titulo', 'span', array('class' => 'error'));
        $errorDescripcion = self::createMensajeError($errores, 'descripcion', 'span', array('class' => 'error'));
        $errorArchivo = self::createMensajeError($errores, 'archivo', 'span', array('class' => 'error'));

        $html = <<<EOF
        <fieldset>
            $htmlErroresGlobales
            <p><label>Titulo:</label> <input type="text" name="titulo" value="$titulo"/>$errorTitulo</p>
            <p><label>Descripcion:</label> <input type="text" name="descripcion" value="$descripcion"/>$errorDescripcion</p>
            <p><label for="archivo">Archivo:</label><input type="file" name="archivo" id="archivo" /></p>
            <button type="submit" name="subir_obra">Subir</button>
        </fieldset>
EOF;
        return $html;
    }
	

    protected function procesaFormulario($datos)
    {
        $result = array();
		
        $titulo = $datos['titulo'] ?? null;
        if ( empty($titulo)) {
            $result['titulo'] = "El titulo de la obra no puede estar vacío.";
        }
        $descripcion = $datos['descripcion'] ?? null;
        if ( empty($descripcion)) {
            $result['descripcion'] = "La descripcion de la obra no puede estar vacía.";
        }
        if (count($result) === 0) {
			$result = self::subirObra($titulo,$descripcion,$_SESSION['user']->id());	
        }
        return $result;
    }
	
	
	protected function subirObra($titulo,$descripcion,$id_autor)
	{
		global $EXTENSIONES_PERMITIDAS;
		
		$ok = count($_FILES) == 1 && $_FILES['archivo']['error'] == UPLOAD_ERR_OK;
		if ( $ok ) {
			$archivo = $_FILES['archivo'];
			$nombre = $_FILES['archivo']['name'];
			$ok = self::check_file_uploaded_name($nombre) && self::check_file_uploaded_length($nombre) ;
			$ok = $ok && in_array(pathinfo($nombre, PATHINFO_EXTENSION), $EXTENSIONES_PERMITIDAS);
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$mimeType = finfo_file($finfo, $_FILES['archivo']['tmp_name']);
			$ok = preg_match('/image\/*./', $mimeType);
			finfo_close($finfo);
			if ( $ok ) {
				$tmp_name = $_FILES['archivo']['tmp_name'];
					
				$dir_subida = "img/obras/artista_".$id_autor."/";
				if (!file_exists($dir_subida))	//Si es la primera subida de archivo, la carpeta no esta creada todavia
					mkdir($dir_subida, 0777, true);		//Se crea la carpeta
					
				$obra = Obra::crea($titulo, $descripcion, $id_autor);	
				if ( ! $obra ) {
					
					$result[] = "Ya existe una obra tuya con ese título";
				}
				else{
					$fichero_subido = $dir_subida.$titulo.".jpg";
					if ( !move_uploaded_file($tmp_name, $fichero_subido) ) {
						$result[] = 'Error al mover el archivo';
					}else{
						$result = 'cuenta.php'; //mostrar obra en grande?
					}
				}
			}else {
				$result[] ='El archivo tiene un nombre o tipo no soportado';
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



