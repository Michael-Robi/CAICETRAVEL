<?php
	// devuelve el codigo de cada sitio
	$codigo=$_POST['codigoS'];
	$tipo=$_POST['tipoS'];

	if($tipo=='Hotel'){
		header("location:reservarHotel.php?codigoS=$codigo&tipoS=$tipo");
	}
 	
 	else{
 		echo $tipo.'<br/>codigo: '.$codigo.'<br/>';
 	}
?>