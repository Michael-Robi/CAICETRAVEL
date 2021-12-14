<?php
require_once("sessionAdministrador.php");
require_once('class.administrador.php');

$administrador = new Administrador();

// Variables de session para utilizar las funcionalidades, solo en el administrador
$user_id = $_SESSION['user_session'];
  
$stmt = $administrador->runQuery("SELECT * FROM usuarios WHERE idUsuarios=:user_id");
$stmt->execute(array(":user_id"=>$user_id));
  
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

$sql="SELECT codigo, descripcion, detalle, ubicacion, imagen, tipo FROM transporte ORDER BY ubicacion, codigo desc";
$stmt = $administrador->runQuery($sql);
$stmt->execute();

$contador=0;
?>

<!DOCTYPE html>
  <html>
    <head>
      <title>Lista de transportes</title>
      <!--etiqueta para codificar el idioma-->
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <style>
      body {
        margin: 0;
        padding: 0;
        background-color:rgb(185,215,253);
        font-family: Arial, Helvetica, sans-serif;
        color: #2E4053;
      }
      input,
        input::-webkit-input-placeholder {
        color: black;
      } 
      input.color{
        color:black;
        background-color:#F1F1F1;
      }
      label.titulo{
        color: black;
      }
      table{
        width: 100%;
      }
      table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
      }
      th, td {
        padding: 8px;
      }
      td.espacio {
        padding-right: 20px;
        padding-left: 20px;
      }
      td.letra{
        font: 0.9em Arial, Helvetica, sans-serif;
      }
      /*estilo letra cuando el navegador carge en cualquier lista*/
      nav.blue div.nav-wrapper ul.dropdown-content li a.estiloletra{
        font: 1.0em Arial, Helvetica, sans-serif;
      }
    </style>

    <body>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>

      <?php 
        require_once('NavBarAdmin.php');
      ?>

      <br>
      <br>
      <div class="container">
        <div class="row">

          <div class="input-field col s12 m12 l12">
            <i class="material-icons prefix">search</i>
            <input class="color" placeholder=" Ingrese el campo que quiera consultar" name="txtBuscador" id="FiltrarContenido" type="text" class="validate">
            <label class="titulo" style="font-size:12pt;" for="txtBuscador">Buscador</label>
          </div>
        
          <table class="striped centered">
            <thead>
              <tr>
                <th>N°</th>
                <th>Descripción</th>
                <th>Detalle</th>
                <th>Ubicación</th>
                <th>A</th>
                <th>E</th>
                <th>IMG</th>    
                <th>A IMG</th>
              </tr>
            </thead>

            <tbody class="BusquedaRapida">
            <?php
              while ($fila=$stmt->fetch(PDO::FETCH_ASSOC)) 
              {
                $contador++;
                $imagen=$fila['imagen'];
                echo "<tr>";
                echo "<td>".$contador."</td>";
                echo "<td>".$fila['descripcion']."</td>";
                echo "<td class='letra'>".$fila['detalle']."</td>";
                echo "<td class='letra espacio'>".$fila['ubicacion']."</td>";

                echo "<td class='espacio'><a class='btn-floating btn-small waves-effect waves-light green' title='Actualizar Transporte' href='actualizarTransporte.php?codigoS=".$fila['codigo']."&tipoS=".$fila['tipo']."'><i class='material-icons'>
                update</i></a></td>"; 

                echo "<td class='espacio'><a class='btn-floating btn-small waves-effect waves-light red' title='Eliminar Transporte' href='eliminarTransporte.php?codigoS=".$fila['codigo']."'><i class='material-icons'>
                delete</i></a></td>";

                echo '<td class="espacio"><img class="materialboxed" data-caption="'.$fila['descripcion'].'" width="80" height="70" src="data:/jgp;base64,'.base64_encode($imagen).'"></td>';

                echo "<td class='espacio'><a class='btn-floating btn-small waves-effect waves-light orange' title='Actualizar Imagen' href='actualizarTransporteImg.php?codigoS=".$fila['codigo']."'><i class='material-icons'>
                crop_original</i></a></td>";

                echo "</tr>";
              }

              //Cerrar conexion 
              $stmt->closeCursor();
              $stmt= null;
              $administrador = null;
            ?>
              
            </tbody>
          </table>

          <a class="btn-floating btn-small waves-effect waves-light indigo" title="Insertar Transporte" href="transporteAdmin.php"><i class="material-icons">add</i></a>

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