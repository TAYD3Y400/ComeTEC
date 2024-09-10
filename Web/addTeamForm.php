<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Crear Equipo</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>
	<link rel="stylesheet" type="text/css" href="css/addTeam.css">
</head>
<?php
        include "includes/Encabezado.php";
		include "includes/errorAlert.php";
		include "includes/successAlert.php";
		$idInstitucion=$_GET['ID'];
		// Traer desde la base de datos los grados disponibles para el equipo
		$query = "SELECT * FROM grado";
		$conn = conectar();
		$result = mysqli_query($conn, $query);
?>
<body>
	<div class="container">
		<h1>Crear Equipo</h1>
		<form class="registerTeam" method="POST">
			<div class="form-group">
				<label for="teamname">Nombre del equipo</label>
				<input type="text" id="teamname" name="teamname" required>
			</div>
			<!-- Dropdown para mostrar los grados disponibles del equipo, traidos desde la base de datos -->
			<div class="form-group">
				<label for="teamgrade">Grado del equipo</label>
				<select id="teamgrade" name="teamgrade">
					<?php
						while($row = mysqli_fetch_assoc($result)){
							$gradoID = $row['ID'];
							$grado = $row['nombre'];
							echo "<option value='$gradoID'>$grado</option>";
						}
					?>
				</select>
			</div>
			<div class="form-group">
				<input type="submit" value="Crear" name="Crear">
			</div>
		</form>
	</div>

	<?php
        include "includes/PiePagina.php";
    ?>

	<?php
		// Function to add a team 
		function addTeam () {
			// Get the data to insert
			$teamname = $_POST["teamname"];
			$teamgrade = $_POST["teamgrade"];
			$idInstitucion=$_GET['ID'];

			// Generate a random code for the team
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			// I want the lenght to be a random between 6 and 10
			$length = rand(6, 10);
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
		
			// Aquí podrías validar que los datos sean correctos antes de guardarlos en la base de datos
			$conn=conectar();
		
			// Verificamos si hay algún error en la conexión
			if ($conn->connect_error) {
				die("Error de conexión a la base de datos: " . $conn->connect_error);
			}
		
			// Insertamos los datos en la base de datos (aquí podrías encriptar la contraseña antes de guardarla)
			$sql = "INSERT INTO equipo (institucionID, gradoID, nombre, codigo) VALUES ('$idInstitucion', '$teamgrade', '$teamname', '$randomString')";
			if ($conn->query($sql) === TRUE) {
				// Alert that says the team has been registered correctly and give the team code
				showSuccessAlert("El equipo ha sido registrado correctamente. El código del equipo es: $randomString", "gestionEquipos.php?ID=$idInstitucion");
				// Quiero un alert que diga que el equipo ha sido registrado correctamente
				// echo "<script type='text/javascript'>alert('El equipo ha sido registrado correctamente');</script>";
				// echo "<script>window.alert('Inicio de sesión exitoso');</script>";
				// echo '<script>window.location.href = "gestionEquipos.php?ID=' . $idInstitucion . '";</script>';
			} else {
				// Alert that says the team has not been registered correctly and no redirect
				showErrorAlertNoRedirect("El equipo no ha sido registrado correctamente");
				// Quiero un alert que diga que el equipo no ha sido registrado correctamente
				// echo "<script type='text/javascript'>alert('El equipo no ha sido registrado correctamente');</script>";
			}
		
			// Cerramos la conexión a la base de datos
			$conn->close();
		}

		// Check if the form has been submitted
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Crear'])) {
			addTeam();
		}

	?>


</body>
</html>