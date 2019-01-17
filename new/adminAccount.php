<?php

require_once('ui/Page.php');

class AdminAccount
	extends Page
{

	protected function getPageData() {
		return array(
			'title'			=> 'Admin | Account',
			'subtitle'		=> 'Admin Account',
			'description'	=> 'Administrator credentials. Please change these settings careful, inappropriate use may cause site malfunction. Make sure that e-mail you are entered is an active e-mail account, because no additional confirmations will be applied.'
		);
	}

	private $user;

	public $login;
	public $email;
	public $oldPassword;
	public $password;
	public $confirmPassword;

	public function __construct() {
		$this->user = UserDAC::getInstance()->get(UserEntity::ADMIN_ID);
		$this->login = $this->user->login;
		$this->email = $this->user->email;

		parent::__construct(RoleEntity::ROLE_ADMIN);
	}

	public function updateAction() {
		if(empty($this->login)) {
			$this->error('Field "Login" is required.');
		}
		if(empty($this->email)) {
			$this->error('Field "E-mail" is required.');
		}
		if(empty($this->oldPassword)) {
			$this->error('Field "Old Password" is required.');
		}
		if(empty($this->password)) {
			$this->error('Field "Password" is required.');
		}
		if(empty($this->confirmPassword)) {
			$this->error('Field "Confirm Password" is required.');
		}
		if($this->password != $this->confirmPassword) {
			$this->error('Password and confirmation do not match.');
		}
		if(!$this->user->checkPassword($this->oldPassword)) {
			$this->error('Invalid password.');
		}

		if(!$this->hasErrors()) {
			$this->user->login = $this->login;
			$this->user->email = $this->email;
			$this->user->setPassword($this->password);
			$this->user->store();
		}
	}

}

new AdminAccount();

?>