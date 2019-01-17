<?php

require_once('ui/Page.php');

class Register
	extends Page
{

	protected function getPageData() {
		return array(
			'title'			=> 'Anmeldung',
			'subtitle'		=> 'Benutzer-Anmeldung',
			'description'	=> 'Damit Du das Angebot auf dieser Seite auch nutzen kannst, benötigen wir von Dir zuerst ein paar Angaben zu Firma, Adresse etc. Die Angaben mit einem Stern (*) sind notwendig - die anderen optional.'
		);
	}

	public $login;
	public $email;
	public $password;
	public $confirmPassword;
	public $roleId;
	public $newsSubscription;
	public $agreement;

	public function __construct() {
		parent::__construct();
	}

	public function registerAction() {
		$user = UserDAC::getInstance()->getOneByLogin($this->login);
		if($user) {
			$this->error('This login is already in use. Please try another.');
		}

		if(empty($this->email) || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
			$this->error('Please enter valid e-mail address.');
		} else {
			$user = UserDAC::getInstance()->getOneByEmail($this->email);
			if($user) {
				$this->error('This e-mail is already registered.');
			}
		}

		if(empty($this->password)) {
			$this->error('Please enter your password.');
		}
		if(empty($this->confirmPassword)) {
			$this->error('Please enter password confirmation.');
		}
		if($this->password != $this->confirmPassword) {
			$this->error('Password and confirmation do not match.');
		}

		if(!$this->agreement) {
			$this->error('You cannot be registered here if you do not agree with our Terms Of Use and Privacy Policy.');
		}

		Logger::logInfo('Validation errors: ' . print_r($this->errors(), true));

		if(!$this->hasErrors()) {
			$user = new UserEntity();
			$user->loadObject($this);
			$user->setPassword($this->password);
			$user->loginAttempts = 0;
			$user->isActive = 0;
			$user->isHold = 0;
			$user->store();

			Logger::logInfo('User stored.');

			$activation = new UserActivationEntity();
			$activation->user = $user;
			$activation->setCode();
			$activation->setDatePosted();
			$activation->store();

			Logger::logInfo('UserActivation stored.');

			try {
				if(RoleEntity::ROLE_PROF == $user->roleId) {
					$subject = 'registerProfSubject';
					$body = 'registerProfBody';
					$css = 'registerProfCSS';
				} elseif(RoleEntity::ROLE_CLIENT == $user->roleId) {
					$subject = 'registerClientSubject';
					$body = 'registerClientBody';
					$css = 'registerClientCSS';
				} else {
					return;
				}

				new EmailProcessor(
					$subject,
					$body,
					$css,
					$this->email,
					null,
					array(
						'email'		=> $this->email,
						'date'		=> date('Y-m-d'),
						'login'		=> $user->login,
						'password'	=> $this->password,
						'code'		=> $activation->code
					)
				);

				header('Location: registered.php');
			} catch(Exception $ex) {
				$this->error('Sending e-mail failed. Please contact administrator.');
			}
		}
	}

}

new Register();

?>