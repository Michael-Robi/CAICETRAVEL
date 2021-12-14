<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	</head>

	<body>
		<?php
			require_once("sessionAdministrador.php");
			require_once('class.administrador.php');

			$administrador = new Administrador();

			// Variables de session para utilizar las funcionalidades, solo en el administrador
		  	$user_id = $_SESSION['user_session'];
		    
		  	$stmt = $administrador->runQuery("SELECT * FROM usuarios WHERE idUsuarios=:user_id");
		  	$stmt->execute(array(":user_id"=>$user_id));
		    
		  	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

			$asunt="Recordatorio Reserva Restaurante";

			$sql1 ="SET lc_time_names ='es_ES'";
			$stmt = $administrador->runQuery($sql1);
	    	$stmt->execute();

			$sql="SELECT rre.reserva idReserva, u.nombre nombre, u.email email, re.descripcion restaurante, re.ubicacion direccion, DATE_FORMAT(r.fechaIngreso, '%W %d ' 'de' ' %M ' 'del' ' %Y') fecha, DATE_FORMAT(r.hora, '%h:%i %p') hora FROM usuarios u, reserva r, reservarestaurante rre, restaurante re WHERE u.idUsuarios=r.usuario AND rre.reserva=r.consecutivo AND rre.restaurante=re.codigo AND r.fechaIngreso BETWEEN CURDATE() AND '2018-12-31'";

			$stmt = $administrador->runQuery($sql);
	    	$stmt->execute();

			while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {

				mail($fila['email'], $asunt, "Hola Sr(a) ".$fila['nombre']."\n\nLe informamos que su reserva esta programada, para el día ".$fila['fecha']." a las ".$fila['hora'].".\nEn el Restaurante ".$fila['restaurante']." dirección: ".$fila['direccion'].".\n\nHasta luego.");
			}
			
			//Cerrar conexion 
		  	$stmt->closeCursor();
		  	$stmt = null;
		  	$administrador = null;
			
			echo'<script type="text/javascript">window.location.href="notificarReserva.php";
			 	</script>';
		?>
	</body>
</html>
