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
                $idInstitucion = $_GET['idInstitucion'];
                $conn=conectar();
                $result=mysqli_query($conn, "SELECT * FROM equipo WHERE institucionID = '$idInstitucion'");                                     
                while($row=mysqli_fetch_assoc($result)){
                  $ID=$row['ID'];
                  $nombre=$row['nombre'];
                  $codigo=$row['codigo'];
                  echo "<div>
                          <tr class='espacio'></tr>
                            <tr class='galeria-item' bgcolor=#F7F7FE>
                                <td class='titulos'  width='150px'>
                                    <h4>$nombre</h4>
                                </td>
                                <td class='titulos'  width='450px'>
                                    <h4>Código: $codigo</h4>
                                </td>
                                <td class='titulos'  width='150px'>
                                    <form class='titulos' action='equipo.php?ID=$ID' method='post'>
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