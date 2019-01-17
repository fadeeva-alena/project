<?php
if (isset($_POST['Submit1'])) {

$selected_radio = $_POST['ty'];

if ($selected_radio == 'Auftraggeber') {
require"classPDF.php";	
	//create the pdf
	$pdf = new PDF();
	$pdf->init();
			
	//set properties
	$pdf->firstname_client = $_POST['firstname_client'];
	$pdf->lastname_client = $_POST['lastname_client'];
	$pdf->zip_client = $_POST['zip_client'];
	$pdf->location_client = $_POST['location_client'];
	$pdf->firstname_service = "";
	$pdf->lastname_service = "";
	$pdf->zip_service = "";
	$pdf->location_service = "";

	$pdf->printAll();	

	//display pdf file
	
	$file = $pdf->Output("Quittung.pdf", "I");	
}
else if ($selected_radio == 'Auftragnehmer') {
require"classPDF.php";	
	//create the pdf
	$pdf = new PDF();
	$pdf->init();
				
	//set properties
	$pdf->firstname_client = "";
	$pdf->lastname_client = "";
	$pdf->zip_client = "";
	$pdf->location_client = "";
                      $pdf->firstname_service =  $_POST['firstname_client'];
	$pdf->lastname_service = $_POST['lastname_client'];
	$pdf->zip_service =$_POST['zip_client'];
	$pdf->location_service = $_POST['location_client'];
	$pdf->printAll();	

	//display pdf file
	
	$file = $pdf->Output("Quittung.pdf", "I");	}
}

?>

