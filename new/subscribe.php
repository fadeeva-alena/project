<?php

require_once('ui/Page.php');

class Subscribe
	extends Page
{

	protected function getPageData() {
		return array(
			'title'			=> 'Unterschreiben',
			'subtitle'		=> 'Unterschreiben',
			'description'	=> 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.'
		);
	}

	public $name;
	public $email;

	public function __construct() {
		$this->name = $this->post('name');
		$this->email = $this->post('email');

		parent::__construct();
	}

	public function sendAction() {
		if(empty($this->email) || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
			$this->error('Please enter valid e-mail address.');
		}

		if(empty($this->name)) {
			$this->error('Please enter your name.');
		}

		/* if(!$this->hasErrors()) {
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
			}
		} */
	}
}

new Subscribe();

?>