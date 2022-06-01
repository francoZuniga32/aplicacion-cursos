<?php 
class Persona{
    public $consulta;

    public function __construct(){
        $this->consulta = new CONSULTA(); 
    }

    public function crear($dni, $nombre, $apellido, $genero, $fechanacimiento, $curso_individual, $curso_grupal){
        if($curso_individual != null && $curso_grupal != null){
            return $this->consulta->getConsulta("INSERT INTO `Personas` (`dni`, `nombre`, `apellido`, `genero`, `fechanacimiento`, `curso_individual`, `curso_grupal`) VALUES ('$dni', '$nombre', '$apellido', '$genero', '$fechanacimiento', '$curso_grupal') ");
        }else{
            return $this->consulta->getConsulta("INSERT INTO `Personas` (`dni`, `nombre`, `apellido`, `genero`, `fechanacimiento`, `curso_individual`, `curso_grupal`) VALUES ('$dni', '$nombre', '$apellido', '$genero', '$fechanacimiento', NULL, NULL) ");
        }
    }

    public function all(){
        return $this->consulta->getConsulta("SELECT * FROM Personas");
    }

    public function persona($dni){
        return $this->consulta->getConsulta("SELECT * FROM Personas WHERE dni = '$dni'");
    }

    public function count_mujeres(){
        $retorno = $this->consulta->getConsulta("SELECT COUNT(*) FROM Personas WHERE genero = 1 ");
        return $retorno[0][0];
    }

    public function count_hombres(){
        $retorno = $this->consulta->getConsulta("SELECT COUNT(*) FROM Personas WHERE genero = 0");
        return $retorno[0][0];
    }

    public function count_otros(){
        $retorno = $this->consulta->getConsulta("SELECT COUNT(*) FROM Personas WHERE genero = 2");
        return $retorno[0][0];
    }

    public function count_mayores(){
        $retorno = $this->consulta->getConsulta("SELECT COUNT(*) FROM `Personas` WHERE (DATEDIFF(CURRENT_DATE, fechanacimiento) DIV 365 ) >= 18");
        return $retorno[0][0];
    }

    public function count_menores(){
        $retorno = $this->consulta->getConsulta("SELECT COUNT(*) FROM `Personas` WHERE (DATEDIFF(CURRENT_DATE, fechanacimiento) DIV 365 ) < 18");
        return $retorno[0][0];
    }
}
?>