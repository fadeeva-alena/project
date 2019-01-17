<?php

require_once('ui/Page.php');

class AdminClients
	extends Page
{

	protected function getPageData() {
		return array(
			'title'			=> 'Admin | Clients',
			'subtitle'		=> 'Clients List',
			'description'	=> 'Here you can manage clients registered on site.'
		);
	}

	protected $clientHash;

	public function __construct() {
		$this->clientHash = ClientDAC::getInstance()->get();

		parent::__construct(RoleEntity::ROLE_ADMIN);
	}

	public function holdAction() {
		$client = $this->clientHash[$this->get('id')];
		$user = $client->user;
		$user->isHold = 1;
		$user->store();
	}

	public function unholdAction() {
		$client = $this->clientHash[$this->get('id')];
		$user = $client->user;
		$user->isHold = 0;
		$user->store();
	}

	public function removeAction() {
		$client = $this->clientHash[$this->get('id')];
		$client->address->remove();
		$user = $client->user;
		$client->remove();
		$user->remove();
	}

}

new AdminClients();

?>