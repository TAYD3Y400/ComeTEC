<!DOCTYPE html>
<html lang="en">

    <?php
        include "includes/Encabezado.php";
    ?>

    <!-- Recibir el id enviado por loginInstitucion -->
    <?php
        $idInstitucion=$_GET['ID'];
    ?>

    <div class="wrapper">
        <main>
            <nav class="menu-paginas">
                <div class="boton-container">
                <!-- Redirecto to gestionarEquipos.php -->
                <button onclick="window.location.href='gestionEquipos.php?ID=<?php echo $idInstitucion ?>'">Mis equipos</button>
                </div>
                <div class="boton-container">
                    <button onclick="window.location.href='ranking.php'">Ver ranking</button>
                </div>
                <div class="boton-container">
                    <button onclick="window.location.href=''">Exámenes</button>
                </div>
            </nav>
        </main>
    </div>

    <?php
        include "includes/PiePagina.php";
    ?>

    <!-- Enlace al archivo CSS -->
    <link rel="stylesheet" href="css/index.css">
</html>