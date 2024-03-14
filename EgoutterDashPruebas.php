<?php
$username="root";
$password="password";
//$password="password";
$database="egoutter1";
$localhost="localhost";

$mysconn = new mysqli($localhost, $username, $password, $database);

if($mysconn->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

$sql="SELECT DATE_TIME, T, RH, SM FROM plant";

if($result=$mysconn->query($sql)) {
    if($result->num_rows > 0) {

	$mediciones = array(
	    $dates = array(),
	    $celsius = array(),
	    $fahr = array(),
        $humedad = array(),
        $humedades = array(),
	);
	    
	for($i = 0; $row = $result->fetch_array(MYSQLI_ASSOC); ++$i) {
	    $mediciones["dates"][$i] = $row['DATE_TIME']; 
	    $mediciones["celsius"][$i] = intval($row["T"]);
	    $mediciones["fahr"][$i] = $row["T"] * 1.8 + 32; 
        $mediciones["humedad"][$i] = intval($row["RH"]);
	    $mediciones["humedades"][$i] = intval($row["SM"]);
	}

	/* echo json_encode($mediciones); */
    } 
    else {
	echo "0 results";
    }
}

//ESTADO DEL INVERNADERO ACTUAL
$sql2="SELECT DATE_TIME, T, RH, SM FROM `plant` WHERE 1  order by ID desc limit 1";

if($result2=$mysconn->query($sql2)) {
    if($result2->num_rows > 0) {    
		for($i = 0; $row2 = $result2->fetch_array(MYSQLI_ASSOC); ++$i) {
			$date2 = $row2['DATE_TIME']; 
			$celsius2  = intval($row2["T"]);
			$fahr2  = $row2["T"] * 1.8 + 32; 
			$humedad2  = intval($row2["RH"]);
			$humedades2  = intval($row2["SM"]);
		}
    } 
    else {
		echo "0 results";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <title>Sistema de Riego Egoutter</title>
	<link href="css/styleold.css" rel="stylesheet"></link>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.13/moment-timezone.min.js"></script>
</head>
<body>
    <script type="text/javascript">
    $(function() {
	$('#temperaturas').highcharts({
	    chart: {
      		type: 'line'
	    },	   
	    title: {
			text: 'Temperatura'
	    }, 
	    xAxis: {
			title: {
				text: 'Fecha'
			},
			type: 'datetime',
			labels: {
				rotation: -90,
				format: '{value: %Y-%m-%d %H : %M}'
			},
			categories: <?php echo json_encode($mediciones["dates"], JSON_NUMERIC_CHECK); ?>
	    },
	    yAxis: {
			min: 0,
			max: 120,
			title: {
				text: 'Temperatura'
			}
	    },
	    series: [{
			name: 'Celsius',
			data: <?php echo json_encode($mediciones["celsius"]); ?>
	    },
	    {
			name: 'Farenheit',
			data: <?php echo json_encode($mediciones["fahr"]); ?>
	    }]
    });
	});

    $(function() {
	$('#humedad').highcharts({
	    chart: {
			type: 'line'
	    },	    
	    title: {
			text: 'Humedad Relativa '
	    }, 
	    xAxis: {
			title: {
				text: 'Humedad Relativa'
			},
			type: 'datetime',
			labels: {
				rotation: -90,
				format: '{value: %Y-%m-%d %H : %M}'
			},
            categories: <?php echo json_encode($mediciones["dates"]); ?>
	    },
	    yAxis: {
			min: 0,
			max: 120,
			title: {
				text: 'Humedad Relativa'
			}
	    },
	    series: [{
			name: 'Porcentaje',
			data: <?php echo json_encode($mediciones["humedad"]); ?>
	    }]
    });
	});
		
	$(function() {
	$('#humedades').highcharts({
	    chart: {
			type: 'line'
	    },	    
	    title: {
			text: 'Humedad Suelo'
	    }, 
	    xAxis: {
			title: {
				text: 'SOIL MOISTURE'
			},
			type: 'datetime',
			labels: {
				rotation: -90,
				format: '{value: %Y-%m-%d %H : %M}'
			},
            categories: <?php echo json_encode($mediciones["dates"]); ?>
	    },
	    yAxis: {
			min: 0,
			max: 1000,
			title: {
				text: 'SOIL MOISTURE'
			}
	    },
	    series: [{
			name: 'Porcentaje',
			data: <?php echo json_encode($mediciones["humedades"]); ?>
	    }]
	});
	});

	</script>
	<div>
		<nav class="navbar">
			<div class="nav-img">
				<a class="navbar-brand"><img src="img/logo.png" width="220" height="50"></a>
			</div>
			<div id="navegador">
				<ul>
				<li><a href="EgoutterDash.php" disabled>INICIO</a></li>
				<li><a href="acercade.html">ACERCA DE</a></li>
				<li><a href="egoutter/Manual.pdf" target="_blank">MANUAL DE USO</a></li>
				<li><a href="egoutter/login.php">CERRAR SESION</a></li><br><br>
				</ul>
			</div>	           	        
		</nav>
	</div>
	<div class="dashboard">
		<div class="control">
			<div class="monitoreo">
				<div class="row">
					<div class="panel panel-default">
						<div class="panel-heading">MONITOREAR</div>
						<div class="panel-body">
							<form action="EgoutterDash.php" method="post">
								<button name="tablero" type="submit" value="temperaturas">Temperatura</button>
								<button name="tablero" type="submit" value="humedad">Humedad Relativa</button>
								<button name="tablero" type="submit" value="humedades">Humedad Suelo</button>
							</form>										
						</div>
					</div>
				</div>
			</div>
			<div class="monitoreo">
				<div class="row">
					<div class="panel panel-default">
						<div class="panel-heading">TEMPERATURA ACTUAL</div>
							<div class="grados"><h5><?php echo json_encode($celsius2); ?> °C</h5></div>								
						<div class="panel-heading">HUMEDAD ACTUAL</div>		
							<div class="humedad"><h5><?php echo json_encode($humedad2); ?> %</h5></div>										
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="panel panel-default">
					<div class="panel-heading">CONTROL DEL SISTEMA DE RIEGO</div>
					<div class="panel-body">
						<div id="<?php isset($_POST["tablero"]) ? print $_POST["tablero"] : ""; ?>"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

