<?php

class IpEntity
	extends Entity
{

	public static function encodeIp($ipAddress) {
		$parts = explode('.', $ipAddress);
		if(4 != count($parts)) {
			return false;
		}

		$result = '';
		foreach($parts as $part) {
			if(!is_numeric($part)
					|| (255 < $part)
					|| (0 > $part)) {
				return false;
			}

			$part = dechex($part);
			if(1 == strlen($part)) {
				$part = '0' . $part;
			}

			$result .= $part;
		}

		return $result;
	}

	public static function decodeIp($ip) {
		return hexdec(substr($ip, 0, 2))
			. '.' . hexdec(substr($ip, 2, 2))
			. '.' . hexdec(substr($ip, 4, 2))
			. '.' . hexdec(substr($ip, 6));
	}

	public $ip;
	public $isBlocked;

	public function setIp($ipAddress) {
		return $this->ip = self::encodeIp($ipAddress);
	}

	public function getIp() {
		return self::decodeIp($this->ip);
	}

}

?>