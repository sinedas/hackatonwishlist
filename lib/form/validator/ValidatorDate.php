<?php

class ValidatorDate extends ValidatorAbstract {

	var $required;
	
	function ValidatorDate($required = true, $errorMessage = null) {
		$this->required = $required;
		$this->errorMessage = $errorMessage;
	}
	
	function isValid($value)
    {
        $valueString = (string)$value;

        if (!$this->required && strlen($value) == 0) {
        	return true;
        }
        
        if (empty($value)) {
        	$this->errorMessage = !empty($this->errorMessage) ? 
        		$this->errorMessage : 
        		'Neáraðyta data. Formatas- yyyy-mm-dd.';
        	return false;
        }        
 
        if (!preg_match('/\d{4}-\d{2}-\d{2}/', $valueString)) {        	
        	$this->errorMessage = !empty($this->errorMessage) ? 
        		$this->errorMessage :
        		'Bloga data. Formatas- yyyy-mm-dd.';
            return false;
        }

        list($year, $month, $day) = sscanf($valueString, '%d-%d-%d');

        if (!checkdate($month, $day, $year)) {
        	$this->errorMessage = !empty($this->errorMessage) ? 
        		$this->errorMessage :
        		'Bloga data.';
            return false;
        }

        return true;
    }	
}

?>