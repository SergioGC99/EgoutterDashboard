<?php require_once('estructura/conexion.php'); ?>
<!DOCTYPE html>
<html lang="es">
<head> 
    <link href="../css/style3.css" rel="stylesheet"></link>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Egoutter</title>
	<script type="text/javascript">
	
		function validar() {
			var usuario, password, expresion;
			usuario=document.getElementById("usuario").value;
			email=document.getElementById("email").value;
			password=document.getElementById("password").value;
			expresion = /\w+@\w+\.+[a-z]/;

			if (usuario == "" || email == "" || password == "") {
				alert("Campos incompletos");
				return false;
			}
			else if (usuario.length.>50) {
				alert("El tamaño maximo para nombre de usuario es de 50 caracteres");
				return false;
			}
				else if (email.length>150) {
				alert("El tamaño maximo para el Correo Electronico es de 150 caracteres");
				return false;
			}
				else if (!expresion.test(email)) {
				alert("El Correo Electronico no es valido");
				return false; 
			}
				else if (password.length>32) {
				alert("El tamaño maximo para contraseña es de 32 caracteres");
				return false;
			}
				else if (password.length<8) {
				alert("La contraseña necesita un minimo de 8 caracteres");
				return false;
			}
		}
	</script>
</head>
<body>
	<section>
		<div class="container3">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form">
					<br><br><br><br><br>
					<img src="../img/logo.png" class="imagen">						
						<form class="imagen3"action="valido.php" method="POST" class="login-form" required>
							<input type="text" id="usuario" name="usuario" placeholder="Usuario" required>
							<input type="password" id="password" name="password" placeholder="Contraseña" required>
							<button class="login" type="submit">Iniciar Sesión</button>
						</form>
					</div>
				</div>
				<!--
				<div class="col-sm-2">
				</div>
				<div class="col-sm-4">
					<div class="signup-form">
						<h2>Crear Cuenta</h2>
						<form action="registrar.php" method="POST" class="form-register">
							<input type="text" id="usuario" name="usuario" placeholder="Usuario" required>
							<input type="email" id="email" name="email" placeholder="Correo Electronico" required>
							<input type="password" id="password" name="password" placeholder="Contraseña" required>
							<input type="submit" class="btn-enviar" value="registrar" onclick="validar();">
						</form>
					</div>
				</div>-->
			</div> 
		</div>
	</section>	
	<br>
	<br>
	<br>
	<br>
	<br>
    <br>
	<br>
	<br>
	<br>
	<br>
	<br>	
</body>
</html>
