<?php
session_start();
require_once('class.usuario.php');
$usuario = new Usuario();

if($usuario->is_loggedin()!="")
{
	$usuario->redireccionar('principal.php');
}

if(isset($_POST['btn-signup']))
{
	$nombre = strip_tags($_POST['txt_uname']);
	$correo = strip_tags($_POST['txt_umail']);
	$pass = strip_tags($_POST['txt_upass']);	
	
	if($nombre=="")	{
		$error[] = "Ingrese nombre de usuario!";	
	}
	else if($correo=="")	{
		$error[] = "Ingrese un correo";	
	}
	else if(!filter_var($correo, FILTER_VALIDATE_EMAIL))	{
	    $error[] = 'Ingrese un correo válido';
	}
	else if($pass=="")	{
		$error[] = "Ingrese password";
	}
	else if(strlen($nombre) < 5 || strlen($nombre) > 20){
		$error[] = "El campo usuario debe contener un minimo 5 o un maximo de 20 caracteres";	
	}
	else if(strlen($correo) < 12 || strlen($correo) > 45){
		$error[] = "El campo correo debe contener un minimo 12 o un maximo de 45 caracteres";	
	}
	else if(strlen($pass) < 4 || strlen($pass) > 15){
		$error[] = "El campo contraseña debe contener un minimo 4 o un maximo de 15 caracteres";	
	}
	else
	{
		try
		{
			$stmt = $usuario->runQuery("SELECT nombre, email FROM usuarios WHERE nombre=:nombre OR email=:correo");
			$stmt->execute(array(':nombre'=>$nombre, ':correo'=>$correo));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
				
			if($row['nombre']==$nombre) {
				$error[] = "El Usuario ya existe";
			}
			else if($row['email']==$correo) {
				$error[] = "El Correo ya existe";
			}
			else
			{
				if($usuario->registrar($nombre,$correo,$pass)){	
					$usuario->redireccionar('registro.php?joined');

					//Cerrar conexion 
				    $stmt->closeCursor();
				    $stmt = null;
				    $usuario = null;
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>
	<meta charset="UTF-8">
	<title>Registro</title>
	<meta name="viewport" content="width=100, initial-scale=1.0, maximum-scale=1, minimum-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
	<link rel="stylesheet" href="style.css" type="text/css"  />
	<!-- jquery para que funcione la funcion de mostrar contraseña -->
	<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<!-- js para mostrar la contraseña -->
	<script type="text/javascript" src="mostrarcontraseñaenbootstrap.js"></script>
</head>
<style>
.form-signin{
	font-size: 16px;
	text-align: justify;
}

.signin-form{
	margin-top: 70px;
}

body{
	background: url(imagenes/calle.jpg);
      background-size: 100% 100%;
      background-attachment: fixed;
      background-repeat: no-repeat;
	background-color: rgb(139, 203, 224);
}
</style>
<body>

	<div class="signin-form">
		<div class="container">
		    	
	        <form method="post" class="form-signin">
	            <h2 class="form-signin-heading">Regístrate</h2><hr />
	            <?php
				if(isset($error))
				{
				 	foreach($error as $error)
				 	{
						 ?>
	                     <div class="alert alert-danger">
	                        <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
	                     </div>
	                     <?php
					}
				}
				else if(isset($_GET['joined']))
				{
					 ?>
	                 <div class="alert alert-primary">
	                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; Registro exitoso - <a href='usuario.php'>Ingresa aquí</a>
	                 </div>
	                 <?php
				}
				?>

	            <div class="form-group">
	            <input type="text" class="form-control" name="txt_uname" placeholder="Nombre del usuario" value="<?php if(isset($error)){echo $nombre;}?>" required style="color:black;"/>
	            </div>
	            <div class="form-group">
	            <input type="email" class="form-control" name="txt_umail" placeholder="Correo" value="<?php if(isset($error)){echo $correo;}?>" required style="color:black;">
	            </div>
	            <div class="input-group">
	            	<input type="password" class="form-control" name="txt_upass" placeholder="Contraseña" value="<?php if(isset($error)){echo $pass;}?>" required style="color:black;"/>
	            	<span id="show-hide-passwd" action="hide" class="input-group-addon glyphicon glyphicon glyphicon-eye-open"></span>
	            </div>
	            <div class="clearfix"></div><hr />
	            <div class="form-group">
	            	<button type="submit" class="btn btn-primary" name="btn-signup">
	                	<i class="glyphicon glyphicon-log-in"></i>&nbsp;Registrar
	                </button>
	            </div>
	            <label>¡Tienes cuenta! <a href="usuario.php">Volver</a></label>
	        </form>
	    </div>
	</div>

</body>
</html>