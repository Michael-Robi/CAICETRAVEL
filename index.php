<!DOCTYPE html>

<html >
<head>
    
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Iniciar</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<style type="text/css"> 

  nav{  
    position: relative;   
    top: 0;
    left: 0; 
    width: 100%;  
  }

  body{
    margin: 0;
    padding: 0;
    height: 100vh;
  }

  .white{
    background-color: black;
  }   
    
  .body
  {
    width:100%;
    margin:auto;
  }

</style>

<body class="body">
  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>

  <?php  
    include('NavBarPrincipal.php');
  ?>

  <!-- -----------------------------EFECTO DE PARALLAX----------------------------- -->
  <div class="parallax-container">
    <div class="parallax"><img src="imagenes/caicedonia2016.jpg"></div>
  </div>

  <div class="section white">
   <div class="container">
     <h2 class="header"><Center>Bienvenido a CaiceTravel</Center></h2>
    
      <div class="row">
       
        <div class="col s12 m7">
          <div class="card horizontal">
            <div class="card-image">
              <img src="imagenes/club.jpg">
            </div>
            <div class="card-stacked">
              <div class="card-content">
                <p>Te ofrecemos los mejores planes vacacionales de nuestro municipio.</p>
              </div>
            </div>
          </div>
        </div>

        <div class="col s12 m6 offset-m6">
          <br>
          <div class="card horizontal">
            <div class="card-image">
              <img src="imagenes/jeep.jpg">
            </div>
            <div class="card-stacked">
              <div class="card-content">
                <p>Un placer que debes darte.</p>
              </div>
            </div>
          </div>
        </div>

      </div> 
    </div>          
  </div>
         
  <div class="parallax-container">
    <div class="parallax"><img src="imagenes/caicedoniav.jpg"></div>
  </div>
    
  <!--Footer-->    
  <footer class="page-footer #4fc3f7 light-blue">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">CaiceTravel</h5>
          <p class="grey-text text-lighten-4">Caicetravel te ofrecemos los mejores sitios turisticos de caicedonia valle .</p>
        </div>
        <div class="col l4 offset-l2 s12">
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
  <!--Fin del footer-->
</body>

</html>

<script>
  $(document).ready(function() {
    $('.parallax').parallax();
  });
</script>