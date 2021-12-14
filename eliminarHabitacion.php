<?php
	require_once('class.administrador.php');

	$administrador = new Administrador();

	// devuelve el codigo de cada sitio
	$codigoHotel=$_GET['codigoS'];
	$habitacion=$_GET['habitacion'];

	$sql="DELETE FROM habitacion WHERE codigo='$codigoHotel'";
	$stmt = $administrador->runQuery($sql);
	$stmt->execute();

	//Cerrar conexion 
  	$stmt->closeCursor();
  	$stmt= null;
  	$administrador = null;

	header("location:habitacion.php?codigoS=$habitacion");
?>