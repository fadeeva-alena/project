<?php

require_once('ui/Page.php');

class AdminDatabase
	extends Page
{

	protected function getPageData() {
		return array(
			'title'			=> 'Admin | Database',
			'subtitle'		=> 'Database Access',
			'description'	=> 'Please change these settings careful, inappropriate use may cause site malfunction. For example, before changing user name and/or password please create new user and check its access privileges first. User should have SELECT, INSERT, UPDATE and DELETE permissions.'
		);
	}

	public $driver;
	public $host;
	public $database;
	public $databaseUser;
	public $password;
	public $confirmPassword;

	public function __construct() {
		$this->driver = $this->config()->get('dbDriver');
		$this->host = $this->config()->get('dbHost');
		$this->databaseUser = $this->config()->get('dbUser');
		$this->database = $this->config()->get('dbName');

		parent::__construct(RoleEntity::ROLE_ADMIN);
	}

	public function updateAction() {
		if(empty($this->driver)) {
			$this->error('Field "Driver" is required.');
		}
		if(empty($this->host)) {
			$this->error('Field "Host" is required.');
		}
		if(empty($this->database)) {
			$this->error('Field "Database Name" is required.');
		}
		if(empty($this->databaseUser)) {
			$this->error('Field "Database User" is required.');
		}
		if(empty($this->password)) {
			$this->error('Field "Database Password" is required.');
		}
		if($this->password != $this->confirmPassword) {
			$this->error('Password and confirmation do not match.');
		}

		if(!$this->hasErrors()) {
			$this->config()->set('dbDriver', $this->driver);
			$this->config()->set('dbHost', $this->host);
			$this->config()->set('dbName', $this->database);
			$this->config()->set('dbUser', $this->databaseUser);
			$this->config()->set('dbPassword', $this->password);

			header('Location: adminHome.php');
		}
	}

}

new AdminDatabase();

?>