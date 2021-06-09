<?php
namespace es\ucm\fdi\aw;

class GestionAltaPremium extends Form
{
    public function __construct() {
        parent::__construct('formAltaPremium');
    }
	
    protected function generaCamposFormulario($datos, $errores = array())
    {
        $html = <<<EOF
        <button type="submit" name="altaPremium">¡Hacerme premium ya!</button>
EOF;
        return $html;
    }
	
    protected function procesaFormulario($datos)
    {
        $user = $_SESSION['user'];
		
		$user->altaPremium();
		$_SESSION['premium'] = true;
		$result = "cuenta.php";
		
        return $result;
    }
	
	public function infoAlta(){
		$html = <<<EOS
<div id=premium>

<h1>Premium</h1>

<p>¡Ser premium tiene muchos beneficios!<p>
<p>Descúbrelos todos por solo 2,99€ al mes</p>

<section id="exposYeventos">
<h4>Expos y eventos</h4>
<p>Tendrás acceso a todas las expos y eventos como los concursos y pujas gratis.</p>
<p>¡Muchas veces de forma exclusiva o antes que nadie!<p>
<img src="img/m1.jpg" alt="Expo" class="p"/>
</section>

<section id="mecenazgos">
<h4>Mecenazgos</h4>
<p>Todos los mecenazgos a mitad de precio.<p>
<p>Podrás convertirte en un verdadero rey de los mecenazgos.<p>
<img src="img/m2.jpg" alt="Artista" class="p"/>
</section>

<section id="newsletter">
<h4>Newsletter</h4>
<p>Si eres tan fan del arte como nosotros no puedes perderte la <span>SOCIAL-MUSEUM newsletter<span>.</p>
<p>Redactada por los mejores con información y noticias actuales relacionadas con a web, las expos, nuestros artistas y mucho más.</p>
<p>¡Recíbela todos los meses!</p>
<img src="img/m3.jpg" alt="Newsletter" class="p"/>
</section>

</div>

<p>¿Lo tienes claro?</p>
EOS;
return $html;
	}
}






