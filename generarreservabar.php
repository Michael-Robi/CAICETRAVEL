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

	$sql="SELECT rb.reserva idReserva, u.nombre nombre, u.email email, b.descripcion bar, b.ubicacion direccion, DATE_FORMAT(r.fechaIngreso, '%W %d ' 'de' ' %M ' 'del' ' %Y') fecha, DATE_FORMAT(r.hora, '%h:%i %p') hora FROM usuarios u, reserva r, reservabar rb, bar b WHERE u.idUsuarios=r.usuario AND rb.reserva=r.consecutivo AND rb.bar=b.codigo AND r.fechaIngreso BETWEEN CURDATE() AND '2018-12-31'";

	$stmt = $administrador->runQuery($sql);
    $stmt->execute();
	
	$pdf = new PDF('L','mm','legal');
	header("Content-Type: text/html; charset=iso-8859-1");
	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(25,7,'idReserva',1,0,'C',1);
	$pdf->Cell(35,7,'Nombre',1,0,'C',1);
	$pdf->Cell(80,7,'Email',1,0,'C',1);
	$pdf->Cell(30,7,'Bar',1,0,'C',1);
	$pdf->Cell(65,7,utf8_decode('Dirección'),1,0,'C',1);
	$pdf->Cell(60,7,'Fecha',1,0,'C',1);
	$pdf->Cell(30,7,'Hora',1,1,'C',1);

	$pdf->SetFont('Arial','',10);
	
	while ($row=$stmt->fetch(PDO::FETCH_ASSOC))
	{
		$pdf->Cell(25,7,$row['idReserva'],1,0,'C');
		$pdf->Cell(35,7,$row['nombre'],1,0,'C');
		$pdf->Cell(80,7,$row['email'],1,0,'C');
		$pdf->Cell(30,7,utf8_decode($row['bar']),1,0,'C');
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