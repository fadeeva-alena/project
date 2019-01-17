<?php

require_once('ui/Page.php');

class AdminHome
	extends Page
{

	protected function getPageData() {
		return array(
			'title'			=> 'Admin | Start',
			'subtitle'		=> 'Welcome',
			'description'	=> 'Administrator Panel.'
		);
	}

	public function __construct() {
		parent::__construct(RoleEntity::ROLE_ADMIN);
	}

}

new AdminHome();

?>