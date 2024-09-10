<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Añadir Respuesta</title>
	<link rel="stylesheet" type="text/css" href="css/registerAdmin.css">
</head>
<?php
        include "includes/Encabezado.php";
		$preguntaID=$_GET['ID'];
		$conn = conectar();
?>
<body>
	<div class="container">
		<h2>Añadir Respuesta</h2>
		<form method="POST" action="addAnswer.php?ID=<?php echo $preguntaID; ?>">
			<div class="form-group">
				<label for="respuesta">Respuesta</label>
				<input type="text" id="respuesta" name="respuesta" required>
			</div>
			<div class="form-group">
				<label for="correcta">Veracidad:</label>
				<select id="correcta" name="correcta">
					<?php
                        echo "<option value='0'>Incorrecta</option>";
                        echo "<option value='1'>Correcta</option>";
					?>
				</select>
			</div>
			<div class="form-group">
				<input type="submit" value="Crear">
			</div>
		</form>
	</div>
</body>
</html>
</html>