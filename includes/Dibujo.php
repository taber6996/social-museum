<?php
namespace es\ucm\fdi\aw;

class Dibujo
{

	/*   ATRIBUTOS   */
	
	private $id;
    private $titulo;
    private $id_autor;
    
    
	
	/*   CONSTRUCTOR   */
	
	private function __construct($titulo, $id_autor)
    {
        $this->titulo= $titulo;
		$this->id_autor = $id_autor;
    }
	
	/*   GETTERS   */
	
	public function id(){return $this->id;}
	public function id_autor(){return $this->id_autor;}
	public function titulo(){return $this->titulo;}
	
	/*   FUNCIONES CRUD   */
	
	public static function crea($titulo,  $id_autor)
    {
        /*$dibujo = self::buscaDibujo($titulo,$id_autor);
        if ($dibujo) {
            return false;
        }*/
        $dibujo = new Dibujo($titulo,  $id_autor);
        return self::guarda($dibujo);
    }
	
    public static function buscaDibujo($titulo, $id_autor)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
		$query = sprintf("SELECT * FROM Dibujos O WHERE O.titulo = '%s' AND O.id_autor = %d",$conn->real_escape_string($titulo),$id_autor);
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $dibujo = new Dibujo($fila['titulo'], $fila['id_autor']);
                
                $dibujo->id = $fila['id'];
                $result = $dibujo;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }
	
	 public static function buscaDibujoPorId($id)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
		$query = sprintf("SELECT * FROM Dibujos O WHERE O.id = %d",$id);
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $dibujo = new Dibujo($fila['titulo'], $fila['id_autor']);
                
                $dibujo->id = $fila['id'];
                $result = $dibujo;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }
    
    public static function guarda($dibujo)
    {
        if ($dibujo->id !== null) {
            return self::actualiza($dibujo);
        }
        return self::inserta($dibujo);
    }
    
    private static function inserta($dibujo)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO Dibujos(titulo, id_autor) VALUES('%s', %d)"
            , $conn->real_escape_string($dibujo->titulo)
			, $dibujo->id_autor);
        if ( $conn->query($query) ) {
            $dibujo->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $dibujo;
    }
    
    private static function actualiza($dibujo)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query=sprintf("UPDATE Dibujos O SET titulo = '%s', id_autor=%d WHERE O.id=%i"
            , $conn->real_escape_string($dibujo->titulo)
            , $dibujo->id_autor
            , $dibujo->id);
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar la obra: " . $dibujo->id;
                exit();
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        
        return $dibujo;
    }
	
	public static function tarjeta($id){
		$dibujo = self::buscaDibujoPorId($id);
		$id_dibujo = $dibujo->id();
		$titulo = $dibujo->titulo();
		$path = "img/dibujos/usuario_".$dibujo->id_autor()."/".$id_dibujo.".jpg";
		
		if($obra instanceof bool){
			return false;
		}
		
        $html = <<<EOF
            <h2>$titulo</h2>
            <img id="publicacion" src=$path>
EOF;
        return $html;
	}
	
	public static function dibujosAutor($id_autor){
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT id FROM Dibujos WHERE id_autor = %d", $id_autor);
        $rs = $conn->prepare($query);
        $rs->execute();
        $dibujos = $rs->get_result();
		return $dibujos;
	}
	
	public static function todosDibujos(){
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM Dibujos");
        $rs = $conn->prepare($query);
        $rs->execute();
        $dibujos = $rs->get_result();
		return $dibujos;
	}
	
}
