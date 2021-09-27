<?php

namespace Vendor;

class Model{

	private $values = [];

	//
	public function __call($name, $args){
		$metodo = substr($name, 0, 3);
		$fieldName = substr($name, 3, strlen($name));

		//var_dump($metodo, $fieldName);
		//exit;

		switch ($metodo) {
			case 'get':
				return (isset($this->values[$fieldName])) ? $this->values[$fieldName] : NULL;
				break;

			case 'set':
				$this->values[$fieldName] = $args[0];
				break;
		}
	}

	public function setData($dados = array()){
		foreach ($dados as $key => $value) {
			$this->{"set" . $key}($value);
		}
	}

	public function getValues(){
		return $this->values;
	}
}
?>