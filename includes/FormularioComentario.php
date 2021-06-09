<?php
namespace es\ucm\fdi\aw;

class FormularioComentario extends Form
{
    public function __construct($id_obra) {
        parent::__construct('formComentario');
		$this->id_obra = $id_obra;
    }
	
	private $id_obra;
	
    protected function generaCamposFormulario($datos, $errores = array())
    {
		$cometario = $datos['comentario'] ?? '';
        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);
        $errorComentario = self::createMensajeError($errores, 'comentario', 'span', array('class' => 'error'));

		if($this->id_obra){
			$id_obra = $this->id_obra;
		}else{
			$id_obra = $errores['obra'];
		}

        $html = <<<EOF
            $htmlErroresGlobales
			<input class="control" type="hidden" name="obra" value=$id_obra contenteditable="false" />
            <p><label>Escribe:</label> <input type="text" name="comentario" value="$cometario"/>$errorComentario</p>
            <button type="submit" name="comentar">Comentar</button>
EOF;
        return $html;
    }
	

    protected function procesaFormulario($datos)
    {
        $result = array();
		
        $comentario = $datos['comentario'] ?? null;
        if ( empty($comentario)) {
            $result['comentario'] = "No puedes dejar un comentario vaciío.";
        }
		
		if (count($result) === 0) {
			
			$id_obra = $datos['obra'];
			$obra = Obra:: buscaObraPorId($id_obra);
			
			$user = $_SESSION['user'];
			$id_usuario = $user->id();
			
			$fecha = date("Y-m-d H:i:s");
			
			$obra->comentario($id_usuario,$comentario,$fecha);
			
			$result = "verObra.php?obra=$id_obra";
		}
		
        return $result;
    }
}
