<?php

date_default_timezone_set("Europe/Berlin");

if(!defined('LOG_FILE')) {
	define('LOG_FILE', 'logs/debug.log'); // Default log file
}

class Logger
{

	const LEVEL_DEBUG = 0;
	const LEVEL_INFO = 1;
	const LEVEL_ERROR = 2;

	public static function logDebug($message) {
		if(DEBUG_MODE) { // Display debug level messages only in debug mode
			self::logMessage(self::LEVEL_DEBUG, $message);
		}
	}

	public static function logInfo($message) {
		self::logMessage(self::LEVEL_INFO, $message);
	}

	public static function logError($message) {
		self::logMessage(self::LEVEL_ERROR, $message);
	}

	private static function logMessage($level, $message) {
		switch($level) {
			case self::LEVEL_INFO:
				$levelMessage = 'INFO';
				break;
			case self::LEVEL_ERROR:
				$levelMessage = 'ERROR';
				break;
			case self::LEVEL_DEBUG:
			default:
				$levelMessage = 'DEBUG';
		}

		$message = date('Y-m-d H:i:s')
			. (defined('PROCESS_NAME')? ' ' . PROCESS_NAME: '')
			. ' [' . session_id() . ']'
			. " [$levelMessage] $message\n";

		file_put_contents(LOG_FILE, $message, FILE_APPEND);

		if((self::LEVEL_ERROR == $level)
				&& (defined('SEND_MAIL')
				&& SEND_MAIL)) {
			if(defined('ADMIN_EMAILS')) {
				if(!mail(ADMIN_EMAILS, 'Error Report', $message)) {
					file_put_contents(LOG_FILE, "Failed sending email report to admin.\n", FILE_APPEND);
				}
			} else {
				file_put_contents(LOG_FILE, "Cannot send email report to admin. No recipients configured.\n", FILE_APPEND);
			}
		}
	}

}

function loggerErrorHandler($errLevel, $errMessage, $errFile, $errLine) {
	Logger::logError("[$errFile:$errLine] ($errLevel) $errMessage");

	return false;
}

set_error_handler('loggerErrorHandler', E_ALL | E_STRICT);

function loggerExceptionHandler($ex) {
	Logger::logError('Uncaught exception: ' . $ex->getMessage());
	Logger::logInfo('Exception details: ' . print_r($ex, true));
}

set_exception_handler('loggerExceptionHandler');

?>