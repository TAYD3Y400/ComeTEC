<?php
$idInstitucion=$_GET['ID'];
// Verificamos si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtenemos los datos del formulario
    $teamname = $_POST['teamname'];
    $teamgrade = $_POST['teamgrade'];

    // Generate a random code for the team
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    // I want the lenght to be a random between 6 and 10
    $length = rand(6, 10);
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
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
    $sql = "INSERT INTO equipo (institucionID, gradoID, nombre, codigo) VALUES ('$idInstitucion', '$teamgrade', '$teamname', '$randomString')";
    if ($conn->query($sql) === TRUE) {
        // Quiero un alert que diga que el equipo ha sido registrado correctamente
        echo "<script type='text/javascript'>alert('El equipo ha sido registrado correctamente');</script>";
        // echo "<script>window.alert('Inicio de sesión exitoso');</script>";
        echo '<script>window.location.href = "gestionEquipos.php?ID=' . $idInstitucion . '";</script>';
    } else {
        // Quiero un alert que diga que el equipo no ha sido registrado correctamente
        echo "<script type='text/javascript'>alert('El equipo no ha sido registrado correctamente');</script>";
    }

    // Cerramos la conexión a la base de datos
    $conn->close();
}
?>
