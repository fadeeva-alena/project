<?php
// require tFPDF
require_once('tfpdf.php');

// map FPDF to tFPDF so FPDF_TPL can extend it
class pdf extends tFPDF {
    /**
     * "Remembers" the template id of the imported page
     */
    protected $_tplIdx;
    
    /**
     * include a background template for every page
     */
    public function Header() {
        if (is_null($this->_tplIdx)) {
            $this->setSourceFile('PDFDocument.pdf');
            $this->_tplIdx = $this->importPage(1);
        }
        $this->useTemplate($this->_tplIdx);
        
        $this->SetFont('DejaVu', 'B', 9);
        $this->SetTextColor(255);
        $this->SetXY(60.5, 24.8);
        $text = 'tFPDF (v' . tFPDF_VERSION . ') and FPDI (v'
        	  . FPDI_VERSION . ')';
        $this->Cell(0, 8.6, $text);
        $this->Ln(10);
    }
}

// just require FPDI afterwards
require_once('fpdi.php');

// initiate PDF
$pdf = new FPDI();


// initiate PDF
//$pdf = new tFPDF();
// add a page
$pdf->AddPage();


 $pdf->setSourceFile('../Template3.pdf');

$tplidx = $pdf->importPage(1,'/MediaBox');	
$pdf->useTemplate($tplidx,0,0,210,297);

// Add some Unicode font (uses UTF-8)
$pdf->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
$pdf->AddFont('DejaVu', 'B', 'DejaVuSansCondensed-Bold.ttf', true);

$pdf->SetFont('DejaVu', '', 14);

// Load a UTF-8 string from a file and print it
$txt = file_get_contents('HelloWorld.txt', true);
$pdf->Write(8, $txt);

// Select a standard font (uses windows-1252)
$pdf->SetFont('Arial', '', 14);
$pdf->Ln(10);
$pdf->Write(5, 'The file uses font subsetting.');

$pdf->Output('doc.pdf', 'D');
