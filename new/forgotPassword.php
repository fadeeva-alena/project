<?php

require_once('ui/Page.php');

class ForgotPassword
	extends Page
{

	protected function getPageData() {
		return array(
			'title'			=> 'Passwort vergessen',
			'subtitle'		=> 'Passwort vergessen',
			'description'	=> 'Please type your e-mail address used for registration here and press "Vorlegen". You will receive message with your new auto-generated password. After successful logging in you can change this password.'
		);
	}

	public $email;

	public function __construct() {
		parent::__construct();
	}

	public function sendAction() {
		if(empty($this->email) || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
			$this->error('Please enter valid e-mail address.');
		} else {
			$user = UserDAC::getInstance()->getOneByEmail($this->email);
			if($user) {
				$newPassword = substr(sha1(uniqid(rand(), true)), 0, 6);
				$user->setPassword($newPassword);
				$user->store();

				new EmailProcessor(
					'forgotPasswordSubject',
					'forgotPasswordBody',
					'forgotPasswordCSS',
					$this->email,
					null,
					array(
						'email'		=> $this->email,
						'login'		=> $user->login,
						'password'	=> $newPassword,
						'date'		=> date('Y-m-d')
					)
				);
			} else {
				$this->error('Your e-mail is not registered.');
			}
		}
	}

}

new ForgotPassword();

?>