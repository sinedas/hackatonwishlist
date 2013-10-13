<?php

/**
 * Enter description here...
 *
 * @abstract 
 */
class ValidatorAbstract {
	
	/**
	 * Enter description here...
	 *
	 * @var string
	 */
	var $errorMessage;
	
	/**
	 * Enter description here...
	 *
	 * @param string $value
	 * @param return boolean
	 */
	function isValid($value) {}
	
	function setMessageIfNotSet($errorMessage) {
		if (empty($this->errorMessage)) {
			$this->errorMessage = $errorMessage;
		}
	}
}

?>