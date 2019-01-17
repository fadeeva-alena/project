<?php

require_once('ui/Page.php');

class ClientHome
	extends Page
{

	protected function getPageData() {
		return array(
			'title'			=> 'Client | Start',
			'subtitle'		=> 'Welcome, ' . $this->user()->login,
			'description'	=> 'Termine für Sitzungen und Seminare einfach vereinbaren, abrechnen, absagen, verschieben...<br />Das Ende der Überstunden, Rückrufmarathons am Abend, ...'
		);
	}

	public function __construct() {
		parent::__construct(RoleEntity::ROLE_CLIENT);
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

new ClientHome();

?>