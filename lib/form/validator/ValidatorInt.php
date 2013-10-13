<?php

require_once('form/validator/ValidatorAbstract.php');

class ValidatorInt extends ValidatorAbstract {
		
	function ValidatorInt($errorMessage, $required = true) {		
		$this->errorMessage = $errorMessage;		
		$this->required = $required;
	}
	
	function isValid($value)
    {
    	if (!$this->required && strlen($value) == 0) {
        	return true;
        }
    	
    	return ($value == strval(intval($value)) )? true : false;
	}	
}

?>