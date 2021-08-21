<?php
require "fpdf.php";
$db=new PDO('mysql:host=localhost;dbname=mydata','root','');

class myPDF extends FPDF
{
	function header()
	{
		$this->Image('logo.png',10.6);
		$this->SetFont('Arial','B',14);
		$this->Cell(276,5,'EMPLOYEE DOCUMENTS',0,0,'C');
		$this->Ln();
		$this->SetFont('Times','',12);
		$this->Cell(276,10,'Street Address of Employee Office',0,0,'C');
		$this->Ln(20);

	}
	function footer()
	{
		$this->setY(-15);
		$this->SetFont('Arial','',8);
		$this->cell(0,10,'page'.$this->PageNo().'/{nb}',0,0,'C');
	}
	function headerTable()
	{
		$this->SetFont('Times','B',12);
		$this->Cell(20,10,'ID',1,0,'C');
		$this->Cell(20,10,'Name',1,0,'C');
		$this->Cell(20,10,'Position',1,0,'C');
		$this->Cell(20,10,'Office',1,0,'C');
		$this->Cell(20,10,'Age',1,0,'C');
		$this->Cell(20,10,'Start Date',1,0,'C');
		$this->Cell(20,10,'Salary',1,0,'C');
		$this->Ln();

	}

	function viewTable($db)
	{
		$this->SetFont('Times','B',12);
		$stmt=$db->query('select * from tablepaginate');
		while($data=$stmt->fetch(PDO::FETCH_OBJ))
		{
			$this->Cell(20,10,$data->ID,1,0,'C');
			$this->Cell(20,10,$data->Name,1,0,'L');
			$this->Cell(20,10,$data->Position,1,0,'L');
			$this->Cell(20,10,$data->Office,1,0,'L');
			$this->Cell(20,10,$data->Age,1,0,'L');
			$this->Cell(20,10,$data->Start_date,1,0,'L');
			$this->Cell(20,10,$data->Salary,1,0,'L');

			$this->Ln();

		}
	}
	

}
$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->Output();


?>