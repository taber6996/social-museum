<?php
namespace es\ucm\fdi\aw;

class Mecena
{

	/*   ATRIBUTOS   */
	
	//private $id;
    private $id_usuario;
    private $id_artista;
  
	/*   CONSTRUCTOR   */
	
	private function __construct($id_usuario, $id_artista)
    {
        $this->id_usuario= $id_usuario;
        $this->id_artista = $id_artista;
    }
	
	/*   GETTERS   */
	
	//public function id(){return $this->id;}
	public function id_usuario(){return $this->id_usuario;}
	public function id_artista(){return $this->id_artista;}
	
	/*   SETTERS   */
	
	
	/*   FUNCIONES CRUD   */
	
	public static function crea($id_usuario, $id_artista)
    {
        $mecena = self::buscaMecena($id_usuario,$id_artista);
        if ($mecena) {
            return false;
        }
        $mecena = new Mecena($id_usuario, $id_artista);
        return self::guarda($mecena);
    }
	
    public static function buscaMecena($id_usuario, $id_artista)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
		$query = sprintf("SELECT * FROM Mecenas M WHERE M.id_usuario = %d AND M.id_artista = %d",$id_usuario,$id_artista);
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
				$mecena = new Mecena($fila['id_usuario'], $fila['id_artista']);
                
                //$mecena->id = $fila['id'];
                $result = $mecena;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }
    
    public static function guarda($mecena)
    {
        //if ($mecena->id !== null) {
           // return self::actualiza($mecena);
        //}
        return self::inserta($mecena);
    }
    
    private static function inserta($mecena)
    { 
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO Mecenas(id_usuario, id_artista) VALUES(%d, %d)"
            , $mecena->id_usuario
            , $mecena->id_artista);
        if ( $conn->query($query) ) {
           // $mecena->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $mecena;
    }
    
    /*private static function actualiza($mecena)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query=sprintf("UPDATE Mecenas M SET id_usuario = %d, id_artista=%d WHERE M.id=%i"
			, $mecena->id_usuario
			, $mecena->id_artista
            , $mecena->id);
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar el mecenazgo: " . $mecena->id;
                exit();
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        
        return $meccena;
    }*/
	
	//FALTA ELIMINA mecena
	
	public static function elimina($mecena)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
		$query=sprintf("DELETE FROM Mecenas WHERE  mecenas.id_usuario=%d AND mecenas.id_artista=%d"
			,$mecena->id_usuario
            , $mecena->id_artista);
        if ( $conn->query($query) ) {
        } else {
            echo "Error al borrar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $mecena;
    }
  
}
