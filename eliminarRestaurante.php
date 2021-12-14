<?php
	require_once('class.administrador.php');

	$administrador = new Administrador();

	// devuelve el codigo de cada sitio
	$codigo=$_GET['codigoS'];

	$sql="DELETE FROM restaurante WHERE codigo='$codigo'";
	$stmt = $administrador->runQuery($sql);
	$stmt->execute();

	//Cerrar conexion 
  	$stmt->closeCursor();
  	$stmt= null;
  	$administrador = null;

	header("location:listaRestaurante.php");
?>