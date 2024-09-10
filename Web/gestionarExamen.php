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
        <div class="tablaEquipos">
            <table class="tablaEquipos" width="75%">
                
              <?php
                $institutoID=1;
                $conn=conectar();
                $result=mysqli_query($conn, "SELECT grado.nombre as grado, ex.ID, ex.nombre, ex.fechaEjecucion
                FROM examen ex
                INNER JOIN grado 
                ON grado.ID=ex.gradoID
                ORDER BY fechaEjecucion");

                echo "<div>
                          <tr class='espacio'></tr>
                            <tr class='tablaEquipos-item' bgcolor=#F7F7FE>
                                <td class='titulos'  width='150px'>
                                    <h4>                    </h4>
                                </td>
                                </td>
                                <td class='titulos'  width='850px'>
                                    <h4>Crear Nuevo Examen</h4>
                                </td>                              
                                <td class='titulos'  width='150px'>
                                    <form class='titulos' action='addTestForm.php?' method='post'>
                                        <button type='submit' class='btn-estandar'>Crear</button>
                                    </form> 
                                </td>
                            </tr>
                          <tr class='espacio'></tr>
                </div>";   

                while($row=mysqli_fetch_assoc($result)){
                  $ID=$row['ID'];
                  $nombre=$row['nombre'];
                  $grado=$row['grado'];
                  $fecha=$row['fechaEjecucion'];
                  echo "<div>
                          <tr class='espacio'></tr>
                            <tr class='tablaEquipos-item' bgcolor=#F7F7FE>
                                <td class='titulos'>
                                    <h4>$fecha</h4>
                                </td>
                                <td class='titulosHorizontal'  width='150px'>
                                    <h4>$nombre - $grado</h4>
                                </td>               
                                
                                <td class='titulos'  width='150px'>
                                    <form class='titulos' action='gestionarPreguntas.php?ID=$ID' method='post'>
                                        <button type='submit' name='ID' id='$ID' class='btn-estandar'>Gestionar</button>
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