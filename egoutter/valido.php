<?php
	session_start();
	$_SESSION['usuario'] = $_POST['usuario'];
	header("Location: ../EgoutterDash.php");  
?>

<?php
$usuario= $_POST['usuario'];
$password= $_POST['password'];

include 'estructura/conexion.php';
$consulta ="SELECT * FROM usuarios where usuario= '$usuario' and password='$password'";
$resultado= mysqli_query($con,$consulta);
$filas=mysqli_num_rows($resultado);

if ($filas>0) {
	header("location: ../EgoutterDash.php");
}
else {
	echo "Error en la autentificación";
}
mysqli_free_result($resultado);
mysqli_close($con);