<?php

class ValidatorTime extends ValidatorAbstract {

	var $required;
	
	function ValidatorTime($required = true, $errorMessage = null) {
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
        		'Neáraðytas laikas.';
        	return false;
        }        
 
        if (!preg_match('/\d{2}:\d{2}/', $valueString)) {        	
        	$this->errorMessage = !empty($this->errorMessage) ? 
        		$this->errorMessage :
        		'Blogas laikas. Formatas- hh:ii.';
            return false;
        }

        list($hour, $minute) = sscanf($valueString, '%d:%d');

        if ($hour > 23) {
        	$this->errorMessage = !empty($this->errorMessage) ? 
        		$this->errorMessage :
        		'Bloga valanda.';
        	return false;
        }
        
    	if ($minute > 59) {    		
        	$this->errorMessage = !empty($this->errorMessage) ? 
        		$this->errorMessage :
        		'Bloga minutë.';
        	return false;
        }

        return true;
    }	
}

?>