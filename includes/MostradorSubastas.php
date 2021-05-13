<?php
namespace es\ucm\fdi\aw;
class MostradorSubastas{
    public function __construct() {}
    public function muestra(){
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM Pujas");
        $rs = $conn->prepare($query);
        $rs->execute();
        $pujas = $rs->get_result();
        $filas = $pujas->num_rows;
        $html = "";
        if($filas == 0){
            $html = <<<EOF
                <p> ¡No hay subastas! </p>
            EOF;
        }
        else{
            foreach($pujas as $puja){
                $id_obra = $puja['id_obra'] ?? null;
                $puja = Puja::tarjeta($id_obra);
					
					$html .= <<<EOF
						$puja
						<button type="button">pujar</button>
EOF;
					
					
                }
            }
            return $html;
        }
}

?>