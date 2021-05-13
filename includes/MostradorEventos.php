<?php
namespace es\ucm\fdi\aw;
class MostradorEventos{
    public function __construct() {}
    public function muestra(){
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $moment = false;
        $tipo = "Concurso";
        if(isset($_GET["tipo"])){
            $tipo = $_GET["tipo"];
        }
        if(isset($_GET["momento"])){
            $moment = $_GET["momento"];
        }
        $query = sprintf("SELECT nombre FROM eventos WHERE tipo = 'Concurso'");
/*        if($moment == 'pasadas'){
            $query = sprintf("SELECT nombre FROM eventos WHERE tipo = $tipo AND fecha_ini > NOW() AND fecha_fin > NOW()");
        }
        else if($moment == 'presente'){
            $query = sprintf("SELECT nombre FROM eventos WHERE tipo = $tipo AND fecha_ini < NOW() AND fecha_fin > NOW()");
        }
        else if($moment == 'futuras'){
            $query = sprintf("SELECT nombre FROM eventos WHERE tipo = $tipo AND fecha_ini > NOW()");
        }
*/
        if($tipo == "Subasta"){
            $query = sprintf("SELECT nombre FROM eventos WHERE tipo = 'Subasta'");
        }
        else if($tipo == "Expo"){
            $query = sprintf("SELECT nombre FROM eventos WHERE tipo = 'Expo'");
        }
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
