<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Crear Examen</title>
	<link rel="stylesheet" type="text/css" href="css/registerAdmin.css">
</head>
<?php
        include "includes/Encabezado.php";
        // Traer desde la base de datos los grados disponibles para el examen
		$query = "SELECT * FROM grado";
		$conn = conectar();
		$result = mysqli_query($conn, $query);
?>
<body>
	<div class="container">
		<h2>Crear Examen</h2>
		<form method="POST" action="addTest.php">
			<div class="form-group">
				<label for="testname">Tema:</label>
				<input type="text" id="testname" name="testname" required>
			</div>
            <div class="form-group">
				<label for="testgrade">Grado del equipo:</label>
				<select id="testgrade" name="testgrade">
					<?php
						while($row = mysqli_fetch_assoc($result)){
							$gradoID = $row['ID'];
							$grado = $row['nombre'];
							echo "<option value='$gradoID'>$grado</option>";
						}
					?>
				</select>
			</div>
            <label for="fecha">Fecha de Realización: </label>
            <div class="date-selectors">
                <select id="dia" name="dia">
                <?php
                    for ($i = 1; $i <= 31; $i++) {
                    echo "<option value=\"$i\">$i</option>";
                    }
                ?>
                </select>

                <select id="mes" name="mes">
                <?php
                    for ($i = 1; $i <= 12; $i++) {
                        echo "<option value=\"$i\">$i</option>";
                    }
                ?>
                </select>

                <select id="anio" name="anio">
                <?php
                    for ($i = date("Y"); $i <= date("Y") + 8; $i++) {
                    echo "<option value=\"$i\">$i</option>";
                    }
                ?>
                </select>
            </div>
            <label> </label>
			<div class="form-group">
				<input type="submit" value="Agregar">
			</div>
		</form>
	</div>
</body>
</html>