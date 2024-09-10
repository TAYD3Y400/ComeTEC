<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Editar examen</title>
	<link rel="stylesheet" type="text/css" href="css/registerAdmin.css">
</head>
<link rel="stylesheet" href="css/estilos.css" />
<?php
		$examID=$_GET['examID'];
?>
<body>
    <div class="wrapper">
    <nav class="menu-paginas">
            <div class="mi-lista-unica" style="text-align:center;">
                <p class="nombre">Nueva pregunta</p>
                <textarea id="alterText" name="nombre_texto" rows="13" cols="80"></textarea>

                <p class="nombre">Respuesta correcta</p>
                <textarea id="correctResponse" name="nombre_texto" rows="5" cols="80"></textarea>

                <div>
                    <button class="btnEncabezado" type="button" onclick="confirmAlter('<?php echo $examID; ?>'); return false;">Guardar cambios</button>
                </div>

            </div>
        </nav>
	</div>
    <script>
        function confirmAlter(examID) {
        var texto = document.getElementById("alterText").value;
        var texto2 = document.getElementById("correctResponse").value;
        // Crear un objeto XMLHttpRequest
        var xhttp = new XMLHttpRequest();

        // Definir la función que se ejecutará cuando se reciba una respuesta del servidor
        xhttp.onreadystatechange = function() {
            // Verificar que la solicitud AJAX se completó correctamente
            if (this.readyState == 4 && this.status == 200) {
            // Verificar que la respuesta del servidor esté en el formato esperado
            if (this.responseText.trim() === 'success') {
                // La actualización de la base de datos fue exitosa
                alert('La actualización fue exitosa.');

                window.close(); // Cierra la ventana emergente

                // Obtener una referencia a la ventana padre
                var parentWindow = window.opener;

                // Actualizar el contenido de la ventana padre
                window.opener.location.reload();
            } else {
                // La actualización de la base de datos falló
                alert('La actualización ha fallado: ' + this.responseText);
                // Deja la ventana emergente abierta para que el usuario pueda hacer correcciones
            }
            }
        };

        // Abrir una conexión con el servidor
        xhttp.open("POST", "addQuestionBD.php", true);

        // Establecer las cabeceras de la solicitud
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        // Enviar los datos al servidor
        xhttp.send("examID="+examID+"&texto=" + texto+"&texto2=" + texto2);

        }

    </script>


</body>
</html>