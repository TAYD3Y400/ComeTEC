<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Crear Equipo</title>
	<link rel="stylesheet" type="text/css" href="css/registerAdmin.css">
</head>
<?php
        include "includes/Encabezado.php";
		$examenID=$_GET['ID'];
		// Traer desde la base de datos los grados disponibles para el equipo
		$query = "SELECT * FROM grado";
		$conn = conectar();
		$result = mysqli_query($conn, $query);
?>
<body>
	<div class="container">
		<h2>Añadir Pregunta</h2>
		<form method="POST" action="addQuestion.php?ID=<?php echo $examenID; ?>">
			<div class="form-group">
				<label for="quest">Pregunta:</label>
				<input type="text" id="quest" name="quest" required>
			</div>
			<!-- Dropdown para mostrar los grados disponibles del equipo, traidos desde la base de datos -->
            <div class="form-group">
				<label for="pts">Puntos:</label>
				<input type="text" id="pts" name="pts" required>
			</div>
			<div class="form-group">
				<input type="submit" value="Añadir">
			</div>
		</form>
	</div>
</body>
</html>