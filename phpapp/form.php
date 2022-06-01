<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

require_once("coneccion.php");
require_once("consulta.php");
require_once("Modelos/personas.php");
require_once("Modelos/cursos.php");

$PERSONA = new Persona();
$CURSO = new Curso();

if ($_POST['dni'] && $_POST['nombre'] && $_POST['apellido'] && $_POST['genero'] != "" && $_POST['fechanacimiento'] && $_POST['curso']) {
    $consulta = new CONSULTA();
    $dni = intval($_POST['dni']);
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $genero = intval( $_POST['genero']);
    $fechanacimiento = $_POST['fechanacimiento'];
    $legajo = $_POST['curso'];

    $persona = $PERSONA->persona($dni);
    
    $curso = $consulta->getConsulta("SELECT * FROM Cursos WHERE legajo = '$legajo'");
    
    if (empty($persona) == 1) {
        $crearpersona = $PERSONA->crear($dni,$nombre, $apellido, $genero, $fechanacimiento, null, null);
        $persona = $PERSONA->persona($dni);
    }
    if ($persona[0]['curso_individual'] == null && $curso[0]['modalidad'] == 0) {
        $actualizar_curso = $consulta->getConsulta("UPDATE `Personas` SET `curso_individual`='$legajo' WHERE dni = '$dni'");
        ?>
            <div class="alert alert-success" role="alert">
                Se ha registado con exito en el curso: <?php echo $curso[0]['nombre'] ?>
            </div>
        <?php
    } else if ($persona[0]['curso_grupal'] == null && $curso[0]['modalidad'] != 0) {
        $actualizar_curso = $consulta->getConsulta("UPDATE `Personas` SET `curso_grupal`='$legajo' WHERE dni = '$dni'");
        ?>
            <div class="alert alert-success" role="alert">
                Se ha registado con exito en el curso: <?php echo $curso[0]['nombre'] ?>
            </div>
        <?php
    } else {
        ?>
            <div class="alert alert-danger" role="alert">
                No se ha podido registrar en el curso: <?php echo $curso[0]['nombre'] ?> Ya que ya esta inscipto a otro
            </div>
        <?php
    }
} else {
    echo "datos mal proporcionados vuelva a revisar el formulario";
}

?>