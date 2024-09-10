<?php
    include "includes/Conexion.php";
    // Conectarse a la base de datos
    $conn = conectar();
    // Obtener el ID del registro a eliminar
    $distractorID = $_POST['distractorID'];

    // Iniciar la transacción
    mysqli_begin_transaction($conn);

    try {

        // Eliminar los registros huérfanos en la tabla Distractor
        $stmt = mysqli_prepare($conn, "DELETE FROM Respuesta WHERE ID=?");
        mysqli_stmt_bind_param($stmt, "i", $distractorID);
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
