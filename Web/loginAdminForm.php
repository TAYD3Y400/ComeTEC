<?php
        include "includes/sesionInicio.php";
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Inicio de Sesión de Administrador</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>
	<link rel="stylesheet" type="text/css" href="css/loginInstitution.css">
</head>
<?php
	include "includes/Encabezado.php";
	include "includes/errorAlert.php";
	include "includes/successAlert.php";
?>
<body>
	<div class="login-form">
		<h1>Inicio de Sesión de Administrador</h1>
		<form method="POST">
			<label for="username">Nombre de usuario</label>
			<input type="text" id="username" name="username" class="registro-input" required>

			<label for="password">Contraseña</label>
			<input type="password" id="password" name="password" class="registro-input" required>

			<input type="submit" value="Iniciar Sesión" name="Ingresar" class="registrobutton">
		</form>
		<form method="POST" action="registerAdminForm.php">
			<input type="submit" value="Registrarse" class="registrobutton">
		</form>
	</div>

	<div class="espacio"></div>
	<div class="espacio"></div>

	<?php
        include "includes/PiePagina.php";
    ?>

	<?php
		function loginAdmin () {
			// Obtenemos los datos del formulario
			$username = $_POST['username'];
			$password = $_POST['password'];

			// Check if the fields are empty
			if ($username == "" || $password == "") {
				// Show error alert
				showErrorAlert("Debe llenar todos los campos solicitados", "loginInstitucion.php");
			}

			// Aquí podrías validar que los datos sean correctos antes de guardarlos en la base de datos
			$conn = conectar();

			// Verificamos si hay algún error en la conexión
			if ($conn->connect_error) {
				die("Error de conexión a la base de datos: " . $conn->connect_error);
			}

			// Insertamos los datos en la base de datos (aquí podrías encriptar la contraseña antes de guardarla)
			$sql = "SELECT * FROM administrador WHERE usuario = '$username' AND contrasena = '$password'";
			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) > 0) {
				showSuccessAlert("Inicio de sesión exitoso", "administrador.php");
			} else {
				// Create alert to say that the user or the password are incorrect
				showErrorAlert("El usuario o la contraseña son incorrectos", "loginAdminForm.php");
				// echo "<script type='text/javascript'>alert('El usuario o la contraseña son incorrectos');</script>";
				// echo "<script>location.href='loginAdminForm.php';</script>";
			}
			// Cerramos la conexión a la base de datos
			$conn->close();
		}
		// Verificamos si se ha enviado el formulario
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Ingresar'])) {
			loginAdmin();
		}
	?>

</body>
</html>

