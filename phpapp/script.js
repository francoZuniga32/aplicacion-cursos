
function inscribirse() {
        if (
                $('#dni').val() != "" &&
                $('#nombre').val() != "" &&
                $('#apellido').val() != "" &&
                $('#genero').val() != "" &&
                $('#fechanacimiento').val() != "" &&
                $('#curso').val() != "") {

                $("#respuesta").empty();
                var parametros = {
                        dni: $('#dni').val(),
                        nombre: $('#nombre').val(),
                        apellido: $('#apellido').val(),
                        genero: $('#genero').val(),
                        fechanacimiento: $('#fechanacimiento').val(),
                        curso: $('#curso').val()
                }
                console.log(parametros);
                $.ajax({
                        data: parametros, //datos que se envian a traves de ajax
                        url: 'form.php', //archivo que recibe la peticion
                        type: 'post', //método de envio
                        beforeSend: function () {
                                $("#respuesta").html("<div class=\"spinner-border text-primary\" role=\"status\"><span class=\"sr-only\">Loading...</span></div>");
                        },
                        success: function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                                $("#respuesta").html(response);
                        }
                });
        }else{
                alert('no completo el formulario adecuadamente');
        }
}