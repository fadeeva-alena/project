<?php

require_once('ui/Page.php');

class AdminEmailsLoginPreview
	extends Page
{

	protected function getPageData() {
		return array(
			'title'			=> 'Admin | Emails',
			'subtitle'		=> 'Forgot Login Email Preview',
			'description'	=> ''
		);
	}

	public $subject;
	public $css;
	public $body;

	public function __construct() {
		$this->subject = $this->config()->get('forgotLoginSubject');
		$this->css = $this->config()->get('forgotLoginCSS');
		$this->body = $this->config()->get('forgotLoginBody');

		if('preview' == $this->get('action')) {
			echo $this->config()->get('emailHtmlHeader');
			echo '<style>' . $this->css . '</style><body>' . $this->body . '</body></html>';
		} else {
			parent::__construct(RoleEntity::ROLE_ADMIN);
		}
	}

}

new AdminEmailsLoginPreview();

?>