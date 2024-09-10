<!DOCTYPE html>
<html>

<?php
        include "includes/Encabezado.php";
		include "includes/errorAlert.php";
		include "includes/successAlert.php";
?>

<body>
	<html>
		<head>
			<title>Registro de Administradores</title>
			<link rel="stylesheet" type="text/css" href="css/registerInstitution.css">
			<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>
		</head>
		<body>
			<form class="registro-form" method="post"
				action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?t=<?php echo time(); ?>">
			
				<h1>Registro de Administrador</h1>

				<label for="username">Nombre de usuario</label>
				<input type="text" id="username" name="username" class="registro-input" required>

				<label for="password">Contraseña</label>
				<input type="password" id="password" name="password" class="registro-input" required>

				<label for="confirm_password">Confirmar contraseña</label>
				<input type="password" id="confirm_password" name="confirm_password" class="registro-input" required>

				<input type="submit" value="Registrarse" name="Registrarse" class="registrobutton">
			</form>
		</body>
	</html>

	<div class="espacio"></div>
	<div class="espacio"></div>

    <?php
        include "includes/PiePagina.php";
    ?>

	<?php
        function registerAdmin() {
			// Obtenemos los datos del formulario
			$username = $_POST['username'];
			$password = $_POST['password'];
			$confirm_password = $_POST['confirm_password'];

			// Check if the passwords match
			if ($password == $confirm_password) {
				$conn=conectar();

				// Verificamos si hay algún error en la conexión
				if ($conn->connect_error) {
					die("Error de conexión a la base de datos: " . $conn->connect_error);
				}

				// Query to check if username already exists
				$selectQuery = "SELECT * FROM administrador WHERE usuario = '$username'";
				// Execute the query
				$result = mysqli_query($conn, $selectQuery);
				// If the query returns cero rows, then the username does not exist
				if (mysqli_num_rows($result) <= 0) {
					// Define the query to insert data
                    $insertQuery = "INSERT INTO administrador (usuario, contrasena) VALUES ('$username', '$password')";
					// Check if the query was executed successfully
					if ($conn->query($insertQuery)) {
						// Show success alert
						showSuccessAlert("El administrador ha sido registrado correctamente", "loginAdminForm.php");
					} else {
						// Show error alert
						showErrorAlert("Ha ocurrido un error al registrar el administrador", "registerAdminForm.php");
					}
				} else {
					// Show error alert
					showErrorAlert("El nombre de usuario ya existe", "registerAdminForm.php");
				}
				// Cerramos la conexión a la base de datos
				$conn->close();
			} else {
				// Show error alert
				showErrorAlert("Las contraseñas ingresadas no coinciden", "registerAdminForm.php");
			}
        }

		// Check if the form was submitted
		if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Registrarse"])) {
			registerAdmin();
		}

	?>
</body>
</html>
