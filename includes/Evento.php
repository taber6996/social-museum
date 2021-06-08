<?php
namespace es\ucm\fdi\aw;

class Evento
{
	
	/*   ATRIBUTOS   */
	
	private $id;
    private $nombre;
    private $tipo;
    private $descripcion;
    private $fecha_ini;
	private $fecha_fin;
	private $precio;
	
	/*   CONSTRUCTOR   */
	
	private function __construct($nombre, $tipo, $descripcion, $fecha_ini, $fecha_fin, $precio)
    {
        $this->nombre= $nombre;
		$this->tipo=$tipo;
        $this->descripcion = $descripcion;
		$this->fecha_ini = $fecha_ini;
		$this->fecha_fin=$fecha_fin;
		$this->precio=$precio;
    }
	
	/*   GETTERS   */
	
	public function id(){return $this->id;}
	public function nombre(){return $this->nombre;}
    public function tipo(){return $this->tipo;}
    public function descripcion(){return $this->descripcion;}
	public function fecha_ini(){return $this->fecha_ini;}
	public function fecha_fin(){return $this->fecha_fin;}
	public function precio(){return $this->precio;}
	
	/*   SETTERS   */
	
	/* FUNCIONES CRUD   */
	
	public static function crea($nombre, $tipo, $descripcion, $fecha_ini, $fecha_fin, $precio)
    {
        $evento = self::buscaEvento($nombre,$tipo);
        if ($evento) {
            return false;
        }
        $evento = new Evento($nombre, $tipo, $descripcion, $fecha_ini, $fecha_fin, $precio);
        return self::guarda($evento);
    }

    public static function buscaEvento($nombre, $tipo)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
		$query = sprintf("SELECT * FROM Eventos E WHERE E.nombre = '%s' AND E.tipo = '%s'",$conn->real_escape_string($nombre),$conn->real_escape_string($tipo));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();$evento = new Evento($fila['nombre'], $fila['tipo'], $fila['descripcion'], $fila['fecha_ini'], $fila['fecha_fin'], $fila['precio']);
                
                $evento->id = $fila['id'];
                $result = $evento;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }
    
    public static function guarda($evento)
    {
        if ($evento->id !== null) {
            return self::actualiza($evento);
        }
        return self::inserta($evento);
    }
	
	public function insertaObra($id_obra){
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO Expos(id_expo, id_obra) VALUES(%d, %d)"
            , $this->id
			, $id_obra);
        if ( $conn->query($query) ) {
            //$evento->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        //return $evento;
    }
    
    private static function inserta($evento)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO Eventos(nombre, tipo, descripcion, fecha_ini, fecha_fin, precio) VALUES('%s', '%s', '%s','%s','%s', %f)"
            , $conn->real_escape_string($evento->nombre)
            , $evento->tipo
			, $conn->real_escape_string($evento->descripcion)
			, $evento->fecha_ini //tipo date
			, $evento->fecha_fin //tipo date
			, $evento->precio);
        if ( $conn->query($query) ) {
            $evento->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $evento;
    }
    

    private static function actualiza($evento)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query=sprintf("UPDATE Eventos E SET nombre = '%s', tipo = '%s', descripcion='%s', fehca_ini = '%s', fecha_fin = '%s', precio=%f WHERE E.id=%i" //tipos date
            , $conn->real_escape_string($evento->nombre)
            , $conn->real_escape_string($evento->tipo)
			, $conn->real_escape_string($evento->descripcion)
			, $conn->real_escape_string($evento->fecha_ini) //tipo date
			, $conn->real_escape_string($evento->fecha_fin) //tipo date
			, $evento->precio
            , $evento->id);
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar el evento: " . $evento->id;
                exit();
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        
        return $evento;
    }
	
	//FALTA BORRAR EVENTO
	/* Buscadores en BBDD */
	
	public static function exposAutor($id_autor){
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
		$query = sprintf("SELECT DISTINCT ev.nombre FROM Eventos ev, Expos ex, Obras o WHERE ev.id=ex.id_expo AND ex.id_obra=o.id AND o.id_autor=%d", $id_autor);
        $rs = $conn->prepare($query);
        $rs->execute();
        $expos = $rs->get_result();
		return $expos;
	}
	
	public static function nombresEventos(){
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT nombre FROM Eventos WHERE tipo = 'Concurso'");
        $rs = $conn->prepare($query);
        $rs->execute();
        $eventos = $rs->get_result();
		return $eventos;
	}
	
	public static function exposPorFecha($moment){
		$query = sprintf("SELECT nombre FROM Eventos WHERE tipo = 'Expo'");
        if($moment == 'pasadas'){
            $query = sprintf("SELECT nombre FROM Eventos WHERE tipo = 'Expo' AND fecha_ini < NOW() AND fecha_fin < NOW()");
        }
        else if($moment == 'presente'){
            $query = sprintf("SELECT nombre FROM Eventos WHERE tipo = 'Expo' AND fecha_ini < NOW() AND fecha_fin > NOW()");
        }
        else if($moment == 'futuras'){
            $query = sprintf("SELECT nombre FROM Eventos WHERE tipo = 'Expo' AND fecha_ini > NOW()");
        }
		
		$app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $rs = $conn->prepare($query);
        $rs->execute();
        $expos = $rs->get_result();
		return $expos;
	}
	
	public function insertaPremio($premio_dinero, $premio_producto){
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO Concursos(id_concurso, premio_dinero, premio_producto) VALUES(%d, %d, '%s')"
            , $this->id
			, $premio_dinero
			, $premio_producto);
        if ( $conn->query($query) ) {
            $evento->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $evento;
    }
    
}