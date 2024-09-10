<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Editar examen</title>
	<link rel="stylesheet" type="text/css" href="css/registerAdmin.css">
</head>
<link rel="stylesheet" href="css/estilos.css" />
<?php
		$idDistractor=$_GET['ID'];
        $Text=$_GET['Text'];
        $Valor=$_GET['Valor'];

        echo "<script> window.addEventListener('DOMContentLoaded', (event) => {";
        if ($Valor == "Correcta") {
            echo "document.getElementById('correcta').value = 1;";
        } else {
            echo "document.getElementById('correcta').value = 0;";
        }
        echo "}); </script>";
?>


<body>
    <div class="wrapper">
    <nav class="menu-paginas">
            <div class="mi-lista-unica" style="text-align:center;">
                <p class="nombre">Respuesta Correcta</p>
                <textarea id="alterText" name="nombre_texto" rows="4" cols="50"><?php echo $Text; ?></textarea>
                <div class="form-group">
                    <label for="correcta">Veracidad:</label>
                    <select id="correcta" name="correcta">
                        <?php
                            echo "<option value='0'>Incorrecta</option>";
                            echo "<option value='1'>Correcta</option>";
                        ?>
                    </select>
                </div>
                <div>
                    <button class="btnEncabezado" type="button" onclick="confirmAlter('<?php echo $idDistractor; ?>'); return false;">Guardar cambios</button>
                </div>

            </div>
        </nav>
	</div>
    <script>
        function confirmAlter(distractorID, texto) {
        var texto = document.getElementById("alterText").value;
        // Crear un objeto XMLHttpRequest
        var xhttp = new XMLHttpRequest();

        var selectElement = document.getElementById("correcta");
        var veracidad = selectElement.value;

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
        xhttp.open("POST", "modifyRightAnswer.php", true);

        // Establecer las cabeceras de la solicitud
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        // Enviar los datos al servidor
        xhttp.send("distractorID="+distractorID+"&texto=" + texto+"&veracidad="+veracidad);

        }

    </script>


</body>
</html>