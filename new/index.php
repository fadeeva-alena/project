<?php

require_once('ui/Page.php');

class Index
	extends Page
{

	protected function getPageData() {
		return array(
			'title'			=> 'Start',
			'subtitle'		=> 'Welcome',
			'description'	=> 'Termine für Sitzungen und Seminare einfach vereinbaren, abrechnen, absagen, verschieben... Das Ende der Überstunden, Rückrufmarathons am Abend, ...'
		);
	}

	public function __construct() {
		parent::__construct();
	}

	public function defaultAction() {
		switch($this->user()->roleId) {
			case RoleEntity::ROLE_CLIENT:
				header('Location: clientHome.php');
				break;
			case RoleEntity::ROLE_PROF:
				header('Location: profHome.php');
				break;
			case RoleEntity::ROLE_ADMIN:
				header('Location: adminHome.php');
				break;
		}
	}

}

new Index();

?>