<?php
require_once("sessionAdministrador.php");
require_once('class.administrador.php');

$administrador = new Administrador();

// Variables de session para utilizar las funcionalidades, solo en el administrador
$user_id = $_SESSION['user_session'];
  
$stmt = $administrador->runQuery("SELECT * FROM usuarios WHERE idUsuarios=:user_id");
$stmt->execute(array(":user_id"=>$user_id));
  
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

$sql="SELECT h.descripcion hotel, ha.descripcion habitacion, ha.precio precio, SUM(DATEDIFF(r.fechaSalida,r.fechaIngreso)+1) diasReservados, SUM(rh.precio) totalAPagar,h.codigo codigo FROM reserva r, reservahotel rh, habitacion ha, hotel h WHERE r.consecutivo=rh.reserva AND rh.habitacion=ha.codigo AND ha.hotel=h.codigo GROUP BY rh.habitacion ORDER BY hotel ASC";
$stmt = $administrador->runQuery($sql);
$stmt->execute();

$sql1="SELECT h.descripcion hotel, SUM(rh.precio) totalAPagar FROM reserva r, reservahotel rh, habitacion ha, hotel h WHERE r.consecutivo=rh.reserva AND rh.habitacion=ha.codigo AND ha.hotel=h.codigo GROUP BY h.codigo ORDER BY hotel ASC";
$stmt1 = $administrador->runQuery($sql1);
$stmt1->execute();

$contador=0;
?>

<!DOCTYPE html>
  <html>
    <head>
      <title>Lista de pagos en Hoteles</title>
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
                <th>Hotel</th>
                <th>Habitación</th>
                <th>PrecioDiario</th>
                <th>DíasReservados</th>
                <th>TotalAPagar</th>
                <th>Pdf</th>
                <th>VerMas</th>
              </tr>
            </thead>

            <tbody class="BusquedaRapida">
            <?php
              while ($fila=$stmt->fetch(PDO::FETCH_ASSOC)) 
              {
                $contador++;
                echo "<tr>";
                echo "<td>".$contador."</td>";
                echo "<td>".$fila['hotel']."</td>";
                echo "<td class='letra'>".$fila['habitacion']."</td>";
                echo "<td class='letra espacio'>$ ".$fila['precio']."</td>";

                echo "<td class='letra'>".$fila['diasReservados']."</td>"; 

                echo "<td class='letra'>$ ".$fila['totalAPagar']."</td>";

                echo "<td class='espacio'><a class='btn-floating btn-small waves-effect waves-light red' title='Pdf Pagos Hotel' href='generarpagoshotel.php?codigoS=".$fila['codigo']."'><i class='material-icons'> picture_as_pdf</i></a></td>";

                echo "<td class='espacio'><a class='btn-floating btn-small waves-effect waves-light black' title='Habitaciones Reservadas' href='habitacionReservada.php?codigoS=".$fila['codigo']."'><i class='material-icons'> airline_seat_individual_suite</i></a></td>";

                echo "</tr>";
              }

              //Cerrar conexion 
              $stmt->closeCursor();
              $stmt= null;
              $administrador = null;
            ?>
              
            </tbody>
          </table>

        </div>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

        <div id="grafico"></div>

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

<!-- Codigo grafico pastel -->
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {

    var data = google.visualization.arrayToDataTable([
      ['hotel', 'Pagos'],
        <?php

          while($fila=$stmt1->fetch(PDO::FETCH_ASSOC)) 
          {
            echo "['".$fila["hotel"]."',".number_format($fila["totalAPagar"],3)."],";
          }

          //Cerrar conexion 
          $stmt1->closeCursor();
          $stmt1= null;
          $administrador = null;
        ?>
      ]);

    var options = {
        title: 'Grafico de Hoteles - Ganancias',
        is3D: true, 
        backgroundColor: 'transparent',
        chartArea:{left:20,top:0,width:'60%',height:'75%'},
        fontName: 'Arial'
    };

    var chart = new google.visualization.PieChart(document.getElementById('grafico'));

    chart.draw(data, options);
  }
</script>