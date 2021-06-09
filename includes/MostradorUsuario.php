<?php
namespace es\ucm\fdi\aw;

class MostradorUsuario {
    public function __construct($usuario) {
		 $this->usuario = $usuario;
	}
	
	public $usuario;
	
	
	public function datosPersonales(){
		$user = $this->usuario;
		$html = <<<EOS
		<div class="datos-personales">
		<h2>Datos personales</h2>
		EOS;
		
		if(isset($_SESSION['avatar'])&&($_SESSION['avatar'])){
			$path = "img/avatares/".$user->id().".jpg";
			$html .= <<<EOS
			
			<img id="avatar" src=$path>

EOS;
		}else{
			$path = "img/avatares/no_avatar.jpg";
			$html .= <<<EOS
				
			<img id="avatar" src=$path>
EOS;
		}
		$nombre = $user->nombre();
		$nick = $user->nick();
		$html .= <<<EOS
		<h4>Nombre</h4>
		$nombre
		<h4>Nick</h4>
		$nick
		<p><a href="cambiarDatosUsuario.php">Editar datos</a></p>
		</div>
		EOS;
		
		return $html;
	}
	
	public function premium(){
		$html = <<<EOS
		<div class="premium">
		<h2>Premium</h2>
EOS;
		if(isset($_SESSION['premium'])&&($_SESSION['premium'])){
			$html .= <<<EOS
		¡Eres premium!
		<p><a href="premium.php">Quiero darme de baja</a></p>
EOS;
			
		}else{
			$html .= <<<EOS
			Todavía no eres premium...
		<p><a href="premium.php">¡Hazte premium!</a></p>
EOS;
			

		}
		$html .= <<<EOS
		</div>
EOS;
		return $html;
	}
	

}
?>
