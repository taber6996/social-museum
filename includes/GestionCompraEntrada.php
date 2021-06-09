<?php
namespace es\ucm\fdi\aw;

class GestionCompraEntrada extends Form
{
    public function __construct($id_expo) {
        parent::__construct('formCompraEntrada');
		$this->id_expo = $id_expo;
    }
	
	private $id_expo;
	
    protected function generaCamposFormulario($datos, $errores = array())
    {
		$htmlErroresGlobales = self::generaListaErroresGlobales($errores);
		$errorSinObras = self::createMensajeError($errores, 'num', 'span', array('class' => 'error'));
		if($this->id_expo){
			$idExpo = $this->id_expo;
		}else{
			$idExpo = $errores['expo'];
		}
        $html = <<<EOF
        <input class="control" type="hidden" name="expo" value=$idExpo contenteditable="false" />
        <button type="submit" name="altaPremium">¡Comprar entrada!</button>
EOF;
        return $html;
    }
	
    protected function procesaFormulario($datos)
    {
        $user = $_SESSION['user'];
		$idExpo = $datos['expo'];
		$user->compraEntradaExpo($idExpo);
		$result = "visitaExpo.php?expo=$idExpo";
		
        return $result;
    }
}






