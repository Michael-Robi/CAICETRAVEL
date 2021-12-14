<?php
  require_once('class.usuario.php');
  $usuario = new Usuario();

  require_once("session.php");
  // Variables de session
  $auth_user = new Usuario();
  
  $user_id = $_SESSION['user1_session'];
  
  $stmt = $auth_user->runQuery("SELECT * FROM usuarios WHERE idUsuarios=:user_id");
  $stmt->execute(array(":user_id"=>$user_id));
  
  $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>

<html lang="es">
<head>
    
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Hoteles</title>
  
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css"> -->

  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script> -->
  <!--Import Google Icon Font-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

</head>

<style type="text/css"> 

  nav{ 
    position: inherit;   
    top: 0;
    left: 0; 
    width: 100%; 
  }

  body{
    margin: 0;
    padding: 0;
    height: 100vh;
  }

  h3{
    margin: 0rem 0 0rem 0;
    font-size: 2.5rem;
  }

  .letras{
    color: white;
  }

  .row{
    margin-bottom: 2px;
  }

  /*Control de contenedor Productos*/    
  @media screen and (max-width: 1500px)
  {
    /*Margen del sidenav*/
    .sliders
    {
      margin:4em 16em 0em 16em;
    }

    /*Tamaño del sidenav*/
    div.parallax-container {
      height: 500px;
    }

    /*Tamaño de la imagen*/
    div.sliders div.slider ul.slides li img.size{
      background-size: 902px 402px;
    }

    /*Contenedor Cards*/
    .contenedor{
      margin:1em 0em 0em 5em; 
    }

    /*Contenedor Titulo de cada Sitio*/
    h3.contenedor{
      margin: 0em 0em 0em 0.2em;
    }

    /*Tamaño Cards*/
    .row .col.s3 {
      width: 33%;
      margin-left: auto;
      left: auto;
      right: auto;
    }

    @media screen and (max-width: 1300px)
    {
      /*Margen del sidenav*/
      .sliders
      {
        margin:4em 16em 0em 16em;
      }

      /*Tamaño del sidenav*/
      div.parallax-container {
        height: 500px;
      }

      /*Tamaño de la imagen*/
      div.sliders div.slider ul.slides li img.size{
        background-size: 836px 402px;
      }

      /*Contenedor Cards*/
      .contenedor{
        margin:1em 0em 0em 5em;
      }

      /*Contenedor Titulo de cada Sitio*/
      h3.contenedor{
        margin: 0em 0em 0em 0.2em;
      }

      /*Tamaño Cards*/
      .row .col.s3 {
        width: 33%;
        margin-left: auto;
        left: auto;
        right: auto;
      }

    }

    @media screen and (max-width: 1100px)
    {
      /*Margen del sidenav*/
      .sliders
      {
        margin:4em 16em 0em 16em;
      }

      /*Tamaño del sidenav*/
      div.parallax-container {
        height: 500px;
      }

      /*Tamaño de la imagen*/
      div.sliders div.slider ul.slides li img.size{
        background-size: 638px 402px;
      }

      /*Contenedor Cards*/
      .contenedor{
        margin:1em 0em 0em 5em;
      }

      /*Contenedor Titulo de cada Sitio*/
      h3.contenedor{
        margin: 0em 0em 0em 0.2em;
      }

      /*Tamaño Cards*/
      .row .col.s3 {
        width: 33%;
        margin-left: auto;
        left: auto;
        right: auto;
      }

    }

    @media screen and (max-width: 1000px)
    {
      /*Margen del sidenav*/
      .sliders
      {
        margin:4em 13em 0em 13em;
      }

      /*Tamaño del sidenav*/
      div.parallax-container {
        height: 500px;
      }

      /*Tamaño de la imagen*/
      div.sliders div.slider ul.slides li img.size{
        background-size: 621px 402px;
      }

      /*Contenedor Cards*/
      .contenedor{
        margin:1em 0em 0em 0em;
      }

      /*Contenedor Titulo de cada Sitio*/
      h3.contenedor{
        margin: 0em 0em 0em 0.3em;
      }

      /*Tamaño Cards*/
      .row .col.s3 {
        width: 33%;
        margin-left: auto;
        left: auto;
        right: auto;
      }

      img.activator{
        height: 220px;
      }
    }

    @media screen and (max-width: 900px)
    {
      /*Margen del sidenav*/
      .sliders
      {
        margin:4em 7em 0em 7em;
      }

      /*Tamaño del sidenav*/
      div.parallax-container {
        height: 500px;
      }

      /*Tamaño de la imagen*/
      div.sliders div.slider ul.slides li img.size{
        background-size: 689px 402px;
      }

      /*Contenedor Cards*/
      .contenedor{
        margin:1em 0em 0em 0em;
      }

      /*Contenedor Titulo de cada Sitio*/
      h3.contenedor{
        margin: 0em 0em 0em 0.3em;
      }
      
      /*Tamaño Cards*/
      .row .col.s3 {
        width: 36%;
        margin-left: auto;
        left: auto;
        right: auto;
      }

      img.activator{
        height: 220px;
      }
    }

    @media screen and (max-width: 800px)
    {
      /*Margen del sidenav*/
      .sliders
      {
        margin:4em 7em 0em 7em;
      }

      /*Tamaño del sidenav*/
      div.parallax-container {
        height: 500px;
      }

      /*Tamaño de la imagen*/
      div.sliders div.slider ul.slides li img.size{
        background-size: 589px 402px;
      }

      /*Contenedor Cards*/
      .contenedor{
        margin:1em 0em 0em 0em;
      }

      /*Contenedor Titulo de cada Sitio*/
      h3.contenedor{
        margin: 0em 0em 0em 0.3em;
      }
      
      /*Tamaño Cards*/
      .row .col.s3 {
        width: 36%;
        margin-left: auto;
        left: auto;
        right: auto;
      }

      img.activator{
        height: 220px;
      }
    }
	
    @media screen and (max-width: 700px)
    {
      /*Margen del sidenav*/
      .sliders
      {
        margin:4em 7em 0em 7em;
      }

      /*Tamaño del sidenav*/
      div.parallax-container {
        height: 500px;
      }

      /*Tamaño de la imagen*/
      div.sliders div.slider ul.slides li img.size{
        background-size: 489px 402px;
      }

      /*Contenedor Cards*/
      .contenedor{
        margin:1em 0em 0em 0em;
      }

      /*Contenedor Titulo de cada Sitio*/
      h3.contenedor{
        margin: 0em 0em 0em 0.3em;
      }
      
      /*Tamaño Cards*/
      .row .col.s3 {
        width: 36%;
        margin-left: auto;
        left: auto;
        right: auto;
      }

      img.activator{
        height: 220px;
      }
    }
    
    @media screen and (max-width: 600px)
    {
      /*Margen del sidenav*/
      .sliders
      {
        margin:4em 1em 0em 1em;
      }

      /*Tamaño del sidenav*/
      div.parallax-container {
        height: 500px;
      }

      /*Tamaño de la imagen*/
      div.sliders div.slider ul.slides li img.size{
        background-size: 567px 402px;
      }

      /*Contenedor Cards*/
      .contenedor{
        margin:1em 0em 0em 0em;
      }

      /*Contenedor Titulo de cada Sitio*/
      h3.contenedor{
        margin: 0em 0em 0em 0.3em;
      }
      
      /*Tamaño Cards*/
      .row .col.s3 {
        width: 50%;
        margin-left: auto;
        left: auto;
        right: auto;
      }

      img.activator{
        height: 200px;
      }
    }

    @media screen and (max-width: 500px)
    {
      /*Margen del sidenav*/
      .sliders
      {
        margin:2em 1em 0em 1em;
      }

      /*Tamaño del sidenav*/
      div.parallax-container {
        height: 500px;
      }

      /*Tamaño de la imagen*/
      div.sliders div.slider ul.slides li img.size{
        background-size: 467px 402px;
      }

      /*Contenedor Cards*/
      .contenedor{
        margin:1em 0em 0em 0em;
      }

      /*Contenedor Titulo de cada Sitio*/
      h3.contenedor{
        margin: 0em 0em 0em 0.3em;
      }
      
      /*Tamaño Cards*/
      .row .col.s3 {
        width: 50%;
        margin-left: auto;
        left: auto;
        right: auto;
      }

      img.activator{
        height: 200px;
      }
    }

    @media screen and (max-width: 400px)
    {
      /*Margen del sidenav*/
      .sliders
      {
        margin:2em 1em 0em 1em;
      }

      /*Tamaño del sidenav*/
      div.parallax-container {
        height: 500px;
      }

      /*Tamaño de la imagen*/
      div.sliders div.slider ul.slides li img.size{
        background-size: 367px 402px;
      }

      /*Contenedor Cards*/
      .contenedor{
        margin:1em 0em 0em 0em;
      }

      /*Contenedor Titulo de cada Sitio*/
      h3.contenedor{
        margin: 0em 0em 0em 0.3em;
      }
      
      /*Tamaño Cards*/
      .row .col.s3 {
        width: 50%;
        margin-left: auto;
        left: auto;
        right: auto;
      }

      img.activator{
        height: 200px;
      }
    }

    @media screen and (max-width: 386px)
    {
      /*Margen del sidenav*/
      .sliders
      {
        margin:2em 0.2em 0em 0.2em;
      }

      /*Tamaño del sidenav*/
      div.parallax-container {
        height: 500px;
      }

      /*Tamaño de la imagen*/
      div.sliders div.slider ul.slides li img.size{
        background-size: 364px 402px;
      }

      /*Contenedor Cards*/
      .contenedor{
        margin:1em 0em 0em 0em;
      }

      /*Contenedor Titulo de cada Sitio*/
      h3.contenedor{
        margin: 0em 0em 0em 0.3em;
      }
      
      /*Tamaño Cards*/
      .row .col.s3 {
        width: 100%;
        margin-left: auto;
        left: auto;
        right: auto;
      }

      img.activator{
        height: 200px;
      }
    }

  }    
  /*Fin de los estilos del contenedor*/

  /*ajustar descripcion al formulario*/
  div.box {
    font-family: Arial, Helvetica, sans-serif;
    overflow: hidden;
    margin-left: 10px;
    margin-right: 10px;
  }

  /*tamaño fijo del formulario*/
  form{
    width: 315px;
  }

  /*estilo titulo*/
  p.titulo{
    width: 210px;
    text-align: justify;
    font-family: Georgia;
    font-size: 16px;
    text-align:center;
    width:auto;
    margin-bottom:3px;
    font-size:20px;
    font-weight: 600;
  }

  /*estilo datos*/
  p.datos{
    font-family: Arial, Helvetica, sans-serif;
    text-align:center;
    width:auto;
    margin-bottom:3px;
    font-size:20px;
  }

  /*estilo direccion*/
  p.direccion{
    font-family: Arial, Helvetica, sans-serif;
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
    font-family: Arial, Helvetica, sans-serif;
    display: block;
    margin:auto;
    margin-bottom:5px;
    height:100px; 
    width:220px;
  }

  /*margen Sitios*/    
  @media screen and (max-width: 1500px)
  {
   .container
    {
      margin:0em 1em 0em 13em;
    }
    .row .mapa
    {
      width: 100%;
      height: 430px;
      margin-top: 0rem;
      margin-left: auto;
      left: auto;
      right: auto;
    }

    @media screen and (max-width: 1300px)
    {
      .container
      {
        margin:0em 1em 0em 13em;
      }
      .row .mapa {
        width: 100%;
        height: 430px;
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
      .row .mapa {
        width: 100%;
        height: 430px;
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
        margin:0em 1em 0em 4em;
      }
      .row .mapa {
        width: 100%;
        height: 430px;
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
        margin:0em 1em 0em 2em;
      }
      .row .mapa {
        width: 100%;
        height: 430px; 
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
      .row .mapa {
        width: 360px;
        height: 430px; 
        margin-top: 0rem;
        margin-left: auto;
        left: auto;
        right: auto;
      }
    }
  }
</style>

<body>
  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>

  <!-- Función para obtener el Tamaño de la pantalla en px -->
  <!-- <script type="text/javascript" src="calcularTamañoPantalla.js"></script>

  <div id="anchoV"></div>
  <div id="altoV"></div> -->

  
  <!-- Función para cambiar la clase card, por card horizontal si el ancho de la pantalla es menor de 369-->
  <script type="text/javascript" src="cambiarCards.js"></script>
 
  <?php  
    include('NavBarUsuario.php');
  ?>

  <div class="parallax-container">
    <div class="parallax"><img src="imagenes/iglesiass.jpg"></div>

  <!--ESLIDER EN LA PARTE INICIAL-->
  <div class="sliders">
    <div class="slider">
      <ul class="slides">
       <li>
          <img class="size" src="Imagenes/cafe.jpg"> <!-- random image -->
          <div class="caption center-align">
            <h3 class="letras">BIENVENIDO A CAICETRAVEL </h3>
            <h5 class="letras" color="black" >EL MEJOR LUGAR DE TODOS PARA TODOS.</h5>
          </div>
       </li>
       <li>
          <img class="size" src="Imagenes/samaria.jpg"> <!-- random image -->
          <div class="caption left-align">
            <h3 class="letras">UNO DE LOS LUGARES QUE SI LO VISITAS NO VAS A QUERERTE IR </h3>
            <h5 class="letras">VISITARLO NO TE VAS A ARREPENTIR DE VISITAR NUESTRO MUNICIPIO </h5>
          </div>
       </li>
       <li>
          <img class="size" src="Imagenes/club.jpg"> <!-- random image -->
          <div class="caption right-align">
            <h3 class="letras">VISTANOS EN TUS MEJORES VACACIONES</h3>
            <h5 class="letras">CAICEDONIA VALLE PARA TODOS</h5>
          </div>
       </li>

      </ul>
   </div>
  </div>
    
    <script type="text/javascript">
      $(document).ready(function(){ $('.slider').slider(); });
    </script>
    
  </div>

  <!-- <div class="section white">
    <div class="row container">
      <h2 class="header">Productos</h2>
      <p class="grey-text text-darken-3 lighten-3">AQUI ENCONTRARAS LOS SITIOS DONDE QUE QUIERAS VISTAR. </p>
    </div>
  </div>

  <div class="parallax-container">
    <div class="parallax"><img src="Imagenes/caice6.jpg"></div> 
  </div> -->
     
  <script type="text/javascript">
    $(document).ready(function(){ $('.parallax').parallax(); });
   </script> 
  
  <div class="container">
    <div class="row">

      <div id="map" class="input-field col s12 m12 l12 mapa"></div>
        
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
          zoom: 14
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
                infoWindow.setContent('<form action=reservaU.php method=post style="background: #F1F1F1;"> <input type="hidden" name="codigoS" value='+codigo+'><input type="hidden" name="tipoS" value='+tipo+'><p class="datos">'+tipo+'</p><p class="titulo">'+descripcion+'</p><img src="data:/jgp;base64,'+imagen+'" class="centrar"><div class="box"><p class="datos">'+detalle+'</p></div><p class="direccion">'+ubicacion+'</p><p class="boton"><button class="btn #212121 grey darken-4" type="submit" name="btnReserva" title="Generar reserva">Reserva</button></p></form>');
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

  <div class="contenedor">

    <?php
    		// $Host = 'localhost';
      //       $Username = 'root';
      //       $Password = '';
      //       $dbName = 'caicetravel01';
            
            //Crear conexion con la abse de datos
            // $db = new mysqli($Host, $Username, $Password, $dbName);
            
            // Cerciorar la conexion
            // if($db->connect_error){
            //     die("Connection failed: " . $db->connect_error);
            // }

            
          //  $codigo=$_GET['codigo'];
            
            //Insertar imagen en la base de datos


    // $consulta = "select * from hotel";
    //echo $consulta;
    // if ($resultado = $db->query($consulta)) {

        /* obtener un array asociativo 
         <img class="activator" src="data:image/jpg;base64,<?php echo base64_encode($reg['imagen']); ?> " width="800" height="300">
        imagen']); ?> " width="800" height="300">
        */
        //header("Content-type:image/jpeg");
        
    // }

    // $consulta2 = "select * from restaurante";
    //echo $consulta;
    // if ($resultado2 = $db->query($consulta2)) {

        /* obtener un array asociativo 
         <img class="activator" src="data:image/jpg;base64,<?php echo base64_encode($reg['imagen']); ?> " width="800" height="300">
        imagen']); ?> " width="800" height="300">
        */
        //header("Content-type:image/jpeg");
        
    // }
    // $consulta3 = "select * from bar";
    //echo $consulta;
    // if ($resultado3 = $db->query($consulta3)) {

        /* obtener un array asociativo 
         <img class="activator" src="data:image/jpg;base64,<?php echo base64_encode($reg['imagen']); ?> " width="800" height="300">
        imagen']); ?> " width="800" height="300">
        */
        //header("Content-type:image/jpeg") transporte;
        
    // }
    // $consulta4 = "select * from lugar";
    // if ($resultado4 = $db->query($consulta4)) {   
    // }
    // $consulta5 = "select * from transporte";
    // if ($resultado5 = $db->query($consulta5)) {   
    // }
    ?>

  	<?php
    echo '<h3 class="contenedor">Hoteles</h3>
          <div class="row">';
  	// while ($fila = $resultado->fetch_assoc()) {
      $stmt1 = $usuario->runQuery("SELECT * FROM hotel");
      $stmt1->execute();

      while ($fila=$stmt1->fetch(PDO::FETCH_ASSOC)) {
        $codigo=$fila['codigo'];
        $imagen=$fila['imagen']; 
        $nombre=$fila['descripcion'];
        $detalle=$fila['detalle'];
        $tipo=$fila['tipo'];

        echo '
            <div class="col s3">
              <div class="card" id="tamañoC">
                <div class="card-image waves-effect waves-block waves-light">
                    <img class= "activator" src="data:/jgp;base64,'.base64_encode($imagen).'" width="500" height="350">   
                </div>
                <div class="card-content">
                  <span class="card-title activator grey-text text-darken-4">'.$nombre.'<i class="material-icons right"></i></span>
                  <p><a href="mapaHotelesU.php?codigoS='.$codigo.'">Ver en el mapa</a></p>
                  <p><a href="reservarHotelU.php?codigoS='.$codigo.'&tipoS='.$tipo.'">Reservar</a></p>
                </div>
                <div class="card-reveal">
                  <span class="card-title grey-text text-darken-4">'.$nombre.'<i class="material-icons right">close</i></span>
                  <p>'.$detalle.'</p>
                </div>
              </div>
            </div>';
      }
    // }
    echo '</div>';
    ?>

    <?php
    	//Cerrar conexion 
    	$stmt1->closeCursor();
    	$stmt1 = null;
		  $usuario = null;
    ?>
  </div>

  <div class="row" style="margin-bottom: 0px;">
    <div class="input-field col s12" style=" padding: 0 .0rem;">
    <footer class="page-footer #4fc3f7 light-blue">
        <div class="container">
          <div class="row">
            <div class="col l6 s12" style=" padding: 0 .0rem;">
              <h5 class="white-text">CaiceTravel</h5>
              <p class="grey-text text-lighten-4">Caicetravel te ofrecemos los mejores sitios turisticos de caicedonia valle .</p>
            </div>
            <div class="col l4 offset-l2 s12" style=" padding: 0 .0rem;">
              <h5 class="white-text">Links</h5>
              <ul>
                <li><a class="grey-text text-lighten-3" href="#!">Acerca de</a></li>
            
              </ul>
            </div>
          </div>
        </div>
        
        <div class="footer-copyright">
          <div class="container">
          <center>© 2018 Copyright Todo los Derechos Reservados.</center>
          </div>
        </div>
    </footer>
   </div> 
  </div>
  <!--Fin del footer-->

</body>
</html>