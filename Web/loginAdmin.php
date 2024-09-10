<?php

include "includes/errorAlert.php";
include "includes/successAlert.php";

?>

<?php

// Verificamos si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtenemos los datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the fields are empty
    if ($username == "" || $password == "") {
        // Show error alert
        showErrorAlert("Debe llenar todos los campos solicitados", "loginInstitucion.php");
    }

    // Aquí podrías validar que los datos sean correctos antes de guardarlos en la base de datos

    // Conectamos a la base de datos (reemplaza estos valores por los tuyos)
    include "includes/Conexion.php";
    $conn=conectar();

    // Verificamos si hay algún error en la conexión
    if ($conn->connect_error) {
        die("Error de conexión a la base de datos: " . $conn->connect_error);
    }

    // Insertamos los datos en la base de datos (aquí podrías encriptar la contraseña antes de guardarla)
    $sql = "SELECT * FROM administrador WHERE usuario = '$username' AND contrasena = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        showSuccessAlert("Inicio de sesión exitoso", "administrador.php");
    } else {
        
        // Create alert to say that the user or the password are incorrect
        showErrorAlert("El usuario o la contraseña son incorrectos", "loginAdminForm.php");
        // echo "<script type='text/javascript'>alert('El usuario o la contraseña son incorrectos');</script>";
        // echo "<script>location.href='loginAdminForm.php';</script>";
    }

    // Cerramos la conexión a la base de datos
    $conn->close();

}
?>
