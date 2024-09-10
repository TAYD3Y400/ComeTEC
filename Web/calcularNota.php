<?php
include "includes/sesionInicio.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Resultado del Examen</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <?php include "includes/Encabezado.php"; ?>
    </header>

    <main>
        <div class="wrapper">
            <h1>Resultado del Examen</h1>
            <div class="nota">
                <?php
                // Recibir las respuestas seleccionadas por el usuario
                $respuestas = $_POST;

                // Inicializar la variable de la nota total
                $nota = 0;

                // Recorrer las respuestas recibidas
                foreach ($respuestas as $key => $value) {
                    // Verificar si la respuesta seleccionada es válida
                    if (strpos($key, 'respuesta_') !== false && is_numeric($value)) {
                        // Obtener el ID de la pregunta y de la respuesta seleccionada
                        $preguntaID = str_replace('respuesta_', '', $key);
                        $respuestaID = $value;
                        $conn=conectar();

                        $sqlExamen = "SELECT examenID FROM Pregunta WHERE ID = $preguntaID";
                        $result=mysqli_query($conn, $sqlExamen);
                        $respuesta = $result->fetch_assoc();
                        $examenID = $respuesta['examenID'];

                        $sqlPTS = "SELECT SUM(puntos) as total FROM Pregunta WHERE examenID = $examenID";
                        $result=mysqli_query($conn, $sqlPTS);
                        $respuesta = $result->fetch_assoc();
                        $puntosTotales = $respuesta['total'];

                        // Obtener la información de la respuesta desde la base de datos
                        // y verificar si es la respuesta correcta
                        $sql = "SELECT correcta FROM Respuesta WHERE ID = $respuestaID";
                        // Realizar la consulta a la base de datos y obtener el resultado
                        $result=mysqli_query($conn, $sql);
                        $respuesta = $result->fetch_assoc();
                        // Calcular la nota de la pregunta si la respuesta es correcta
                        if ($respuesta['correcta'] == 1) {
                            // Obtener los puntos de la pregunta desde la base de datos
                            $sql1 = "SELECT puntos FROM Pregunta WHERE ID = $preguntaID";
                            // Realizar la consulta a la base de datos y obtener el resultado
                            $result1=mysqli_query($conn, $sql1);
                            $resultado = $result1->fetch_assoc();
                            // Sumar los puntos al total de la nota
                            $nota += $resultado['puntos'];
                        }
                    }
                }

                // Aquí puedes realizar cualquier acción adicional con la nota obtenida
                // por ejemplo, guardarla en la base de datos o mostrarla al usuario
                $notaFinal = $nota * 100 / $puntosTotales;
                
                // Mostrar la nota al usuario  
                if ($notaFinal < 70) {
                    echo "<p style='font-size: 24px; font-weight: bold; font-family: Arial, sans-serif; color: #FF0000;'>Tu nota es de: $notaFinal</p>";
                }
                else{
                    // Mostrar la nota  
                    echo "<p style='font-size: 24px; font-weight: bold; font-family: Arial, sans-serif; color: blue;'>Tu nota es de: $notaFinal</p>";

                }
                ?>
            </div>
                <div class="boton-container">
                        <button onclick="window.location.href='Certificado.php'">Generar Certificado</button> <!-- Cambiar de lugar para la siguiente iteracion-->
                </div>
          
        </div>
    </main>

    
    <?php
        include "includes/PiePagina.php";
    ?> 

    <!-- Enlace al archivo CSS -->
    <link rel="stylesheet" href="css/index.css">
</body>
</html>




