<?php
  
  require_once("session.php");
  require_once("class.usuario.php");
  // Variables de session
  $auth_user = new Usuario();
  
  $user_id = $_SESSION['user1_session'];
  
  $stmt = $auth_user->runQuery("SELECT * FROM usuarios WHERE idUsuarios=:user_id");
  $stmt->execute(array(":user_id"=>$user_id));
  
  $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

  //Cerrar conexion 
  $stmt->closeCursor();
  $stmt = null;
  $auth_user = null;

?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <title>Principal</title>
    <meta name="viewport" content="width=500, initial-scale=1.0, maximum-scale=1, minimum-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <link rel="stylesheet" href="style.css" type="text/css"/>
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
  </head>

  <style>
    body{
      background: url(imagenes/Principal.png);
          background-size: 100% 100%;
          background-attachment: fixed;
          background-repeat: no-repeat;
          background-color: rgb(139, 203, 224);
    }

    label.h3 {
      text-align: left;
      font-family: Georgia;
      font-size: 22px;
      font-weight: 600;
    }

    p.h3 {
      text-align:justify;
      font-family: Georgia;
    }
  </style>

  <body>

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>

    <?php  
      include('NavBarUsuario.php');
    ?>
    
    <div class="container-fluid" style="margin-top:10px;">
    
      <div class="container">
        <div class="color" style="display: inline-block; padding: 0px 0px 5px 5px;"> 
        <div class='col-xs-3 col-sm-5 col-md-5 col-lg-5 visible-xs visible-sm visible-md visible-lg'> <!-- hidden-xs -->
        </div>
          
          <article>
            <p class="h3">PASOS PARA UTILIZAR LA APLICACION.:</p>
            <p class="h3"><b>1.</b> Te serbia para escoge tu mejor sitio turístico donde puedes pasar las vacaciones .<br>
              <p class="contenedor">
              En la barra de navegación escoge la opción de lo sitios turísticos><a style="color:black;" href="bares.php" title="Crear negocio">CrearBares</a> o desde el menú <a class="btn-floating btn-large btn black" title="Menu de opciones"><i class="large material-icons" style="color:white;">dehaze</i></a> escoge el icono <a class="btn-floating orange" href="bares.php" title="Crear bares"><i class="material-icons" style="color:white;">store</i></a>
              </p>
            </p>
            <i ></i>
            <p class="h3"><b>2.</b> 
            Administralo.
              <p class="contenedor1">
              En la barra de navegación escoge la opción Bares><a style="color:black;" href="negocio.php" title="Administrar negocio">NegociosCreados</a> o  desde el menu <a class="btn-floating btn-large btn black" title="Menu de opciones"><i class="large material-icons" style="color:white;">dehaze</i></a> escoge el icono <a class="btn-floating green" href="negocio.php" title="Negocios creados"><i class="material-icons" style="color:white;">business</i></a>
              </p>
            </p>
            <p class="h3"><b>3.</b> 
            Busca en el mapa el bar creado.
              <p class="contenedor1">
              En la barra de navegación escoge la opción Bares><a style="color:black;" href="barescreados.php" title="Bares Creados">BaresCreados</a> o  desde el menú <a class="btn-floating btn-large btn black" title="Menu de opciones"><i class="large material-icons" style="color:white;">dehaze</i></a> escoge el icono <a class="btn-floating red" href="barescreados.php" title="Bares creados"><i class="material-icons" style="color:white;">local_bar</i></a>
              </p>
            </p>
            <p class="h3">Con estos simples pasos la gente conocerá los sitios turísticos y sus productos.</p>
          </article>
        </div>
      </div>
    </div>

  </body>
</html>