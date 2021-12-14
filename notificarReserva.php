<?php  
  require_once("sessionAdministrador.php");
  require_once('class.administrador.php');

  $administrador = new Administrador();

  // Variables de session para utilizar las funcionalidades, solo en el administrador
  $user_id = $_SESSION['user_session'];
    
  $stmt = $administrador->runQuery("SELECT * FROM usuarios WHERE idUsuarios=:user_id");
  $stmt->execute(array(":user_id"=>$user_id));
    
  $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

  //Cerrar conexion 
  $stmt->closeCursor();
  $stmt = null;
  $administrador = null;
?>

<!DOCTYPE html>
  <html lang="es">
    <head>
    	<title>Correo y Notificar Reservas</title>
    	<!--Let browser know website is optimized for mobile-->
      	<meta name="viewport" content="width=500, initial-scale=1.0, maximum-scale=1, minimum-scale=1.0">
      	<!-- Codificar idioma -->
      	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      	<!--Import Google Icon Font-->
      	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      	<!--Import materialize.css-->
      	<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    </head>

    <style>
    	/*Pintar todos los campos input de gris, cuando se recargue la pagina*/
		input,
	  	input::-webkit-input-placeholder {
			color:#798081;
		} 
	
		/*Pintar todos los campos textarea de gris, cuando se recargue la pagina*/
		textarea,
	  	textarea::-webkit-input-placeholder {
		    color:#798081;
	    }

		/*Pintar todos los campos de negro, cuando un administrador empiece a digitar*/
		input.color, textarea.materialize-textarea{
	   	color:black;
  		}

		/*Pintar todos los titulos de negro*/
		label.color{
			color:black;
		}

		/*Pintar iconos de negro*/
	  	i.material-icons{
	  		color:black;
	  	}

	  	/*Pintar iconos de blanco*/
	  	i.right, i.left{
	  		color:white;
	  	}
    </style>

    <body>
      	<!--Import jQuery before materialize.js-->
      	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      	<script type="text/javascript" src="js/materialize.min.js"></script>

	  	<div class="row">
	  		<?php	
				require_once('NavBarAdmin.php');
			?>

			<br>

		    <form class="col s12 m12 l12" name="enviar" method="post" action="mail.php">

		    	<div class="input-field col s12 m8 l6 offset-l1 offset-m1">
		      		<i class="material-icons prefix">email</i>
		      		<input type="email" name="txtCorreo" placeholder=" Ingrese el correo electronico" class="color" required> 
		      		<label class="color" for="txtCorreo">Para:</label>
		      	</div>

		      	<div class="input-field col s12 m8 l6 offset-l1 offset-m1">
		      		<i class="material-icons prefix">mode_edit</i>
		      		<input type="text" name="txtAsunto" placeholder=" Ingrese el asunto" class="color" required>
		      		<label class="color" for="txtAsunto">Asunto:</label>
		      	</div>

		      	<div class="input-field col s12 m8 l6 offset-l1 offset-m1">
		      		<i class="material-icons prefix">mode_edit</i>
		      		<textarea id="textarea1" name="textAMensaje" class="materialize-textarea" placeholder=" Ingrese el mensaje"></textarea>
		      		<label class="color" for="textarea1">Mensaje</label>
		      	</div>

		      	<div class="input-field col s12 m10 l7 offset-l1 offset-m1">
		       		<button class="btn #1976d2 blue darken-2" type="submit" name="btnGrabar">Enviar</button>
		      	</div>

		      	<div class="input-field col s12 m10 l11 offset-l1 offset-m1">
		      		<a class="waves-effect waves-light btn indigo darken-1" href="notificacionbar.php"><i class="material-icons right">local_bar</i>Notificar reseva Bar</a> &nbsp; 

		      		<a class="btn-floating btn-large waves-effect waves-light red" href="generarreservabar.php" title="Generar pdf reserva Bar"><i class="material-icons left">picture_as_pdf</i></a>  
		      	</div>
		      	<div class="input-field col s12 m10 l11 offset-l1 offset-m1">
		       		<a class="waves-effect waves-light btn indigo darken-1" href="notificacionhotel.php"><i class="material-icons right">business</i>Notificar reverva Hotel</a> &nbsp;

		       		<a class="btn-floating btn-large waves-effect waves-light red" href="generarreservahotel.php" title="Generar pdf reserva Hotel"><i class="material-icons left">picture_as_pdf</i></a>
				</div>
		      	<div class="input-field col s12 m10 l11 offset-l1 offset-m1">
		       		<a class="waves-effect waves-light btn grey darken-2" href="notificacionlugar.php"><i class="material-icons right">account_balance</i>Notificar reseva Lugar</a> &nbsp;

		       		<a class="btn-floating btn-large waves-effect waves-light red" href="generarreservalugar.php" title="Generar pdf reserva Lugar"><i class="material-icons left">picture_as_pdf</i></a>
		       	</div>
		      	<div class="input-field col s12 m10 l11 offset-l1 offset-m1"> 
		       		<a class="waves-effect waves-light btn grey darken-2" href="notificacionrestaurante.php"><i class="material-icons right">store</i>Notificar reseva Restaurante</a> &nbsp;

		       		<a class="btn-floating btn-large waves-effect waves-light red" href="generarreservarestaurante.php" title="Generar pdf reserva Restaurante"><i class="material-icons left">picture_as_pdf</i></a>
		       	</div>
		      	<div class="input-field col s12 m10 l11 offset-l1 offset-m1">
		       		<a class="waves-effect waves-light btn grey darken-2" href="notificaciontransporte.php"><i class="material-icons right">airport_shuttle</i>Notificar reseva Transporte</a> &nbsp;

		       		<a class="btn-floating btn-large waves-effect waves-light red" href="generarreservatrasnporte.php" title="Generar pdf reserva Transporte"><i class="material-icons left">picture_as_pdf</i></a>
		      	</div>
		    </form>
	  	</div>
    </body>  
  </html>
 