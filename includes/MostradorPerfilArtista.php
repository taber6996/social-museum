<?php
namespace es\ucm\fdi\aw;

class MostradorPerfilArtista {
    public function __construct($artist) {
		 $this->usuarioArista = Usuario::buscaUsuario($artist);
		 //echo $this->usuarioArista->id();
		 //echo $this->usuarioArista->nombre();
	}
	
	public $usuarioArista;
	
	public function muestra(){
		$html="";
		$html.=self::muestra_avatar();	


		
		return $html;
	}
	
	private function muestra_avatar(){
		$html="";
		if(($this->usuarioArista->avatar())==1){
			$path = "img/avatares/".$usuarioArtista->id().".jpg";
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

    public function muestralo(){
		
		echo $this->usuarioArista->id();
		//echo $this->usuarioArista->avatar();
		
		$html="";
		
		if(($this->usuarioArista->avatar())==1){
			$path = "img/avatares/".$usuarioArtista->id().".jpg";
			$html .= <<<EOS
				
			<img src=$path height="150" width="150">
EOS;
		}else{
			$path = "img/avatares/no_avatar.jpg";
			$html .= <<<EOS
				
			<img src=$path height="150" width="150">
EOS;
		}
		
		
		
		
    $app = Aplicacion::getInstance();
    $conn = $app->conexionBd();
    $query = sprintf("SELECT nombre FROM productos P");
    $rs = $conn->prepare($query);
    $rs->execute();
    $productos = $rs->get_result();
    $filas = $productos->num_rows;
    $html = "";
    if($filas == 0){
        $html = <<<EOF
            <p> ¡No hay productos en la tienda! </p>
        EOF;
    }
    else{
        foreach($productos as $producto){
            $nombre = $producto['nombre'] ?? null;
            if(!empty($nombre)){
                $html .= Producto::tarjeta($nombre);
            }
            }
        }
        return $html;
    }

}
?>