<?php

require_once("class.administrador.php");

$sql="SELECT * FROM usuarios WHERE estado=1";
$miUsuario = new Administrador();

$usu=$miUsuario->runQuery($sql);
$usu->execute();

$userRow=$usu->fetch(PDO::FETCH_ASSOC);
if($userRow['estado'] == 1){

  session_start();

  if($miUsuario->is_loggedin()!="")
  {
      $miUsuario->redireccionar('hotelAdmin.php');
  }

  if(isset($_POST['btn-login']))//Si es presionado el botón Ingresar
  {
      $uname = $_POST['txt_uname_email'];
      $upass = $_POST['txt_password'];
          
      if($miUsuario->doLogin($uname,$upass))
      {
          $miUsuario->redireccionar('hotelAdmin.php');
      }
      else
      {
          $error = "Datos incorrectos";
      }   
  }
}

  //Cerrar conexion 
  $usu->closeCursor();
  $usu = null;
  $miUsuario = null;
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <title>Administrador</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <!-- <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> -->
    <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="style.css" type="text/css"/>
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="jquery.js"></script>
  </head>

  <style>
    body {
      background: url(imagenes/luuz.jpg);
      background-size: 100% 100%;
      background-attachment: fixed;
      background-repeat: no-repeat;
      background-color: #F1F1F1;
    }

    main {
      flex: 1 0 auto;
    }

    .input-field input[type=date]:focus + label,
    .input-field input[type=text]:focus + label,
    .input-field input[type=txt_uname_email]:focus + label,
    .input-field input[type=password]:focus + label {
      color: #e91e63;
    }

    .input-field input[type=date]:focus,
    .input-field input[type=text]:focus,
    .input-field input[type=txt_uname_email]:focus,
    .input-field input[type=password]:focus {
      border-bottom: 2px solid #e91e63;
      box-shadow: none;
    }
    
    .color
    {
      background: rgba(0,0,0,.2);
    }

    i.material-icons, label.blanco{
      color: white;
    }

    h5{
      color: white;
      text-align: justify;
    }

    div.row div.input-field input{
    size: 35;
    }

    input,
    input::-webkit-input-placeholder {
    font-size: 21px;
    line-height: 3;
    color: white;
    } 

    button {
    font-size: 26px;
    margin-left: auto;
    margin-right: auto;
    }

  </style>

<body>
  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <!-- js para mostrar la contraseña -->
  <script type="text/javascript" src="mostrarcontraseña.js"></script>

  <main>
    <center>
      <div class="section"></div>
      <div id="container">
      	<h3 style="color: white">CaiceTravel</h3>

        <div class="color" style="display: inline-block; padding: 0px 39px 0px 39px;"> 
          <form class="col s12 m12 l12" name="Ingresar" method="post">

            <h3 style="color: #FFD700">Iniciar sesión</h3>
            
            <!-- error -->
            <div id="error">
            <?php
                if(isset($error))
                {
                    ?>
                    <div class="alert alert-danger">
                       <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                    </div>
                    <?php
                }
            ?>
            </div>

            <br>  
            
            <div class="row">
              <div class="input-field col s12">
                <i class="material-icons prefix">account_circle</i>  
                <input placeholder="&#128272; Ingrese usuario o email" name="txt_uname_email" type="text" class="validate" style="color:white;font-size:15pt;" size="35" required>
                <label class="blanco" style="font-size:16pt;" for="txt_uname_email">Usuario o Email</label>
              </div>
            </div>
            
            <div class='row'>
              <div class="input-field col s12">
              <i class="material-icons prefix">vpn_key</i>
              <input placeholder="&#128272; Digite password" id="password" name="txt_password" type="password" class="validate" style="color:white;font-size:15pt;" size="35" required>
              <label class="blanco" style="font-size:16pt;" for="txt_password">Contraseña</label>
              </div>

              <p class="center1">
              <input name="VerPassword" id="VerPassword" type="checkbox">
              <label class="blanco" style="font-size:13pt;" for="VerPassword">Ver contraseña</label>
              </p>
            </div>

            <div class="row">
              <button class="col s7 m8 l8 offset-s3 offset-m2 offset-l2 waves-effect waves-light btn-large  indigo darken-4" type="submit" name="btn-login">Ingresar
              </button>  
            </div>      
			
			<label><a  href="index.php" style="font: 1.5em Arial, Helvetica, sans-serif;">Volver</a></label>
             
          </form>

          <div class="section"></div> 
          </div>
      </div>
            
    </center>
  </main>
</body>

</html>