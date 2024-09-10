<?php
    include "includes/DatosPrueba.php";
    include "includes/Conexion.php";
    $conn=conectar();
    borrarBD($conn);
    crearBD($conn);
    cargarDatos($conn);
    cerrar($conn);
    echo "<script>location.href='index.php';</script>";
?>