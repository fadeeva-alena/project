<?php

require_once('ui/Page.php');

class Confirm
	extends Page
{

	protected function getPageData() {
		return array(
			'title'			=> 'Confirm Registration',
			'subtitle'		=> 'Confirm Registration',
			'description'	=> ''
		);
	}

	public function __construct() {
		parent::__construct();
	}

	public function rejectAction() {
		$activation = UserActivationDAC::getInstance()->getOneByCode($this->get('code'));
		if($activation) {
			$user = $activation->user;
			if($user) {
				if($user->isActive) {
					$this->error('Your account is already active. You can log in and remove it.');
				} else {
					switch($user->roleId) {
						case RoleEntity::ROLE_CLIENT:
							$userAccount = ClientDAC::getInstance()->getOneByUserId($user->id);
							break;
						case RoleEntity::ROLE_PROF:
							$userAccount = ProfDAC::getInstance()->getOneByUserId($user->id);
					}

					if($userAccount) {
						$address = $userAccount->address;

						$address->remove();
						$userAccount->remove();
						$user->remove();
						$activation->remove();
					} else {
						$this->error('Internal error. Please contact administrator.');
					}
				}
			} else {
				$activation->remove();
			}
		} else {
			$this->error('Invalid activation code. Possible your activation link is broken or incomplete.');
		}
	}

	protected function defaultAction() {
		$activation = UserActivationDAC::getInstance()->getOneByCode($this->get('code'));
		if($activation) {
			$user = $activation->user;
			if($user) {
				if($user->isActive) {
					$this->error('Ihr Konto wurde schon aktiviert, Sie können sich jetzt anmelden.');
				} else {
					$user->isActive = 1;
					$user->store();
				}
			} else {
				$this->error('Internal error. Please contact administrator.');
			}
		} else {
			$this->error('Invalid activation code. Possible your activation link is broken or incomplete.');
		}
	}

}

new Confirm();

?>