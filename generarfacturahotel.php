<?php
	include 'plantilla.php';
	require_once("sessionAdministrador.php");
	require_once('class.administrador.php');

	// devuelve el codigo de cada sitio
	$usuario=$_GET['usuarioS'];
	$habitacion=$_GET['habitacion'];
	date_default_timezone_set ('America/Bogota');
	$fecha=date("d-m-Y");

	$administrador = new Administrador();

	// Variables de session para utilizar las funcionalidades, solo en el administrador
  	$user_id = $_SESSION['user_session'];
    
  	$stmt = $administrador->runQuery("SELECT * FROM usuarios WHERE idUsuarios=:user_id");
  	$stmt->execute(array(":user_id"=>$user_id));
    
  	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

  	$sql="SELECT * FROM habitacion WHERE descripcion='$habitacion'";
  	$stmt3 = $administrador->runQuery($sql);
    $stmt3->execute();

    $row=$stmt3->fetch(PDO::FETCH_ASSOC);
    $codigo=$row['hotel'];

  	$sql="SELECT * FROM usuarios WHERE nombre='$usuario'";
  	$stmt2 = $administrador->runQuery($sql);
    $stmt2->execute();

    $row=$stmt2->fetch(PDO::FETCH_ASSOC);
    $id=$row['idUsuarios'];

	$sql="SELECT u.nombre usuario, h.descripcion habitacion, DATEDIFF(r.fechaSalida,r.fechaIngreso)+1 diasReservados, rh.precio totalAPagar, DATE_FORMAT(r.hora, '%h:%i %p') horaIngreso, r.fechaIngreso fechaIngreso, r.fechaSalida fechaSalida FROM usuarios u, reserva r, reservaHotel rh, habitacion h, hotel ho WHERE u.idUsuarios=r.usuario AND r.consecutivo=rh.reserva AND rh.habitacion=h.codigo AND h.hotel=ho.codigo AND u.idUsuarios=$id ORDER BY fechaIngreso,usuario,habitacion ASC";

	$stmt2 = $administrador->runQuery($sql);
    $stmt2->execute();

    $sql="SELECT h.descripcion hotel FROM usuarios u, reserva r, reservahotel rh, habitacion ha, hotel h WHERE u.idUsuarios=r.usuario AND r.consecutivo=rh.reserva AND rh.habitacion=ha.codigo AND ha.hotel=h.codigo AND u.idUsuarios=$id GROUP BY hotel";
    $stmt1 = $administrador->runQuery($sql);
    $stmt1->execute();

	$sql="SELECT ha.descripcion habitacion, ha.precio precio, SUM(DATEDIFF(r.fechaSalida,r.fechaIngreso)+1) diasReservados, SUM(rh.precio) totalAPagar FROM reserva r, reservahotel rh, habitacion ha, hotel h, usuarios u WHERE u.idUsuarios=r.usuario AND r.consecutivo=rh.reserva AND rh.habitacion=ha.codigo AND ha.hotel=h.codigo AND u.idUsuarios=$id GROUP BY rh.habitacion ORDER BY habitacion ASC";

	$stmt = $administrador->runQuery($sql);
    $stmt->execute();

	$pdf = new PDF('L','mm','A4');
	$pdf->AliasNbPages();
	$pdf->AddPage();

	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(196);
	$pdf->Cell(22,7,'Hotel(es)',1,0,'C',1);

	while ($row=$stmt1->fetch(PDO::FETCH_ASSOC))
	{
		$pdf->Cell(40,7,utf8_decode($row['hotel']),1,1,'C');
		$pdf->Cell(218);
	}

	$pdf->Ln(0);
	$pdf->Cell(196);
	$pdf->Cell(22,7,'Fecha',1,0,'C',1);

	$pdf->Cell(40,7,$fecha,1,1,'C');

	$pdf->Ln(5);

	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(70,7,utf8_decode('Habitación'),1,0,'C',1);
	$pdf->Cell(35,7,'precioDiario',1,1,'C',1);

	$stmt = $administrador->runQuery($sql);
    $stmt->execute();
	while ($row=$stmt->fetch(PDO::FETCH_ASSOC))
	{
		$pdf->Cell(70,7,utf8_decode($row['habitacion']),1,0,'C');
		$pdf->Cell(35,7,$row['precio'],1,1,'C');
	}

	$pdf->Ln(5);

	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(96,7,'Hospedaje',1,0,'C',1);
	$pdf->Cell(162,7,'Reservas',1,1,'C',1);
	$pdf->SetFillColor(240,248,255);
	$pdf->Cell(30,7,'HoraIngreso',1,0,'C',1);
	$pdf->Cell(33,7,'FechaIngreso',1,0,'C',1);
	$pdf->Cell(33,7,'fechaSalida',1,0,'C',1);
	$pdf->Cell(30,7,'Usuario',1,0,'C',1);
	$pdf->Cell(60,7,utf8_decode('Habitación'),1,0,'C',1);
	$pdf->Cell(42,7,utf8_decode('DíasReservados'),1,0,'C',1);
	$pdf->Cell(30,7,utf8_decode('TotalAPagar'),1,1,'C',1);

	$pdf->SetFont('Arial','',10);

	$diasReservados = 0;
	$totalAPagar = 0;
	while ($row=$stmt2->fetch(PDO::FETCH_ASSOC))
	{
		$pdf->Cell(30,7,$row['horaIngreso'],1,0,'C');
		$pdf->Cell(33,7,$row['fechaIngreso'],1,0,'C');
		$pdf->Cell(33,7,$row['fechaSalida'],1,0,'C');
		$pdf->Cell(30,7,utf8_decode($row['usuario']),1,0,'C');
		$pdf->Cell(60,7,utf8_decode($row['habitacion']),1,0,'C');
		$pdf->Cell(42,7,$row['diasReservados'],1,0,'C');
		$pdf->Cell(30,7,$row['totalAPagar'],1,1,'C');
		$diasReservados += $row['diasReservados'];
		$totalAPagar += $row['totalAPagar'];
	}

	$totalAPagar=number_format($totalAPagar,3);

	$pdf->Ln(5);

	$pdf->SetFillColor(240,248,255);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(186);
	$pdf->Cell(42,7,utf8_decode('N°DiasReservados'),1,0,'C',1);
	$pdf->Cell(30,7,utf8_decode('Acumulado'),1,1,'C',1);

	$pdf->SetFont('Arial','',10);
	
	$stmt = $administrador->runQuery($sql);
    $stmt->execute();

	$pdf->Cell(186);
	$pdf->Cell(42,7,$diasReservados,1,0,'C');
	$pdf->Cell(30,7,$totalAPagar,1,1,'C');

	$pdf->Output();

	//Cerrar conexion 
  	$stmt->closeCursor();
  	$stmt = null;
  	$administrador = null;

  	$stmt1->closeCursor();
  	$stmt1 = null;

  	$stmt2->closeCursor();
  	$stmt2 = null;
?>