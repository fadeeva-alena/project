<?php

class UserActivationEntity
	extends Entity
{

	public $userId;
	public $datePosted;
	public $code;

	public function setCode() {
		$this->code = sha1(uniqid(rand(), true));
	}

	public function setDatePosted() {
		$this->datePosted = date('Y-m-d');
	}

}

?>