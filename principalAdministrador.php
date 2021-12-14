<?php
  require_once("sessionAdministrador.php");
  require_once('class.administrador.php');

  $administrador = new Administrador();

  // Variables de session para utilizar las funcionalidades, solo en el administrador
  $user_id = $_SESSION['user_session'];
    
  $stmt1 = $administrador->runQuery("SELECT * FROM usuarios WHERE idUsuarios=:user_id");
  $stmt1->execute(array(":user_id"=>$user_id));
    
  $userRow=$stmt1->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <title>Principal Administrador</title>
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
      background: url(imagenes/iglesiass.jpg);
      background-size: 100% 100%;
      background-attachment: fixed;
      background-repeat: no-repeat;
      background-color: #F1F1F1;
      margin: 0;
      padding: 0;
      height: 100vh;
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

  /*Control de contenedor sidenav*/    
  @media screen and (max-width: 1500px)
  {
    /*Margen del sidenav*/
    .sliders
    {
      margin:0em 16em 0em 16em;
    }

    /*Tamaño del sidenav*/
    div.row div.parallax-container {
      height: 500px;
    }

    /*Tamaño de la imagen*/
    div.sliders div.slider ul.slides li img.size{
      background-size: 869px 400px;
    }

    @media screen and (max-width: 1300px)
    {
      /*Margen del sidenav*/
      .sliders
      {
        margin:0em 16em 0em 16em;
      }

      /*Tamaño del sidenav*/
      div.row div.parallax-container {
        height: 500px;
      }

      /*Tamaño de la imagen*/
      div.sliders div.slider ul.slides li img.size{
        background-size: 802px 400px;
      }
    }

    @media screen and (max-width: 1100px)
    {
      /*Margen del sidenav*/
      .sliders
      {
        margin:0em 12em 0em 12em;
      }

      /*Tamaño del sidenav*/
      div.row div.parallax-container {
        height: 500px;
      }

      /*Tamaño de la imagen*/
      div.sliders div.slider ul.slides li img.size{
        background-size: 732px 400px;
      }
    }

    @media screen and (max-width: 1000px)
    {
      /*Margen del sidenav*/
      .sliders
      {
        margin:0em 9em 0em 9em;
      }

      /*Tamaño del sidenav*/
      div.row div.parallax-container {
        height: 500px;
      }

      /*Tamaño de la imagen*/
      div.sliders div.slider ul.slides li img.size{
        background-size: 724px 400px;
      }
    }

    @media screen and (max-width: 700px)
    {
      /*Margen del sidenav*/
      .sliders
      {
        margin:0em 8em 0em 8em;
      }

      /*Tamaño del sidenav*/
      div.row div.parallax-container {
        height: 500px;
      }

      /*Tamaño de la imagen*/
      div.sliders div.slider ul.slides li img.size{
        background-size: 459px 400px;
      }

    }

    @media screen and (max-width: 600px)
    {
      /*Margen del sidenav*/
      .sliders
      {
        margin:0em 1em 0em 1em;
      }

      /*Tamaño del sidenav*/
      div.row div.parallax-container {
        height: 500px;
      }

      /*Tamaño de la imagen*/
      div.sliders div.slider ul.slides li img.size{
        background-size: 555px 400px;
      }

    }

    @media screen and (max-width: 500px)
    {
      /*Margen del sidenav*/
      .sliders
      {
        margin:0em 1em 0em 1em;
      }

      /*Tamaño del sidenav*/
      div.row div.parallax-container {
        height: 500px;
      }

      /*Tamaño de la imagen*/
      div.sliders div.slider ul.slides li img.size{
        background-size: 455px 400px;
      }

    }

    @media screen and (max-width: 400px)
    {
      /*Margen del sidenav*/
      .sliders
      {
        margin:0em 1em 0em 1em;
      }

      /*Tamaño del sidenav*/
      div.row div.parallax-container {
        height: 500px;
      }

      /*Tamaño de la imagen*/
      div.sliders div.slider ul.slides li img.size{
        background-size: 355px 400px;
      }

    }

    @media screen and (max-width: 386px)
    {
      /*Margen del sidenav*/
      .sliders
      {
        margin:0em 1em 0em 1em;
      }

      /*Tamaño del sidenav*/
      div.row div.parallax-container {
        height: 500px;
      }

      /*Tamaño de la imagen*/
      div.sliders div.slider ul.slides li img.size{
        background-size: 341px 400px;
      }

    }

  }

  </style>

  <body>

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>

    <div class="row">
      <?php 
        require_once('NavBarAdmin.php');
      ?>

      <div class="parallax-container">
        <!--ESLIDER EN LA PARTE INICIAL-->
        <div class="sliders" class="scrollspy section">
          <h3 style="line-height: 50%; color: white;">Hoteles</h3>
          <div class="slider">
            <ul class="slides">
              <li>
                <img class="size" src="Imagenes/cafe.jpg"> <!-- random image -->
                <div class="caption center-align">
                  <h3 class="letras">BIENVENIDO A CAICETRAVEL </h3>
                  <h5 class="letras" color="black" >EL MEJOR LUGAR DE TODOS PARA TODOS.</h5>
                </div>
              </li>

            <?php
              $stmt1 = $administrador->runQuery("SELECT * FROM hotel");
              $stmt1->execute();

              while ($row=$stmt1->fetch(PDO::FETCH_ASSOC)) { 
                $imagen=$row['imagen']; 
                $nombreSitio=$row['descripcion'];
                $detalle=$row['detalle'];

                echo '<li>
                      <img class="size" src="data:/jgp;base64,'.base64_encode($imagen).'">
                        <div class="caption center-align">
                          <h3 class="letras">'.$nombreSitio.'</h3>
                          <h5 class="letras" color="black">'.$detalle.'</h5>
                        </div>
                      </li>';

              }
            ?>
            </ul>
          </div>
        </div>
      </div>

      <div class="parallax-container">

        <!--ESLIDER EN LA PARTE INICIAL-->
        <div class="sliders" class="scrollspy section">
          <h3 style="line-height: 50%; color: white;">Lugares</h3>
          <div class="slider">
            <ul class="slides">
              <li>
                <img class="size" src="Imagenes/samaria.jpg"> <!-- random image -->
                <div class="caption right-align">
                  <h3 class="letras" >VISTANOS EN TUS MEJORES VACACIONES</h3>
                  <h5 class="letras">CAICEDONIA VALLE PARA TODOS</h5>
                </div>
              </li>

            <?php
              $stmt1 = $administrador->runQuery("SELECT * FROM lugar");
              $stmt1->execute();

              while ($row=$stmt1->fetch(PDO::FETCH_ASSOC)) { 
                $imagen=$row['imagen']; 
                $nombreSitio=$row['descripcion'];
                $detalle=$row['detalle'];

                echo '<li>
                      <img class="size" src="data:/jgp;base64,'.base64_encode($imagen).'">
                        <div class="caption right-align">
                          <h3 class="letras">'.$nombreSitio.'</h3>
                          <h5 class="letras" color="black">'.$detalle.'</h5>
                        </div>
                      </li>';

              }
            ?>

            </ul>
          </div>
        </div>
      </div>

      <div class="parallax-container">
        <!--ESLIDER EN LA PARTE INICIAL-->
        <div class="sliders" class="scrollspy section">
          <h3 style="line-height: 50%; color: white;">Bares</h3>
          <div class="slider">
            <ul class="slides">
              <li>
                <img class="size" src="Imagenes/PaisajeCafetero.png"> <!-- random image -->
                <div class="caption left-align">
                  <h3 class="letras">VEN Y CONOCE LOS MEJORES SITIOS DE LA REGION</h3>
                  <h5 class="letras" color="black" >EL MEJOR LUGAR DE TODOS PARA TODOS.</h5>
                </div>
              </li>

            <?php
              $stmt1 = $administrador->runQuery("SELECT * FROM bar");
              $stmt1->execute();

              while ($row=$stmt1->fetch(PDO::FETCH_ASSOC)) { 
                $imagen=$row['imagen']; 
                $nombreSitio=$row['descripcion'];
                $detalle=$row['detalle'];

                echo '<li>
                      <img class="size" src="data:/jgp;base64,'.base64_encode($imagen).'">
                        <div class="caption left-align">
                          <h3 class="letras">'.$nombreSitio.'</h3>
                          <h5 class="letras" color="black">'.$detalle.'</h5>
                        </div>
                      </li>';

              }
            ?>
            </ul>
          </div>
        </div>
      </div>

    </div>

    <div class="parallax-container">
        <!--ESLIDER EN LA PARTE INICIAL-->
        <div class="sliders" class="scrollspy section">
          <h3 style="line-height: 50%; color: white;">Restaurantes</h3>
          <div class="slider">
            <ul class="slides">
              <li>
                <img class="size" src="Imagenes/123.jpg"> <!-- random image -->
                <div class="caption left-align">
                  <h3 class="letras">DONDE ENCONTRARAS LOS MEJORES SITIOS TURISTICOS</h3>
                  <h5 class="letras" color="black" >Y CONOCERAS DE LA GASTRONOMIA DE NUESTRA REGION</h5>
               </div>
              </li>

            <?php
              $stmt1 = $administrador->runQuery("SELECT * FROM restaurante");
              $stmt1->execute();

              while ($row=$stmt1->fetch(PDO::FETCH_ASSOC)) { 
                $imagen=$row['imagen']; 
                $nombreSitio=$row['descripcion'];
                $detalle=$row['detalle'];

                echo '<li>
                      <img class="size" src="data:/jgp;base64,'.base64_encode($imagen).'">
                        <div class="caption left-align">
                          <h3 class="letras">'.$nombreSitio.'</h3>
                          <h5 class="letras" color="black">'.$detalle.'</h5>
                        </div>
                      </li>';

              }
            ?>
            </ul>
          </div>
        </div>
      </div>

    </div>

    <div class="parallax-container">
        <!--ESLIDER EN LA PARTE INICIAL-->
        <div class="sliders" class="scrollspy section">
          <h3 style="line-height: 50%; color: white;">Transportes</h3>
          <div class="slider">
            <ul class="slides">
              <li>
                <img class="size" src="Imagenes/yisss.jpg"> <!-- random image -->
                <div class="caption right-align">
                  <h3 class="letras">ENCONTRARAS LOS VEHICULOS TIPICOS DE CAICEDONIA</h3>
                  <h5 class="letras" color="black" >DONDE PERSONAS Y TURISTAS SE TRANSPORTAN Y CONOCEN DE CAICEDONIA</h5>
               </div>
              </li>

            <?php
              $stmt1 = $administrador->runQuery("SELECT * FROM transporte");
              $stmt1->execute();

              while ($row=$stmt1->fetch(PDO::FETCH_ASSOC)) { 
                $imagen=$row['imagen']; 
                $nombreSitio=$row['descripcion'];
                $detalle=$row['detalle'];

                echo '<li>
                      <img class="size" src="data:/jgp;base64,'.base64_encode($imagen).'">
                        <div class="caption right-align">
                          <h3 style="color:black;">'.$nombreSitio.'</h3>
                          <h5 style="color:black;">'.$detalle.'</h5>
                        </div>
                      </li>';

              }
            ?>
            </ul>
          </div>
        </div>
      </div>

    </div>

    <?php
      //Cerrar conexion 
      $stmt1->closeCursor();
      $stmt1 = null;
      $administrador = null;
    ?>

</body>
</html>

<script>
  $(document).ready(function() {
    $(".button-collapse").sideNav();
    $(document).ready(function(){ $('.slider').slider(); });
    $(document).ready(function(){ $('.parallax').parallax(); });
  });
</script>  