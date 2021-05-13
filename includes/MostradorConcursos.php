<?php
namespace es\ucm\fdi\aw;
class MostradorConcursos{
    public function __construct() {}
    public function muestra(){
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
		$tipo = "Concurso";
        $query = sprintf("SELECT nombre FROM eventos WHERE tipo = 'Concurso'");
        $rs = $conn->prepare($query);
        $rs->execute();
        $eventos = $rs->get_result();
        $filas = $eventos->num_rows;
        $html = "";
        if($filas == 0){
            $html = <<<EOF
                <p> ¡No hay eventos! </p>
            EOF;
        }
        else{
            foreach($eventos as $evento){
                $nombre = $evento['nombre'] ?? null;
                $html .= Evento::tarjeta($nombre, $tipo);
                }
            }
            return $html;
        }
}

?>