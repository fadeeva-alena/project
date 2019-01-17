<?php

class EmailException
	extends Exception
{

	public function __construct($message = 'Got mailing exception with no message') {
		parent::__construct($message);
	}

}

?>