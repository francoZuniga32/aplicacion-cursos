<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (!empty($_SERVER['usuario'])) {
    header('Location: admin.php');
}

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
    <div class="contendor">
        <div class="card">
            <div class="card-body">
                <form action="logincontrol.php" method="post">
                    <div class="row">
                        <label for="usuario">Usuario</label>
                        <input type="text" class="form-control" name="usuario">
                    </div>
                    <div class="row"><label for="contraseña">Contraña</label><input type="password" class="form-control" name="contraseña"></div>
                    <div class="row">
                        <button class="btn btn-primary" type="submit">login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>