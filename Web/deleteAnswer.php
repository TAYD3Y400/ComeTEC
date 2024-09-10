<?php
include_once('db/db_utilities.php');
include "includes/Conexion.php";
?>

<?php

$preguntaID= (int)$_GET['ID'];

$conn=conectar();
$back=mysqli_query($conn, "SELECT examenID FROM pregunta WHERE ID='$preguntaID'");

while ($row = $back->fetch_assoc()) {
    $idBack = $row['examenID']."<br>";
}
header("Location: gestionarPreguntas.php?ID=$idBack");

deletePregunta($id);
?>