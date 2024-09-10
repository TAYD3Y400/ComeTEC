<?php
    include "includes/sesionInicio.php";
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <title>Inicio de Prueba por Equipo</title>
        <link rel="stylesheet" type="text/css" href="css/loginAdmin.css">
    </head>
    <?php
        include "includes/Encabezado.php";
    ?>

    <body>

        <div class="espacio">
        </div>
        <div class="espacio">
        </div>

        <div class="registro-form">
            <h2>Inicio de Prueba</h2>
            <form method="POST">

                <label for="code">Ingrese el código del equipo:</label>
                <input type="text" id="code" name="code" class="registro-input" required>

                <input type="submit" value="Ingresar" name="Ingresar" class="registrobutton">

            </form>

        </div>
    </body>

    <div class="espacio">
    </div>

    <div class="espacio">
    </div>

    <?php
        include "includes/PiePagina.php";
    ?>


    <?php

        function ValidarDatos()
        {
            // Validación de credenciales
            $code = $_POST["code"];

            if ($code == "" ) {
                return false;
            }

            $conn = conectar();
            $resultado = mysqli_query(
                $conn,
                "SELECT * FROM equipo WHERE codigo = '$code'"
            );

            if (mysqli_num_rows($resultado) != 0) {
                // Tomar el ID del equipo
                $row = mysqli_fetch_array($resultado);
                $id = $row['ID'];
                $nombre = $row['nombre'];
                echo "<script>window.alert('Inicio de prueba exitoso, equipo: $nombre');</script>";
                header("Location: seleccionarExamen.php?ID=$id");
            } else {
                echo "<script>window.alert('Contreseña o usuario incorrecto.');</script>";
            }
            mysqli_close($conn);
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Ingresar'])) {
            ValidarDatos();
        }
    ?>

    <script type="text/javascript">
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

    </script>

</html>