<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Agregar Estudiante</title>
	<link rel="stylesheet" type="text/css" href="css/registerAdmin.css">
</head>
<?php
        include "includes/Encabezado.php";
		$idEquipo=$_GET['ID'];
?>
<body>
	<div class="container">
		<h2>Agregar Estudiante</h2>
		<form method="POST" action="addStudent.php?ID=<?php echo $idEquipo; ?>">
            <div class="form-group">
                <label for="identificacion">Identificación:</label>
                <input type="number" id="identificacion" name="identificacion" required>
            </div>
			<div class="form-group">
				<label for="name">Nombre:</label>
				<input type="text" id="name" name="name" required>
			</div>
            <div class="form-group">
                <label for="lastname1">Primer apellido:</label>
                <input type="text" id="lastname1" name="lastname1" required>
            </div>
            <div class="form-group">
                <label for="lastname2">Segundo apellido:</label>
                <input type="text" id="lastname2" name="lastname2" required>
            </div>
            <div class="form-group">
                <label for="age">Edad:</label>
                <input type="number" id="age" name="age" required>
            </div>
            <div class="form-group">
                <label for="mail">Correo electrónico:</label>
                <input type="email" id="mail" name="mail" required>
            </div>
			<div class="form-group">
				<input type="submit" value="Agregar">
			</div>
		</form>
	</div>
</body>
</html>