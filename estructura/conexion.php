<?php
	$con=mysqli_connect("localhost","root","","egoutter");
	if (mysqli_connect_error()) {
		echo "Conexión Fallida",mysqli_connect_error();
		exit();
	}
?>