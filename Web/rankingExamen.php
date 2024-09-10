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
        <div class="galeria">
            <table class="galeria" width="75%">
              <?php
                $examenID=$_GET['ID'];

                $conn=conectar();
                $result=mysqli_query($conn, "SELECT * FROM Calificacion WHERE examenID='$examenID'");                     
                while($row=mysqli_fetch_assoc($result)){
                  $ID=$row['ID'];
                  $estudianteID=$row['estudianteID'];
                  $nota=$row['nota'];

                  $resultEstudiante=mysqli_query($conn, "SELECT * FROM Estudiante WHERE ID='$estudianteID'");                     
                  $rowE=mysqli_fetch_assoc($resultEstudiante);
                  $estudianteNombre=$rowE['nombre'];
                  echo "<div>
                          <tr class='espacio'></tr>
                            <tr class='galeria-item' bgcolor=#F7F7FE>
                                <td class='titulos'  width='150px'>
                                    <h4>$estudianteNombre</h4>
                                </td>
                                <td class='titulos'  width='450px'>
                                    <h4>Nota: $nota</h4>
                                </td>
                            </tr>
                          <tr class='espacio'></tr>
                        </div>";
                  
                }
                mysqli_close($conn);
              ?>
            </table>
        </div>
    </main>

    <?php
        include "includes/PiePagina.php";
    ?>
</body>

</html>