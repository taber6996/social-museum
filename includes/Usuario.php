<?php
namespace es\ucm\fdi\aw;

class Usuario
{
	
	/*   ATRIBUTOS   */
	
	private $id;
    private $nick;
    private $nombre;
    private $password;
    private $rol;
	private $avatar;
	private $premium;
	
	
	/*   CONSTRUCTOR   */
	
	 private function __construct($nick, $nombre, $password, $rol, $premium)
    {
        $this->nick= $nick;
        $this->nombre = $nombre;
        $this->password = $password;
        $this->rol = $rol;
		$this->premium = $premium;
    }
	
	/*   GETTERS   */
	
	public function id(){return $this->id;}
	public function nombre(){return $this->nombre;}
	public function rol(){return $this->rol;}
	public function nick(){return $this->nick;}
	public function avatar(){return $this->avatar;}
	public function premium(){return $this->premium;}
	
	
	
	/*   SETTERS   */
	
	 public function cambiaPassword($nuevoPassword){
        $this->password = self::hashPassword($nuevoPassword);
		//self::actualiza($this);
    }
	
	public function cambiaNombre($nuevoNombre){
        $this->nombre = $nuevoNombre;
		//self::actualiza($this);
    }
	
	public function cambiaNick($nuevoNick){
		$this->nick=$nuevoNick;
	}
	
	public function cambiaAvatar(){
		$this->avatar = 1;
	}
	
	/*   FUNCIONES CRUD   */
	
	public static function crea($nick, $nombre, $password, $rol, $premium)
    {
        $user = self::buscaUsuario($nick);
        if ($user) {
            return false;
        }
        $user = new Usuario($nick, $nombre, self::hashPassword($password), $rol, $premium);
        return self::guarda($user);
    }
	
	public static function buscaUsuario($nick)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM Usuarios U WHERE U.nick = '%s'", $conn->real_escape_string($nick));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $user = new Usuario($fila['nick'], $fila['nombre'], $fila['password'], $fila['rol'], $fila['premium']);
                $user->avatar = $fila['avatar'];
				$user->id = $fila['id'];
                $result = $user;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }
	
	public static function buscaUsuarioPorId($id)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM Usuarios U WHERE U.id = %d", $id);
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $user = new Usuario($fila['nick'], $fila['nombre'], $fila['password'], $fila['rol'], $fila['premium']);
                $user->id = $fila['id'];
                $result = $user;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }
	
	public static function guarda($usuario)
    {
        if ($usuario->id !== null) {
            return self::actualiza($usuario);
        }
        return self::inserta($usuario);
    }
	
	private static function inserta($usuario)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO Usuarios(nick, nombre, password, rol, premium,avatar) VALUES('%s', '%s', '%s', '%s', %d,%d)"
            , $conn->real_escape_string($usuario->nick)
            , $conn->real_escape_string($usuario->nombre)
            , $conn->real_escape_string($usuario->password)
            , $conn->real_escape_string($usuario->rol)
			, $usuario->premium()
			, 0);
        if ( $conn->query($query) ) {
            $usuario->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $usuario;
    }
	

	public static function actualiza($usuario)
    {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
		
        $query=sprintf("UPDATE Usuarios U SET nick = '%s', nombre='%s', password='%s', avatar=%d, premium=%d WHERE U.id=%d"
            , $conn->real_escape_string($usuario->nick)
            , $conn->real_escape_string($usuario->nombre)
            , $conn->real_escape_string($usuario->password)
			, $usuario->avatar
			, $usuario->premium
            , $usuario->id);
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar el usuario: " . $usuario->id;
                exit();
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $usuario;
    }
	
	//FALTA BORRAR USUARIO
	
	
	/*   FUNCIONES DE USUARIO   */
	
	 public static function login($nick, $password)
    {
        $user = self::buscaUsuario($nick);
        if ($user && $user->compruebaPassword($password)) {
            return $user;
        }
        return false;
    }
	
	/*   FUNCIONES AUXILIARES   */
	
	public function altaPremium(){
		$this->premium = 1;
		$user = self:: actualiza($this);
	}
	
	public function bajaPremium(){
		$this->premium = 0;
		$user = self:: actualiza($this);
	}
	
	public function darLike($id_obra){
		$app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO Likes(id_obra, id_usuario) VALUES(%d,%d)"
			, $id_obra
			, $this->id);
        if ( $conn->query($query) ) {
            //$usuario->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        
	}
	
	public function quitarLike($id_obra){
		$app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
		//DELETE FROM `likes` WHERE 0
        $query=sprintf("DELETE FROM Likes WHERE id_obra=%d AND id_usuario=%d"
			, $id_obra
			, $this->id);
        if ( $conn->query($query) ) {
            //$usuario->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        
	}
	
	public function compraEntradaExpo($id_expo){
		$app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO Entradas(id_evento, id_usuario) VALUES(%d,%d)"
			, $id_expo
			, $this->id);
        if ( $conn->query($query) ) {
           // $usuario->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        
	}
	
	
	public function serMecenas($artistNick){
		$artist = self::buscaUsuario($artistNick);
		$a= $artist->id();
		$u= $this->id;
		$mecena = Mecena::crea($u,$a);
	}
	
	public function dejarDeSerMecenas($artistNick){
		$artist = self::buscaUsuario($artistNick);
		$a= $artist->id();
		$u= $this->id;
		$mecena = Mecena::buscaMecena($u,$a);
		if($mecena){
			$mecena = Mecena::elimina($mecena);
		}
	}
	
	public function esMecenas($id_artista){
		$mecena = Mecena::buscaMecena($this->id,$id_artista);
		return $mecena;
	}
	
	 public function compra($id_producto){
        $compra = Compra::crea($id_producto, $this->id);
    }

	
	public function compruebaPassword($password)
    {
        return password_verify($password, $this->password);
    }
	
	private static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

	

	public function bio(){
		 $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM Biografias B WHERE B.id_autor = %d", $this->id);
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
				$bio = $fila['bio'];
                $result = $bio;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
		return $result;
	}
	
	
	public function numMecenazgos(){
		$app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM Mecenas B WHERE B.id_artista = %d", $this->id);
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
			$result = $rs->num_rows;
        
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
		return $result;
	}
	
	public function numObras(){
		$app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM Obras B WHERE B.id_autor = %d", $this->id);
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
			$result = $rs->num_rows;
        
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
		return $result;
	}
	
	public function numExpos(){
		$app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
		$query = sprintf("SELECT DISTINCT ev.nombre FROM Eventos ev, Expos ex, Obras o WHERE ev.id=ex.id_expo AND ex.id_obra=o.id AND o.id_autor=%d", $this->id);
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
			$result = $rs->num_rows;
        
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
		return $result;
	}
	
	/* Buscadores */
	
	public static function todosArtistas(){
        $query = sprintf("SELECT nick FROM Usuarios WHERE rol = 'artist'");
        $artistas = self:: consulta($query);
		return $artistas;
	}
	
	public static function misArtistas($user){
		//SELECT nick FROM `usuarios`,`mecenas` WHERE `mecenas`.`id_usuario`=14 AND `mecenas`.`id_artista` = `usuarios`.`id`
		$query = sprintf("SELECT nick FROM Usuarios, mecenas WHERE mecenas.id_usuario=%d AND mecenas.id_artista=usuarios.id",$user->id());
        $artistas = self:: consulta($query);
		return $artistas;
	}
	
	 public static function misCompras($user){
        $query = sprintf("SELECT id_articulo FROM Compras WHERE id_usuario = %d", $user->id());
        $compras = self::consulta($query);
        return $compras;
    }
	
	private static function consulta($query){
		$app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $rs = $conn->prepare($query);
        $rs->execute();
		return $rs->get_result();
	}
	
	public function tieneEntrada($id_expo){
		//SELECT * FROM `entradas` WHERE id_evento = 3 AND id_usuario = 3
		//$expo = Evento::buscaEvento($nombre_expo,'Expo');
		//$id_expo = $expo->id();
		$app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
		$query = sprintf("SELECT * FROM Entradas WHERE id_evento=%d AND id_usuario=%d", $id_expo ,$this->id);
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
			$result = $rs->num_rows;
        
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
		if($result==0){
			return false;
		}else{
			return true;
		}
	}
	
	public function exposConEntrada(){
		//SELECT * FROM `eventos` EV,`entradas` EN WHERE EV.id=EN.id_evento AND EN.id_usuario=3
		$query = sprintf("SELECT * FROM Eventos EV, Entradas EN WHERE EV.id=EN.id_evento AND EN.id_usuario=%d", $this->id);
		$obras = self:: consulta($query);
		return $obras;
	}
	
	public function likeDado($id_obra){
		//SELECT * FROM `entradas` WHERE id_evento = 3 AND id_usuario = 3
		//$expo = Evento::buscaEvento($nombre_expo,'Expo');
		//$id_expo = $expo->id();
		$app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
		$query = sprintf("SELECT * FROM Likes WHERE id_obra=%d AND id_usuario=%d", $id_obra ,$this->id);
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
			$result = $rs->num_rows;
        
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
		if($result==0){
			return false;
		}else{
			return true;
		}
	}
	
}
