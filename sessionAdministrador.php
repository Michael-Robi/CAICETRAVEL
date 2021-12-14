<?php
	require_once 'class.administrador.php';
	
	session_start();
	
	$session = new Administrador();
	
	if(!$session->is_loggedin())
	{
		$session->redireccionar('administrador.php');
	}
