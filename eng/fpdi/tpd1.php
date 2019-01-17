<?php
require_once('fpdi/tfpdf.php');
class pdf extends tFPDF {

// map FPDF to tFPDF so FPDF_TPL can extend it
    /**
     * "Remembers" the template id of the imported page
     */
    protected $_tplIdx;
    }

?>
