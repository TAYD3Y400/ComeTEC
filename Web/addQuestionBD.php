<?php
    include "includes/Conexion.php";
    // Conectarse a la base de datos
    $conn = conectar();
    // Obtener el ID del registro a eliminar
    $idExamen = $_POST['examID'];
    $texto = $_POST['texto'];
    $texto2 = $_POST['texto2'];
    $valor=25;

    // Iniciar la transacción
    mysqli_begin_transaction($conn);

    try {
        // Finalmente, eliminar el registro de la pregunta
        $stmt = mysqli_prepare($conn, "INSERT INTO Pregunta (examenID, pregunta, puntos)
        VALUES  (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "isi", $idExamen, $texto, $valor);
        mysqli_stmt_execute($stmt);

        $last_id = mysqli_insert_id($conn);
        // Eliminar los registros de respuesta y pregunta-imagen asociados a la pregunta
        $stmt = mysqli_prepare($conn, "INSERT INTO Respuesta(preguntaID, respuesta)
        VALUES  (?, ?)");
        mysqli_stmt_bind_param($stmt, "is", $last_id, $texto2);
        mysqli_stmt_execute($stmt);


        // Confirmar la transacción
        mysqli_commit($conn);
        // Cerrar la conexión a la base de datos
        mysqli_close($conn);
        // Enviar una respuesta al cliente
        http_response_code(200); // Set HTTP status code to 200 OK
        echo "success";
    } catch(Exception $e) {
        // Si ocurre un error, cancelar la transacción
        mysqli_rollback($conn);
        // Cerrar la conexión a la base de datos
        mysqli_close($conn);
        http_response_code(500);
        echo "El registro no ha podido ser añadido, hay un error con los datos";
    }
?>
