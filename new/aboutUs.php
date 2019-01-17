<?php

require_once('ui/Page.php');

class AboutUs
	extends Page
{

	protected function getPageData() {
		return array(
			'title'			=> 'Über uns',
			'subtitle'		=> 'Über uns',
			'description'	=> 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.'
		);
	}

	public function __construct() {
		parent::__construct();
	}

}

new AboutUs();

?>