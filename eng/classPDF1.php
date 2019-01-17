<?php
// require tFPDF
require_once('fpdi/fpdf.php');
// map FPDF to tFPDF so FPDF_TPL can extend it
    
// just require FPDI afterwards
require_once('fpdi/fpdi.php');

// initiate PDF
$pdf = new FPDI();

// Add some Unicode font (uses UTF-8)
$pdf->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
$pdf->AddFont('DejaVu', 'B', 'DejaVuSansCondensed-Bold.ttf', true);

// add a page
$pdf->AddPage();

$pdf->SetFont('DejaVu', '', 14);

// Load a UTF-8 string from a file and print it
//$txt = file_get_contents('HelloWorld.txt', true);
$pdf->Write(8, "Schläpfer");

// Select a standard font (uses windows-1252)
$pdf->SetFont('Arial', '', 14);
$pdf->Ln(10);
$pdf->Write(5, 'The file uses font subsetting.');

$pdf->Output('Quittung.pdf', 'D');
?>
