<?php
require_once("sessionAdministrador.php");
require_once('class.administrador.php');
$administrador = new Administrador();

// devuelve el codigo de cada sitio
$codigo=$_GET['codigoS'];

$sql="select * from bar where codigo='$codigo'";
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

	$revisar = getimagesize($_FILES["imagen2"]["tmp_name"]);

	if($revisar !== false){
		try
		{
			$imagen2 = addslashes(file_get_contents($_FILES['imagen2']['tmp_name']));

			$sql2="UPDATE bar SET imagen='$imagen2' WHERE codigo='$codigo'";

			$stmt=$administrador->runQuery($sql2);
			$stmt->execute();

			echo'<script type="text/javascript">
      		alert("Imagen Actualizada");     
      		window.location="listaBar.php"
     		</script>';
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	else{
		$error[] = "Por favor ingrese la imagen";
	}
}
	//Cerrar conexion 
	$stmt->closeCursor();
  	$stmt= null;
  	$administrador = null;

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Actualizar Imagen</title>
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

  	/*Tamaño Cards*/
  	@media screen and (max-width: 1500px)
	{

		.row .col.s9 
		{
			width: 266px;
			margin-left: 20%;
			left: auto;
			right: auto;
		}

		@media screen and (max-width: 1300px)
		{
			.row .col.s9 {
				width: 266px;
				margin-left: 20%;
				left: auto;
				right: auto;
			}

		}

	  	@media screen and (max-width: 1100px)
		{
		    .row .col.s9 {
			    width: 266px;
				margin-left: 20%;
			    left: auto;
			    right: auto; 
			}

		}
	    
	  	@media screen and (max-width: 700px)
		{
		  	.row .col.s9 {
			    width: 266px;
			    margin-left: 10%;
			    left: auto;
			    right: auto;
			}

		}

		@media screen and (max-width: 500px)
		{
		  	.row .col.s9 {
			    width: 266px;
			    margin-left: auto;
			    left: auto;
			    right: auto;
			}

		}
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
					    <?php echo "window.location='actualizarBarImg.php?codigoS=$codigo'"; 
					    ?>    
					    </script> 
	                <?php
				}
			}
		?>

		<div class="col">

			<div style="margin-top: 0rem;" class="input-field col s12 m10 l9 offset-l2 offset-m2">
				<p class="titulo"><b>Bienvenido: </b><?php echo $userRow['nombre']; ?></p>
				<article>
					<h5 class="color">ACTUALIZAR DISCOTECA</h5>
				</article>
			</div>
	
			
			<?php
		        $codigo=$fila['codigo'];
		        $imagen=$fila['imagen']; 
		        $nombre=$fila['descripcion'];
		        $detalle=$fila['detalle'];

		        echo '
		        <div class="row" style="margin-bottom: 0px;">
		        	<div class="col s9 m6 l4 offset-l1 offset-m1">
		              <div class="card">
		                <div class="card-image waves-effect waves-block waves-light">
		                    <img class= "activator" src="data:/jgp;base64,'.base64_encode($imagen).'" width="100" height="250">   
		                </div>
		                <div class="card-content">
		                  <span class="card-title activator grey-text text-darken-4">'.$nombre.'<i class="material-icons right"></i></span>
		                </div>
		                <div class="card-reveal">
		                  <span class="card-title grey-text text-darken-4">'.$nombre.'<i class="material-icons right">close</i></span>
		                  <p>'.$detalle.'</p>
		                </div>
		              </div>
		            </div>
		        </div>';
		    ?>

			<!-- Adjuntar Imagen -->
			<div class="row" style="margin-bottom: 0px;">
				<div class="input-field col s12 m12 l11 offset-l2 offset-m2" style="margin-top: 0rem;">
					<div class="file-field input-field">
			            <div class="btn #1976d2 blue darken-2">
			              <span>Adjuntar Imagen Bar</span>
			              <input type="file" id="imagen" name="imagen2" accept="image/jpeg,image/png" >
			            </div>
			            <div class="file-path-wrapper">
			              <input class="file-path validate" type="text" placeholder=" Imagen jpg, png" required>
			            </div>
			        </div>
				</div>
			</div>

			<div class="col">
				<div class="input-field col s5 m3 l3 pull-s1 offset-l2 offset-m2" style="margin-top: 0rem;">
					<button class="btn #1976d2 blue darken-2" type="submit" name="btnGrabar">ACTUALIZAR</button>
				</div>

				<div class="input-field col s3 m1 l1 pull-s3 offset-l4 offset-m4" style="margin-top: 0rem;">
				 	<a class="waves-effect waves-light btn green darken-3" href="listaBar.php">Bares</a>
				</div>
			</div>

		</div>
	</form>
</div>
    
</body>

</html>