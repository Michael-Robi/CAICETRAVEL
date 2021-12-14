<?php
	require_once('session.php');
	require_once('class.usuario.php');
	$user_logout = new Usuario();
	
	if($user_logout->is_loggedin()!="")
	{
		$user_logout->redireccionar('principal.php');
	}
	
	if(isset($_GET['logout1']) && $_GET['logout1']=="true")
	{
		$user_logout->cerrarSesion();
		$user_logout->redireccionar('usuario.php');
	}
