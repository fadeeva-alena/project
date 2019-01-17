<?php

require_once('ui/Page.php');

class Registered
	extends Page
{

	protected function getPageData() {
		return array(
			'title'			=> 'Register',
			'subtitle'		=> 'Benutzer-Anmeldung',
			'description'	=> 'Ihr Konto wurde erfolgreich registriert. Bitte rufen Sie Ihre Mails ab und bestätigen Sie Ihre Anmeldung.'
		);
	}

	public function __construct() {
		parent::__construct();
	}

	public function defaultAction() {
		$this->info('Danke! Sie können sich nach der Bestätigung anmelden.');
	}

}

new Registered();

?>