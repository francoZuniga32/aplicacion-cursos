<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

require_once("coneccion.php");
require_once("consulta.php");
require_once("Modelos/cursos.php");

if($_POST['nombre'] && $_POST['descripcion'] && $_POST['modalidad'] != ""){
    $CURSO = new Curso();

    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $modalidad = intval($_POST['modalidad']);

    $curso = $CURSO->get_curso($nombre);
    if(empty($curso) == 1){
        $curso = $CURSO->cargar($nombre, $descripcion, $modalidad);
        echo "<div class=\"alert alert-success\" role=\"alert\">
        El curso se registro con exito
      </div>
      ";
    }else{
        echo "<div class=\"alert alert-info\" role=\"alert\">
        Ya existe un curso con ese nombre
      </div>
      "; 
    }
}else{
    echo "<div class=\"alert alert-danger\" role=\"alert\">
        No se pudo registrar el curso, revise el formulario
      </div>
      ";
}

?>