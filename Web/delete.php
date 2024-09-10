<?php
include_once('db/db_utilities.php');
include "includes/Conexion.php";
?>

<?php

$id= (int)$_GET['ID'];

$conn=conectar();
$back=mysqli_query($conn, "SELECT equipoID FROM estudianteXequipo WHERE estudianteID='$id'");

while ($row = $back->fetch_assoc()) {
    $idBack = $row['equipoID']."<br>";
}
header("Location: equipo.php?ID=$idBack");

deleteEstudiante($id);
?>
	

