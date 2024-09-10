<?php
// Verificamos si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtenemos los datos del formulario
    $testname = $_POST['testname'];
    $testgrade = $_POST['testgrade'];
    $dia = $_POST["dia"];
    $mes = $_POST["mes"];
    $anio = $_POST["anio"];

    $fecha = "$anio-$mes-$dia";
    $fecha = date('Y-m-d', strtotime($fecha));


    // Aquí podrías validar que los datos sean correctos antes de guardarlos en la base de datos

    // Conectamos a la base de datos (reemplaza estos valores por los tuyos)
    include "includes/Conexion.php";
    $conn=conectar();

    // Verificamos si hay algún error en la conexión
    if ($conn->connect_error) {
        die("Error de conexión a la base de datos: " . $conn->connect_error);
    }

    // Insertamos los datos en la base de datos (aquí podrías encriptar la contraseña antes de guardarla)
    $sql = "INSERT INTO examen (gradoID, nombre, fechaEjecucion) VALUES ('$testgrade', '$testname', '$fecha')";
    if ($conn->query($sql) === TRUE) {
        // Quiero un alert que diga que el examen ha sido registrado correctamente
        echo "<script type='text/javascript'>alert('El examen ha sido registrado correctamente $fecha');</script>";
        echo "<script>window.location.href = 'gestionarExamen.php';</script>";
    } else {
        // Quiero un alert que diga que el examen no ha sido registrado correctamente
        echo "<script type='text/javascript'>alert('El examen no ha sido registrado correctamente');</script>";
    }

    // Cerramos la conexión a la base de datos
    $conn->close();
}
?>
