<?php
namespace es\ucm\fdi\aw;

class Obra
{

	/*   ATRIBUTOS   */
	
	private $id;
    private $titulo;
    private $id_autor;
    private $descripcion;
    private $likes;
	
	/*   CONSTRUCTOR   */
	
	private function __construct($titulo, $descripcion, $id_autor)
    {
        $this->titulo= $titulo;
        $this->descripcion = $descripcion;
		$this->id_autor = $id_autor;
		$this->likes=0;
    }
	
	/*   GETTERS   */
	
	public function id(){return $this->id;}
	public function id_autor(){return $this->id_autor;}
	public function titulo(){return $this->titulo;}
	public function descripcion(){return $this->descripcion;}
	public function likes(){return $this->likes;}
	
	/*   SETTERS   */
	
	public function likeUp(){
		$this->likes= ($this->likes) +1;
		//self::actualiza($this);
	}
	public function likeDown(){
		$this->likes= ($this->likes) -1;
		//self::actualiza($this);
	}
	
	/*   FUNCIONES CRUD   */
	
	public static function crea($titulo, $descripcion, $id_autor)
    {
        $obra = self::buscaObra($titulo,$id_autor);
        if ($obra) {
            return false;
        }
        $obra = new Obra($titulo, $descripcion, $id_autor);
        return self::guarda($obra);
    }
	
    public static function buscaObra($titulo, $id_autor)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
		$query = sprintf("SELECT * FROM Obras O WHERE O.titulo = '%s' AND O.id_autor = %d",$conn->real_escape_string($titulo),$id_autor);
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();$obra = new Obra($fila['titulo'], $fila['descripcion'], $fila['id_autor']);
                
                $obra->id = $fila['id'];
                $result = $obra;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }
	
	 public static function buscaObraPorId($id)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
		$query = sprintf("SELECT * FROM Obras O WHERE O.id = %d",$id);
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();$obra = new Obra($fila['titulo'], $fila['descripcion'], $fila['id_autor']);
                
                $obra->id = $fila['id'];
                $result = $obra;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }
    
    public static function guarda($obra)
    {
        if ($obra->id !== null) {
            return self::actualiza($obra);
        }
        return self::inserta($obra);
    }
    
    private static function inserta($obra)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO Obras(titulo, descripcion, id_autor, likes) VALUES('%s', '%s', %d, %d)"
            , $conn->real_escape_string($obra->titulo)
            , $conn->real_escape_string($obra->descripcion)
			, $obra->id_autor
			, 0);
        if ( $conn->query($query) ) {
            $obra->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $obra;
    }
    
    private static function actualiza($obra)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query=sprintf("UPDATE Obras O SET titulo = '%s', descripcion='%s', id_autor=%d, likes=%d WHERE O.id=%i"
            , $conn->real_escape_string($obra->titulo)
            , $conn->real_escape_string($obra->descripcion)
            , $obra->id_autor
			, $obra->likes
            , $obra->id);
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar la obra: " . $obra->id;
                exit();
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        
        return $obra;
    }
	
	//FALTA ELIMINA OBRA
 
}
