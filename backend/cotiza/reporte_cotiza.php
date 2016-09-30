<?php
require('../fpdf/fpdf.php');
require("../procesos/database.php");
session_start();
date_default_timezone_set('America/Guatemala');
$fecha_impresion = date("Y/m/d");
$hora_impresion = date("G:i:s");


	
	class PDF extends FPDF 
	{
		function AcceptPageBreak()
		{
			
			$this->Addpage();
			$this->Ln(15);
			$this->SetFillColor(232,232,232);
			$this->SetFont('Arial','B',12);
			$this->SetX(40);
			$this->Cell(45,6,'Nombre Cliente',1,0,'C',1);
			$this->Cell(45,6,'Cotizacion',1,0,'C',1);
			$this->Cell(30,6,'Precio',1,0,'C',1);
			$this->Ln();
			
		}
		
		function Header()
		{
		    $this->Image('Fondo.jpg', 0,0, 210, 295, 'jpg');
			$this->SetFont('Arial','',12);
			$this->SetTextColor(232,232,232);
			$this->SetY(22);
			$this->SetX(50);
   		    $this->Cell(0,6,'Numero: 7247-6838',0,1);
   		    $this->SetX(50);
			$this->Cell(0,6,'Correo: LCSV@gmail.com',0,1);
			$this->SetX(50);
			$this->SetFont('Arial','B',12);
			$this->Cell(0,6,'Reporte: Cotizacion Pendientes',0,1); 
			$this->SetX(50);
			$this->SetFont('Arial','',12);
		    $this->Cell(0,6,'Usuario: ',0,1); 

			
		}
		
		function Footer()
		{
			$this->SetY(-15);
			$this->SetFont('Arial','I',8);
			$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
		}
		
	}
	
	$query="SELECT * FROM cotizaciones, clientes where clientes.Id_cliente=cotizaciones.Id_cliente AND estadoCotizacion = 0";
	$params = array(null);
	$resultado = Database::getRows($query, $params);
	
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->Addpage();
	
        
	 
		$pdf->SetY(22);
        $pdf->SetX(110);
        $pdf->SetTextColor(232,232,232);
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(0,6,'Fecha: '.$fecha_impresion,0,1);
        $pdf->SetX(110);
        $pdf->Cell(0,6,'Hora: '.$hora_impresion,0,1); 
 
	$pdf->Ln(25);
    $pdf->SetTextColor(0,0,0);		
	$pdf->SetFillColor(205,133,63);
	$pdf->SetFont('Arial','B',12);
	$pdf->SetX(60);
	$pdf->Cell(45,6,'Nombre Cliente',1,0,'C',1);
	$pdf->Cell(45,6,'Cotizacion',1,0,'C',1);
	$pdf->Ln();
	
	foreach($resultado as $row)
	{

		$pdf->SetFont('Arial','',12);
		$pdf->SetX(60);
		$pdf->Cell(45,6, utf8_decode($row['nombreCliente']),1,0,'C');
		//$pdf->SetX(70);
		$pdf->Cell(45,6, utf8_decode($row['cotizacion']),1,1,'C');
	;
	}
	$pdf->Output();
	
?>