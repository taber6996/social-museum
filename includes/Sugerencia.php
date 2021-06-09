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
	
	public static function buscaPorId($id){		
		$app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
		$query = sprintf("SELECT * FROM Sugerencias S WHERE S.id = %d",$id);        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $sugerencia = new Sugerencia($fila['correo'], $fila['nombre'], $fila['tipo'], $fila['contenido']);
				$sugerencia->id = $fila['id'];
                $result = $sugerencia;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
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
        $query=sprintf("INSERT INTO Sugerencias(nombre, correo, tipo, contenido) VALUES('%s', '%s', '%s', '%s')"
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
		
		public static function todasSugerencias(){
			$query = sprintf("SELECT * FROM Sugerencias");
			$sugerencias = self::consulta($query);
			return $sugerencias;
		}
		
		
		private static function consulta($query){
		$app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $rs = $conn->prepare($query);
        $rs->execute();
		return $rs->get_result();
	}
}