<?php
namespace es\ucm\fdi\aw;

class Entrada
{

	/*   ATRIBUTOS   */
	
	private $id;
    private $id_evento;
    private $id_usuario;
	
	/*   CONSTRUCTOR   */
	
	private function __construct($id_evento, $id_usuario)
    {
        $this->id_evento= $id_evento;
        $this->id_usuario = $id_usuario;
    }
	
	/*   GETTERS   */
	
	public function id(){return $this->id;}
	public function id_evento(){return $this->id_evento;}
    public function id_usuario(){return $this->id_usuario;}
	
	/*   SETTERS   */
	
	/*   FUNCIONES CRUD   */
	
	public static function crea($id_evento, $id_usuario)
    {
        $entrada = self::buscaEntrada($id_evento,$id_usuario);
        if ($entrada) {
            return false;
        }
        $entrada = new Entrada($id_evento, $id_usuario);
        return self::guarda($entrada);
    }
	
    public static function buscaEntrada($id_evento, $id_usuario)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
		$query = sprintf("SELECT * FROM Entradas E WHERE E.id_evento = %d AND O.id_usuario = %d",$id_evento,$id_autor);
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();$entrada = new Entrada($fila['id_evento'], $fila['id_usuario']);
                
                $entrada->id = $fila['id'];
                $result = $entrada;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }
    
    public static function guarda($entrada)
    {
        if ($entrada->id !== null) {
            return self::actualiza($entrada);
        }
        return self::inserta($entrada);
    }
    
    private static function inserta($entrada)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO Entradas(id_evento, id_usuario) VALUES(%d, %d)"
            , $entrada->id_evento
            , $entrada->id_usuario);
        if ( $conn->query($query) ) {
            $entrada->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $entrada;
    }
    
    private static function actualiza($entrada)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query=sprintf("UPDATE Entradas E SET id_evento = %d, id_usuario=%d WHERE E.id=%i"
            , $entrada->id_evento
            , $entrada->id_usuario
            , $entrada->id);
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar la entrada: " . $entrada->id;
                exit();
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        
        return $entrada;
    }
	
	//FALTA BORRAR ENTRADA
    
}