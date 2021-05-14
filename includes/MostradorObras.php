<?php
namespace es\ucm\fdi\aw;


class MostradorObras {
    public function __construct($artist) {
		 $this->usuarioArista = Usuario::buscaUsuario($artist);
	}
	
	private $usuarioArista;
	
	public function muestra(){
		$id_autor = $this->usuarioArista->id();
		
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT id FROM Obras WHERE id_autor = %d", $id_autor);
        $rs = $conn->prepare($query);
        $rs->execute();
        $obras = $rs->get_result();
        $filas = $obras->num_rows;
        $html = "";
        if($filas == 0){
            $html = <<<EOF
                <p> ¡No hay obras! </p>
            EOF;
        }
        else{
            foreach($obras as $obra){
                $id = $obra['id'] ?? null;
                $obra = Obra::tarjeta($id);
				
				$html .= <<<EOF
				$obra
				<button type="button">like</button>
				<button type="button">comentar</button>
				EOF;
					
					
					
					
                }
            }
            return $html;
        }

}
?>