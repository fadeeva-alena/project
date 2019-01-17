<?php

require_once('ui/Page.php');

class AdminEmailsRegisterClientPreview
	extends Page
{

	protected function getPageData() {
		return array(
			'title'			=> 'Admin | Emails',
			'subtitle'		=> 'Client Registration Email Preview',
			'description'	=> 'Here you can see three input fields, first for e-mail message subject, second for message body CSS styles, and third is for message body HTML code. Note: 1) put CSS styles without any <style> </style> tags, feel like you are already have these tags; 2) put HTML email body code as if you are in <body> </body>; 3) use XHTML transitional or XHTML strict, no HTML here! Also note: all variables are case-sensitive. So {email} is ok, but {Email} is unknown. Be careful.'
		);
	}

	public $subject;
	public $css;
	public $body;

	public function __construct() {
		$this->subject = $this->config()->get('registerClientSubject');
		$this->css = $this->config()->get('registerClientCSS');
		$this->body = $this->config()->get('registerClientBody');

		if('preview' == $this->get('action')) {
			echo $this->config()->get('emailHtmlHeader');
			echo '<style>' . $this->css . '</style><body>' . $this->body . '</body></html>';
		} else {
			parent::__construct(RoleEntity::ROLE_ADMIN);
		}
	}

}

new AdminEmailsRegisterClientPreview();

?>