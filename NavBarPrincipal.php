<!-- ---------BARRA DE MENU---------------->
  <nav class="#4fc3f7 light-blue lighten-">
    <div class="nav-wrapper">
      <a href="index.php" class="brand-logo">CAICETRAVEL</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons" style="color: white;">menu</i></a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="productos.php">Productos</a></li>
        <li><a href="usuario.php">Iniciar Sesion</a></li>
        <li><a href="registro.php">Registrarse</a></li>
        <li><a class="btn-floating indigo" href="hotelAdmin.php" title="Administrador"><i class="material-icons" style="color:white;">account_circle</i></a></li>        
      </ul>
      <ul class="side-nav" id="mobile-demo">
        <li><a href="productos.php">Productos</a></li>
        <li><a href="usuario.php">Iniciar Sesion</a></li>
        <li><a href="registro.php">Registrarse</a></li>
        <li><a href="hotelAdmin.php">Administrador</a></li>
      </ul>
    </div>
  </nav>

<script>
  $(document).ready(function() {
    $(".button-collapse").sideNav();
  });
</script>