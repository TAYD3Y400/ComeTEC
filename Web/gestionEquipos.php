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
            .btn-estandar {
                background-color: #007bff;
                border: none;
                color: white;
                padding: 10px 20px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                /* Adjust to */
            }
            .btn-estandar:hover {
                background-color: #0069d9;
            }
            /*  */ 
        </style>
        <div class="tablaEquipos">
            <table class="tablaEquipos" width="75%">
                
              <?php
                $institutoID=$_GET['ID'];
                $conn=conectar();
                $result=mysqli_query($conn, "SELECT * FROM equipo WHERE institucionID = $institutoID");

                // Get institution name
                $result2=mysqli_query($conn, "SELECT * FROM institucion WHERE ID = $institutoID");
                $row2=mysqli_fetch_assoc($result2);
                $nombreInstitucion = $row2['nombre'];

                echo "<div>
                          <tr class='espacio'></tr>
                            <tr class='tablaEquipos-item' bgcolor=#F7F7FE>
                                <td class='titulos'  width='150px'>
                                    <h4>                    </h4>
                                </td>
                                </td>  
                                <td class='titulos'  width='450px'>
                                    <h1>$nombreInstitucion</h1>
                                </td>                              
                                <td class='titulos'  width='150px'>
                                    <form class='titulos' action='addTeamForm.php?ID=$institutoID' method='post'>
                                        <button type='submit' name='ID' id='$institutoID' class='btn-estandar'>Agregar equipo</button>
                                    </form> 
                                </td>
                            </tr>
                          <tr class='espacio'></tr>
                </div>";   

                while($row=mysqli_fetch_assoc($result)){
                  $ID=$row['ID'];
                  $nombre=$row['nombre'];
                  $codigo=$row['codigo'];
                  echo "<div>
                          <tr class='espacio'></tr>
                            <tr class='tablaEquipos-item' bgcolor=#F7F7FE>
                                <td class='titulos'  width='150px'>
                                    <h4>$nombre</h4>
                                </td>
                                <td class='titulosHorizontal' width='750px'>
                                    <h4>Código:&nbsp</h4>
                                    <h4 id='id-$ID-a-copiar'>$codigo</h4>
                                    <h4>&nbsp</h4>
                                    <i class=\"far fa-clipboard\" onclick='copyToClipboard(\"id-$ID-a-copiar\")'></i>

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

    <script>
        function copyToClipboard(id) {
            var texto = document.getElementById(id).innerText; //Obtiene el texto a copiar
            var dummy = document.createElement("textarea");
            document.body.appendChild(dummy);
            dummy.value = texto;
            dummy.select();
            document.execCommand("copy");
            document.body.removeChild(dummy);
            showSuccessAlertNoRedirect("El texto se ha copiado al portapapeles"); //Muestra una alerta para confirmar la acción
        }

    </script>
    

    <?php
        include "includes/PiePagina.php";
    ?>
</body>

</html>