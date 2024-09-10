<?php
    include "includes/Conexion.php";
    // Conectarse a la base de datos
    $conn = conectar();
    $idPregunta = $_POST['idPregunta'];

    $query = "INSERT INTO Distractor(distractor) VALUES ('Distractor');";
    mysqli_query($conn, $query);

    $last_id = mysqli_insert_id($conn);

    $query = "INSERT INTO PreguntaXDistractor(preguntaID, distractorID) VALUES ('$idPregunta', $last_id);";

    if (mysqli_query($conn, $query)) {
        echo "success";
    } else {
        echo "Error updating row: ".mysqli_error($conn);
    }

    mysqli_close($conn);
?>
