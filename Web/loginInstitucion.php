<?php
    include "includes/sesionInicio.php";
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <title>Inicio de Sesión de Institución</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>
        <link rel="stylesheet" type="text/css" href="css/loginInstitution.css">
    </head>
    <?php
        include "includes/Encabezado.php";
        include "includes/errorAlert.php";
        include "includes/successAlert.php";
    ?>

    <body>

        <div class="espacio">
        </div>
        <div class="espacio">
        </div>

        <div class="login-form">
            <h1>Inicio de Sesión de Institución</h1>
            <form method="POST">

                <label for="username">Nombre de usuario</label>
                <input type="text" id="username" name="username" class="registro-input" required>

                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" class="registro-input" required>

                <input type="submit" value="Iniciar Sesión" name="Ingresar" class="registrobutton">

            </form>


            <form method="POST" action="registroInstitucion.php">
                <input type="submit" value="Registrarse" class="registrobutton">
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

        function validateData() {
            // Validation of credentials
            $username = $_POST["username"];
            $password = $_POST["password"];

            // Check if the fields are empty
            if ($username == "" || $password == "") {
                // Show error alert
                showErrorAlert("Debe llenar todos los campos solicitados", "loginInstitucion.php");
            }

            // Check if the username exists
            $conn = conectar();
            $resultado = mysqli_query(
                $conn,
                "SELECT * FROM institucion WHERE usuario = '$username' AND contrasena = '$password'"
            );
            // If the query returns a row, the username exists
            if (mysqli_num_rows($resultado) != 0) {
                // Get the id of the institution
                $row = mysqli_fetch_array($resultado);
                $id = $row['ID'];
                // Check if the institution is active
                $estado = $row['estado'];
                if ($estado == 1) {
                    // Create session variables
                    //$_SESSION['loggedin'] = true;
                    //$_SESSION['username'] = $username;
                    //$_SESSION['id'] = $id;
                    showSuccessAlert("Inicio de sesión exitoso", "institucion.php?ID=$id");
                } else {
                    // Show error alert
                    showErrorAlert("La institución no ha sido aprobada", "loginInstitucion.php");
                }
                // echo "<script>window.alert('Inicio de sesión exitoso');</script>";
                // Show success alert
                //showSuccessAlert("Inicio de sesión exitoso", "institucion.php?ID=$id");   
                
                // Redireccionamos a la página de institución llamado institución.php pasando por parámetro el nombre de usuario
                // echo '<script>window.location.href = "institucion.php?ID=' . $id . '";</script>';
                //echo '<script>window.location.href = "institucion.php?";</script>';
            } else {
                // Show error alert
                showErrorAlert("El usuario o la contraseña son incorrectos", "loginInstitucion.php");
                // echo "<script>window.alert('El usuario o la contraseña son incorrectos');</script>";
            }
            mysqli_close($conn);
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Ingresar'])) {
            validateData();
        }
    ?>

    <script type="text/javascript">
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

    </script>

</html>