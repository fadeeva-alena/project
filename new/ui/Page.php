<?php

require_once('classes/Logger.php');
require_once('classes/Configurator.php');
require_once('classes/EmailProcessor.php');
require_once('data/DAC.php');

if(!isset($_SESSION)) {
	session_start();
}

abstract class Page
{

	private $pageTitle;
	private $pageSubtitle;
	private $pageDescription;

	private $user;
	private $loggedIn;

	private $config;

	private $infos = array();
	private $errors = array();

	private $pageHelper;

	// default access is 15 = RoleEntity::ROLE_VISITOR | RoleEntity::ROLE_CLIENT | RoleEntity::ROLE_PROF | RoleEntity::ROLE_ADMIN
	public function __construct($role = 15) {
		Logger::logInfo('Accessing from '. $_SERVER['REMOTE_ADDR']);
		if($ip = IpDAC::getInstance()->getOneByIp(IpEntity::encodeIp($_SERVER['REMOTE_ADDR']))) {
			if($ip->isBlocked) {
				echo 'Your IP address is locked.';
				exit;
			}
		}

		$this->pageHelper = new PageHelper($this);

		Logger::logInfo(print_r($_SESSION, true));

		if(isset($_SESSION['userId'])) {
			$this->user = UserDAC::getInstance()->get($_SESSION['userId']);
		} else {
			$this->user = new UserEntity();
		}

		$pageData = $this->getPageData();
		$this->pageTitle = $pageData['title'];
		$this->pageSubtitle = isset($pageData['subtitle'])? $pageData['subtitle']: $pageData['title'];
		$this->pageDescription = $pageData['description'];

		$this->loggedIn = !empty($this->user->id);

		Logger::logInfo('Accessing ' . $this->pageTitle . ' [' . $this->pageSubtitle . ']');

		if(RoleEntity::ROLE_VISITOR & $role) {
			$permitted = true;
		} else {
			$permitted = $role & $this->user->roleId;
		}

		if($permitted) {
			DAC::pdo()->beginTransaction();
			try {
				$this->init();

				$this->pageHelper->populatePost();

				if(isset($_GET['action'])) {
					$action = $_GET['action'] . 'Action';
					$this->$action();
				} else {
					$this->defaultAction();
				}

				$this->renderTemplate();

				DAC::pdo()->commit();
			} catch(DACException $dex) {
				DAC::pdo()->rollBack();
				$this->errors[] = "Internal error. Please contact administrator.";
				Logger::logError($dex->__toString());
			} catch(Exception $ex) {
				DAC::pdo()->rollBack();
				$this->errors[] = "Unknown error. Please contact administrator.";
				Logger::logError($ex->__toString());
			}
		} else {
			header('Location: index.php');
		}
	}

	protected function renderTemplate() {
		require_once('Page.template.php');
	}

	protected function render() {
		require_once(lcfirst('templates/' . get_class($this)) . '.template.php');
	}

	protected function renderNavigation() {
	}

	protected function defaultAction() {
	}

	protected function init() {
	}

	public function get($var) {
		if(isset($_GET[$var])) {
			return $_GET[$var];
		}

		return null;
	}

	public function post($var) {
		if(isset($_POST[$var])) {
			return $_POST[$var];
		}

		return null;
	}

	protected function info($message) {
		$this->infos[] = $message;
	}

	protected function error($message) {
		$this->errors[] = $message;
	}

	protected function errors() {
		return $this->errors;
	}

	protected function hasErrors() {
		return 0 < count($this->errors);
	}

	protected function pageTitle() {
		return $this->pageTitle;
	}

	protected function pageSubtitle() {
		return $this->pageSubtitle;
	}

	protected function pageDescription() {
		return $this->pageDescription;
	}

	protected function getPageData() {
		return array('title' => '', 'subtitle' => '', 'description' => '');
	}

	protected function action() {
		return $_GET['action'];
	}

	protected function user($user = null) {
		if(!is_null($user)) {
			$_SESSION['userId'] = $user->id;
			$this->user = $user;
		}

		return $this->user;
	}

	protected function config() {
		if(is_null($this->config)) {
			$this->config = Configurator::getConfig('main');
		}

		return $this->config;
	}

	protected function isLoggedIn() {
		return $this->loggedIn;
	}

	public function loadObject($object) {
		foreach($this as $field => $value) {
			if(property_exists($object, $field)) {
				$this->$field = $object->$field;
			}
		}
	}

}

class PageHelper
{

	private $page;

	private $fields = array();

	public function __construct(Page $page) {
		$this->page = $page;

		foreach($page as $field => $value) {
			$this->fields[] = $field;
		}
	}

	public function populatePost() {
		foreach($this->fields as $field) {
			if(isset($_POST[$field])) {
				$this->page->$field = $_POST[$field];
			}
		}
	}

}

?>