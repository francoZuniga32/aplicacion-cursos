<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

require_once("coneccion.php");
require_once("consulta.php");


$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];
$consulta = new CONSULTA();

$usuario = $consulta->getConsulta("SELECT * FROM Administrador WHERE usuario = '$usuario' AND contrasenia = '$contraseña' ");

if(empty($usuario)){
    header('Location: login.php');
}else{
    session_start(); 
    $_SERVER['usuario'] = $usuario[0];
    header('Location: admin.php');
}

?>