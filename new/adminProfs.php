<?php

require_once('ui/Page.php');

class AdminProfs
	extends Page
{

	protected function getPageData() {
		return array(
			'title'			=> 'Admin | Professionals',
			'subtitle'		=> 'Professionals List',
			'description'	=> 'Here you can manage professionals registered on site.'
		);
	}

	public $profHash;

	public function __construct() {
		$this->profHash = UserDAC::getInstance()->getByRoleId(RoleEntity::ROLE_PROF);

		parent::__construct(RoleEntity::ROLE_ADMIN);
	}

}

new AdminProfs();

?>