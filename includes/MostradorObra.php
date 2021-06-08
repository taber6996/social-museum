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

	
	

}
?>