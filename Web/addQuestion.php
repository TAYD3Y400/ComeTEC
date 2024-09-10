<?php
$examenID=$_GET['ID'];
// Verificamos si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtenemos los datos del formulario
    $pregunta = $_POST['quest'];
    $puntos = $_POST['pts'];

    // Aquí podrías validar que los datos sean correctos antes de guardarlos en la base de datos

    // Conectamos a la base de datos (reemplaza estos valores por los tuyos)
    include "includes/Conexion.php";
    $conn=conectar();

    // Verificamos si hay algún error en la conexión
    if ($conn->connect_error) {
        die("Error de conexión a la base de datos: " . $conn->connect_error);
    }

    // Insertamos los datos en la base de datos (aquí podrías encriptar la contraseña antes de guardarla)
    $sqlQuest = "INSERT INTO pregunta (examenID, pregunta, puntos) VALUES ('$examenID', '$pregunta', '$puntos')";
    if ($conn->query($sqlQuest) === TRUE) {
            // alert que diga que la pregunta ha sido registrado correctamente
            echo "<script type='text/javascript'>alert('La pregunta ha sido insertada correctamente');</script>";
            // Redireccionar a la página del examen 
            echo '<script>window.location.href = "gestionarPreguntas.php?ID=' . $examenID . '";</script>';
    } else {
        // Quiero un alert que diga que el estudiante no ha sido registrado correctamente
        echo "<script type='text/javascript'>alert('La pregunta no se ha podido registrar correctamente');</script>";
        // Mostrar error en consola 
        echo "Error: " . $sqlQuest . "<br>" . $conn->error;
    }

    // Cerramos la conexión a la base de datos
    $conn->close();
}
?>
