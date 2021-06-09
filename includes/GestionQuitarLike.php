<?php
namespace es\ucm\fdi\aw;

class GestionQuitarLike extends Form
{
    public function __construct($id_obra) {
        parent::__construct('formQuitarLike');
		$this->id_obra = $id_obra;
    }
	
	private $id_obra;
	
    protected function generaCamposFormulario($datos, $errores = array())
    {
		$htmlErroresGlobales = self::generaListaErroresGlobales($errores);
		$errorSinObras = self::createMensajeError($errores, 'num', 'span', array('class' => 'error'));
		if($this->id_obra){
			$id_obra = $this->id_obra;
		}else{
			$id_obra = $errores['obra'];
		}
        $html = <<<EOF
        <input class="control" type="hidden" name="obra" value=$id_obra contenteditable="false" />
        <button type="submit" name="altaPremium">UNLIKE</button>
EOF;
        return $html;
    }
	
    protected function procesaFormulario($datos)
    {
        $user = $_SESSION['user'];
		$id_obra = $datos['obra'];
		$user->quitarLike($id_obra);
		
		$obra = Obra::buscaObraPorId($id_obra);
		$id_artist = $obra->id_autor();
		$autor = Usuario::buscaUsuarioPorId($id_artist);
		$nick = $autor->nick();
	
		$result = "perfilArtista.php?artist=$nick";
		
        return $result;
    }
}
