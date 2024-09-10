<!DOCTYPE html>
<html lang="en">

    <?php
        include "includes/Encabezado.php";
    ?>          

    <div class="wrapper">
        <main>
            <nav class="menu-paginas">
                <div class="boton-container">
                    <button onclick="window.location.href='loginAdminForm.php'">Administrador</button>
                </div>
                <div class="boton-container">
                    <button onclick="window.location.href='loginTeam.php'">Estudiante</button>
                </div>
                <div class="boton-container">
                    <button onclick="window.location.href='loginInstitucion.php'">Institución</button>
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