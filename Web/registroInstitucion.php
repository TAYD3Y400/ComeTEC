<!DOCTYPE html>
<html lang="en">

<?php
    include "includes/Encabezado.php";
    include "includes/errorAlert.php";
    include "includes/successAlert.php";
?>

<body>
    <html>
        <head>
            <title>Formulario de Registro</title>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>
        </head>
        <body>
            <form class="registro-form" method="post"
                action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?t=<?php echo time(); ?>">

                <h1>Registro de Institución</h1>

                <label for="nombre">Nombre de la institución</label>
                <input type="text" id="nombre" name="nombre" class="registro-input" required>

                <label for="nombreResponsable">Nombre del responsable de la institución</label>
                <input type="text" id="nombreResponsable" name="nombreResponsable" class="registro-input" required>

                <label for="correo">Correo electrónico</label>
                <input type="email" id="correo" name="correo" class="registro-input" required>

                <label for="telefono">Teléfono</label>
                <input type="tel" id="telefono" name="telefono" class="registro-input" required>

                <label for="contraseña">Nombre de usuario</label>
                <input type="text" id="usuario" name="usuario" class="registro-input" required>

                <label for="contraseña">Contraseña</label>
                <input type="password" id="contraseña" name="contraseña" class="registro-input" required>

                <label for="confirmar-contraseña">Confirmar la contraseña</label>
                <input type="password" id="confirmarcontraseña" name="confirmarcontraseña" class="registro-input" required>

                <input type="submit" value="Registrarse" name="Registrarse" class="registrobutton">
            </form>
        </body>
    </html>
    
    <div class="espacio"></div>
    <div class="espacio"></div>

    <?php
        include "includes/PiePagina.php";
    ?>
    
    <?php
        function registerInstitution() {
            // Get the data to insert
            $nombre = $_POST["nombre"];
            $nombreResponsable = $_POST["nombreResponsable"];
            $correo = $_POST["correo"];
            $telefono = $_POST["telefono"];
            $usuario = $_POST["usuario"];
            $contraseña = $_POST["contraseña"];
            $contraseña2 = $_POST["confirmarcontraseña"];
            $estado = false;

            // Check if the passwords match
            if ($contraseña == $contraseña2) {
                // Connect to database
                $conn = conectar();
                // Query to check if username already exists
                $selectQuery = "SELECT * FROM institucion WHERE usuario = '$usuario'";
                // Execute the query
                $result = $conn->query($selectQuery);
                // If the query returns cero rows, then the username does not exist
                if ($result->num_rows <= 0) {
                    // Define the query to insert data
                    $insertQuery = "INSERT INTO institucion (nombre, nombreResponsable, correoElectronico, telefono, usuario, contrasena, estado) 
                                    VALUES ('$nombre', '$nombreResponsable', '$correo', '$telefono', '$usuario', '$contraseña', '$estado')";
                    // Execute the query
                    $result = $conn->query($insertQuery);
                    // Check if the query was executed successfully
                    if ($result) {
                        showSuccessAlert("La solicitud de registro ha sido enviada exitosamente", "loginInstitucion.php");
                    } else {
                        showErrorAlert("Ha ocurrido un error al registrar la institución", "registroInstitucion.php");
                    }
                } else {
                    $result = false;
                    showErrorAlert("El nombre de usuario ya existe", "registroInstitucion.php");
                }
                // Close the connection to the database
                mysqli_close($conn);
            } else {
                $result = false;
                showErrorAlert("Las contraseñas ingresadas no coinciden", "registroInstitucion.php");
            }
            return $result;
        }

        // Check if the form was submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Registrarse'])) {
            // Call the function to register the institution
            $registered = registerInstitution();
            // Check if the institution was not registered successfully
            if (!$registered) {
                echo "<script>document.getElementById('nombre').value = '" . $_POST['nombre'] . "';</script>";
                echo "<script>document.getElementById('nombreResponsable').value = '" . $_POST['nombreResponsable'] . "';</script>";
                echo "<script>document.getElementById('correo').value = '" . $_POST['correo'] . "';</script>";
                echo "<script>document.getElementById('telefono').value = '" . $_POST['telefono'] . "';</script>";
                echo "<script>document.getElementById('usuario').value = '" . $_POST['usuario'] . "';</script>";
                echo "<script>document.getElementById('contraseña').value = '" . $_POST['contraseña'] . "';</script>";
                echo "<script>document.getElementById('confirmarcontraseña').value = '" . $_POST['confirmarcontraseña'] . "';</script>";   
            }
        } 
    ?>
</body>

<script type="text/javascript">
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<!-- Enlace al archivo CSS -->
<link rel="stylesheet" href="css/registerInstitution.css">



