<? ob_start(); ?>
<?php
session_start();
$j=$_GET['al'];


if ($j == '1') {
$te=1;
require"classPDF.php";	
	//create the pdf
	$pdf = new PDF();
	$pdf->init();
			
	//set properties
$pdf->firstname_client = $_SESSION['first_name'];

	$pdf->lastname_client = $_SESSION['last_name'];
	$pdf->zip_client = $_SESSION['zip'];
	$pdf->location_client = $_SESSION['location'] ;
	$pdf->firstname_service = "";
	$pdf->lastname_service = "";
	$pdf->zip_service = "";
	$pdf->location_service = "";

	$pdf->printAll();	

	//display pdf file
	
	$file = $pdf->Output("Quittung.pdf", "I");	
}
if ($j == '2') {
$te=1;
require"classPDF.php";	
	//create the pdf
	$pdf = new PDF();
	$pdf->init();
				
	//set properties
	$pdf->firstname_client = "";
	$pdf->lastname_client = "";
	$pdf->zip_client = "";
	$pdf->location_client = "";
                      $pdf->firstname_service =  $_SESSION['first_name'];
	$pdf->lastname_service = $_SESSION['last_name'];
	$pdf->zip_service =$_SESSION['zip'];
	$pdf->location_service = $_SESSION['location'];
	$pdf->printAll();	

	//display pdf file
	
	$file = $pdf->Output("Quittung.pdf", "I");	}



?>

<? ob_flush(); ?>
