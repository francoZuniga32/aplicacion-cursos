<!DOCTYPE html>
<html lang="en">
<?php 
require("coneccion.php");
require("consulta.php");
include('Modelos/personas.php');
require('Modelos/cursos.php');
require("Componentes/card.php");
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <link rel="stylesheet" href="main.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Cursos</a>
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
    <div class="container">
        <h1>Inscripcion</h1>
        <div class="row" id="respuesta">

        </div>
        <div class="row">
            <label for="dni" class="form-label">Dni:</label>
            <input type="text" class="form-control" id="dni" placeholder="" required>
        </div>
        <div class="row">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre" placeholder="" required>
        </div>
        <div class="row">
            <label for="apellido" class="form-label">Apellido:</label>
            <input type="text" class="form-control" id="apellido" placeholder="" required>
        </div>
        <div class="row">
            <label for="genero" class="form-label">Genero:</label>
            <select class="form-select" name="" id="genero">
                <option value="0">Masculino</option>
                <option value="1">Femenino</option>
                <option value="2">Otro</option>
            </select>
        </div>
        <div class="row">
            <label for="fechanacimiento">Fecha de Nacimiento:</label>
            <input type="date" class="form-control" id="fechanacimiento" required>
        </div>
        <div class="row">
            <label for="curso">Curso:</label>
            <select name="" id="curso" class="form-select">
                <?php
                $cursos = new Curso();
                $cursos->select();
                ?>
            </select>
        </div>
        <br>
        <div class="row">
            <button class="btn btn-primary" onclick="inscribirse()">Inscribirse</button>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>