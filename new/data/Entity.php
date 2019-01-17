<?php

abstract class Entity
{

	public $id;

	public function loadPost() {
		foreach($this as $field => $value) {
			if(isset($_POST[$field])) {
				$this->$field = $_POST[$field];
			}
		}
	}

	public function loadObject($object) {
		foreach($this as $field => $value) {
			if(property_exists($object, $field)) {
				$this->$field = $object->$field;
			}
		}
	}

	public function remove() {
		$this->dac()->remove($this);
	}

	public function store() {
		$this->dac()->store($this);
	}

	public function __get($name) {
		return $this->dac()->_getRelation($this, $name);
	}

	public function __set($name, $value) {
		$this->dac()->_setRelation($this, $name, $value);
	}

	public function relations() {
		return array();
	}

	private $dac;
	private function dac() {
		if(is_null($this->dac)) {
			// Validate class name
			$className = get_class($this);
			if((6 >= strlen($className))
					|| !strendswith($className, 'Entity')) {
				throw new DACException('Invalid class name');
			}

			$dacClassName = strgetfirst($className, strlen($className) - 6) . 'DAC';

			$class = new ReflectionClass($dacClassName);
			$getInstanceMethod = $class->getMethod('getInstance');
			$this->dac = $getInstanceMethod->invoke(null);
		}

		return $this->dac;
	}

}

?>