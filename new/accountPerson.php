<?php

require_once('ui/Page.php');

class AccountPerson
	extends Page
{

	protected function getPageData() {
		return array(
			'title'			=> 'Persönliche Daten: Name und Geburtsdatum',
			'subtitle'		=> 'Persönliche Daten: Name und Geburtsdatum',
			'description'	=> 'Ihr Geburtsdatum wird nur für interne Zwecke verwendet - andere Benutzer sehen das nicht - es erlaubt uns aber eine Prüfung, ob Sie volljährig sind genauso wie eine Authentifikation per Telefon.'
		);
	}

	public $lastName;
	public $firstName;
	public $birthDate;

	private $person;

	public function __construct() {
		parent::__construct();
	}

	public function init() {
		$this->person = $this->user()->person;
		if(!$this->person) {
			$this->person = new PersonEntity();
		}

		$this->loadObject($this->person);
	}

	public function updateAction() {
		if(empty($this->lastName)) {
			$this->error('Last Name is required.');
		}
		if(empty($this->firstName)) {
			$this->error('First Name is required.');
		}
		if(empty($this->birthDate)) {
			$this->error('Birth Date is required.');
		}

		if(!$this->hasErrors()) {
			$this->person->loadPost();
			$this->person->fixBirthDate();
			$this->person->store();

			$this->user()->personId = $this->person->id;
			$this->user()->store();

			header('Location: index.php');
		}
	}

}

new AccountPerson();

?>