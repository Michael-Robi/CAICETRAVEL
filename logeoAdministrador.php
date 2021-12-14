<?php
	require_once('sessionAdministrador.php');
	require_once('class.administrador.php');
	$user_logout = new Administrador();
	
	if($user_logout->is_loggedin()!="")
	{
		$user_logout->redireccionar('hotelAdmin.php');
	}
	
	if(isset($_GET['logout']) && $_GET['logout']=="true")
	{
		$user_logout->cerrarSesion();
		$user_logout->redireccionar('administrador.php');
	}
