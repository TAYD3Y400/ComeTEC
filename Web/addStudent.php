<?php
$idEquipo=$_GET['ID'];
// Verificamos si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtenemos los datos del formulario
    $identification = $_POST['identificacion'];
    $name = $_POST['name'];
    $lastname1 = $_POST['lastname1'];
    $lastname2 = $_POST['lastname2'];
    $age = $_POST['age'];
    $email = $_POST['mail'];
    $lastname = $lastname1 . " " . $lastname2;

    // Aquí podrías validar que los datos sean correctos antes de guardarlos en la base de datos

    // Conectamos a la base de datos (reemplaza estos valores por los tuyos)
    include "includes/Conexion.php";
    $conn=conectar();

    // Verificamos si hay algún error en la conexión
    if ($conn->connect_error) {
        die("Error de conexión a la base de datos: " . $conn->connect_error);
    }

    // Insertamos los datos en la base de datos (aquí podrías encriptar la contraseña antes de guardarla)
    $sqlStudent = "INSERT INTO estudiante (nombre, apellidos, identificacion) VALUES ('$name', '$lastname', '$identification')";
    if ($conn->query($sqlStudent) === TRUE) {
        // Obtener id de inserción anterior
        $idEstudiante = $conn->insert_id;
        // Insertamos los datos en la base de datos (aquí podrías encriptar la contraseña antes de guardarla)
        $sqlStudentXTeam = "INSERT INTO estudiantexequipo (estudianteID, equipoID) VALUES ('$idEstudiante', '$idEquipo')";
        if ($conn->query($sqlStudentXTeam) === TRUE) {
            // Quiero un alert que diga que el estudiante ha sido registrado correctamente
            echo "<script type='text/javascript'>alert('El estudiante ha sido registrado correctamente');</script>";
            // Redireccionar a la página del equipo 
            echo '<script>window.location.href = "equipo.php?ID=' . $idEquipo . '";</script>';
        } else {
            // Quiero un alert que diga que el estudiante no ha sido registrado correctamente
            echo "<script type='text/javascript'>alert('El estudiante no ha sido registrado correctamente');</script>";
            echo '<script>window.location.href = "equipo.php?ID=' . $idEquipo . '";</script>';
            // Mostrar error en consola 
            echo "Error: " . $sqlStudent . "<br>" . $conn->error;
        }
    } else {
        // Quiero un alert que diga que el estudiante no ha sido registrado correctamente
        echo "<script type='text/javascript'>alert('El estudiante no ha sido registrado correctamente');</script>";
        echo '<script>window.location.href = "equipo.php?ID=' . $idEquipo . '";</script>';
        // Mostrar error en consola 
        echo "Error: " . $sqlStudent . "<br>" . $conn->error;
    }

    // Cerramos la conexión a la base de datos
    $conn->close();
}
?>
