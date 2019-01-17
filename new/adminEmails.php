<?php

require_once('ui/Page.php');

class AdminEmails
	extends Page
{

	protected function getPageData() {
		return array(
			'title'			=> 'Admin | Emails',
			'subtitle'		=> 'Notification Emails',
			'description'	=> 'Notification emails bodies and subjects'
		);
	}

	public function __construct() {
		parent::__construct(RoleEntity::ROLE_ADMIN);
	}

}

new AdminEmails();

?>