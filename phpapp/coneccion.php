<?php
class coneccion{
    //la clase de PDO conecciona  la BD
    
    public function getConneccion(){
      $usuario = "admin";//el usurio
      $contraseña = "j8ayISLrMjR4";//la contraseña
      $hostName = "localhost";//el nombre del host
      $baseDeDatos = "cursos";//la base de getDatos
      $coneccion = new PDO("mysql:host=$hostName;dbname=$baseDeDatos;", $usuario, $contraseña);
      return $coneccion;
    }
  }
?>