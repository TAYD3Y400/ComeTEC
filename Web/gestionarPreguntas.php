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
                $result=mysqli_query($conn, "SELECT * FROM pregunta WHERE examenID='$examenID'");

                echo "<div>
                          <tr class='espacio'></tr>
                            <tr class='galeria-item' bgcolor=#F7F7FE>
                                <td class='titulos'  width='450px'>
                                    <h4>                    </h4>
                                </td>
                                </td>
                                <td class='titulos'  width='450px'>
                                    <h4>Agregar Nueva Pregunta</h4>
                                </td>
                                
                                <td class='titulos'  width='150px'>
                                    <h4>                    </h4>
                                </td>                             
                                <td class='titulos'  width='150px'>
                                    <h4>                    </h4>
                                </td>
                                <td class='titulos'  width='150px'>
                                    <form class='titulos' action='addQuestionForm.php?ID=$examenID' method='post'>
                                        <button class='btnEncabezado' type='submit' name='ID' id='$examenID' class='btn-estandar'>Añadir</button>
                                    </form> 
                                </td> 
                            </tr>
                          <tr class='espacio'></tr>
                </div>";

                while($row=mysqli_fetch_assoc($result)){
                  $preguntaID=$row['ID'];         
                  $pregunta = $row['pregunta'];
                  $puntos = $row['puntos'];
                  echo "<div>
                          <tr class='espacio'></tr>
                            <tr class='galeria-item' bgcolor=#F7F7FE>
                                <td class='titulos'  width='150px'>
                                    <h4>PTS:$puntos</h4>
                                </td>
                                <td class='titulos'  width='450px'>
                                    <h4>$pregunta</h4>
                                </td>
                                <td class='titulos'  width='50px'>
                                    <form class='titulos' action='gestionarRespuestas.php?ID=$preguntaID' method='post'>
                                        <button class='btnEncabezado' type='submit' name='ID' id='$preguntaID' class='btn-estandar'>Respuestas</button>
                                    </form> 
                                </td>
                                <td class='titulos'  width='50px'>
                                    <form class='titulos' action='gestionarRespuestas.php?ID=$preguntaID' method='post'>
                                        <button class='btnEncabezado' type='submit' name='ID' id='$preguntaID' class='btn-estandar'>Editar</button>
                                    </form> 
                                </td>
                                <td class='titulos'  width='50px'>
                                    <form class='titulos' action='deleteAnswer.php?ID=$preguntaID' method='post'>
                                        <button class='btnEliminar' type='submit' name='ID' id='$preguntaID' class='btn-estandar'>Eliminar</button>
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

function 