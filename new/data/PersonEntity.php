<?php

class PersonEntity
	extends Entity
{

	public $lastName;
	public $firstName;
	public $birthDate;

	public function fixBirthDate() {
		$this->birthDate = date('Y-m-d', strtotime($this->birthDate));
	}

}

?>