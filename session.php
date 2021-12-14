<?php

	session_start();
	require_once 'class.usuario.php';
	$session = new Usuario();
	
	if(!$session->is_loggedin())
	{
		$session->redireccionar('usuario.php');
	}
