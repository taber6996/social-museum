<?php
namespace es\ucm\fdi\aw;

class GestionBajaPremium extends Form
{
    public function __construct() {
        parent::__construct('formBajaPremium');
    }
	
	
    protected function generaCamposFormulario($datos, $errores = array())
    {
        $html = <<<EOF
        <button type="submit" name="bajaPremium">Me doy de baja...</button>
EOF;
        return $html;
    }
	
    protected function procesaFormulario($datos)
    {
        $user = $_SESSION['user'];
		
		$user->bajaPremium();
		$_SESSION['premium'] = false;
		$result = "cuenta.php";
		
        return $result;
    }
	
	public function infoBaja(){
		$html = <<<EOS
<div id=premium>

<h1>Premium</h1>

<p>¡Ser premium tiene muchos beneficios!<p>
<p>¿Por qué te quieres dar de baja? :(</p>
<p>Puedes enviarnos tus recomendaciones para mejorar pinchando <a href="contacto.php">aquí</a>.</p>
</div>

<p>¿Seguro que te quieres dar de baja?</p>
EOS;
return $html;
	}
}






