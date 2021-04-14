<?php

require_once __DIR__.'/config.php';


class Usuario
{

  public static function login($username, $password)
  {
    $user = self::buscaUsuario($username);
    if ($user && $user->compruebaPassword($password)) {
      $conn = getConexionBD();
      $query = sprintf("SELECT R.nombre FROM RolesUsuario RU, Roles R WHERE RU.rol = R.id AND RU.usuario=%s", $conn->real_escape_string($user->id));
      $rs = $conn->query($query);
      if ($rs) {
        while($fila = $rs->fetch_assoc()) { 
          $user->addRol($fila['nombre']);
        }
        $rs->free();
      }
      return $user;
    }    
    else{
      print "La contraseña es incorrecta.";
    }
    return false;
  }

  public static function signup($username, $password){
    $user = self::buscaUsuarioSignup($username);
    if(!$user){
      $conn = getConexionBD();
      $query = sprintf("INSERT INTO usuario (id_usuario, nick, nombre, passwd, email, es_admin, es_artista, es_premium, es_juez) VALUES (NULL, NULL, '%s', '%s', NULL, NULL, NULL, NULL, NULL);", $username, $password);
      $rs = $conn->query($query);
      print "Usuario introducido correctamente.";
      return true;
    }
    else{
      print "Ya hay un usuario registrado con esos datos!";
      return false;
    }
    

  }


  public static function buscaUsuario($username)
  {
    $conn = getConexionBD();
    $query = sprintf("SELECT * FROM usuario WHERE nombre='%s'", $conn->real_escape_string($username));
    $prueba = $conn->real_escape_string($username);
    
    echo "---$username---";
    echo "---$prueba---";
    $rs = $conn->query($query);
    if ($rs && $rs->num_rows == 1) {
      $fila = $rs->fetch_assoc();
      $user = new Usuario($fila['id_usuario'], $fila['nombre'], $fila['passwd']);
      $rs->free();

      return $user;
    }
    else{
      print "No se encontro el usuario.";
    }
    return false;
  }


public static function buscaUsuarioSignup($username){
  $conn = getConexionBD();
  $query = sprintf("SELECT * FROM usuario WHERE nombre='%s'", $conn->real_escape_string($username));
  $rs = $conn->query($query);
  if($rs->num_rows > 0){
    $rs->free();
    return true;
  }
  else{
    $fila = $rs->fetch_assoc();
    $user = new Usuario($fila['id_usuario'], $fila['nombre'], $fila['passwd']);
    $rs->free();
    return false;
  }
}
  private $id;

  private $username;

  private $password;

  private $roles;

  private function __construct($id, $username, $password)
  {
    $this->id = $id;
    $this->username = $username;
    $this->password = $password;
    $this->roles = [];
  }

  public function id()
  {
    return $this->id;
  }

  public function addRol($role)
  {
    $this->roles[] = $role;
  }

  public function roles()
  {
    return $this->roles;
  }

  public function username()
  {
    return $this->username;
  }

  public function compruebaPassword($password)
  {
   // $comp = $password == $this->password;
    //print "$comp";
    //return password_verify($password, $this->password);
    return ($password == $this->password);
  }

  public function cambiaPassword($nuevoPassword)
  {
    $this->password = password_hash($nuevoPassword, PASSWORD_DEFAULT);
  }
}
