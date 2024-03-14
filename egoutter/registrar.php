<?php 
include 'estructura/conexion.php';
$usuario = $_POST["usuario"];
$email = $_POST["email"];
$password = $_POST["password"];

$insertar = "INSERT INTO usuarios (usuario, email, password) VALUES ('$usuario', '$email', '$password')";
$verificar_usuario = mysqli_query($con, "SELECT * FROM  usuarios WHERE usuario ='$usuario'");
if (mysqli_num_rows($verificar_usuario) > 0) {
	echo '<script> 
			alert ("El usuario ya está registrado");
			window.history.go(-1);
		</script>';
	exit;
}

$verificar_correo = mysqli_query($con, "SELECT * FROM  usuarios WHERE email ='$email'");
if (mysqli_num_rows($verificar_correo) > 0) {
	echo '<script> 
			alert ("El Correo Electronico ya está registrado");
			window.history.go(-1);
		</script>';
	exit;
}

$resultado = mysqli_query($con, $insertar);
if (!$resultado) {
	echo '<script> 
			alert ("El registro no fue posible");
			window.history.go(-1);
		</script>';
} else {
	echo '<script> 
			alert ("Ha sido registrado exitosamente");
			window.history.go(-1);
		</script>';
}
mysqli_close($con);