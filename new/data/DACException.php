<?php

class DACException
	extends Exception
{

	public function __construct($message = 'Got DAC exception with no message') {
		parent::__construct($message);
	}

}

?>