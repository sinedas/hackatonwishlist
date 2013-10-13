<?php

class ValidatorRequired extends ValidatorAbstract {
		
	function ValidatorRequired($errorMessage) {		
		$this->errorMessage = $errorMessage;		
	}
	
	function isValid($value) 
	{
		if (empty($value)) {
			return false;	
		} else if (strlen($value) == 0) {
			return false;
		}
		
		return true;
	}
}

?>