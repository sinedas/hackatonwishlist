<?php

/**
 * Enter description here...
 *
 * @abstract 
 */
class FormElement {
	
	/**
	 * Enter description here...
	 *
	 * @var string
	 */
	var $desc;
	
	/**
	 * Enter description here...
	 *
	 * @var string
	 */
	var $name;
	
	/**
	 * Enter description here...
	 *
	 * @var string
	 */
	var $value;
	
	/**
	 * Enter description here...
	 *
	 * @var array
	 */
	var $params = array();
	
	/**
	 * Enter description here...
	 *
	 * @var string
	 */
	var $errorMessage;
	
	/**
	 * Enter description here...
	 *
	 * @var array
	 */
	var $validators = array();

	/**
	 * Enter description here...
	 *
	 * @param string $desc
	 * @param string $name
	 * @param string $value
	 * @param array $params
	 * @return FormElement
	 */
	function FormElement($desc, $name, $value, $params = array()) 
	{
		$this->desc = $desc;
		$this->name = $name;
		$this->value = $value;
		$this->params = $params;		
	}

	/**
	 * Enter description here...
	 *
	 * @return string
	 */
	function renderValue() {
		return htmlspecialchars($this->value, ENT_QUOTES);
	}
	
	/**
	 * Enter description here...
	 *
	 * @return string
	 */
	function renderParams() {
		$str = "";
		
		foreach ($this->params as $key => $value) {
			$str .= " " . $key . "=\"" . $value . "\"";
		}
		
		return $str;
	}
	
	/**
	 * Enter description here...
	 *
	 * @param ValidatorAbstract $validator
	 */
	function addValidator(&$validator) {
		$this->validators[] = &$validator;
	}
	
	/**
	 * Enter description here...
	 *
	 * @return boolean
	 */
	function isValid() {		
		foreach ($this->validators as $value) {
			if (!$value->isValid($this->value)) {
				$this->errorMessage = $value->errorMessage;				
				return false;	
			} 
		}
		
		$this->errorMessage = null;
		return true;
	}
	
}

?>