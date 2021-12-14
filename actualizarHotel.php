<?php
require_once("sessionAdministrador.php");
require_once('class.administrador.php');

$administrador = new Administrador();

// devuelve el codigo de cada sitio
$codigo=$_GET['codigoS'];
$tipo=$_GET['tipoS'];

$sql="select * from hotel where codigo='$codigo'";
$stmt = $administrador->runQuery($sql);
$stmt->execute();

$fila=$stmt->fetch(PDO::FETCH_ASSOC);

// Variables de session para utilizar las funcionalidades, solo en el administrador
$user_id = $_SESSION['user_session'];
  
$stmt = $administrador->runQuery("SELECT * FROM usuarios WHERE idUsuarios=:user_id");
$stmt->execute(array(":user_id"=>$user_id));
  
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['btnGrabar']))
{
	$codigo1 = strip_tags($_POST['codigoo']);
	$descripcion1 = strip_tags($_POST['descripcionn']);
	$detalle1 = strip_tags($_POST['detallee']);
	$ubicacion1 = strip_tags($_POST['ubicacionn']);
	$latitud1=strip_tags($_POST['latitud']);
	$longitud1=strip_tags($_POST['longitud']);

	if($codigo1=="")	{
		$error[] = "Ingrese el código del hotel!";	
	}

	else if($descripcion1=="") {
		$error[] = "Ingrese la descripción del hotel!";	
	}

	else if($detalle1=="") {
		$error[] = "Ingrese el detalle del hotel!";	
	}

	else if($ubicacion1=="") {
		$error[] = "Ingrese la dirección del hotel!";	
	}

	else if ($latitud1=="" OR $longitud1=="") {
		$error[] = "Coordenadas no creadas por favor consulte la dirección,\\ndando click en la lupa";
	}

	else{
		try
		{
			$stmt = $administrador->runQuery("SELECT descripcion, ubicacion, latitud, longitud FROM hotel WHERE descripcion=:descripcion1 OR ubicacion=:ubicacion1 OR latitud=:latitud1 OR longitud=:longitud1");
			$stmt->execute(array(':descripcion1'=>$descripcion1, ':ubicacion1'=>$ubicacion1, ':latitud1'=>$latitud1, ':longitud1'=>$longitud1));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);

			if($row['descripcion']==$descripcion1) {
				$error[] = "La descripción del hotel ya existe,\\npor favor escriba otra descripción";
			}

			else if($row['ubicacion']==$ubicacion1) {
				$error[] = "La dirección del hotel ya existe,\\npor favor digite otra dirección";
			}

			else if($row['latitud']== $latitud1 AND $row['longitud']== $longitud1) {
				$error[] = "Las coordenadas ya existen, por favor verifique la dirección dando click en la lupa.\\nSi vuelve apareces este mensaje, por favor digite otra dirección y verifíquela dando click en la lupa.";
			}

			else
			{
				$sql="UPDATE hotel SET descripcion='$descripcion1', detalle='$detalle1', ubicacion='$ubicacion1', latitud='$latitud1', longitud='$longitud1', tipo='$tipo' WHERE codigo='$codigo1'";

				$stmt=$administrador->runQuery($sql);
				$stmt->execute();

				echo'<script type="text/javascript">
          		alert("Hotel Actualizado");     
          		window.location="listaHotel.php"
         		</script>';
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
		
	}
}

	//Cerrar conexion 
  	$stmt->closeCursor();
	$stmt = null;
  	$administrador = null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Actualizar Hotel</title>
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
	input.color, input.file-path, textarea.materialize-textarea{
	   	color:black;
  	}

	/*Pintar todos los titulos de negro*/
	label.color, h5.color{
		color:black;
	}

	/*Pintar todos los iconos de negro*/
  	i.material-icons{
  		color:black;
  	}
	
	/*Estilo para darle tamaño al titulo*/
  	p.titulo{
  		font: 1.3em Arial, Helvetica, sans-serif;
  	}
</style>

<script>
    mapa = {
	map : false, 
	marker : false,

      initMap : function() {
     
      // Creamos un objeto mapa y especificamos el elemento DOM donde se va a mostrar.
      mapa.map = new google.maps.Map(document.getElementById('mapa'), {
        center: {lat: 4.3333, lng: -75.8333 },
        scrollwheel: false,
        zoom: 14,
        zoomControl: true,
        rotateControl : false,
        mapTypeControl: true,
        streetViewControl: false,
      });
     
      // Creamos el marcador
      mapa.marker = new google.maps.Marker({
        position: {lat: 4.3333, lng: -75.8333},
        draggable: true,
      });

      mapa.marker.addListener( 'dragend', function (event)
      {
        document.getElementById("latitud").value = this.getPosition().lat();
        document.getElementById("longitud").value = this.getPosition().lng();
      });
     
      // Le asignamos el mapa a los marcadores.
      mapa.marker.setMap(mapa.map);
      },

      // función que se ejecuta al pulsar el botón buscar dirección
      getCoords : function()
      {
        // Creamos el objeto geodecoder
        var geocoder = new google.maps.Geocoder();
       
        address = document.getElementById('search').value;
        if(address!='')
        {
        // Llamamos a la función geodecode pasándole la dirección que hemos introducido en la caja de texto.
          geocoder.geocode({ 'address': address}, function(results, status)  
          {
            if (status == 'OK')
            {
            // Mostramos las coordenadas obtenidas en el p con id coordenadas
            var a= innerHTML=results[0].geometry.location.lat();
            var b= innerHTML=results[0].geometry.location.lng();
             
            document.getElementById('latitud').value=a;
            document.getElementById('longitud').value=b;
            // Posicionamos el marcador en las coordenadas obtenidas
            mapa.marker.setPosition(results[0].geometry.location);
            // Centramos el mapa en las coordenadas obtenidas
            mapa.map.setCenter(mapa.marker.getPosition());
            agendaForm.showMapaEventForm();
            }
          });
        }
      }
    }
</script>

<body onload="mapa.initMap()">
<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>

<div class="row">

    <?php	
		require_once('NavBarAdmin.php');
	?>

	<form class="col s12 m12 l12" name="enviar" method="POST" enctype="multipart/form-data">

		<?php  
			if(isset($error))
			{
			 	foreach($error as $error)
			 	{
					?>
	                    <script type="text/javascript">
					        alert("<?php echo $error; ?>");  
					        <?php echo "window.location='actualizarHotel.php?codigoS=$codigo&tipoS=$tipo'"; 
					    	?>   
					    </script> 
	                <?php
				}
			}
		?>

		<div class="col">

			<div style="margin-top: 0rem;" class="input-field col s12 m8 l6 offset-l1 offset-m1">
				<p class="titulo"><b>Bienvenido: </b><?php echo $userRow['nombre']; ?></p>
				<article>
					<h5 class="color">ACTUALIZAR HOTEL</h5>
				</article>
			</div>

			<!-- Mapa -->
			<div id="mapa" style="height:410px; margin-top: 0rem;" class="input-field col s12 m8 l10 offset-l1 offset-m1"></div>

            <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbbP6TH6nmNXVkYcnWYEPw6OtBNP6FhMc"> 
            </script>

	        <!--CODIGO-->
			<!-- <div class="input-field col s12 m8 l6 offset-l1 offset-m1"> -->
				<!-- <i class="material-icons prefix">vpn_key</i> -->
				<input maxLength="10" type="hidden" id="codigoo" name="codigoo" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;"
				placeholder=" Ingrese el codigo" class="color" value="<?php echo $fila['codigo']; ?>" required>
				<!-- <label class="color" for="codigoo">CODIGO</label> -->
			<!-- </div> -->

	        <!--descripción-->
	        <div class="input-field col s12 m8 l6 offset-l1 offset-m1">
	        	<i class="material-icons prefix">business</i>
				<input maxLength="30" type="text" pattern="-?[A-Za-záéíóúÁÉÍÓÚÑñ #-]*" id="descripcionn" name="descripcionn" class="color" placeholder=" Ingrese el nombre del hotel" value="<?php echo $fila['descripcion']; ?>" required>
				<label class="color" for="descripcionn">DESCRIPCION</label>
			</div>

			<!-- detalle -->
			<div class="input-field col s12 m8 l6 offset-l1 offset-m1">
				<i class="material-icons prefix">description</i>
				<textarea maxLength="300" id="detalle" name="detallee" rows=5 cols=40 class="materialize-textarea" placeholder=" Ingrese el detalle de los servicios que ofrece el hotel" required><?php echo $fila['detalle']; ?></textarea>
				<label class="color" for="detallee">DETALLE</label>
			</div>

			<!--ubicación-->
			<div class="input-field col s10 m8 l6 offset-l1 offset-m1">
				<i class="material-icons prefix">pin_drop</i>
				<input maxLength="45" type="text" pattern="-?[A-Za-záéíóúÁÉÍÓÚÑñ 0-9 #-]*" id="search" name="ubicacionn" class="color" placeholder=" Ingrese la direccion" value="<?php echo $fila['ubicacion']; ?>" required>
				<label class="color" for="ubicacionn">UBICACION</label>
            </div>

            <div class="input-field col s2 m2 l1">
              <a class="btn-floating btn-large waves-effect waves-light blue darken-2" onClick="mapa.getCoords()" style='width:56px; height:56px' title="Obtener Coordenadas a partir de una direccion"><i class="material-icons left" style="color:white;">search</i></a>
            </div>

			<!-- latitud -->
            <!-- <div class="input-field col s7 m8 l6 offset-l1 offset-m1"> -->
              <!-- <i class="material-icons prefix">location_on</i> -->
              <input type="hidden" id="latitud" name="latitud" value="<?php echo $fila['latitud']; ?>" placeholder=" Latitud" required>
              <!-- <label for="latitud">Latitud</label> -->
            <!-- </div> -->

			<!-- longitud -->
            <!-- <div class="input-field col s7 m8 l6 offset-l1 offset-m1"> -->
              <!-- <i class="material-icons prefix>location_on</i> -->
              <input type="hidden" id="longitud" name="longitud" value="<?php echo $fila['longitud']; ?>" placeholder=" Longitud" required>
              <!-- <label for="longitud">Longitud</label> -->
            <!-- </div> -->

		</div>

		<div class="col">
			<div class="input-field col s6 m3 l3 offset-l4 offset-m2">
				<button class="btn #1976d2 blue darken-2" type="submit" name="btnGrabar">ACTUALIZAR</button>
			</div>

			<div class="input-field col s6 m1 l1 offset-l3 offset-m3">
			 	<a class="waves-effect waves-light btn green darken-3" href="listaHotel.php">HOTELES</a>
			</div>
		</div>	

	</form>
</div>
    
</body>

<!-- js para validar solo letras en una etiqueta textarea -->
<script>
	// creamos el evento para cada tecla pulsada
	document.getElementById("detalle").addEventListener("keypress",verificar);
	function verificar(e) {

	// comprobamos con una expresión regular que el carácter pulsado sea
	// una letra, numero o un espacio
	if(e.key.match(/[a-zñçáéíóú.,!#$%&/()=?¿¡|*+;:_-\s]/i)===null) {

		// Si la tecla pulsada no es la correcta, eliminado la pulsación
		e.preventDefault();
	}
}
</script>

</html>