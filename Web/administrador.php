<!DOCTYPE html>
<html lang="en">

    <?php
        include "includes/Encabezado.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="wrapper">
        <main>
            <nav class="menu-paginas">
                <div class="boton-container">
                    <button onclick="window.location.href='gestionarInstituciones.php'">Gestionar instituciones</button>
                </div>
                <div class="boton-container">
                    <button onclick="window.location.href='gestionarInstitucionesPendientes.php'">Gestionar instituciones pendientes</button>
                </div>
                <div class="boton-container">
                    <button onclick="window.location.href='ranking.php'">Ver ranking</button>
                </div>
                <div class="boton-container">
                    <button onclick="window.location.href='gestionarExamen.php'">Administrar examenes</button>
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