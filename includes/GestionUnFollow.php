<?php
namespace es\ucm\fdi\aw;

class GestionUnFollow extends Form
{
    public function __construct($id_artista) {
        parent::__construct('formUnFollow');
		$this->id_artista = $id_artista;
    }
	
	private $id_artista;
	
    protected function generaCamposFormulario($datos, $errores = array())
    {
		$htmlErroresGlobales = self::generaListaErroresGlobales($errores);
		$errorSinObras = self::createMensajeError($errores, 'num', 'span', array('class' => 'error'));
		if($this->id_artista){
			$id_artista = $this->id_artista;
		}else{
			$id_artista = $errores['artista'];
		}
        $html = <<<EOF
        <input class="control" type="hidden" name="artista" value=$id_artista contenteditable="false" />
        <button type="submit" name="follow">DEJAR DE SER MECENAS</button>
EOF;
        return $html;
    }
	
    protected function procesaFormulario($datos)
    {
        $user = $_SESSION['user'];
		$id_artista = $datos['artista'];
		$autor = Usuario::buscaUsuarioPorId($id_artista);
		$nick = $autor->nick();
		$user->dejarDeSerMecenas($nick);
		
		$result = "perfilArtista.php?artist=$nick";
		
        return $result;
    }
}