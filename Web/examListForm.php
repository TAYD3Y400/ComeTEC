<!DOCTYPE html>
<html lang="en">
    <!-- Enlace al archivo CSS -->
    <link rel="stylesheet" href="css/index.css">

    <?php
        include "includes/Encabezado.php";
        // Traer desde la base de datos los examenes disponibles para el examen
		$query = "SELECT E.ID, G.nombre as grado, E.nombre, E.fechaEjecucion FROM examen E, grado G WHERE E.gradoID=G.ID";
		$conn = conectar();
		$result = mysqli_query($conn, $query);
    ?>
    <div class="wrapper">
        <nav class="menu-paginas">
        <?php
                $lista = array();
                    while($row = mysqli_fetch_assoc($result)){
                        $gradoID = $row['ID'];
                        $grado = $row['grado'];
                        $nombre = $row['nombre'];
                        $fechaEjecucion = $row['fechaEjecucion'];
                        $lista[] = $row;
                    }
                ?>
            <ul class="mi-lista">
                <?php foreach($lista as $elemento): ?>
                    <li>
                        <p class="nombre"><?php echo $elemento['nombre'];  ?></p>
                        <p class="grado"><?php echo 'Grado: '; echo $elemento['grado'];  ?></p>
                        <p class="fecha"><?php echo 'Fecha: '; echo $elemento['fechaEjecucion'];?></p>
                        <div class="editar">
                            <form action="editExam.php" method="GET">
                                <input type="hidden" name="ID" value="<?php echo $elemento['ID']; ?>">
                                <button class="btnEncabezado" type="submit">Editar</button>
                            </form>
                            
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="boton-container">
                <button onclick="window.location.href=''">Administrar Examenes</button>
            </div>
        </nav>
    </div>

    <?php
        include "includes/PiePagina.php";
    ?>

</html>