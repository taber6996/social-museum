<?php
namespace es\ucm\fdi\aw;
class MostradorExpos{
    public function __construct() {}
    public function muestra(){
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $moment = false;
        if(isset($_GET["momento"])){
            $moment = $_GET["momento"];
        }
        $query = sprintf("SELECT nombre FROM eventos WHERE tipo = 'Expo'");
        if($moment == 'pasadas'){
            $query = sprintf("SELECT nombre FROM eventos WHERE tipo = 'Expo' AND fecha_ini > NOW() AND fecha_fin > NOW()");
        }
        else if($moment == 'presente'){
            $query = sprintf("SELECT nombre FROM eventos WHERE tipo = 'Expo' AND fecha_ini < NOW() AND fecha_fin > NOW()");
        }
        else if($moment == 'futuras'){
            $query = sprintf("SELECT nombre FROM eventos WHERE tipo = 'Expo' AND fecha_ini > NOW()");
        }
        $rs = $conn->prepare($query);
        $rs->execute();
        $expos = $rs->get_result();
        $filas = $expos->num_rows;
        $html = "";
        if($filas == 0){
            $html = <<<EOF
                <p> ¡No hay exposiciones! </p>
            EOF;
        }
        else{
            foreach($expos as $expo){
                $nombre = $expo['nombre'] ?? null;
                $type = 'Expo';
                $html .= Evento::tarjeta($nombre, $type);
                }
            }
            return $html;
        }
}



?>