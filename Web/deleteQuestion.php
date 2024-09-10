<?php
    include "includes/Conexion.php";
    // Conectarse a la base de datos
    $conn = conectar();
    // Obtener el ID del registro a eliminar
    $preguntaID = $_POST['preguntaID'];

    // Iniciar la transacción
    mysqli_begin_transaction($conn);

    try {
        // Obtener los ID de los distractores asociados a la pregunta
        $stmt = mysqli_prepare($conn, "SELECT distractorID FROM PreguntaXDistractor WHERE preguntaID = ?");
        mysqli_stmt_bind_param($stmt, "i", $preguntaID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $distractorIDs = mysqli_fetch_all($result, MYSQLI_ASSOC);

        // Eliminar los registros de respuesta y pregunta-imagen asociados a la pregunta
        $stmt = mysqli_prepare($conn, "DELETE FROM Respuesta WHERE preguntaID = ?");
        mysqli_stmt_bind_param($stmt, "i", $preguntaID);
        mysqli_stmt_execute($stmt);

        $stmt = mysqli_prepare($conn, "DELETE FROM PreguntaXImagen WHERE preguntaID = ?");
        mysqli_stmt_bind_param($stmt, "i", $preguntaID);
        mysqli_stmt_execute($stmt);

        // Eliminar los registros en la tabla PreguntaXDistractor asociados a la pregunta
        $stmt = mysqli_prepare($conn, "DELETE FROM PreguntaXDistractor WHERE preguntaID = ?");
        mysqli_stmt_bind_param($stmt, "i", $preguntaID);
        mysqli_stmt_execute($stmt);

        // Eliminar los registros huérfanos en la tabla Distractor
        $stmt = mysqli_prepare($conn, "DELETE FROM Distractor WHERE ID IN (SELECT d.ID FROM Distractor d LEFT JOIN PreguntaXDistractor pd ON d.ID = pd.distractorID WHERE pd.distractorID IS NULL)");
        mysqli_stmt_execute($stmt);

        // Finalmente, eliminar el registro de la pregunta
        $stmt = mysqli_prepare($conn, "DELETE FROM Pregunta WHERE ID = ?");
        mysqli_stmt_bind_param($stmt, "i", $preguntaID);
        mysqli_stmt_execute($stmt);

        // Confirmar la transacción
        mysqli_commit($conn);
        // Cerrar la conexión a la base de datos
        mysqli_close($conn);
        // Enviar una respuesta al cliente
        http_response_code(200); // Set HTTP status code to 200 OK
        echo "El registro ha sido eliminado correctamente";
    } catch(Exception $e) {
        // Si ocurre un error, cancelar la transacción
        mysqli_rollback($conn);
        // Cerrar la conexión a la base de datos
        mysqli_close($conn);
        http_response_code(500);
        echo "El registro no ha podido ser eliminado, hay un error con los datos";
    }
?>
