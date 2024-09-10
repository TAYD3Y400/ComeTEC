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
        $sql = "SELECT * FROM Pregunta WHERE examenID = $examenID";
        $result=mysqli_query($conn, $sql);
        $n = 1;


        if ($result->num_rows > 0) {
            echo "<form method='post' action='calcularNota.php'>";
            echo "<br>";
            foreach ($result as $row) {
                $preguntaID = $row['ID'];
                $pregunta = $row['pregunta'];
                $puntos = $row['puntos'];

                echo "<h3>Pregunta $n: <br></h3> <h4> $pregunta</h4>";
                echo "<h4>Puntos: $puntos</h4>";

                //Manejo de respuestas por pregunta
                $Resql = "SELECT * FROM Respuesta WHERE preguntaID = $preguntaID";
                $resultAns=mysqli_query($conn, $Resql);
                while ($row2 = $resultAns->fetch_assoc()) {
                    $respuestaID = $row2['ID'];
                    $respuesta = $row2['respuesta'];
                    $correcta = $row2['correcta'];

                    echo "<input type='radio' name='respuesta_$preguntaID' value='$respuestaID'>";
                    echo "<label>$respuesta</label>";
                    echo "<br>";
                    
                }

                $n = $n + 1;
                echo "<br>";
            }
            echo "<input type='submit' value='Enviar respuestas'>";
            echo "</form>";
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