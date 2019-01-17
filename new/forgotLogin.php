<?php

require_once('ui/Page.php');

class ForgotLogin
	extends Page
{

	protected function getPageData() {
		return array(
			'title'			=> 'Benutzername vergessen',
			'subtitle'		=> 'Benutzername vergessen',
			'description'	=> 'Please type your e-mail address used for registration here and press "Vorlegen". You will receive message with your login.'
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
				new EmailProcessor(
					'forgotLoginSubject',
					'forgotLoginBody',
					'forgotLoginCSS',
					$this->email,
					null,
					array(
						'email'		=> $this->email,
						'login'		=> $user->login,
						'date'		=> date('Y-m-d')
					)
				);
			} else {
				$this->error('Your e-mail is not registered.');
			}
		}
	}

}

new ForgotLogin();

?>