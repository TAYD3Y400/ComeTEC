<?php
    include "includes/Conexion.php";
    // Conectarse a la base de datos
    $conn = conectar();
    // Obtener el ID del registro a eliminar
    $distractorID = $_POST['distractorID'];
    $texto = $_POST['texto'];

    $query = "UPDATE Distractor SET distractor='$texto' WHERE ID=$distractorID";
    if (mysqli_query($conn, $query)) {
        echo "success";
    } else {
        echo "Error updating row: ".mysqli_error($conn);
    }

    mysqli_close($conn);
?>
