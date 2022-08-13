<?php 
require '../config.inc.php';
require '../fpdf.php';


$getData=$_GET['dataf'];
echo $getData;

$pdf = new FPDF('P', 'mm', 'A5');

$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Write(7,utf8_decode($getData));
$pdf->Output();



