<?php
require_once("sessionAdministrador.php");
require_once('class.administrador.php');

// devuelve el codigo de cada sitio
$codigoH=$_GET['codigoS'];

$administrador = new Administrador();

// Variables de session para utilizar las funcionalidades, solo en el administrador
$user_id = $_SESSION['user_session'];
  
$stmt = $administrador->runQuery("SELECT * FROM usuarios WHERE idUsuarios=:user_id");
$stmt->execute(array(":user_id"=>$user_id));
  
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

// Consultar habitaciones creadas
$sql="SELECT codigo, descripcion, cantidad, precio FROM habitacion WHERE hotel=$codigoH ORDER BY descripcion desc";
$stmt1 = $administrador->runQuery($sql);
$stmt1->execute();

if(isset($_POST['btnGrabar']))
{
	$codigo = strip_tags($_POST['codigo']);
	$descripcion = strip_tags($_POST['descripcion']);
	$cantidad = strip_tags($_POST['cantidad']);
	$precio = strip_tags($_POST['precio']);
	$codigoHotel=strip_tags($_POST['codigoH']);

	if($codigo=="")	{
		$error[] = "Ingrese el código de la habitación!";	
	}

	else if($descripcion=="") {
		$error[] = "Ingrese la descripción de la habitación!";	
	}

	else if($cantidad=="") {
		$error[] = "Ingrese la cantidad de habitación, disponibles en el hotel!";
	}

	else if($precio=="") {
		$error[] = "Ingrese el precio de la habitación!";	
	}

	else if($codigoHotel=="") {
		$error[] = "Codigo del hotel invalido";
		echo'<script type="text/javascript">
			alert("Codigo del hotel invalido");
	      	window.location="listaHotel.php"
	     	</script>';
	}

	else{
		try
		{
			$stmt = $administrador->runQuery("SELECT codigo, descripcion FROM Habitacion WHERE codigo=:codigo OR descripcion=:descripcion");
			$stmt->execute(array(':codigo'=>$codigo, ':descripcion'=>$descripcion));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
				
			if($row['codigo']==$codigo) {
				$error[] = "El código del habitación ya existe,\\npor favor digite otro código";
			}

			else if($row['descripcion']==$descripcion) {
				$error[] = "La descripción del habitación ya existe,\\npor favor escriba otra descripción";
			}

			else
			{
				$sql="INSERT INTO habitacion values(
				'$codigo','$descripcion','$cantidad','$precio',
				'$codigoHotel')";

				$stmt=$administrador->runQuery($sql);
				$stmt->execute();

         		echo'<script type="text/javascript">
	      		alert("Habitacion Registrada");     
	      		window.location="habitacion.php?codigoS='.$codigoHotel.'"
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
	<title>Habitacion</title>
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

	/*Margen tabla*/
  	table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }

	/*Espacio Tabla*/
	th, td {
	    padding: 6px;
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

			<div style="margin-top: 0rem;" class="input-field col s12 m8 l6 offset-l1 offset-m1">
				<p class="titulo"><b>Bienvenido: </b><?php echo $userRow['nombre']; ?></p>
				<article>
					<h5 class="color">GUARDAR HABITACION</h5>
				</article>
			</div>

	        <!--CODIGO-->
			<div class="input-field col s12 m8 l6 offset-l1 offset-m1">
				<i class="material-icons prefix">vpn_key</i>
				<input maxLength="10" type="text" id="codigo" name="codigo" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;"
				placeholder=" Ingrese el codigo" class="color" value="<?php if(isset($error)){echo $codigo;}?>" 
				required>
				<label class="color" for="codigo">CODIGO</label>
			</div>

			<!-- descripcion -->
			<div class="input-field col s12 m8 l6 offset-l1 offset-m1">
				<i class="material-icons prefix">description</i>
				<textarea maxLength="45" id="descripcion" name="descripcion" rows=5 cols=40 class="materialize-textarea" placeholder=" Descripción habitación / servicios" required><?php if(isset($error)){echo $descripcion;}?></textarea>
				<label class="color" for="descripcion">DESCRIPCION</label>
			</div>

			<!-- cantidad -->
			<div class="input-field col s12 m8 l6 offset-l1 offset-m1">
				<i class="material-icons prefix">airline_seat_individual_suite</i>
				<input maxLength="10" type="text" id="cantidad" name="cantidad" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;"
				placeholder=" Ingrese la cantidad" class="color" value="<?php if(isset($error)){echo $cantidad;}?>" 
				required>
				<label class="color" for="cantidad">CANTIDAD</label>
			</div>

			<!--precio-->
	        <div class="input-field col s12 m8 l6 offset-l1 offset-m1">
	        	<i class="material-icons prefix">monetization_on</i>
				<input maxLength="10" type="text" onKeypress="if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode > 46 || event.keyCode < 46))  event.returnValue = false;" id="precio" name="precio" class="color" placeholder=" En decimales por ejemplo: 10.000" value="<?php if(isset($error)){echo $precio;}?>" required>
				<label class="color" for="precio">PRECIO</label>
			</div>

			<!--CODIGO HOTEL-->
			<div class="input-field col s12 m8 l6 offset-l1 offset-m1">
				<!-- <i class="material-icons prefix">business</i> -->
				<input maxLength="10" type="hidden" id="codigoH" name="codigoH" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;"
				placeholder=" Ingrese el codigo del Hotel" class="color" value="<?php echo $codigoH;?>" 
				required>
				<!-- <label class="color" for="codigoH">CODIGO HOTEL</label> -->
			</div>

		</div>

		<div class="col">
			<div class="input-field col s6 m3 l3 offset-l4 offset-m2" style="margin-top: 0rem;">
				<button class="btn #1976d2 blue darken-2" type="submit" name="btnGrabar">AGREGAR</button>
			</div>

			<div class="input-field col s6 m1 l1 offset-l3 offset-m3" style="margin-top: 0rem;">
			 	<a class="waves-effect waves-light btn green darken-3" href="listaHotel.php">HOTELES</a>
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
                <th>Código</th>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>E</th>
              </tr>
            </thead>

            <tbody class="BusquedaRapida">
            <?php
              while ($fila=$stmt1->fetch(PDO::FETCH_ASSOC)) 
              {
                echo "<tr>";
                echo "<td>".$fila['codigo']."</td>";
                echo "<td class='letra'>".$fila['descripcion']."</td>";
                echo "<td class='letra espacio'>".$fila['cantidad']."</td>";
                echo "<td class='letra espacio'>".$fila['precio']."</td>"; 

                echo "<td class='espacio'><a class='btn-floating btn-small waves-effect waves-light red' title='Eliminar Habitación' href='eliminarHabitacion.php?codigoS=".$fila['codigo']."&&habitacion=".$codigoH."'><i class='material-icons' style='color:#F1F1F1;'>
                delete</i></a></td>";

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
    
</body>

</html>

<script>
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