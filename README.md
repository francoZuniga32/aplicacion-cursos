# Aplicacion de cursos

## Instalacion
### Opcion 1:
Teniendo instalado WAMP (Windows Apache Mysql Php) o LAMP (Linux Apache Mysql Php) crea una carpeta dentro del directorio de proyectos de apache, y luego carge la el archivo cursos.sql en su base de datos. edite el archivo coneccion.php se la siguiente manera:
```php
class coneccion{
    //la clase de PDO conecciona  la BD
    
    public function getConneccion(){
      $usuario = "";//el usurio
      $contraseña = "";//la contraseña
      $hostName = "localhost";//el nombre del host
      $baseDeDatos = "cursos";//la base de getDatos
      $coneccion = new PDO("mysql:host=$hostName;dbname=$baseDeDatos;", $usuario, $contraseña);
      return $coneccion;
    }
  }
```

donde $usaurio es el usaurio de la base de datos $contraseña es la contraseña de la misma, localhost no es necesario modificarlo y la base de datos es cursos.

luego podra probar la aplicacion

### Opcion2:
montar un contenedor de docker con lamp ya instalado
```bash
 sudo docker run -p "80:80" -v ${PWD}/phpapp:/app mattrayner/lamp:latest-1804
```
donde phppp es el subdirectorio donde esta parado el interprete osea ${pwd}/phpapp es la ruta de nuestra aplicacion. luego de esto tenemos que modificar el archivo coneccion.php con el usuario y la contraseña que se crea al montar el contenedor.
si colocamos al opcion -d y queremos saber cual es este usuario y contraseña podemos ejecutar:
```bash
sudo docker ps 
sudo docker logs <container-id>
```

con docker ps vemos el container id del contenedor que montamos y con docker logs <container-id> vemos los logs del contenedor
vera un contenido como este:
```bash
Editing MySQL config
=> An empty or uninitialized MySQL volume is detected in /var/lib/mysql
=> Installing MySQL ...
=> Done!
=> Waiting for confirmation of MySQL service startup
=> Creating MySQL admin user with random password
ERROR 1133 (42000) at line 1: Can't find any matching row in the user table
=> Done!
========================================================================
You can now connect to this MySQL Server with J4eLJ4KTbez4

    mysql -uadmin -pJ4eLJ4KTbez4 -h<host> -P<port>

Please remember to change the above password as soon as possible!
MySQL user 'root' has no password but only allows local connections

enjoy!
========================================================================
Starting supervisord
```

nos dira cual es el usaurio y la contraseña del contenedor. el usuario siempre es admin.
podra acceder a phpMyAdmin desde el navegar y configurar la base de datos.

## Funcionalidades:
- [x] Formulario de Inscripcion a Cursos
- [x] Muestra de Cursos
- [x] Login de administrador
- [x] Monitorizador de Inscriptos (cuandos hombres, mujeres, y otros hay ademas de las cantidad de menores y mayores de edad )
- [x] Cargar un Curso
- [x] Simular la Carga de Inscriptos desde la [web](http://weblogin.muninqn.gov.ar/api/examen)
- [x] Carga en tiempo real 5seg de expera.
- [ ] Editar un Curso
- [ ] Eliminar un Curso
- [ ] Solicitar baja de un Curso por Parte del Inscripto
- [ ] Manjear las consultas mediante transacciones ya que si tenemos mucha concurrencia se pierden insercciones (problemas de manejos de consurrencia) Esto es importante para mantener la integridad de los datos.

## Puntos a mejorar
1. Como la primera solicitud de reportes no la entendi muy claramente, hice que el sistema ordenara y actualizara la lista de cursos colocando primero el que tiene mas inscriptos.
2. No pude completar los ABM de los inscriptos y de los cursos.
3. El sistema no contempla un diseño que atraiga a las personas a inscribirse ni detalla que cosas se ven en cada curso. No existen estilos propios.

