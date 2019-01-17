<?php

require_once('ui/Page.php');

class ProfHome
	extends Page
{

	protected function getPageData() {
		return array(
			'title'			=> 'Professional | Start',
			'subtitle'		=> 'Welcome',
			'description'	=> 'Termine für Sitzungen und Seminare einfach vereinbaren, abrechnen, absagen, verschieben... Das Ende der Überstunden, Rückrufmarathons am Abend, ...'
		);
	}

	public function __construct() {
		parent::__construct(RoleEntity::ROLE_PROF);
	}

	public function defaultAction() {
		if(!$this->user()->personId) {
			$this->error('Bitte ergänzen Sie Ihre persönlichen Daten.');
		}
		if(!$this->user()->addressId) {
			$this->error('Bitte ergänzen Sie Ihre Adressinformationen.');
		}
	}

}

new ProfHome();

?>