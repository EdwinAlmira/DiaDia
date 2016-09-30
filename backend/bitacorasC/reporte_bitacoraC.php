<?php
require('../fpdf/fpdf.php');
require("../procesos/database.php");

	
	class PDF extends FPDF 
	{
		function AcceptPageBreak()
		{
			/*
			$this->Addpage();
			$this->SetFillColor(232,232,232);
			$this->SetFont('Arial','B',12);
			$this->SetX(10);
			$this->Cell(70,6,'Nombre',1,0,'C',1);
			$this->SetX(80);
			$this->Cell(20,6,'Apellido',1,0,'C',1);
			$this->SetX(100);
			$this->Cell(70,6,'Usuario',1,0,'C',1);
			$this->Cell(70,6,'correo',1,0,'C',1);
			$this->Ln();
			*/
		}
		
		function Header()
		{
			$this->Image('logo1.jpg',10,8,40);
			$this->SetFont('Arial','B',15);
			$this->Cell(80);
			$this->Cell(30,10,'La Caa SV',0,0,'C');
			$this->Ln(1);
		}
		
		function Footer()
		{
			$this->SetY(-15);
			$this->SetFont('Arial','I',8);
			$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
		}
		
	}
	
	$query="SELECT Id_bitacora, acciones.Id_accion, descripcion, nombreCliente.Id_cliente, fechaBitacora, horaBitacora FROM bitacoras, acciones, personal WHERE bitacoras.Id_accion = acciones.accion AND bitacoras.Id_cliente = clientes.nombreCliente";
	$params = array(null);
	//$resultado = $connect->query($query);
	$resultado = Database::getRows($query, $params);
	
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->Addpage();
	
        
	$pdf->SetMargins(55,20,20);
	$pdf->Ln(10);
	
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(0,6,'Numero: 2222-222',0,1);
	$pdf->Cell(0,6,'Correo: LCSV@gmail.com',0,1);
	$pdf->Cell(0,6,'Reporte: Bitacora',0,1); 
	//$pdf->Image('fondo.jpg', 0,0, 210, 295, 'jpg');
	$pdf->Ln(15);

	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->SetX(10);
	$pdf->Cell(60,6,'Descripcion',1,0,'C',1);
	$pdf->SetX(70);
	$pdf->Cell(35,6,'Accion',1,0,'C',1);
	$pdf->SetX(105);
	$pdf->Cell(35,6,'Cliente',1,0,'C',1);
	$pdf->SetX(140);
	$pdf->Cell(30,6,'Fecha',1,0,'C',1);
	$pdf->Cell(30,6,'Hora',1,0,'C',1);
	$pdf->Ln();
	
	foreach($resultado as $row)
	{

		$pdf->SetFont('Arial','',12);
		$pdf->SetX(10);
		$pdf->Cell(60,6, utf8_decode($row['descripcion']),1,0,'C');
		$pdf->SetX(70);
		$pdf->Cell(35,6, utf8_decode($row['accion']),1,0,'C');
		$pdf->SetX(105);
		$pdf->Cell(35,6, utf8_decode($row['nombreCliente']),1,1,'C');
		$pdf->SetX(140);
		$pdf->Cell(30,6, utf8_decode($row['fechaBitacora']),1,0,'C');
		//$pdf->SetX(155);
		$pdf->Cell(30,6, utf8_decode($row['horaBitacora']),1,0,'C');
	}
	$pdf->Output();
	
?>