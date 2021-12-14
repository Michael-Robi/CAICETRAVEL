<!-- Dropdown Structure -->
<ul id="dropdownR" class="dropdown-content">
 <li><a href="hotel.php">Hotel</a></li>
 <li><a href="">Restaurante</a></li>
 <li><a href="">Discoteca</a></li>
 <li><a href="">Lugar</a></li>
 <li><a href="">Transporte</a></li>
</ul>

<ul id="dropdownR1" class="dropdown-content">
 <li><a href="hotel.php">Hotel</a></li>
 <li><a href="">Restaurante</a></li>
 <li><a href="">Discoteca</a></li>
 <li><a href="">Lugar</a></li>
 <li><a href="">Transporte</a></li>
</ul>

<ul id="dropdownS" class="dropdown-content">
  <li><a href="logeo.php?logout1=true">Cerrar Sesion</a></li>
</ul>

<ul id="dropdownS1" class="dropdown-content">
<li><a href="logeo.php?logout1=true">Cerrar Sesion</a></li>
</ul>

<nav class="#4fc3f7 light-blue lighten-""navigation">
  <div class="nav-wrapper container">
    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons" style="color:white;">menu</i></a>
    <a href="principal.php" class="brand-logo">Inicio</a>
    <ul id="nav-mobile" class="right hide-on-med-and-down">
      <li><a href="cuenta.php">Cuenta</a></li>
      <li><a class="dropdown-button" href="#!" data-activates="dropdownR">Reservar<i class="material-icons right" style="color:white;">arrow_drop_down</i></a></li>
      <li><a class="dropdown-button" href="#!" data-activates="dropdownS">Bienvenido <?php echo $userRow['email']; ?>&nbsp;<i class="material-icons right" style="color:white;">arrow_drop_down</i></a></li>
    </ul>
    <ul class="side-nav" id="mobile-demo">
      <li><a href="cuenta.php">Cuenta</a></li>
      <li><a class="dropdown-button" href="#!" data-activates="dropdownR1">Reservar<i class="material-icons right">arrow_drop_down</i></a></li>
      <li><a class="dropdown-button" href="#!" data-activates="dropdownS1">Bienvenido <?php echo $userRow['email']; ?><i class="material-icons right">arrow_drop_down</i></a></li>
    </ul>
  </div>
</nav> 

<script>
  $(document).ready(function() {
    $(".button-collapse").sideNav();
  });
</script>  