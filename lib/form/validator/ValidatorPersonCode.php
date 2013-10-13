<?php

class ValidatorPersonCode extends ValidatorAbstract {
		
	function ValidatorPersonCode($errorMessage = null) {
		$this->errorMessage = $errorMessage;
	}
	
	function isValid($value) 
	{
		if (empty($value)) {
			$this->setMessageIfNotSet('Neáraðytas asmens kodas.');
			return false;	
		} else if (!ereg("^[0-9]{11}$", $value)) {
        	$this->setMessageIfNotSet('Asmens kodas 11-aþenklis skaièius.');
			return false;
		} 

		$first = substr($value, 0, 1);
		
		if ($first == 3 || $first == 4) {
			$start = '19';
		} else if ($first == 5 || $first == 6) {
			$start = '20';
		} else if ($first == 1 || $first == 2) {
			$start = '18';
		} else {
			$this->setMessageIfNotSet('Neteisinga kodo pradþia.');
            return false;
		}
				
		$year = $start . substr($value, 1, 2);
		$month = substr($value, 3, 2);
		$day = substr($value, 5, 2);	
				
		if (!checkdate($month, $day, $year)) {
			$this->setMessageIfNotSet('Asmens kode neteisinga gimimo data');
            return false;
        }
		
		return true;
	}
}

?>