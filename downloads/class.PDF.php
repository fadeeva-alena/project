<?php
/*
	Class Name : PDF
	Description : Handle pdf generation
*/

require_once('fpdi/fpdi.php');

class PDF extends FPDI
{
	//client properties
	public $firstname_client, $lastname_client, $zip_client, $location_client;
	
	//service properties
	public $firstname_service, $lastname_service, $zip_service, $location_service;

	//initialization
	function init()
	{
		//add fonts
		$this->AddFont('Calibri');

		//add new page
		$this->addNewPage();
	}
	
	/*
	 * Add new page and set initial conditions
	 */
	function addNewPage()
	{
		//add new page and import the original template
		$this->AddPage(P,A4);
		$this->importTemplate();
	}			

	/*
	 * Import PDF Template
	 */
	function importTemplate()
	{
		//$this->setSourceFile('Receit_template_ger.pdf');
                                           $this->setSourceFile('Template.pdf');
		$tplidx = $this->importPage(1,'/MediaBox');	
		$this->useTemplate($tplidx,0,0,210,297);		
	}

	/*
	 * Print everything here
	 */	
	function printAll()
	{
		$this->SetFont('Calibri','',14);
		
		$client_name=$this->getContent($this->firstname_client, $this->lastname_client);
		$client_location=$this->getContent($this->zip_client, $this->location_client);
		$service_name=$this->getContent($this->firstname_service, $this->lastname_service);
		$service_location=$this->getContent($this->zip_service, $this->location_service);
							
		$this->text(100,55.4,$client_name);
		$this->text(100,61.7,$client_location);
		$this->text(95,74.5,$service_name);
		$this->text(95,80.5,$service_location);
	}
	
	/*
	 * Return dot text if 2 parameters is empty
	 */
	function getContent($param1, $param2)
	{
		// remove all blank spaces
		$param1=trim($param1);
		$param2=trim($param2);
		
		// check empty
		if (empty($param1) && empty($param2))
			$text='....................................................................';
		else
			$text=$param1. ' ' .$param2;
		
		return $text;
	}
	 	
}	
?>
