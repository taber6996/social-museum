<?php
namespace es\ucm\fdi\aw;

class MostradorPerfilArtista {
    public function __construct($artist) {
		 $this->usuarioArista = Usuario::buscaUsuario($artist);
	}
	
	public $usuarioArista;
	
	public function muestra(){
		$html="";
		$html.=self::muestra_avatar();
		$nombre = $this->usuarioArista->nombre();
		
		$html .= <<<EOS
		<h2>$nombre</h2>
		EOS;

		
		return $html;
	}
	
	private function muestra_avatar(){
		$html="";
		
		$id = $this->usuarioArista->id();
		
		if(($this->usuarioArista->avatar())==1){
			//$path = "img/avatares/".$user->id().".jpg";
			$path = "img/avatares/".$id.".jpg";
			$html .= <<<EOS
				
			<img src=$path height="150" width="150">
EOS;
		}else{
			$path = "img/avatares/no_avatar.jpg";
			$html .= <<<EOS
				
			<img src=$path height="150" width="150">
EOS;
		}
		return $html;
	}

}
?>
