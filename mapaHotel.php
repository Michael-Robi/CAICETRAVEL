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
    <title>Mapa Hoteles</title>
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

        /*margen hotel*/    
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

          <div id="map" class="input-field col s12 m7 l12"></div>
            
          </div>
          
          <script>
            var customLabel = {
            Hotel: {
              label: 'H'
            }
          };

              function initMap() {
              var map = new google.maps.Map(document.getElementById('map'), {
                center: new google.maps.LatLng(4.334262882331916, -75.8311016201294),
                zoom: 15
              });
              var infoWindow = new google.maps.InfoWindow;

                // Cargamos a hotel.xml una vez creado en la clase crearMapaHotel.php
                downloadUrl('crearMapaHotel.php', function(data) {
                  var xml = data.responseXML;
                  var markers = xml.documentElement.getElementsByTagName('marker');
                  Array.prototype.forEach.call(markers, function(markerElem) {

                    // Creamos la variable point la cual invoca las cordenadas de cada hotel y las marca con un punto en el mapa
                    var point = new google.maps.LatLng(
                        parseFloat(markerElem.getAttribute('latitud_hotel')),
                        parseFloat(markerElem.getAttribute('longitud_hotel')));

                    // creamos la variable codigo y llamamos la etiqueta codigo_hotel, la cual contiene el id de todos los hoteles creados, en la base de datos
                    var codigo = markerElem.getAttribute('codigo_hotel');

                    var descripcion= markerElem.getAttribute('descripcion_hotel');

                    var ubicacion= markerElem.getAttribute('ubicacion_hotel');

                    var detalle = markerElem.getAttribute('detalle_hotel');

                    var imagen= markerElem.getAttribute('imagen_hotel');

                    var latitud= markerElem.getAttribute('latitud_hotel');
                    var longitud= markerElem.getAttribute('longitud_hotel');

                    var tipo= markerElem.getAttribute('tipo_hotel');

                    //text.textContent = address
                    //infowincontent.appendChild(text);
                    
                    var icon = customLabel[tipo] || {};
                    var marker = new google.maps.Marker({
                      map: map,
                      position: point,
                      label: icon.label
                    });
                    marker.addListener('click', function() {
                      // si encuentra el codigo del hotel en la base de datos 
                      // devuelve las variables especificas para el hotel
                      // por ejemplo si hotel es 1: devuelve la descripcion, la imagen,
                      // el detalle y la ubicación.
                      // una vez invocadas estas variables, lo regirecciona a otra pagina, cuando de click en el boton que se encuentra en este formulario.
                      if (codigo) {

                      infoWindow.setContent('<form action=negocio.php method=post style="background: #F1F1F1;"> <input type="hidden" name="codigoH" value='+codigo+'><input type="hidden" name="tipoH" value='+tipo+'><p class="titulo" for="descripcionH">'+descripcion+'</p><img src="data:/jgp;base64,'+imagen+'" class="centrar"><div class="box"><p class="datos">'+detalle+'</p></div><p class="direccion">'+ubicacion+'</p><p class="boton"><button class="btn #212121 grey darken-4" type="submit" name="btnGuardar" title="Buscar Hotel">Buscar</button></p></form>');
                      infoWindow.open(map, marker);
                      };
                      
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
          
          <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiaXtLuZinVIWc5MRGCm61QQqziqqJbN0&sensor=false&signed_in=true&libraries=places&callback=initMap">
          </script>

        </div>
      </div>  
    </body>
  </html>