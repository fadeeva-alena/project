<?php

class RoleEntity
	extends Entity
{

	const ROLE_ADMIN	= 1;
	const ROLE_PROF		= 2;
	const ROLE_CLIENT	= 4;
	const ROLE_VISITOR	= 8;

	public $name;
	public $description;

}

?>