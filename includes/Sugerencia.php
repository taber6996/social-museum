<?php
namespace es\ucm\fdi\aw;

class Sugerencia
{
    	/*   ATRIBUTOS   */
	
	private $id;
    private $nombre;
    private $correo;
    private $tipo;
    private $contenido;



	 private function __construct($correo, $nombre, $tipo, $contenido)
    {
        $this->correo= $correo;
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->contenido = $contenido;
    }

    public function id(){return $this->id;}
	public function nombre(){return $this->nombre;}
    public function correo(){return $this->correo;}
	public function tipo(){return $this->tipo;}
	public function contenido(){return $this->contenido;}

    public function setID($id){
        $this->id = $id;
    }
    public static function crea($correo, $nombre, $tipo, $contenido)
    {
        $sugerencia = new Sugerencia($correo, $nombre, $tipo, $contenido);
        return self::inserta($sugerencia);
    }

    private static function inserta($sugerencia)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO sugerencias(nombre, correo, tipo, contenido) VALUES('%s', '%s', '%s', '%s')"
            , $conn->real_escape_string($sugerencia->nombre)
            , $conn->real_escape_string($sugerencia->correo)
            , $conn->real_escape_string($sugerencia->tipo)
            , $conn->real_escape_string($sugerencia->contenido));
        if ( $conn->query($query) ) {
            $sugerencia->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $sugerencia;
    }


    public static function muestraTodos(){
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM sugerencias");
        $rs = $conn->prepare($query);
        $rs->execute();
        $sugerencias = $rs->get_result();
        $filas = $sugerencias->num_rows;
        $html = "";
        if($filas == 0){
            $html = <<<EOF
                <p> ¡No hay sugerencias! </p>
            EOF;
        }
        else{
            foreach($sugerencias as $sugerencia){
                $id = $sugerencia['id'] ?? null;
                $correo = $sugerencia['correo'] ?? null;
                $nombre = $sugerencia['nombre'] ?? null;
                $tipo = $sugerencia['tipo'] ?? null;
                $contenido = $sugerencia['contenido'] ?? null;
                if(!empty($id)){
                    $instancia = new Sugerencia($correo, $nombre, $tipo, $contenido);
                    $instancia->setID($id);
                    $html .= Sugerencia::tarjeta($instancia);
                }
                }
            }
            return $html;
        }
        public static function tarjeta($instancia){
            $correo = $instancia->correo();
            $nombre = $instancia->nombre();
            $tipo = $instancia->tipo();
            $id = $instancia->id();
            $contenido = $instancia->contenido();
                $html = <<<EOF
                <div class="sugerencia">
                <div class="sugerencia-izq">
                <h6>$tipo</h6>
                <h2>$nombre</h2>
                <a href="https://www.gmail.com">$correo</a>
                </div>
                <div class="sugerencia-der">
                <h6>ID: #$id</h6>
                <p>$contenido</p>
                </div>
                </div>

                EOF;
            return $html;
            
            
        }
}