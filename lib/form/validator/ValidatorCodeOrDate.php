<?php

class ValidatorCodeOrDate extends ValidatorAbstract {

	var $required;
	
	function ValidatorCodeOrDate($required = true, $errorMessage = null) {
		$this->required = $required;
		$this->errorMessage = $errorMessage;
	}
	
	function isValid($value)
    {
        $valueString = (string)$value;

        if (!$this->required && strlen($value) == 0) {
        	return true;
        }

        $valCode = new ValidatorPersonCode();
        if ($valCode->isValid($value)) {
        	return true;
        }
        
        $valDate = new ValidatorDate();
        if ($valDate->isValid($value)) {
        	return true;
        }        
                
        return false;
    }	
}

?>