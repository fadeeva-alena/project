<?php

class UserEntity
	extends Entity
{

	const ADMIN_ID = 1;

	public $personId;
	public $addressId;
	public $login;
	public $passwordHash;
	public $email;
	public $loginAttempts	= 0;
	public $roleId			= RoleEntity::ROLE_VISITOR;
	public $isActive		= 0;
	public $isHold			= 0;

	public function setPassword($password = null) {
		if(empty($password)) {
			return $this->setPassword(substr(sha1(uniqid(rand(), true)), 0, 6));
		} else {
			$this->passwordHash = sha1($password);

			return $password;
		}
	}

	public function checkPassword($password) {
		return sha1($password) == $this->passwordHash;
	}

}

?>