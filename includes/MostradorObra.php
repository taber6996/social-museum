<?php
namespace es\ucm\fdi\aw;


class MostradorObra {
    public function __construct($id_obra) {
		 $this->obra = Obra::buscaObraPorId($id_obra);
	}
	
	private $obra;
	
	public function muestraObra(){		
		$path = "img/obras/artista_".$this->obra->id_autor()."/".$this->obra->id().".jpg";
		$html = <<<EOS
		<img id="imagen_obra" src=$path>
EOS;
		return $html;
	}
	
	public function muestraComentarios(){
		$html="";
		$id_obra = $this->obra->id();
		$comentarios = Obra::comentarios($id_obra);
		
		foreach($comentarios as $comentario){
			$iu = $comentario['id_usuario'];
			$u = Usuario::buscaUsuarioPorId($iu);
			$nick = $u->nick();
			$c = $comentario['comentario'];
			
			$html .= <<<EOS
				<div class="comment">
				<p>@$nick : $c </p>
				</div>
EOS;
		
		}
		
		
		return $html;
	}
}
?>