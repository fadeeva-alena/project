<?php

require_once('Logger.php');

final class Configurator
{

	private static $c_configs = array();
	public static function getConfig($configName = null) {
		if(empty($configName)) {
			trigger_error('No config name passed to Configurator::getConfig()', E_USER_ERROR);
		}

		if(isset(self::$c_configs[$configName])) {
			return self::$c_configs[$configName];
		}

		$config = new Configurator($configName);
		self::$c_configs[$configName] = $config;

		return $config;
	}

	private $configName;
	private $config = array();
	private $isModified = false;

	private function __construct($configName = null) {
		$this->configName = $configName;

		$this->load();
	}

	private function getConfigPath() {
		return realpath(dirname($_SERVER['SCRIPT_FILENAME'])) . '/config/' . $this->configName . '.ini.php';
	}

	public function __destruct() {
		Logger::logInfo('destructor called');

		if($this->isModified) {
			Logger::logInfo('storing to ' . $this->getConfigPath());

			$this->store();
		}
	}

	private function load() {
		Logger::logInfo('loading config ' . $this->getConfigPath());

		if(file_exists($this->getConfigPath())) {
			$lines = file($this->getConfigPath());
			foreach($lines as $line) {
				$line = trim($line);

				if(empty($line)
						|| ('<?php' == $line)
						|| ('?>' == $line)
						|| (0 === strpos($line, '//'))) {
					continue;
				}

				$params = explode('=', $line, 2);
				if(2 != count($params)) {
					trigger_error('Error in config ' . $this->getConfigPath() . ': \'' . $line . '\'', E_USER_ERROR);
				}

				$key = ltrim(trim($params[0]), '$');
				$value = rtrim(trim($params[1]), ';');
				$value = stripcslashes(substr($value, 1, strlen($value) - 2));
				$isArray = (strlen($key) - 2 == strrpos($key, '[]'));

				if($isArray) {
					$key = substr($key, 0, strlen($key) - 2);
				}

				if(isset($this->config[$key])) {
					if($isArray) {
						$this->config[$key][] = $value;
					} else {
						trigger_error('Key ' . $key . ' already present in config ' . $this->getConfigPath() . '. Duplicate key.', E_USER_WARNING);
						$this->config[$key] = $value;
					}
				} else {
					if($isArray) {
						$this->config[$key] = array();
						$this->config[$key][] = $value;
					} else {
						$this->config[$key] = $value;
					}
				}
			}
		}
	}

	private function store() {
		$configLine = "<?php\n";

		foreach($this->config as $key => $value) {
			if(is_array($value)) {
				foreach($value as $subValue) {
					if(empty($subValue)) {
						continue;
					}

					$subValue = addcslashes($subValue, "\r\n'");

					$configLine .= '$' . $key . '[] = \'' . $subValue . '\';' . "\n";
				}
			} else {
				if(empty($value)) {
					continue;
				}

				$value = addcslashes($value, "\r\n'");

				$configLine .= '$' . $key . ' = \'' . $value . '\';' . "\n";
			}
		}

		$configLine .= "?>";

		file_put_contents($this->getConfigPath(), $configLine);
	}

	public function get($key = null) {
		if(is_null($key)) {
			return $this->config;
		}

		if(isset($this->config[$key])) {
			return $this->config[$key];
		}

		return null;
	}

	public function getArray($key) {
		if(!isset($this->config[$key])) {
			return array();
		}

		if(is_array($this->config[$key])) {
			return $this->config[$key];
		} else {
			return array($this->config[$key]);
		}
	}

	public function out($key) {
		echo htmlspecialchars($this->get($key));
	}

	public function outJS($key) {
		echo addslashes($this->get($key));
	}

	public function set($key, $value, $remove = false) {
		if('password' != $key) {
			Logger::logInfo("set key $key to $value");
		}

		$this->isModified = true;

		if($remove) {
			if(!isset($this->config[$key])) {
				return;
			}

			if(is_array($this->config[$key])) {
				if(in_array($value, $this->config[$key])) {
					$index = array_search($value, $this->config[$key]);
					array_splice($this->config[$key], $index, 1);
				}
			} else {
				unset($this->config[$key]);
			}

			return;
		}

		if(is_array($this->config[$key])) {
			if(in_array($value, $this->config[$key])) {
				return;
			} else {
				$this->config[$key][] = $value;
			}
		} else {
			$this->config[$key] = $value;
		}
	}

}

?>