<?php
	include 'plantilla.php';
	require_once("sessionAdministrador.php");
	require_once('class.administrador.php');

	$administrador = new Administrador();

	// Variables de session para utilizar las funcionalidades, solo en el administrador
  	$user_id = $_SESSION['user_session'];
    
  	$stmt = $administrador->runQuery("SELECT * FROM usuarios WHERE idUsuarios=:user_id");
  	$stmt->execute(array(":user_id"=>$user_id));
    
  	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

	$sql1 ="SET lc_time_names ='es_ES'";
	$stmt = $administrador->runQuery($sql1);
    $stmt->execute();

	$sql="SELECT rh.reserva idReserva, u.nombre nombre, u.email email, h.descripcion hotel, h.ubicacion direccion, DATE_FORMAT(r.fechaIngreso, '%W %d ' 'de' ' %M ' 'del' ' %Y') fecha, r.fechaIngreso fechaI, DATE_FORMAT(r.hora, '%h:%i %p') hora FROM usuarios u, reserva r, reservahotel rh, habitacion ha, hotel h WHERE u.idUsuarios=r.usuario AND rh.reserva=r.consecutivo AND rh.habitacion=ha.codigo AND ha.hotel=h.codigo AND r.fechaIngreso BETWEEN CURDATE() AND '2019-12-31' ORDER BY hotel, fechaI, hora ASC";

	$stmt = $administrador->runQuery($sql);
    $stmt->execute();

	$pdf = new PDF('L','mm','legal');
	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(25,7,'idReserva',1,0,'C',1);
	$pdf->Cell(35,7,'Nombre',1,0,'C',1);
	$pdf->Cell(80,7,'Email',1,0,'C',1);
	$pdf->Cell(30,7,'Hotel',1,0,'C',1);
	$pdf->Cell(65,7,utf8_decode('Dirección'),1,0,'C',1);
	$pdf->Cell(60,7,'Fecha',1,0,'C',1);
	$pdf->Cell(30,7,'Hora',1,1,'C',1);

	$pdf->SetFont('Arial','',10);

	while ($row=$stmt->fetch(PDO::FETCH_ASSOC))
	{
		$pdf->Cell(25,7,$row['idReserva'],1,0,'C');
		$pdf->Cell(35,7,$row['nombre'],1,0,'C');
		$pdf->Cell(80,7,$row['email'],1,0,'C');
		$pdf->Cell(30,7,utf8_decode($row['hotel']),1,0,'C');
		$pdf->Cell(65,7,utf8_decode($row['direccion']),1,0,'C');
		$pdf->Cell(60,7,utf8_decode($row['fecha']),1,0,'C');
		$pdf->Cell(30,7,$row['hora'],1,1,'C');
	}
	$pdf->Output();

	//Cerrar conexion 
  	$stmt->closeCursor();
  	$stmt = null;
  	$administrador = null;

?>