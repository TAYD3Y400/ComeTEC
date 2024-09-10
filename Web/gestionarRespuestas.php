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

                $preguntaID=$_GET['ID'];
                $conn=conectar();
                $result=mysqli_query($conn, "SELECT * FROM respuesta WHERE preguntaID='$preguntaID'");

                
                $contador = 1;

                while($row=mysqli_fetch_assoc($result)){
                  $respuestaID = $row['ID'];         
                  $respuesta = $row['respuesta'];
                  $correcta = $row['correcta'];
                  if ($correcta == 1) {
                    $correcta = 'Correcta';
                  }else{
                    $correcta = 'Distractor';
                  };
                  echo "<div>
                          <tr class='espacio'></tr>
                            <tr class='galeria-item' bgcolor=#F7F7FE>
                                <td class='titulos'  width='150px'>
                                    <h4>$correcta</h4>
                                </td>
                                <td class='titulos'  width='450px'>
                                    <h4>$respuesta</h4>
                                </td>
                                <td class='titulos'  width='25px'>
                                <button class='btnEncabezado' type='submit' onclick='abrirVentanaCorrecta($respuestaID, \"$respuesta\", \"$correcta\")'>Editar</button>
                                </td>
                                <td class='titulos'  width='125px'>
                                    <button class='btnEliminar' type='submit' onclick='confirmDelete($respuestaID)'>Eliminar</button>
                                </td>
                            </tr>
                          <tr class='espacio'></tr>
                        </div>";
                        $contador++;
                }
                if($contador<=5){
                    echo "<div>
                          <tr class='espacio'></tr>
                            <tr class='galeria-item' bgcolor=#F7F7FE>
                                <td class='titulos'  width='150px'>
                                    <h4>                    </h4>
                                </td>
                                </td>
                                <td class='titulos'  width='450px'>
                                    <h4>Agregar Nueva Respuesta</h4>
                                </td>                              
                                <td class='titulos'  width='50px'>
                                    <h4>                    </h4>
                                </td>
                                <td class='titulos'  width='150px'>
                                    <form class='titulos' action='addAnswerForm.php?ID=$preguntaID' method='post'>
                                        <button class='btnEncabezado' type='submit' name='ID' id='$preguntaID' class='btn-estandar'>Añadir</button>
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
        function abrirVentanaCorrecta(Id, distractor, correcta) {
            var width = 500; // Ancho de la ventana emergente
            var height = 500; // Altura de la ventana emergente
            var left = (screen.width/2) - (width/2); // Posición horizontal centrada
            var top = (screen.height/2) - (height/2) - 50; // Posición vertical centrada
            window.open("editRightAnswer.php?ID="+Id+"&Text="+distractor+"&Valor="+correcta, "ventanaDesplegable", "width="+width+",height="+height+",left="+left+",top="+top);
        }

        function confirmDelete(distractorID) {
            // Crear un objeto XMLHttpRequest
            var xhttp = new XMLHttpRequest();

            // Definir la función que se ejecutará cuando se reciba una respuesta del servidor
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Mostrar la respuesta del servidor en la consola del navegador
                    alert(this.responseText);
                    location.reload();
                }
            };

            // Abrir una conexión con el servidor
            xhttp.open("POST", "deleteAnswer2.php", true);

            // Establecer las cabeceras de la solicitud
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            // Enviar los datos al servidor
            xhttp.send("distractorID="+distractorID);
    
        }

    </script>

    <?php
        include "includes/PiePagina.php";
    ?>
</body>

</html>
