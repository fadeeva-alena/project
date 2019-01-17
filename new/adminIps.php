<?php

require_once('ui/Page.php');

class AdminIps
	extends Page
{

	protected function getPageData() {
		return array(
			'title'			=> 'Admin | IPs',
			'subtitle'		=> 'IP Management',
			'description'	=> 'Do not lock your own IP address because you will not be able to manage site. Also note, one IP address can be used by more than one users, so lock IP address only when you are sure that other site visitors will still have access to the site.'
		);
	}

	public $ipAddress;

	public function __construct() {
		parent::__construct(RoleEntity::ROLE_ADMIN);
	}

	public function addAction() {
		$ipAddress = IpEntity::encodeIp($this->ipAddress);
		if($ipAddress) {
			$ip = IpDAC::getInstance()->getOneByIp($ipAddress);
			if($ip) {
				$this->error('This IP address is already added.');
			} else {
				$ip = new IpEntity();
				$ip->isBlocked = 1;
				$ip->ip = $ipAddress;
				$ip->store();
			}
		} else {
			$this->error('Invalid IP address.');
		}
	}

	public function lockAction() {
		$ip = IpDAC::getInstance()->get($this->get('id'));
		$ip->isBlocked = 1;
		$ip->store();
	}

	public function unlockAction() {
		$ip = IpDAC::getInstance()->get($this->get('id'));
		$ip->isBlocked = 0;
		$ip->store();
	}

	public function removeAction() {
		$ip = IpDAC::getInstance()->get($this->get('id'));
		$ip->remove();
	}

}

new AdminIps();

?>