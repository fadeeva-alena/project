<?php

require_once('ui/Page.php');

class AdminEmailsLogin
	extends Page
{

	protected function getPageData() {
		return array(
			'title'			=> 'Admin | Emails',
			'subtitle'		=> 'Forgot Login Email',
			'description'	=> 'Here you can see three input fields, first for e-mail message subject, second for message body CSS styles, and third is for message body HTML code. Note: 1) put CSS styles without any <style> </style> tags, feel like you are already have these tags; 2) put HTML email body code as if you are in <body> </body>; 3) use XHTML transitional or XHTML strict, no HTML here! Also note: all variables are case-sensitive. So {email} is ok, but {Email} is unknown. Be careful.'
		);
	}

	public $subject;
	public $css;
	public $body;

	public function __construct() {
		$this->subject = $this->config()->get('forgotLoginSubject');
		$this->css = $this->config()->get('forgotLoginCSS');
		$this->body = $this->config()->get('forgotLoginBody');

		parent::__construct(RoleEntity::ROLE_ADMIN);
	}

	public function updateAction() {
		if(empty($this->subject)) {
			$this->error('Please type in email subject.');
		} elseif(100 < strlen($this->subject)) {
			$this->error('Email subject cannot have more than 100 chars.');
		}

		if(empty($this->body)) {
			$this->error('Please type in email body HTML code.');
		}

		if(!$this->hasErrors()) {
			$this->config()->set('forgotLoginSubject', $this->subject);
			$this->config()->set('forgotLoginCSS', $this->css);
			$this->config()->set('forgotLoginBody', $this->body);

			header('Location: adminEmailsLoginPreview.php');
		}
	}

}

new AdminEmailsLogin();

?>