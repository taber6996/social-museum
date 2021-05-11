<?php
namespace es\ucm\fdi\aw;

class Puja
{
	/*   ATRIBUTOS   */
	
	private $id;
    private $id_obra;
	private $id_evento;
    private $precio_inicial;
    private $precio_actual;
    private $id_comprador_actual;
	
	/*   CONSTRUCTOR   */
	
	private function __construct($id_obra, $id_evento, $precio_inicial)
    {
        $this->id_obra= $id_obra;
        $this->od_evento = $id_evento;
		$this->precio_inicial = $precio_inicial;
		$this->precio_actual = $precio_inicial;
    }
	
	/*   GETTERS   */
	
	public function id(){return $this->id;}
	public function id(){return $this->id_obra;}
	public function id(){return $this->id_evento;}
	public function id(){return $this->precio_inicial;}
	public function id(){return $this->precio_actual;}
	public function id(){return $this->id_comprador_actual;}
	
	/*   SETTERS   */
	
	/*   FUNCIONE CRUD   */
	
	public static function crea($id_obra, $id_evento, $precio_inicial)
    {
        $puja = self::buscaPuja($id_obra,$id_evento);
        if ($puja) {
            return false;
        }
        $puja = new Puja($id_obra, $id_evento, $precio_actual);
        return self::guarda($puja);
    }

    public static function buscaPuja($id_obra, $id_evento)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
		$query = sprintf("SELECT * FROM Pujas P WHERE P.id_obra = %d AND P.id_evento = %d",$id_obra,$id_autor);
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();$puja = new Puja($fila['id_obra'], $fila['id_evento'], $fila['precio_inicial']);
                $puja->precio_actual = $fila['precio_actual'];
				$puja->id_comprador_actual = $fila['id_comprador_actual'];
                $puja->id = $fila['id'];
                $result = $puja;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }
    
    public static function guarda($puja)
    {
        if ($puja->id !== null) {
            return self::actualiza($puja);
        }
        return self::inserta($puja);
    }
    
    private static function inserta($puja)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO Pujas(id_obra, id_evento, precio_inicial, precio_actual) VALUES(%d, %d, %d, %d)"
            , $puja->id_obra
            , $puja->id_evento
			, $puja->precio_inicial
			, $puja->precio_actual);
        if ( $conn->query($query) ) {
            $puja->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $puja;
    }
    
    private static function actualiza($puja)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query=sprintf("UPDATE Pujas P SET precio_actual = %d, id_comprador_actual=%d WHERE O.id=%i"
            , $conn->real_escape_string($puja->precio_actual)
            , $conn->real_escape_string($puja->id_comprador_actual)
            , $puja->id);
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar la puja: " . $puja->id;
                exit();
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        
        return $puja;
    }
    
}