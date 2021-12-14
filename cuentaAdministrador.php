<?php
  
  require_once("sessionAdministrador.php");
  require_once('class.administrador.php');
  $auth_user = new Administrador();
  
  $user_id = $_SESSION['user_session'];
  
  $stmt = $auth_user->runQuery("SELECT * FROM usuarios WHERE idUsuarios=:user_id");
  $stmt->execute(array(":user_id"=>$user_id));
  
  $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
  require_once 'cuenta.entidad.php'; 
  require_once 'cuenta.model.php';

  $usu=new cuenta();
  $model=new cuentaModel();

  if(isset($_REQUEST['action'])) //si tiene informacion haga lo siguiente
  //SELECT idUsuarios, nombre, email, password, joining_date FROM usuarios
  {
    switch ($_REQUEST['action']) 
    {
      case 'actualizar':
      $usu->__SET('idUsuarios',$_REQUEST['idUsuarios']);
      $usu->__SET('nombre',$_REQUEST['nombre']);
      $usu->__SET('email',$_REQUEST['email']);
      $usu->__SET('password',$_REQUEST['password']);
      $usu->__SET('joining_date',$_REQUEST['joining_date']);

      $model->Actualizar($usu);
      header('Location:cuentaAdministrador.php');
      break;

      case 'eliminar':
      $model->Eliminar($_REQUEST['idUsuarios']);
      header('Location:cuentaAdministrador.php');
      break;

      case 'editar';
      $usu=$model->Obtener($_REQUEST['idUsuarios']);
      break;
    }
  }

  //Cerrar conexion 
  $stmt->closeCursor();
  $stmt = null;
  $auth_user = null;
?>

<!DOCTYPE html>
  <html lang="es">
    <head>
      <meta charset="UTF-8">
      <title>Cuenta</title>
      <!--Let browser know website is optimized for mobile-->
      <!-- <meta name="viewport" content="width=device-width, initial-scale=1"/> -->
      <meta name="viewport" content="width=500, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <script src='http://code.jquery.com/jquery-1.11.3.min.js'></script>
      <script type="text/javascript" src="jquery.js"></script>
      <script type="text/javascript" src="validar.js"></script>
      
    </head>
    
    <style>
      h5 {
        text-align: justify;
      }

      body {
        background-color: #F1F1F1;
      }

      input,
      input::-webkit-input-placeholder {
      color: #798081;
      } 

      i.material-icons, label.blanco{
        color: black;
      }

      textarea,
        textarea::-webkit-input-placeholder {
        color:#798081;
        }
      }

    </style>

    <body>
      <!-- Latest compiled and minified JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <!-- js para mostrar la contraseña -->
      <script type="text/javascript" src="mostrarcontraseña.js"></script>

      <?php 
        require_once('NavBarAdmin.php');
      ?>

      <br>

      <div class="container"> <!-- container -->
        <div class="row"> <!-- row -->

          <form action="?action=<?php echo $usu->idUsuarios > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" onsubmit="return cuentabar();">

            <br>

            <div class="input-field col s9 m11 l8">
              <input type="hidden" name="idUsuarios" value="<?php echo $usu->__GET('idUsuarios'); ?>" required="required" style="color:black;background-color:white;" placeholder=" id usuario">

              <i class="material-icons prefix">account_circle</i>
              <input type="text" id="nombre" name="nombre" value="<?php echo $usu->__GET('nombre'); ?>" required="required" style="color:black;background-color:white;" placeholder=" Usuario" data-length="20">
              <label class="blanco" style="font-size:12pt;" for="nombrebar">Usuario</label>
            </div>

            <div class="input-field col s9 m11 l8">
              <i class="material-icons prefix">email</i>
              <input type="email" id="email" name="email" value="<?php echo $usu->__GET('email'); ?>" placeholder=" Correo" required="required" style="color:black;background-color:white;" data-length="45">
              <label class="blanco" for="email" style="font-size:12pt;">Correo</label>
            </div>

            <div class="input-field col s4.1 m8 l8">
              <i class="material-icons prefix">vpn_key</i>
              <input type="password" id="password" name="password" required="required" placeholder=" Contraseña" style="color:black;background-color:white;" data-length="15">
              <label class="blanco" for="password" style="font-size:12pt;">Contraseña</label>
            </div>

            <div class="input-field col s4 m4 l3">
              <p>
              <input name="VerPassword" id="VerPassword" type="checkbox">
              <label class="blanco" for="VerPassword">Ver contraseña</label>
              </p>
            </div>

            <div class="input-field col s9 m11 l8">
              <!-- <i class="material-icons prefix">event_available</i> -->
              <input type="hidden" id="joining_date" name="joining_date" value="<?php echo $usu->__GET('joining_date'); ?>" required="required" placeholder=" Fecha de registro" style="color:black;background-color:white;"> 
              <!-- <label class="blanco" for="joining_date" style="font-size:12pt;">Fecha de registro</label> -->
              
              <button class="btn #1976d2 blue darken-2" type="submit">Guardar
              </button> &nbsp; <a class="waves-effect waves-light btn green darken-3" href="cuenta.php">Limpiar</a>
            </div>

          </form>   

        </div>
      </div>

      <div class="container">
        <table class="striped">
            <thead>
              <tr class="active">
                  <th style="text-align:left;">Nombre</th>
                  <th style="text-align:left;">Correo</th>
                  <th style="text-align:left;">Contraseña</th>
                  <!-- <th style="text-align:left;">Fecha de registro</th> -->
                  <th></th>
                  <th></th>
                  <!-- <?php echo $userRow['idUsuarios']; ?> -->
              </tr>
            </thead>
            <?php foreach($model->listarUsuarios($userRow['idUsuarios']) as $r): ?>
                <tr>
                  <td><?php echo $r->__GET('nombre'); ?></td>
                  <td><?php echo $r->__GET('email'); ?></td>
                  <td><?php echo $r->__GET('password'); ?></td>
                  <!-- <td><?php echo $r->__GET('joining_date'); ?></td> -->
                  <!-- <td><?php echo $r->__GET('idUsuarios'); ?></td> -->
                  <td>
                      <!-- <a href="?action=editar&idUsuarios=<?php echo $r->idUsuarios; ?>"><button class="btn btn-primary glyphicon glyphicon-pencil" title="Modificar"></button></a> -->

                      <a class='mover btn-floating btn-small waves-effect waves-light indigo' href="?action=editar&idUsuarios=<?php echo $r->idUsuarios; ?>" title='Actualizar'><i class='material-icons' style="color:white;">update</i></a> 
                  </td>
                  <td>
                      <!-- <a href="?action=eliminar&idUsuarios=<?php echo $r->idUsuarios; ?>"><button class="btn btn-danger glyphicon glyphicon-remove" title="Eliminar"></button></a> -->
                      <a class='mover btn-floating btn-small waves-effect waves-light red' href="?action=eliminar&idUsuarios=<?php echo $r->idUsuarios; ?>" title='Elimanar'><i class='material-icons' style="color:white;">delete</i></a>
                  </td>
                </tr>
            <?php 
            endforeach; 
            ?>
        </table> 
      </div>
      
    </body>
  </html>

  <script>
    $(document).ready(function() {
      $('.collapsible').collapsible();
    });
  </script>