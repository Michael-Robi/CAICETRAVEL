<?php  
  require_once("sessionAdministrador.php");
  require_once('class.administrador.php');

  $administrador = new Administrador();

  // Variables de session para utilizar las funcionalidades, solo en el administrador
  $user_id = $_SESSION['user_session'];
    
  $stmt = $administrador->runQuery("SELECT * FROM usuarios WHERE idUsuarios=:user_id");
  $stmt->execute(array(":user_id"=>$user_id));
    
  $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

  //Cerrar conexion 
  $stmt->closeCursor();
  $stmt = null;
  $administrador = null;
?>

<!DOCTYPE html >
  <html lang="es">
    <head>
    <title>Mapa Sitios</title>
    <meta name="viewport" content="width=500, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!--Import Google Icon Font-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">  
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>

      <style>
        /* Optional: Makes the sample page fill the window. */
        html, body {
          height: 100%;
          margin: 0;
          padding: 0;
        }

        /*estilo pagina*/
        body {
          margin: 0;
          padding: 0;
          background: #F1F1F1;
          font-family: Arial, Helvetica, sans-serif;
          font-size: 12px;
        }

        /*margen migas de pan*/
        ul{
          margin-bottom: 0px;
        }
        
        /*ajustar descripcion al formulario*/
        div.box {
          overflow: hidden;
          margin-left: 10px;
          margin-right: 10px;
        }

        /*tamaño fijo del formulario*/
        form{
          width: 315px;
        }

        /*estilo para etiqueta p*/
        p {
          width: 210px;
          text-align: justify;
          font-family: Georgia;
          font-size: 16px;
        }

        /*estilo titulo*/
        p.titulo{
          text-align:center;
          width:auto;
          margin-bottom:3px;
          font-size:20px;
          font-weight: 600;
        }

        /*estilo datos*/
        p.datos{
          text-align:center;
          width:auto;
          margin-bottom:3px;
          font-size:20px;
        }

        /*estilo direccion*/
        p.direccion{
          text-align:center;
          width:auto;
          margin-bottom:3px;
          font-size:18px;
        }

        /*estilo boton*/
        p.boton{
          text-align:center;
          width:auto;
        }

        /*estilo imagen*/
        img.centrar{
          display: block;
          margin:auto;
          margin-bottom:5px;
          height:200px; 
          width:250px;
        }

        /*margen Sitios*/    
        @media screen and (max-width: 1500px)
        {
         .container
          {
            margin:0em 1em 0em 16em;
          }
          .row .col.s12
          {
            width: 100%;
            height: 670px;
            margin-top: 0rem;
            margin-left: auto;
            left: auto;
            right: auto;
          }

          @media screen and (max-width: 1300px)
          {
            .container
            {
              margin:0em 1em 0em 16em;
            }
            .row .col.s12 {
              width: 100%;
              height: 670px;
              margin-top: 0rem;
              margin-left: auto;
              left: auto;
              right: auto;
            }
          }

          @media screen and (max-width: 1100px)
          {
            .container
            {
              margin:0em 7em 0em 12em;
            }
            .row .col.s12 {
              width: 100%;
              height: 670px;
              margin-top: 0rem;
              margin-left: auto;
              left: auto;
              right: auto;
            }
          }

          @media screen and (max-width: 1000px)
          {
            .container
            {
              margin:0em 1em 0em 7em;
            }
            .row .col.s12 {
              width: 100%;
              height: 670px;
              margin-top: 0rem;
              margin-left: auto;
              left: auto;
              right: auto;
            }
          }
            
          @media screen and (max-width: 700px)
          {
            .container
            {
              margin:0em 1em 0em 1em;
            }
            .row .col.s12 {
              width: 100%;
              height: 670px; 
              margin-top: 0rem;
              margin-left: auto;
              left: auto;
              right: auto;
            }
          }

          @media screen and (max-width: 400px)
          {
            .container
            {
              margin:0em 1em 0em 1em;
            }
            .row .col.s12 {
              width: 360px;
              height: 670px; 
              margin-top: 0rem;
              margin-left: auto;
              left: auto;
              right: auto;
            }
          }
        }
      </style>
    </head>

    <body>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>

      <?php  
        include('NavBarAdmin.php');
      ?>

      <br>

      <div class="container">
        <div class="row">

          <div id="map" class="input-field col s12 m12 l12"></div>
            
        </div>
          
          <script>
          var customLabel = {
            Hotel: {
              label: 'H'
            },
            Restaurante: {
              label: 'R'
            },
            Bar: {
              label: 'B'
            },
            Lugar: {
              label: 'L'
            },
            Transporte: {
              label: 'T'
            }
          };

            function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
              center: new google.maps.LatLng(4.334262882331916, -75.8311016201294),
              zoom: 15
            });
            var infoWindow = new google.maps.InfoWindow;

              // Change this depending on the name of your PHP or XML file
              downloadUrl('crearMapaSitios.php', function(data) {
                var xml = data.responseXML;
                var markers = xml.documentElement.getElementsByTagName('marker');
                Array.prototype.forEach.call(markers, function(markerElem) {
                  var codigo = markerElem.getAttribute('codigo');
                  var descripcion = markerElem.getAttribute('descripcion');
                  var detalle = markerElem.getAttribute('detalle');
                  var ubicacion = markerElem.getAttribute('ubicacion');
                  var imagen= markerElem.getAttribute('imagen');
                  var tipo = markerElem.getAttribute('tipo');
                  var point = new google.maps.LatLng(
                      parseFloat(markerElem.getAttribute('lat')),
                      parseFloat(markerElem.getAttribute('lng')));

                  var icon = customLabel[tipo] || {};
                  var marker = new google.maps.Marker({
                    map: map,
                    position: point,
                    label: icon.label
                  });
                  marker.addListener('click', function() {
                    infoWindow.setContent('<form action=reserva.php method=post style="background: #F1F1F1;"> <input type="hidden" name="codigoS" value='+codigo+'><input type="hidden" name="tipoS" value='+tipo+'><p class="datos">'+tipo+'</p><p class="titulo">'+descripcion+'</p><img src="data:/jgp;base64,'+imagen+'" class="centrar"><div class="box"><p class="datos">'+detalle+'</p></div><p class="direccion">'+ubicacion+'</p><p class="boton"><button class="btn #212121 grey darken-4" type="submit" name="btnReserva" title="Generar reserva">Reserva</button></p></form>');
                    infoWindow.open(map, marker);
                  });
                });
              });
            }



          function downloadUrl(url, callback) {
            var request = window.ActiveXObject ?
                new ActiveXObject('Microsoft.XMLHTTP') :
                new XMLHttpRequest;

            request.onreadystatechange = function() {
              if (request.readyState == 4) {
                request.onreadystatechange = doNothing;
                callback(request, request.status);
              }
            };

            request.open('GET', url, true);
            request.send(null);
          }

          function doNothing() {}
        </script>
        <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiaXtLuZinVIWc5MRGCm61QQqziqqJbN0&sensor=false&signed_in=true&libraries=places&callback=initMap">
        </script>

      </div>  
    </body>
  </html>