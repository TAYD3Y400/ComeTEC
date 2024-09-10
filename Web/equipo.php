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

                $equipoID=$_GET['ID'];
                $conn=conectar();
                $result=mysqli_query($conn, "SELECT * FROM estudianteXequipo WHERE equipoID='$equipoID'");

                echo "<div>
                          <tr class='espacio'></tr>
                            <tr class='galeria-item' bgcolor=#F7F7FE>
                                <td class='titulos'  width='150px'>
                                    <h4>                    </h4>
                                </td>
                                </td>
                                <td class='titulos'  width='450px'>
                                    <h4>Agregar Nuevo Estudiante</h4>
                                </td>                              
                                <td class='titulos'  width='150px'>
                                    <form class='titulos' action='addStudentForm.php?ID=$equipoID' method='post'>
                                        <button type='submit' name='ID' id='$equipoID' class='btn-estandar'>Añadir</button>
                                    </form> 
                                </td>
                            </tr>
                          <tr class='espacio'></tr>
                </div>";

                while($row=mysqli_fetch_assoc($result)){
                  $estudianteID=$row['estudianteID'];         
                  $resultEstudiante=mysqli_query($conn, "SELECT * FROM Estudiante WHERE ID='$estudianteID'");                     
                  $rowE=mysqli_fetch_assoc($resultEstudiante);
                  $estudianteNombre=$rowE['nombre'];
                  $estudianteApellido = $rowE['apellidos'];
                  $nombreCompleto = $estudianteNombre . " " . $estudianteApellido;
                  $estudianteIdentificacion=$rowE['identificacion'];
                  echo "<div>
                          <tr class='espacio'></tr>
                            <tr class='galeria-item' bgcolor=#F7F7FE>
                                <td class='titulos'  width='150px'>
                                    <h4>$nombreCompleto</h4>
                                </td>
                                <td class='titulos'  width='450px'>
                                    <h4>Identificación: $estudianteIdentificacion</h4>
                                </td>
                                <td class='titulos'  width='150px'>
                                    <form class='titulos' action= 'delete.php?ID=$estudianteID?IDback=$equipoID' method='post'>
                                        <button type='submit' name='ID' id='$equipoID' class='btn-estandar'>Eliminar</button>
                                    </form> 
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