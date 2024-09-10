<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Editar examen</title>
	<link rel="stylesheet" type="text/css" href="css/registerAdmin.css">
</head>
<?php
        include "includes/Encabezado.php";
		$idPregunta=$_GET['ID'];
        $numeroPregunta=$_GET['numeroPregunta'];
        // Traer desde la base de datos los examenes disponibles para el examen
        $query = "SELECT P.ID, P.pregunta, P.puntos FROM pregunta P WHERE $idPregunta=P.ID";
        $conn = conectar();
        $result = mysqli_query($conn, $query);

        $query2 = "SELECT D.ID, D.distractor FROM preguntaxdistractor PXD, distractor D WHERE $idPregunta=PXD.preguntaID and PXD.distractorID=D.ID ";
        $result2 = mysqli_query($conn, $query2);

        $query3 = "SELECT R.ID, R.respuesta FROM respuesta R WHERE $idPregunta=R.preguntaID";
        $result3 = mysqli_query($conn, $query3);
?>
<body>
    <div class="wrapper">
    <nav class="menu-paginas">
        <?php
            $elemento = mysqli_fetch_assoc($result);
            $respuestaCorrecta=mysqli_fetch_assoc($result3);
        ?>
        <?php
            $lista2 = array();
            while($row = mysqli_fetch_assoc($result2)){
                $lista2[] = $row;
            }

            mysqli_close($conn);
        ?>
            <div class="mi-lista-unica">
                <p class="nombre"><?php echo 'Pregunta #'.$numeroPregunta;  ?></p>
                <p class="grado"><?php echo 'Pregunta: '; echo $elemento['pregunta'];  ?></p>
                <p class="fecha"><?php echo 'Puntos: '; echo $elemento['puntos'];?></p>
            

                <ul class="mi-lista-unica-respuestas">
                    <h1>Respuesta correcta</h1>
                    <li> 
                        <p><?php echo 'Pregunta: '; echo $respuestaCorrecta['ID'];  ?></p>
                        <p><?php echo 'Respuesta: '; echo $respuestaCorrecta['respuesta'];?></p>
                        <div>
                        <button class="btnEncabezado" type="submit" onclick="abrirVentanaCorrecta('<?php echo $respuestaCorrecta['ID']; ?>', '<?php echo $respuestaCorrecta['respuesta']; ?>')">Editar</button>
                        </div>
                    </li>
                    <h1>Distractores</h1>
                    <?php $contador = 1;
                    foreach($lista2 as $elemento): ?>
                        <li> 
                            <H4><?php echo 'Distractor #'.$contador;  ?></H4>
                            <!-- <p ><?php echo 'Pregunta: '; echo $elemento['ID'];  ?></p> -->
                            <H4><?php echo "Respuesta: "; echo $elemento['distractor'];?></H4>
                            <div>
                                
                                <button class="btnEncabezado" type="submit" onclick="abrirVentana('<?php echo $contador; ?>', '<?php echo $elemento['ID']; ?>', '<?php echo $elemento['distractor']; ?>')">Editar</button>
                                <button class="btnEliminar" type="submit" onclick="confirmDelete('<?php echo $elemento['ID']; ?>')">Eliminar</button>
                            </div>
                        </li>
                    <?php $contador++;
                    endforeach; ?> 
                    <?php if($contador<=5){ ?>
                        <li>
                            <H4>Añadir distractor</H4>
                            <div>
                                <button class="btnEncabezado" type="submit" onclick="anadirDistractor('<?php echo $idPregunta; ?>')">Añadir</button>
                            </div>
                        </li>
                    <?php } ?>
                </ul>

            </div>
        </nav>
	</div>
    <script>
        function anadirDistractor(idPregunta){
            // Crear un objeto XMLHttpRequest
            var xhttp = new XMLHttpRequest();

            // Definir la función que se ejecutará cuando se reciba una respuesta del servidor
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Mostrar la respuesta del servidor en la consola del navegador
                    location.reload();
                }
            };

            // Abrir una conexión con el servidor
            xhttp.open("POST", "addAnswer.php", true);

            // Establecer las cabeceras de la solicitud
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            // Enviar los datos al servidor
            xhttp.send("idPregunta="+idPregunta);

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
            xhttp.open("POST", "deleteAnswer.php", true);

            // Establecer las cabeceras de la solicitud
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            // Enviar los datos al servidor
            xhttp.send("distractorID="+distractorID);
    
        }

        function abrirVentana(Cont, Id, distractor) {
            var width = 500; // Ancho de la ventana emergente
            var height = 500; // Altura de la ventana emergente
            var left = (screen.width/2) - (width/2); // Posición horizontal centrada
            var top = (screen.height/2) - (height/2) - 50; // Posición vertical centrada
            window.open("editAnswer.php?Cont="+Cont+"&ID="+Id+"&Text="+distractor, "ventanaDesplegable", "width="+width+",height="+height+",left="+left+",top="+top);
        }

        function abrirVentanaCorrecta(Id, distractor) {
            var width = 500; // Ancho de la ventana emergente
            var height = 500; // Altura de la ventana emergente
            var left = (screen.width/2) - (width/2); // Posición horizontal centrada
            var top = (screen.height/2) - (height/2) - 50; // Posición vertical centrada
            window.open("editRightAnswer.php?ID="+Id+"&Text="+distractor, "ventanaDesplegable", "width="+width+",height="+height+",left="+left+",top="+top);
        }

    </script>


</body>
</html>