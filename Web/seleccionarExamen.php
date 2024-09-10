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
                $fechaActual = date("Y-m-d");
                $result=mysqli_query($conn, "SELECT grado.nombre as grado, ex.ID, ex.nombre, ex.fechaEjecucion
                FROM examen ex
                INNER JOIN grado 
                ON grado.ID=ex.gradoID
                WHERE ex.fechaEjecucion='$fechaActual'
                ORDER BY fechaEjecucion");

                while($row=mysqli_fetch_assoc($result)){
                    $ID=$row['ID'];
                    $nombre=$row['nombre'];
                    $grado=$row['grado'];
                    $fecha=$row['fechaEjecucion'];
                    echo "<div>
                            <tr class='espacio'></tr>
                              <tr class='tablaEquipos-item' bgcolor=#F7F7FE>
                                  <td class='titulos' width='25px'>
                                      <h4> </h4>
                                  </td>
                                  <td class='titulosHorizontal'  width='150px'>
                                      <h4>$nombre - $grado</h4>
                                  </td>               
                                  <td class='titulos'  width='150px'>
                                      <form class='titulos' action='ejecutarExamen.php?ID=$ID' method='post'>
                                          <button type='submit' name='ID' id='$ID' class='btn-estandar'>Realizar</button>
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

 