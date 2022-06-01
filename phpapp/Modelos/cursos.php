<?php 
class Curso{
    public $consulta;
    public function __construct(){
        $this->consulta = new CONSULTA();
    }

    public function card(){
        $cursos = $this->consulta->getConsulta("SELECT * FROM Cursos ");

        $card = new Card();

        foreach ($cursos as $curso) {
            $card->cardCurso($curso['nombre'], $curso['descripcion'], $curso['modalidad']);
        }
    }

    public function card_admin(){
        $cursos = $this->consulta->getConsulta("SELECT Cursos.*, COUNT(Personas.curso_individual) as inscriptos FROM Cursos LEFT JOIN Personas ON Cursos.legajo = Personas.curso_individual WHERE Cursos.modalidad = 0 GROUP BY Cursos.legajo UNION SELECT Cursos.*, COUNT(Personas.curso_grupal) as inscriptos FROM Cursos LEFT JOIN Personas ON Cursos.legajo = Personas.curso_grupal WHERE Cursos.modalidad = 1 GROUP BY Cursos.legajo ORDER BY inscriptos DESC");

        $card = new Card();

        foreach ($cursos as $curso) {
            $card->card_curso_admin($curso['nombre'], $curso['descripcion'], $curso['modalidad'], $curso['inscriptos']);
        }
    }

    public function select(){
        $cursos = $this->consulta->getConsulta("SELECT * FROM Cursos");

        foreach($cursos as $curso){
            echo "<option value=\"".$curso['legajo']."\" >".$curso['nombre']."</option>"; 
        }
    }

    public function cargar($nombre, $descripcion, $modalidad){
        $this->consulta->getConsulta("INSERT INTO `Cursos` (`legajo`, `nombre`, `descripcion`, `modalidad`) VALUES (NULL, '$nombre', '$descripcion', '$modalidad') ");
    }

    public function get_curso($nombre){
        return $this->consulta->getConsulta("SELECT * FROM Cursos WHERE nombre = '$nombre'");
    }

    public function count_cursos(){
        $retorno = $this->consulta->getConsulta("SELECT COUNT(*) FROM Cursos");
        return $retorno[0][0];
    }
}
