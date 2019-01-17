<?php

require_once('ui/Page.php');

class Login
	extends Page
{

	protected function getPageData() {
		return array(
			'title'			=> 'Eingang',
			'subtitle'		=> 'Eingang',
			'description'	=> 'Termine für Sitzungen und Seminare einfach vereinbaren, abrechnen, absagen, verschieben... <br />Das Ende der Überstunden, Rückrufmarathons am Abend, ...'
		);
	}

	public $login;
	public $password;

	public function __construct() {
		$this->login = $this->post('login');
		$this->password = $this->post('password');

		parent::__construct();
	}

	public function loginAction() {
		if($this->isLoggedIn()) {
			header('Location: index.php');
		}

		$user = UserDAC::getInstance()->getOneByLogin($this->login);
		if($user) {
			if(!$user->checkPassword($this->password)) {
				$user->loginAttempts++;
				$user->store();

				$this->error('Die falsche Passwort.');
			} elseif(!$user->isActive) {
				$this->error('Ihr Konto ist nicht aktiv. Bitte prüfen Sie Ihre Emails - wenn Sie Ihre Anmeldung abgeschlossen haben, finden Sie dort ein Willkommens-Email mit einem Link, welches den Zugang freischaltet.');
			} elseif($user->isHold) {
				$this->error('Ihr Account ist halten. Setzen Sie sich bitte mit Administrator in Verbindung, um es unzuhalten.');
			} else {
				$user->loginAttempts = 0;
				$user->store();

				$this->user($user);

				header('Location: index.php');
			}
		} else {
			$this->error('Diese Anmeldung wird nicht registriert. Wenn Sie überzeugt sind, dass Sie registriert werden, setzen Sie sich bitte mit Administrator in Verbindung.');
		}
	}

	public function logoutAction() {
		session_destroy();

		header('Location: index.php');
	}

}

new Login();

?>