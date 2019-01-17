<?php

require_once('classes/utilities.php');
require_once('classes/Configurator.php');
require_once('classes/Logger.php');
require_once('DACException.php');

function __autoload($className) {
	if(strendswith($className, 'DAC')) {
		if(file_exists('data/' . $className . '.php')) {
			require_once('data/' . $className . '.php');
		} else {
			eval('
				class ' . $className . '
					extends DAC
				{

					private static $c_instance = null;

					public static function getInstance() {
						if(is_null(self::$c_instance)) {
							$class = __CLASS__;
							self::$c_instance = new $class();
						}

						return self::$c_instance;
					}

					protected function __construct() {
						parent::__construct();
					}

				}
			');
		}
	} else {
		if(file_exists('data/' . $className . '.php')) {
	    	require_once('data/' . $className . '.php');
		} else {
			throw new DACException('Cannot find class declaration');
		}
	}
}

abstract class DAC
{

	private static $c_pdo = null;

	public static function pdo() {
		if(is_null(self::$c_pdo)) {
			$config = Configurator::getConfig('main');

			self::$c_pdo = new PDO(
				$config->get('dbDriver') . ":host=" . $config->get('dbHost') . ";dbname=" . $config->get('dbName'),
				$config->get('dbUser'),
				$config->get('dbPassword'));
		}

		return self::$c_pdo;
	}

	public static function hash(array $entities = array(), $field = 'id') {
		$entitiesHash = array();
		foreach($entities as $entity) {
			if(!property_exists($entity, $field)) {
				throw new DACException('Hash property does not exist');
			} elseif(is_null($entity->$field)) {
				throw new DACException('Hash property is null');
			}

			$entitiesHash[$entity->$field] = $entity;
		}

		return $entitiesHash;
	}

	private $tableName;
	private $entityName;
	private $fieldsList = array();
	private $fieldsHash = array();
	private $relations;

	protected function __construct() {
		$className = get_class($this);

		// Validate class name
		if((3 >= strlen($className))
				|| !strendswith($className, 'DAC')) {
			throw new DACException('Invalid class name');
		}

		$this->tableName = strgetfirst($className, strlen($className) - 3);
		$this->entityName = $this->tableName . 'Entity';

		$entityPath = $this->entityName . '.php';
		if(!file_exists('data/' . $entityPath)) {
			throw new DACException('Cannot find entity');
		}

		$entity = new $this->entityName();
		if(get_class($entity) != $this->entityName) {
			throw new DACException('Invalid entity class name');
		}
		if(!($entity instanceof Entity)) {
			throw new DACException('Not a subclass of Entity');
		}

		$this->relations = $entity->relations();
		if(!is_array($this->relations)) {
			throw new DACException('Invalid relations');
		}

		foreach($entity as $field => $value) {
			$this->fieldsList[] = $field;
			$this->fieldsHash[$field] = true;

			if((2 < strlen($field))
					&& strendswith($field, 'Id')
					&& !isset($this->relations[$field])) {
				$this->relations[$field] = ucfirst(strgetfirst($field, strlen($field) - 2));
			}
		}
	}

	public function _getRelation($entity, $name) {
		if(!isset($this->relations[$name . 'Id'])) {
			throw new DACException('Unknown relation');
		}

		$relationDAC = $this->relations[$name . 'Id'] . 'DAC';
		$relationId = $name . 'Id';

		if(empty($entity->$relationId)) {
			return null;
		}

		$class = new ReflectionClass($relationDAC);
		$getInstanceMethod = $class->getMethod('getInstance');
		$dac = $getInstanceMethod->invoke(null);

		return $dac->get($entity->$relationId);
	}

	public function _setRelation($entity, $name, $value) {
		$entityField = $name . 'Id';

		$entityClass = ucfirst($name) . 'Entity';
		if(!is_object($value)
				|| !($value instanceof Entity)
				|| !($value instanceof $entityClass)
				|| !isset($this->relations[$entityField])) {
			throw new DACException('Invalid relation');
		}

		if(empty($value->id)) {
			$value->store();
		}

		$entity->$entityField = $value->id;
	}

	public function __call($methodName, array $args) {
		if((3 > strlen($methodName))) {
			throw new DACException('Unknown method name');
		}

		if(strstartswith($methodName, 'set')) {
			return $this->_set(lcfirst(substr($methodName, 3)), $args);
		} elseif(strstartswith($methodName, 'get')) {
			if(strstartswith($methodName, 'getScalarBy')) {
				if(11 == strlen($methodName)) {
					throw new DACException('Unknown method name');
				}

				$field = lcfirst(substr($methodName, 11));

				return $this->_scalarBy($field, $args);
			}

			if(strstartswith($methodName, 'getBy')) {
				if(5 == strlen($methodName)) {
					throw new DACException('Unknown method name');
				}

				$field = lcfirst(substr($methodName, 5));

				return $this->_getBy($field, $args);
			}

			if(strstartswith($methodName, 'getOneBy')) {
				if(8 == strlen($methodName)) {
					throw new DACException('Unknown method name');
				}

				$field = lcfirst(substr($methodName, 8));

				return $this->_getOneBy($field, $args);
			}

			if(strstartswith($methodName, 'getLast')) {
				if(7 == strlen($methodName)) {
					throw new DACException('Unknown method name');
				}

				$count = substr($methodName, 7);

				return $this->_getLast($count, $args);
			}

			switch($methodName) {
				case 'get':
					return $this->_get($args);
				case 'getOrdered':
					return $this->_getOrdered($args);
				case 'getScalar':
					return $this->_scalar($args);
			}
		} else {
			switch($methodName) {
				case 'remove':
					return $this->_remove($args);
				case 'clear':
					return $this->_clear($args);
				case 'store':
					return $this->_store($args);
			}
		}

		throw new DACException('Unknown method name');
	}

	private function _scalarBy($field, array $args) {
		if((0 == count($args))) {
			throw new DACException('Missing parameter');
		} elseif(1 < count($args)) {
			throw new DACException('Too much parameters');
		}

		$command = self::pdo()->prepare('
			SELECT	count(*)
			FROM	`' . $this->tableName . '`
			WHERE	`' . ucfirst($field) . '` = :' . $field);
		$command->bindValue(':' . $field, $args[0]);

		if(!$command->execute()) {
			Logger::logError(print_r($command->errorInfo(), true));
			throw new DACException('Cannot select data');
		}

		$row = $command->fetch();
		return $row[0];
	}

	private function _scalar(array $args) {
		if(0 == count($args)) {
			$command = self::pdo()->prepare('
				SELECT	count(*)
				FROM	`' . $this->tableName . '`');
		} else {
			if(!is_string($args[0])) {
				throw new DACException('Invalid parameter');
			}

			if(1 == count($args)) {
				$command = self::pdo()->prepare($args[0]);
			} elseif(2 == count($args)) {
				if(!is_array($args[1])) {
					throw new DACException('Invalid parameter');
				}

				$command = self::pdo()->prepare($args[0]);
				foreach($args[1] as $field => $value) {
					$command->bindValue(':' . $field, $value);
				}
			} else {
				throw new DACException('Too much parameters');
			}
		}

		if(!$command->execute()) {
			Logger::logError(print_r($command->errorInfo(), true));
			throw new DACException('Cannot select data');
		}

		$row = $command->fetch();
		return $row[0];
	}

	private function _store(array $args) {
		$updateFields = array();
		$entity = new $this->entityName();

		if(0 == count($args)) {
			throw new DACException('No parameters passed');
		} elseif(1 == count($args)) {
			$entityClass = $this->entityName;
			if(is_object($args[0])
					&& $args[0] instanceof $entityClass) {
				$entity = $args[0];
			} elseif(is_array($args[0])) {
				foreach($args[0] as $field => $value) {
					if(!isset($this->fieldsHash[$field])) {
						throw new DACException('Invalid parameter passed');
					}

					$entity->$field = $value;
					$updateFields[] = $field;
				}
			} else {
				throw new DACException('Invalid parameter passed');
			}
		} else {
			if(count($this->fieldsList) == count($args)) {
				$entity->id = array_shift($args);
			}

			if(count($this->fieldsList) - 1 == count($args)) {
				$fieldIndex = 0;
				while(0 < count($args)) {
					$field = $this->fieldsList[$fieldIndex++];
					$entity->$field = array_shift($args);
				}
			} else {
				throw new DACException('Invalid parameters count');
			}
		}

		if(0 == count($updateFields)) {
			$updateFields = $this->fieldsList;
		}

		if(empty($entity->id)) {
			$fieldsStr = '';
			$valuesStr = '';
			foreach($updateFields as $field) {
				if('id' == $field) {
					continue;
				}

				if(empty($fieldsStr)) {
					$fieldsStr = '`' . ucfirst($field) . '`';
					$valuesStr = ':' . $field;
				} else {
					$fieldsStr .= ', `' . ucfirst($field) . '`';
					$valuesStr .= ', :' . $field;
				}
			}

			$command = self::pdo()->prepare('
				INSERT	INTO `' . $this->tableName . '` (' . $fieldsStr . ')
				VALUES	(' . $valuesStr . ')');

			foreach($updateFields as $field) {
				if('id' == $field) {
					continue;
				}

				$command->bindValue(':' . $field, $entity->$field);
			}
		} else {
			$pairsStr = '';
			foreach($updateFields as $field) {
				if('id' == $field) {
					continue;
				}

				if(empty($pairsStr)) {
					$pairsStr = '`' . ucfirst($field) . '` = :' . $field;
				} else {
					$pairsStr .= ', `' . ucfirst($field) . '` = :' . $field;
				}
			}

			$command = self::pdo()->prepare('
				UPDATE	`' . $this->tableName . '`
				SET		' . $pairsStr . '
				WHERE	`Id` = :id');

			foreach($updateFields as $field) {
				$command->bindValue(':' . $field, $entity->$field);
			}
		}

		if(!$command->execute()) {
			Logger::logError(print_r($command->errorInfo(), true));
			throw new DACException('Cannot store data');
		}

		if(empty($entity->id)) {
			$entity->id = self::pdo()->lastInsertId();
		}

		return $entity->id;
	}

	private function _remove(array $args) {
		if(0 == count($args)) {
			throw new DACException('Id is not specified');
		} elseif(1 != count($args)) {
			throw new DACException('Invalid parameters count');
		}

		$arg = $args[0];

		if(is_object($arg)) {
			if(!($arg instanceof Entity)) {
				throw new DACException('Not an Entity passed');
			}

			$id = $arg->id;
		} else {
			$id = (int) $arg;
		}

		if(empty($id)) {
			throw new DACException('Id is empty');
		}

		$command = self::pdo()->prepare('
			DELETE	FROM `' . $this->tableName . '`
			WHERE	`Id` = :id');
		$command->bindValue(':id', $id);
		
		if(!$command->execute()) {
			Logger::logError(print_r($command->errorInfo(), true));
			throw new DACException('Cannot remove data');
		}

		if(is_object($arg)) {
			foreach($arg as $field => $value) {
				$arg->$field = null;
			}
		}
	}

	private function _clear(array $args) {
		if(0 < count($args)) {
			throw new DACException('Invalid parameters count');
		}

		$command = self::pdo()->prepare('
			DELETE	FROM `' . $this->tableName . '`');
		
		if(!$command->execute()) {
			Logger::logError(print_r($command->errorInfo(), true));
			throw new DACException('Cannot remove data');
		}
	}

	private function _set($field, array $args) {
		if(!isset($this->fieldsHash[$field])) {
			throw new DACException('Unknown field specified');
		}

		if(2 != count($args)) {
			throw new DACException('Not enough arguments');
		}

		$id = (int) $args[0];
		if(empty($id)) {
			throw new DACException('Id is empty');
		}

		$command = self::pdo()->prepare('
			UPDATE	`' . $this->tableName . '`
			SET		`' . ucfirst($field) . '` = :value
			WHERE	`Id` = :id');
		$command->bindValue(':id', $id);
		$command->bindValue(':value', $args[1]);
		
		if(!$command->execute()) {
			Logger::logError(print_r($command->errorInfo(), true));
			throw new DACException('Cannot update data');
		}
	}

	private function _get(array $args) {
		if(0 == count($args)) {
			$command = self::pdo()->prepare('
				SELECT	*
				FROM	`' . $this->tableName . '`');
			
			if(!$command->execute()) {
				Logger::logError(print_r($command->errorInfo(), true));
				throw new DACException('Cannot read data');
			}

			return $this->_loadEntities($command);
		} elseif(1 == count($args)) {
			$id = (int) $args[0];
			if(empty($id)) {
				throw new DACException('Id is empty');
			}

			$command = self::pdo()->prepare('
				SELECT	*
				FROM	`' . $this->tableName . '`
				WHERE	`Id` = :id');
			$command->bindValue(':id', $id);
			
			if(!$command->execute()) {
				Logger::logError(print_r($command->errorInfo(), true));
				throw new DACException('Cannot read data');
			}

			return $this->_loadEntity($command->fetch(PDO::FETCH_ASSOC));
		} else {
			throw new DACException('Invalid parameters count');
		}
	}

	private function _getOrdered(array $args) {
		if(1 != count($args)) {
			throw new DACException('Invalid parameters count');
		}

		if(is_string($args[0])) {
			$command = self::pdo()->prepare('
				SELECT	*
				FROM	`' . $this->tableName . '`
				ORDER	BY `' . ucfirst($args[0]) . '`');
		} elseif(is_array($args[0])) {
			$orderStr = '';

			foreach($args[0] as $field => $order) {
				if(!isset($this->fieldsHash[$field])) {
					throw new DACException('Unknown field');
				}

				if(empty($orderStr)) {
					$orderStr .= '`' . ucfirst($field) . '` ' . ((empty($order))? 'DESC': 'ASC');
				} else {
					$orderStr .= ', `' . ucfirst($field) . '` ' . ((empty($order))? 'DESC': 'ASC');
				}
			}

			$command = self::pdo()->prepare('
				SELECT	*
				FROM	`' . $this->tableName . '`
				ORDER	BY ' . $orderStr);
		} else {
			throw new DACException('Invalid parameter');
		}
		
		if(!$command->execute()) {
			Logger::logError(print_r($command->errorInfo(), true));
			throw new DACException('Cannot read data');
		}

		return $this->_loadEntities($command);
	}

	private function _getLast($count, $args) {
		if(!ctype_digit($count)) {
			throw new DACException('Not a number specified as a rows count');
		}

		if(0 < count($args)) {
			throw new DACException('Too much parameters');
		}

		$count = (int) $count;

		$command = self::pdo()->prepare('
			SELECT	*
			FROM	`' . $this->tableName . '`
			LIMIT	' . $count);
		$command->bindValue(':value', $value);

		if(!$command->execute()) {
			Logger::logError(print_r($command->errorInfo(), true));
			throw new DACException('Cannot read data');
		}

		return $this->_loadEntities($command);
	}

	private function _getBy($field, $args) {
		$entityPassed = false;
		if(!isset($this->fieldsHash[$field])) {
			if(isset($this->fieldsHash[$field . 'Id'])) {
				$entityPassed = true;
			} else {
				throw new DACException('Unknown field name');
			}
		}

		if(1 != count($args)) {
			throw new DACException('Invalid parameters count');
		}

		$value = $args[0];
		if($entityPassed) {
			if(!is_object($value) || !($value instanceof Entity)) {
				throw new DACException('Not an entity passed');
			}

			$value = $value->id;
			$field = $field . 'Id';
		}

		$command = self::pdo()->prepare('
			SELECT	*
			FROM	`' . $this->tableName . '`
			WHERE	`' . ucfirst($field) . '` = :value');
		$command->bindValue(':value', $value);

		if(!$command->execute()) {
			Logger::logError(print_r($command->errorInfo(), true));
			throw new DACException('Cannot read data');
		}

		return $this->_loadEntities($command);
	}

	private function _getOneBy($field, $args) {
		$entities = $this->_getBy($field, $args);
		if(0 == count($entities)) {
			return null;
		}

		return $entities[0];
	}

	private function _loadEntities($command) {
		$entities = array();
		while($row = $command->fetch(PDO::FETCH_ASSOC)) {
			$entities[] = $this->_loadEntity($row);
		}

		return $entities;
	}

	private function _loadEntity($row) {
		if(!$row) {
			return null;
		}

		$fieldsHash = $this->fieldsHash;
		$entity = new $this->entityName();
		foreach($row as $field => $value) {
			$lcField = lcfirst($field);

			if(isset($fieldsHash[$lcField])) {
				$entity->$lcField = $value;
				unset($fieldsHash[$lcField]);
			} else {
				throw new DACException('Data and entity mismatch');
			}
		}

		if(0 < count($fieldsHash)) {
			throw new DACException('Data and entity mismatch');
		}

		return $entity;
	}

}

?>