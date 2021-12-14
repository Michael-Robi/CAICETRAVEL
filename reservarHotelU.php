<?php
	require_once("session.php");
	require_once('class.usuario.php');

  	$usuario = new Usuario();

  	// devuelve el codigo de cada sitio
	$codigo=$_GET['codigoS'];
	$tipo=$_GET['tipoS'];
  	
  	// Variables de session
  	$auth_user = new Usuario();
  
  	$user_id = $_SESSION['user1_session'];
  
  	$stmt = $auth_user->runQuery("SELECT * FROM usuarios WHERE idUsuarios=:user_id");
  	$stmt->execute(array(":user_id"=>$user_id));
  
  	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

  	$id= $userRow['idUsuarios'];

	// Consultar habitaciones creadas
	$sql="SELECT ho.descripcion hotel, ho.codigo codigoH, h.descripcion habitacion, DATEDIFF(r.fechaSalida,r.fechaIngreso)+1 diasReservados, rh.precio totalAPagar, DATE_FORMAT(r.hora, '%h:%i %p') horaIngreso, r.fechaIngreso fechaIngreso, r.fechaSalida fechaSalida, rh.reserva consecutivo FROM usuarios u, reserva r, reservaHotel rh, habitacion h, hotel ho WHERE u.idUsuarios=r.usuario AND r.consecutivo=rh.reserva AND rh.habitacion=h.codigo AND h.hotel=ho.codigo AND u.idUsuarios=$id ORDER BY fechaIngreso,hotel ASC";

	$stmt1 = $usuario->runQuery($sql);
	$stmt1->execute();
 
    // echo $tipo.'<br/>codigo: '.$codigo.'<br/>';

    if(isset($_POST['btnGrabar']))
	{
		$consecutivo = strip_tags($_POST['consecutivo']);
		$formatoHora=date("H:i:s", strtotime($_POST['hora']));
		$hora = strip_tags($formatoHora);
		$fechaIngreso = strip_tags($_POST['fechaIngreso']);
		$fechaSalida = strip_tags($_POST['fechaSalida']);
		$nombre = strip_tags($_POST['nombre']);
		$habitacionE = strip_tags($_POST['habitacionE']);
		$habitacionC = strip_tags($_POST['habitacionC']);

		if($consecutivo=="")	{
			$error[] = "Ingrese el consecutivo de la reserva!";	
		}

		else if($hora=="") {
			$error[] = "Ingrese la hora de ingreso al hotel!";	
		}

		else if($fechaIngreso=="") {
			$error[] = "Ingrese la fecha de ingreso al hotel!";	
		}

		else if($fechaSalida=="") {
			$error[] = "Ingrese la fecha de salida!";	
		}

		else if($usuario=="") {
			$error[] = "Ingrese el nombre usuario!";	
		}

		else if($habitacionE=="") {
			$error[] = "No ha seleccionado la habitación!";	
		}

		else if($fechaSalida < $fechaIngreso) {
			$error[] = "La fecha de ingreso no puede ser mayor a la fecha de salida!";
		}

		else{
			try {
				$stmt = $usuario->runQuery("SELECT consecutivo FROM reserva WHERE consecutivo=:consecutivo");
				$stmt->execute(array(':consecutivo'=>$consecutivo));
				$row=$stmt->fetch(PDO::FETCH_ASSOC);

				if($row['consecutivo']==$consecutivo){
					$error[] = "El consecutivo de la reserva ya existe,\\npor favor digite otro consecutivo";
				}

				else{
					$stmt = $usuario->runQuery("SELECT idUsuarios FROM usuarios WHERE nombre=:nombre OR email=:nombre");
					$stmt->execute(array(':nombre'=>$nombre));
					$row=$stmt->fetch(PDO::FETCH_ASSOC);

					$nombreU=$row['idUsuarios'];

					if($nombreU==""){
					$error[] = "Usuario no registrado por favor registrese en la aplicacion";
					}

					else{
					$sql="CALL crearReservaHotel ('$consecutivo','$hora','$fechaIngreso','$fechaSalida','$nombreU','$habitacionC')";
					

					$stmt=$usuario->runQuery($sql);
					$stmt->execute();

					echo"<script type='text/javascript'>
          			alert('Hotel Reservado');     
          			window.location='reservarHotelU.php?codigoS=$codigo&tipoS=$tipo'
         			</script>";
         			}
				}
			} 
			catch (PDOException $e) {
				
			}
		}

	}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Reservar Hotel</title>
	<!--Import Google Icon Font-->
  	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  	<!--Import materialize.css-->
  	<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
</head>

<style>

	body{
		font-family: Arial, Verdana; 
	}

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
	input.color, input.file-path, textarea.materialize-textarea{
	   	color:black;
  	}

  	/*Pintar todos los titulos de negro*/
	div.input-field label.color{
		color:black;
		font-family: Arial, Verdana; 
	}

	/*Tipo de letra navegador*/
	nav.light-blue div.nav-wrapper .estiloletra{
		font-family: Arial, Verdana; 
	}

	/*Pintar todos los iconos de negro*/
  	i.material-icons {
  		color:black;
  	}

	/*Pintar todos los select de color negro*/
  	.dropdown-content li > a, .dropdown-content li > span {
    color: black !important;
    }

  	/*Control de contenedor sidenav*/    
	@media screen and (max-width: 1500px)
	{
		/*Margen del sidenav*/
	    .sliders
	    {
	      margin:0em 10em 0em 10em;
	    }

	    /*Tamaño del sidenav*/
	    div.row div.parallax-container {
	      height: 500px;
	  	}

		/*Tamaño de la imagen*/
	  	div.sliders div.slider ul.slides li img.size{
	  		background-size: 1049px 400px;
	  	}

	  	@media screen and (max-width: 1300px)
		{
			/*Margen del sidenav*/
		    .sliders
		    {
		      margin:0em 8em 0em 8em;
		    }

		    /*Tamaño del sidenav*/
		    div.row div.parallax-container {
		      height: 500px;
		  	}

			/*Tamaño de la imagen*/
		  	div.sliders div.slider ul.slides li img.size{
		  		background-size: 1041px 400px;
		  	}
		}

	  	@media screen and (max-width: 1100px)
		{
			/*Margen del sidenav*/
		    .sliders
		    {
		      margin:0em 8em 0em 8em;
		    }

		    /*Tamaño del sidenav*/
		    div.row div.parallax-container {
		      height: 500px;
		  	}

			/*Tamaño de la imagen*/
		  	div.sliders div.slider ul.slides li img.size{
		  		background-size: 852px 400px;
		  	}
		}

	 	@media screen and (max-width: 1000px)
		{
			/*Margen del sidenav*/
		    .sliders
		    {
		      margin:0em 8em 0em 8em;
		    }

		    /*Tamaño del sidenav*/
		    div.row div.parallax-container {
		      height: 500px;
		  	}

			/*Tamaño de la imagen*/
		  	div.sliders div.slider ul.slides li img.size{
		  		background-size: 752px 400px;
		  	}
		}

		@media screen and (max-width: 700px)
		{
			/*Margen del sidenav*/
		    .sliders
		    {
		      margin:0em 8em 0em 8em;
		    }

		    /*Tamaño del sidenav*/
		    div.row div.parallax-container {
		      height: 500px;
		  	}

			/*Tamaño de la imagen*/
		  	div.sliders div.slider ul.slides li img.size{
		  		background-size: 459px 400px;
		  	}

		}

		@media screen and (max-width: 600px)
		{
			/*Margen del sidenav*/
		    .sliders
		    {
		      margin:0em 1em 0em 1em;
		    }

		    /*Tamaño del sidenav*/
		    div.row div.parallax-container {
		      height: 500px;
		  	}

			/*Tamaño de la imagen*/
		  	div.sliders div.slider ul.slides li img.size{
		  		background-size: 553px 400px;
		  	}

		}

		@media screen and (max-width: 500px)
		{
			/*Margen del sidenav*/
		    .sliders
		    {
		      margin:0em 1em 0em 1em;
		    }

		    /*Tamaño del sidenav*/
		    div.row div.parallax-container {
		      height: 500px;
		  	}

			/*Tamaño de la imagen*/
		  	div.sliders div.slider ul.slides li img.size{
		  		background-size: 454px 400px;
		  	}

		}

		@media screen and (max-width: 400px)
		{
			/*Margen del sidenav*/
		    .sliders
		    {
		      margin:0em 1em 0em 1em;
		    }

		    /*Tamaño del sidenav*/
		    div.row div.parallax-container {
		      height: 500px;
		  	}

			/*Tamaño de la imagen*/
		  	div.sliders div.slider ul.slides li img.size{
		  		background-size: 355px 400px;
		  	}

		}

		@media screen and (max-width: 386px)
		{
			/*Margen del sidenav*/
		    .sliders
		    {
		      margin:0em 1em 0em 1em;
		    }

		    /*Tamaño del sidenav*/
		    div.row div.parallax-container {
		      height: 500px;
		  	}

			/*Tamaño de la imagen*/
		  	div.sliders div.slider ul.slides li img.size{
		  		background-size: 341px 400px;
		  	}

		}

	}
</style>

<body>

<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="js/materialize.min.js"></script>

<div class="row">

    <?php  
    	include('NavBarUsuario.php');
  	?>

	<div class="parallax-container">
        <!--ESLIDER EN LA PARTE INICIAL-->
        <div class="sliders" class="scrollspy section">
          <h3 style="line-height: 50%; color: black;">Hoteles</h3>
          <div class="slider">
            <ul class="slides">
              <li>
                  <img class="size" src="Imagenes/cafe.jpg"> <!-- random image -->
                  <div class="caption center-align">
                    <h3 class="letras">BIENVENIDO A CAICETRAVEL </h3>
                    <h5 class="letras" color="black" >EL MEJOR LUGAR DE TODOS PARA TODOS.</h5>
                 </div>
              </li>

            <?php
              $stmt = $usuario->runQuery("SELECT * FROM hotel");
              $stmt->execute();

              while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) { 
                $imagen=$row['imagen']; 
                $nombreSitio=$row['descripcion'];
                $detalle=$row['detalle'];

                echo '<li>
                      <img class="size" src="data:/jgp;base64,'.base64_encode($imagen).'">
                        <div class="caption center-align">
                          <h3 class="letras">'.$nombreSitio.'</h3>
                          <h5 class="letras" color="black">'.$detalle.'</h5>
                        </div>
                      </li>';
              }
            ?>
            </ul>
          </div>
        </div>
    </div>


	<form class="col s12 m12 l12" name="enviar" method="POST" enctype="multipart/form-data">

		<?php  
			if(isset($error))
			{
			 	foreach($error as $error)
			 	{
					?>
	                    <script type="text/javascript">
					        alert("<?php echo $error; ?>"); 
					    </script> 
	                <?php
				}
			}
		?>

		<div class="col">

	        <!--Consecutivo-->
			<div class="input-field col s12 m8 l6 offset-l1 offset-m1">
				<i class="material-icons prefix">vpn_key</i>
				<input maxLength="10" type="text" id="consecutivo" name="consecutivo" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;"
				placeholder=" Ingrese el consecutivo" class="color" value="<?php if(isset($error)){echo $consecutivo;}?>" 
				required>
				<label class="color" for="consecutivo" style="font-size: medium;">CONSECUTIVO</label>
			</div>

	        <!--hora-->
	        <div class="input-field col s12 m8 l6 offset-l1 offset-m1">
	        	<i class="material-icons prefix">access_alarms</i>
    			<input type="text" id="hora" name="hora" placeholder=" Ingrese la hora de la reserva" class="timepicker color"  value="<?php if(isset($error)){echo $hora;}?>" readonly>
    			<label class="color" for="hora" style="font-size: medium;">HORA</label>
			</div>

			<!--fechaIngreso-->
			<div class="input-field col s10 m8 l6 offset-l1 offset-m1">
				<i class="material-icons prefix">perm_contact_calendar</i>
				<input type="text" id="fechaIngreso" name="fechaIngreso" placeholder=" Ingrese la fecha de Ingreso" class="datepicker color" value="<?php if(isset($error)){echo $fechaIngreso;}?>" readonly>
				<label class="color" for="fechaIngreso" style="font-size: medium;">FECHA INGRESO</label>
            </div>

            <!--fechaSalida-->
			<div class="input-field col s10 m8 l6 offset-l1 offset-m1">
				<i class="material-icons prefix">date_range</i>
				<input type="text" id="fechaSalida" name="fechaSalida" placeholder=" Ingrese la fecha de salida" class="datepicker color" value="<?php if(isset($error)){echo $fechaSalida;}?>" readonly>
				<label class="color" for="fechaSalida" style="font-size: medium;">FECHA SALIDA</label>
            </div>

			<!-- Usuario -->
            <div class="input-field col s12 m8 l6 offset-l1 offset-m1">
				<i class="material-icons prefix">account_circle</i>
				<input type="text" id="nombre" name="nombre" placeholder=" Ingrese usuario o email" class="color" value="<?php echo $userRow['nombre']; ?>" readonly>
				<label class="color" for="nombre" style="font-size: medium;">USUARIO O EMAIL</label>
			</div>

            <!-- Habitación -->
            <div class="input-field col s12 m8 l6 offset-l1 offset-m1">
	          <i class="material-icons prefix">airline_seat_individual_suite</i>
	          <select id="habitacion" name="habitacion" onChange="precioHabitacion()">
	          <option value="" disabled selected>Seleccione la Habitación</option> 
	          	<?php
	          		// Consulta para validar las habitaciones disponibles en cada hotel
					$sql="SELECT * FROM habitacion where hotel='$codigo' AND cantidad<>'0'";
				    $stmt=$usuario->runQuery($sql);
					$stmt->execute();

      				while ($fila=$stmt->fetch(PDO::FETCH_ASSOC)) {

      					$codigoHabitacion=$fila['codigo'];
      					$Habitacion=$fila['descripcion'];
      					$Precio=$fila['precio'];

  			      		echo '<option value="'.$codigoHabitacion.'" 
  			      		>'.$Habitacion.' $'.$Precio.'</option>';
			        }
			      ?>
	          </select>
	          <label class="color" for="Habitacion" style="font-size: 14px;">HABITACION</label>
	        </div>

			<!-- Mostrar el Input, con la habitación escogida-->
  			<div class="input-field col s12 m8 l6 offset-l1 offset-m1">
				<i class="material-icons prefix">airline_seat_individual_suite</i>
				<input type="text" id="habitacionE" name="habitacionE" placeholder=" Habitación Escogida" class="color" value="<?php if(isset($error)){echo $habitacionE;}?>" readonly>
				<label class="color" for="habitacionE" style="font-size: medium;">USTED ESCOGIO</label>
			</div>

			<!-- Mostrar el Input, con la habitación escogida-->
  			<!-- <div class="input-field col s12 m8 l6 offset-l1 offset-m1"> -->
				<!-- <i class="material-icons prefix">airline_seat_individual_suite</i> -->
				<input type="hidden" id="habitacionC" name="habitacionC" placeholder=" Habitación Escogida" class="color" value="<?php if(isset($error)){echo $habitacionC;}?>" readonly>
				<!-- <label class="color" for="habitacionC" style="font-size: medium;">USTED ESCOGIO</label> -->
			<!-- </div> -->
		</div>

		<div class="col">
			<div class="input-field col s6 m3 l3 offset-l9 offset-m5" style="margin-top: 0rem;">
				<button class="btn #1976d2 blue darken-2" type="submit" name="btnGrabar">AGREGAR</button>
			</div>

			<br><br><br>
		</div>	

	</form>

	<div class="input-field col s12 m8 l6 offset-l1 offset-m1">
        <div class="row">

          <div class="input-field col s12 m12 l12">
            <i class="material-icons prefix">search</i>
            <input class="color" placeholder=" Ingrese el campo que quiera consultar" name="txtBuscador" id="FiltrarContenido" type="text" class="validate">
            <label class="color" style="font-size:12pt;" for="txtBuscador">Buscador</label>
          </div>
        
          <table class="striped centered">
            <thead>
              <tr>
                <th>HoraIngreso</th>
                <th>FechaIngreso</th>
                <th>fechaSalida</th>
                <th>Hotel</th>
                <th>Habitación</th>
                <th>DíasReservados</th>
                <th>TotalAPagar</th>
                <th>A</th>
              </tr>
            </thead>

            <tbody class="BusquedaRapida">
            <?php
              while ($fila=$stmt1->fetch(PDO::FETCH_ASSOC)) 
              {
                echo "<tr>";
                echo "<td>".$fila['horaIngreso']."</td>";
                echo "<td class='letra espacio'>".$fila['fechaIngreso']."</td>";
                echo "<td class='letra espacio'>".$fila['fechaSalida']."</td>"; 
                echo "<td class='letra espacio'>".$fila['hotel']."</td>";
                echo "<td class='letra espacio'>".$fila['habitacion']."</td>"; 
                echo "<td class='letra espacio'>".$fila['diasReservados']."</td>";
                echo "<td class='letra espacio'>".$fila['totalAPagar']."</td>";

                echo "<td class='espacio'><a class='btn-floating btn-small waves-effect waves-light green' title='Actualizar Reserva' href='actualizarReservaH.php?codigoS=".$fila['codigoH']."&&tipoS=".$tipo."&&idResevaH=".$fila['consecutivo']."'><i class='material-icons' style='color:#F1F1F1;'>
                update</i></a></td>";

                echo "</tr>";
              }

              //Cerrar conexion 
              $stmt1->closeCursor();
              $stmt1= null;
              $administrador = null;
            ?>
              
            </tbody>
          </table>

        </div>
    </div>
</div>

<?php
  	//Cerrar conexion 
  	$stmt->closeCursor();
  	$stmt = null;
  	$usuario = null;
?>
    
</body>

</html>

<script>
	function precioHabitacion()
	{
	  var habitacion, seleccion;
	// var str = "Hello world!";
 //    var res = str.substring(1, 4);
 //    document.getElementById("demo").innerHTML = res;

 	  habitacion= document.getElementById("habitacion").value;

 	  if(habitacion === ""){
 	  	alert("Por favor selecione la habitacion");
     	return true;
 	  }

 	  else{
 	  	seleccion=document.getElementById('habitacion');
	  	document.getElementById('habitacionE').value=seleccion.options[seleccion.selectedIndex].text;
	  	document.getElementById('habitacionC').value=seleccion.options[seleccion.selectedIndex].value;
 	  }
	  
	};

   $(document).ready(function(){ $('.slider').slider(); });

   $(document).ready(function(){
   	$('select').material_select();
    $('#hora').timepicker({
    	defaultTime: 'now',
    	showClearBtn: true,
    	i18n: {
    		cancel: 'Cancelar',
    		clear: 'Limpiar',
    		done: 'Aceptar'
    	}
    });

    $('#fechaIngreso').datepicker({
    	format: 'yyyy/mm/dd',
    	<?php date_default_timezone_set ('America/Bogota'); ?>
    	minDate: new Date('<?php echo date("Y/m/d"); ?>'),
    	showClearBtn: true,
    	i18n: {
    		cancel: 'Cancelar',
    		clear: 'Limpiar',
    		done: 'Aceptar',
    		months: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
    		'Julio','Agosto','Septiembre','Octubre','Noviembre',
    		'Diciembre'],
    		monthsShort: ['Ene','Feb','Mar','Abr','Mayo','Jun',
    		'Jul','Ago','Sep','Oct','Nov','Dic'],
    		weekdays: ['Domingo','Lunes','Martes','Miércoles','Jueves',
    		'Viernes','Sábado'],
    		weekdaysShort: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],
    		weekdaysAbbrev: ['D','L','Ma','Mi','J','V','S']
    	}
    });

    $('#fechaSalida').datepicker({
    	format: 'yyyy/mm/dd',
    	<?php date_default_timezone_set ('America/Bogota'); ?>
    	minDate: new Date('<?php echo date("Y/m/d"); ?>'),
    	showClearBtn: true,
    	i18n: {
    		cancel: 'Cancelar',
    		clear: 'Limpiar',
    		done: 'Aceptar',
    		months: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
    		'Julio','Agosto','Septiembre','Octubre','Noviembre',
    		'Diciembre'],
    		monthsShort: ['Ene','Feb','Mar','Abr','Mayo','Jun',
    		'Jul','Ago','Sep','Oct','Nov','Dic'],
    		weekdays: ['Domingo','Lunes','Martes','Miércoles','Jueves',
    		'Viernes','Sábado'],
    		weekdaysShort: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],
    		weekdaysAbbrev: ['D','L','Ma','Mi','J','V','S']
    	}
    });
  });

  $(document).ready(function () {
   (function($) {
       $('#FiltrarContenido').keyup(function () {
            var ValorBusqueda = new RegExp($(this).val(), 'i');
            $('.BusquedaRapida tr').hide();
             $('.BusquedaRapida tr').filter(function () {
                return ValorBusqueda.test($(this).text());
              }).show();
                })
      }(jQuery));
  });
</script>
