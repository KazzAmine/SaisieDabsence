<?php

require '../config.inc.php';
require '../fpdf.php';

$grp=$_GET['grp'];
 
class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('../ofppt_logo.png',10,-1,70);
    $this->SetFont('Arial','B',13);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(80,10,'Les notes des stagiaires',1,0,'C');
    // Line break
    $this->Ln(20);
}
 
// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
 

$display_heading = array('id'=>'CEF', 'stagiaire_name'=> 'Nom', 'stagiaire_prenom'=> 'Prenom','stagiaire_total'=> 'Total absence','stagiaire_note'=> 'Note');
$result = mysqli_query($conn, "select stagiaire.cef,stagiaire.nom,stagiaire.prenom,note.note_comportement,note.note_assiduite,COUNT(absence.id_stagiaire) 
FROM stagiaire ,note ,absence  
where stagiaire.cef=note.cef and stagiaire.cef=absence.id_stagiaire and stagiaire.groupe='".$grp."';");
// $header = mysqli_query($conn, "SHOW columns FROM stagiaire");

$pdf = new PDF();
//header
$pdf->AddPage();
//foter page
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',12);
// foreach($header as $heading) {
// $pdf->Cell(40,12,$display_heading[$heading['Field']],1);
// }
foreach($result as $row) {
$pdf->Ln();
foreach($row as $column)
$pdf->Cell(40,12,$column,1);
}
$pdf->Output();
?>