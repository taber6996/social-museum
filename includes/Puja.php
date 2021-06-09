<?php
namespace es\ucm\fdi\aw;

class Puja
{
	/*   ATRIBUTOS   */
	
	private $id;
    private $id_obra;
    private $precio_inicial;
    private $precio_actual;
    private $id_comprador_actual;
    private $fecha_finalizacion;
	
	/*   CONSTRUCTOR   */
	
	public function __construct($id_obra,$precio_inicial,$fecha_finalizacion)
    {
        $this->id_obra= $id_obra;
		$this->precio_inicial = $precio_inicial;
		$this->precio_actual = $precio_inicial;
        $this->fecha_finalizacion = $fecha_finalizacion;
    }
	
	/*   GETTERS   */
	
	public function id(){return $this->id;}
	public function id_obra(){return $this->id_obra;}
	public function precio_inicial(){return $this->precio_inicial;}
	public function precio_actual(){return $this->precio_actual;}
	public function id_comprador_actual(){return $this->id_comprador_actual;}
	public function fecha_finalizacion(){return $this->fecha_finalizacion;}
	
	/*   SETTERS   */
	public function actualiza_campos($nueva, $id_comprador){
        $this->precio_actual = $nueva;
        $this->id_comprador_actual = $id_comprador;
    }
	/*   FUNCIONE CRUD   */
	
	public static function crea($id_obra, $precio_inicial, $fecha_finalizacion)
    {
        $puja = self::buscaPuja($id_obra);
        if ($puja) {
            return false;
        }
        $puja = new Puja($id_obra, $precio_inicial, $fecha_finalizacion);
        return self::guarda($puja);
    }

    public static function buscaPuja($id_obra)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
		$query = sprintf("SELECT * FROM Pujas P WHERE P.id_obra = %d",$id_obra);
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $puja = new Puja($fila['id_obra'], $fila['precio_inicial'], $fila['fecha_finalizacion']);
                $puja->precio_actual = $fila['precio_actual'];
				$puja->id_comprador_actual = $fila['id_comprador_actual'];
                //$puja->id = $fila['id'];
                $result = $puja;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }
	
	public static function buscaPujaPorId($id)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
		$query = sprintf("SELECT * FROM Pujas P WHERE P.id = %d",$id);
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $puja = new Puja($fila['id_obra'], $fila['fecha_finalizacion'], $fila['precio_inicial'], $fila['precio_actual'], $fila['id_comprador_actual']);
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
    
    public static function muestraSubastas(){
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
		$query = sprintf("SELECT * FROM Pujas");
        $rs = $conn->query($query);
        $result = [];
        if($rs){
            while($fila = $rs->fetch_assoc()){
                $result[] = new Puja($fila['id_obra'], $fila['fecha_finalizacion'], $fila['precio_inicial'], $fila['precio_actual'], $fila['id_comprador_actual']);
                echo $result;
            }
            $rs->free();
        }
        else{
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
        $query=sprintf("INSERT INTO Pujas(id_obra, fecha_finalizacion, precio_inicial, precio_actual) VALUES(%d, '%s', %f, %f)"
            , $puja->id_obra
            , $puja->fecha_finalizacion
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
        $query=sprintf("UPDATE Pujas P SET precio_actual=%f, id_comprador_actual=%d WHERE P.id=%d"
            , $puja->precio_actual
            , $puja->id_comprador_actual
            , $puja->id);
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar la puja: " . $puja->id;
                exit();
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error)."---". $query ;
            exit();
        }
        
        return $puja;
    }
	
	
	public static function todasPujas(){
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM Pujas");
        $rs = $conn->prepare($query);
        $rs->execute();
        $pujas = $rs->get_result();
		return $pujas;
	}
	
}
