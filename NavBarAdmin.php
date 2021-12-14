<style>
  /*estilo letra cuando el navegador carge en mapas*/
  .dropdown-content * .estiloletra{
    font: 1.2em Arial, Helvetica, sans-serif;
  }

  /*estilo letra cuando el navegador carge en administrador*/
  div.row ul.dropdown-content li a.estiloletra{
    font: 1.0em Arial, Helvetica, sans-serif;
  }

</style>
<!-- Dropdown Structure -->
<ul id="dropdownM" class="dropdown-content">
  <li><a href="mapaHotel.php">Mapa Hotel</a></li>
  <li><a href="mapaLugar.php" class="estiloletra">Mapa Lugar</a></li>
  <li class="divider"></li>
  <li><a href="mapaBar.php">Mapa Bar</a></li>
  <li><a href="mapaRestaurante.php">Mapa Restaurante</a></li>
  <li class="divider"></li>
  <li><a href="mapaTransporte.php">Mapa Transporte</a></li>
  <li><a href="mapaSitios.php" class="estiloletra">Mapa Sitios</a></li>
</ul>

<ul id="dropdownM1" class="dropdown-content">
  <li><a href="mapaHotel.php">Mapa Hotel</a></li>
  <li><a href="mapaLugar.php">Mapa Lugar</a></li>
  <li class="divider"></li>
  <li><a href="mapaBar.php">Mapa Bar</a></li>
  <li><a href="mapaRestaurante.php">Mapa Restaurante</a></li>
  <li class="divider"></li>
  <li><a href="mapaTransporte.php">Mapa Transporte</a></li>
  <li><a href="mapaSitios.php">Mapa Sitios</a></li>
</ul>

<ul id="dropdownA" class="dropdown-content">
  <li><a href="hotelAdmin.php">Hotel</a></li>
  <li class="divider"></li>
  <li><a href="lugarAdmin.php">Lugar</a></li>
  <li><a href="barAdmin.php">Bar</a></li>
  <li class="divider"></li>
  <li><a href="restauranteAdmin.php">Restaurante</a></li>
  <li><a href="transporteAdmin.php">Transporte</a></li>
</ul>

<ul id="dropdownA1" class="dropdown-content">
  <li><a href="hotelAdmin.php">Hotel</a></li>
  <li class="divider"></li>
  <li><a href="lugarAdmin.php">Lugar</a></li>
  <li><a href="barAdmin.php">Bar</a></li>
  <li class="divider"></li>
  <li><a href="restauranteAdmin.php">Restaurante</a></li>
  <li><a href="transporteAdmin.php">Transporte</a></li>
</ul>

<ul id="dropdownP" class="dropdown-content">
  <li><a href="pagosHotel.php">Pdf Hotel</a></li>
  <li><a href="pagoslugar.php">Pdf Lugar</a></li>
  <li class="divider"></li>
  <li><a href="pagosBar.php">Pdf Bar</a></li>
  <li><a href="pagosRestaurante.php" class="estiloletra">Pdf Restaurante</a></li>
  <li class="divider"></li>
  <li><a href="pagosTransporte.php">Pdf Transporte</a></li>
  <li><a href="notificarReserva.php">Pdf Reservas</a></li>
</ul>

<ul id="dropdownP1" class="dropdown-content">
  <li><a href="pagosHotel.php">Pdf Hotel</a></li>
  <li><a href="pagoslugar.php">Pdf Lugar</a></li>
  <li class="divider"></li>
  <li><a href="pagosBar.php">Pdf Bar</a></li>
  <li><a href="pagosRestaurante.php">Pdf Restaurante</a></li>
  <li class="divider"></li>
  <li><a href="pagosTransporte.php">Pdf Transporte</a></li>
  <li><a href="notificarReserva.php">Pdf Reservas</a></li>
</ul>

<ul id="dropdownO" class="dropdown-content">
  <center><a class="btn-floating indigo" href="cuentaAdministrador.php" title="Cuenta"><i class="Small material-icons" style="color:white;">account_circle</i></a></center>
  <center><a class="btn-floating purple darken-3" href="registroAdministrador.php" title="Registrar Administrador"><i class="Small material-icons" style="color:white;">person_add</i></a></center>
  <center><a class="btn-floating red darken-1" href="logeoAdministrador.php?logout=true" title="Salir"><i class="Small material-icons" style="color:white;">exit_to_app</i></a></center>
</ul>

<ul id="dropdownO1" class="dropdown-content">
  <li><a href="cuentaAdministrador.php">Cuenta</a></li>
  <li><a href="registroAdministrador.php">Registrar Administrador</a></li>
  <li><a href="logeoAdministrador.php?logout=true">Salir</a></li>
</ul>

<nav class="#1976d2 blue darken-2" role="navigation">
  <div class="nav-wrapper container">
    <a href="principalAdministrador.php" class="brand-logo">CaiceTravel</a>
    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons" style="color: white;">menu</i></a>
    <ul id="nav-mobile" class="right hide-on-med-and-down">
      <li><a class="dropdown-button" href="#!" data-activates="dropdownA">Administrador<i class="material-icons right" style="color: white;">arrow_drop_down</i></a></li>
      <li><a class="dropdown-button" href="#!" data-activates="dropdownM">Mapas<i class="material-icons right" style="color: white;">arrow_drop_down</i></a></li>
      <li><a class="dropdown-button" href="#!" data-activates="dropdownP">Pagos Pdfs<i class="material-icons right" style="color: white;">arrow_drop_down</i></a></li>
      <li><a class="dropdown-button" href="#!" data-activates="dropdownO">Opciones<i class="material-icons right" style="color: white;">arrow_drop_down</i></a></li>
    </ul>
    <ul class="side-nav" id="mobile-demo">
      <li><a class="dropdown-button" href="#!" data-activates="dropdownA1">Administrador<i class="material-icons right">arrow_drop_down</i></a></li>
      <li><a class="dropdown-button" href="#!" data-activates="dropdownM1">Mapas<i class="material-icons right">arrow_drop_down</i></a></li>
      <li><a class="dropdown-button" href="#!" data-activates="dropdownP1">Pagos Pdfs<i class="material-icons right">arrow_drop_down</i></a></li>
      <li><a class="dropdown-button" href="#!" data-activates="dropdownO1">Opciones<i class="material-icons right">arrow_drop_down</i></a></li>
    </ul>
  </div>
</nav>

<script>
  $(document).ready(function() {
  $(".button-collapse").sideNav();
  });
</script>