<?php
namespace es\ucm\fdi\aw;

class Aplicacion{
	
	/*PATRON SINGLETON*/
	private static $instance;
	
	public static function getInstance(){
		if(!(self::$instance instanceof self)){
			self::$instance = new self;
		}
		return self::$instance;
	}
	
	
	/*INICIALIZACION DE LA APLICACION*/	
	private $datosBD;
	private $inicializada = false;
	
	public function init($datosBD){
		if(!$this->inicializada){
			$this->datosBD = $datosBD;
			session_start();
			$this->inicializada = true;
		}
	}
	
	/*CIERRE DE LA APLICACION*/
	public function shutdown(){
	    $this->compruebaInicializacion();
	    if ($this->conn !== null && ! $this->conn->connect_errno) {
	        $this->conn->close();
	    }
	}
	
	
	/*CREACION DE CONEXION CON LA BD*/
	private $conn;
	
	public function conexionBD(){
		$this->compruebaInicializacion();
		if(!$this->conn){
			$bdHost = $this->datosBD['host'];
			$bdUser = $this->datosBD['user'];
			$bdPass = $this->datosBD['pass'];
			$bd = $this->datosBD['bd'];
			
			$this->conn = new \mysqli($bdHost, $bdUser, $bdPass, $bd);
			if ( $this->conn->connect_errno ) {
				echo "Error de conexión a la BD: (" . $this->conn->connect_errno . ") " . utf8_encode($this->conn->connect_error);
				exit();
			}
			if ( ! $this->conn->set_charset("utf8mb4")) {
				echo "Error al configurar la codificación de la BD: (" . $this->conn->errno . ") " . utf8_encode($this->conn->error);
				exit();
			}
		}
		return $this->conn;
	}
	
	public function compruebaInicializacion(){
		if(!$this->inicializada){
			echo "Aplicacion no inicializada";
			exit();
		}
	}
	
	/*CARACTERISTICAS SINGLETON*/
	private function __construct() {}
	
	public function __clone(){
		throw new Exception('No tiene sentido el clonado');
	}
	
	public function __sleep(){
		throw new Exception('No tiene sentido el serializar el objeto');
	}
	
	public function __wakeup(){
		throw new Exception('No tiene sentido el deserializar el objeto');
	}

}