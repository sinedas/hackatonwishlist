<?php

class ValidatorNum extends ValidatorAbstract {

	var $required;
	
	function ValidatorNum($errorMessage, $required = true) {		
		$this->errorMessage = $errorMessage;		
	}
	
	function isValid($value)
    {
    	if (!$this->required && strlen($value) == 0) {
        	return true;
        }
    	
    	return ($value == strval(floatval($value)) )? true : false;
	}	
}

?>