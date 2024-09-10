<?php
        include "includes/sesionInicio.php";
?>

<!DOCTYPE html>
<html lang="en">



<?php
        include "includes/Encabezado.php";

?>
<body>     
    <main>
        <style>
            tr td:first-child {
                border-radius: 15px 0px 0px 15px;
            }
                tr td:last-child  {
                border-radius: 0px 15px 15px 0px;
            }
        </style>
        <?php

        $examenID=$_GET['ID'];
        $conn=conectar();
        $fechaActual = date("Y-m-d");
        $sql = "SELECT * FROM Pregunta WHERE examenID = $examenID";
        $result=mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $preguntaID = $row['ID'];
                $pregunta = $row['pregunta'];
                $puntos = $row['puntos'];

                // Mostrar la pregunta
                echo "<p>Pregunta ID: $preguntaID</p>";
                echo "<p>Pregunta: $pregunta</p>";
                echo "<p>Puntos: $puntos</p>";

                $Resql = "SELECT * FROM Respuesta WHERE preguntaID = $preguntaID";
                $resultAns=mysqli_query($conn, $Resql);
                while ($row2 = $resultAns->fetch_assoc()) {
                    $respuestaID = $row2['ID'];
                    $respuesta = $row2['respuesta'];
                    $correcta = $row2['correcta'];

                    // Mostrar la respuesta como un segmento de selección única
                    echo "<input type='radio' name='respuesta_$preguntaID' value='$respuestaID'>";
                    echo "<label>$respuesta</label>";
                    echo "<br>";
                }
            }
        } else {
            echo "No se encontraron preguntas para este examen.";
        }
            mysqli_close($conn);
        ?>
    </main>

    <?php
        include "includes/PiePagina.php";
    ?>
</body>

</html>