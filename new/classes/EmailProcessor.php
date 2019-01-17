<?php

require_once('EmailException.php');

class EmailProcessor
{

	public function __construct($subjectKey, $bodyKey, $cssKey, $receiver, $sender = null, array $parameters = array()) {
		$config = Configurator::getConfig('main');

		$subject = $config->get($subjectKey);
		$body = $config->get($bodyKey);
		$css = $config->get($cssKey);

		$sender = is_null($sender)? $config->get('email'): $sender;

		foreach($parameters as $paramName => $paramValue) {
			$body = str_replace('{' . $paramName . '}', $paramValue, $body);
		}

		$body = $config->get('emailHtmlHeader')
			. '<style>' . $css . '</style><body>' . $body . '</body></html>';

		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$headers .= 'From: ' . $sender . "\r\n";

		if(!mail($receiver, $subject, $body, $headers)) {
			$msg = 'Cannot send mail. Please contact administrator.';
			Logger::logError(print_r(error_get_last(), true));
			Logger::logError($msg);
			throw new EmailException($msg);
		}
	}

}

?>