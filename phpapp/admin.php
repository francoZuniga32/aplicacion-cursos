<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracion</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="main.css">
</head>
<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);
require("coneccion.php");
require("consulta.php");
include('Modelos/personas.php');
require('Modelos/cursos.php');
require("Componentes/card.php");

$persona = new Persona();

?>

<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Cursos</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse spacearaund" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/cursos.php">Cursos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/">Inscripcion</a>
                    </li>
                </ul>
                <a class="btn btn-primary" href="/login.php">Login</a>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm" id="inscriptos">
                <div class="row">
                    <div class="col">
                        <h1>Inscriptos</h1>
                    </div>
                    <div class="col">
                        <button class="btn btn-primary" onclick="simular()" title="esto carga usuario de una web a la base de datos">simular carga</button>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-md-3 g-3">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Hombres</h5>
                                <p><?php echo $persona->count_hombres(); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Mujeres</h5>
                                <p>cantidad <?php echo $persona->count_mujeres(); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Otros</h5>
                                <p><?php echo $persona->count_otros(); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Mayores de Edad</h5>
                                <p><?php echo $persona->count_mayores(); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Menores de Edad</h5>
                                <p><?php echo $persona->count_menores(); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm"></div>
            </div>
        </div>
        <div class="row" class="cursos">
            <div class="col">
                <h1>Cursos</h1>
            </div>
            <div class="col">
                <?php
                include('./Componentes/formcursoscomponent.php');
                ?>
            </div>
        </div>
        <div class="row">
            <span>los cursos son actualizados y el que es mas concurrido es el primero en mostrarse</span>
        </div>
        <div class="row" id="mensajes">

        </div>
        <div class="row cursos" id="cursos">
            <?php

            $cursos = new Curso();

            $cursos->card_admin();
            ?>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
        <script>
            $(document).ready(function() {

                setInterval(() => {
                    console.log('cargando');
                    $('#inscriptos').load(' #inscriptos');
                    $("#cursos").load(' #cursos')
                }, 1500);
            })

            function cargarcurso() {
                $("#mensajes").empty();
                var parametros = {
                    nombre: $('#nombre').val(),
                    descripcion: $('#descripcion').val(),
                    modalidad: $('#modalidad').val()
                }
                console.log(parametros);
                $.ajax({
                    data: parametros, //datos que se envian a traves de ajax
                    url: 'formcursos.php', //archivo que recibe la peticion
                    type: 'post', //método de envio
                    success: function(response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $("#cursos").load(' #cursos');
                        $('#mensajes').html(response);
                    }
                });
            }

            async function simular() {
                try {
                    var personas = await axios.get('http://weblogin.muninqn.gov.ar/api/examen');
                    var personas = personas.data.value;

                    var countcursos = <?= $cursos->count_cursos() - 1; ?>;
                    if (countcursos >= 0) {

                        for (let i = 0; i < personas.length; i++) {
                            var persona = personas[i];
                            var fechanacimiento = moment(persona.fechaNacimiento).format('YYYY-MM-DD')
                            var objeto = {
                                nombre: persona.razonSocial.split(', ')[1],
                                apellido: persona.razonSocial.split(', ')[0],
                                dni: persona.dni,
                                genero: persona.genero.id,
                                fechanacimiento: fechanacimiento,
                                curso: await aleatorio_entre(0, countcursos)
                            };
                            console.log(objeto);
                            await cargar_personas(objeto);
                            await sleep(2000);
                        }
                    }else{
                        alert("Necesita al menos un curso");
                    }

                } catch (error) {
                    console.log(error);
                }
            }

            async function cargar_personas(persona) {
                $.ajax({
                    data: persona, //datos que se envian a traves de ajax
                    url: 'form.php', //archivo que recibe la peticion
                    type: 'post', //método de envio
                    success: function(response) { //una vez que el archivo recibe el request lo procesa y lo devuelve

                    }
                });
            }

            function format(day) {
                if (day < 10) {
                    return "0".day;
                }
            }

            function sleep(ms) {
                return new Promise((resolve) => {
                    setTimeout(resolve, ms);
                });
            }

            async function aleatorio_entre(min, max) {
                return Math.floor((Math.random() * (max - min)) + min);
            }
        </script>
</body>

</html>