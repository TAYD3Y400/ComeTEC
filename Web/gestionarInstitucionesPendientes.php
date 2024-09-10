<?php
        include "includes/sesionInicio.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>
</head>



<?php
        include "includes/Encabezado.php";
        include "includes/errorAlert.php";
        include "includes/successAlert.php";
        include "includes/infoAlert.php";
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
                $conn=conectar();
                $result=mysqli_query($conn, "SELECT * FROM institucion WHERE estado = 0");      
                $cantidadInstituciones = mysqli_num_rows($result); 
                if ($cantidadInstituciones > 0) {                       
                    while($row=mysqli_fetch_assoc($result)){
                    $idInstitucion=$row['ID'];
                    $nombre = $row['nombre'];
                    echo "<div>
                            <tr class='espacio'></tr>
                                <tr class='galeria-item' bgcolor=#F7F7FE>
                                    <td class='titulos'  width='150px'>
                                        <h4>$nombre</h4>
                                    </td>
                                    <td class='titulos'  width='150px'>
                                    <form method='POST'>
                                        <input type='hidden' name='idInstitucion' value='$idInstitucion'>
                                        <input type='submit' value='Aceptar' name='Aceptar' class='registro-input'>
                                    </form>
                                    </td>
                                </tr>
                            <tr class='espacio'></tr>
                            </div>";
                    }
                } else {
                    showInfoAlert("No hay instituciones pendientes por aceptar", "administrador.php");
                }
                mysqli_close($conn);
              ?>
            </table>
        </div>
    </main>

    <?php
        include "includes/PiePagina.php";
    ?>

    <?php
        // Función para aceptar una institución
        function acceptInstitution ($idInstitucion) {
            // Conectamos a la base de datos
            $conn=conectar();
            // Verificamos si hay algún error en la conexión
            if ($conn->connect_error) {
                die("Error de conexión a la base de datos: " . $conn->connect_error);
            }
            // Se cambia el estado de la institución a aceptado (estado 1)
            $sql = "UPDATE institucion SET estado = 1 WHERE ID = '$idInstitucion'";
            $result = mysqli_query($conn, $sql);
            // Verificamos si se ha aceptado la institución
            if ($conn->query($sql)) {
                // Mostramos una alerta de éxito
                showSuccessAlert("Se ha autorizado la institución", "administrador.php");
                // echo '<script>alert("Se ha autorizado la institución")</script>';
                /* header('Location: administrador.php'); // Redireccionar a la página de administrador */
                // Otra manera de redireccionar es con Javascript, usando el siguiente código:
                // echo '<script>window.location.href = "administrador.php";</script>';
            } else {
                // echo "Error al aceptar la institución" . $conn->error;
                // Mostramos una alerta de error
                showErrorAlert("Error al aceptar la institución", "administrador.php");
            }
            // Cerramos la conexión a la base de datos
            $conn->close();
        }
        // Verificamos si se ha enviado el formulario
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Aceptar'])) {
            // Obtener el ID de la institución enviado por el formulario
            $idInstitucion = $_POST['idInstitucion'];

            // Llamar a la función para aceptar la institución
            acceptInstitution($idInstitucion);
		}
    ?>

</body>

</html>