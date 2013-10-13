<?php

class AutoComplete {
	
	/**
	 * Enter description here...
	 *
	 * @var string
	 */
	var $inputName;
	
	/**
	 * Enter description here...
	 *
	 * @var string
	 */
	var $styleClass;
	
	var $array;
	
	
	/**
	 * Enter description here...
	 *
	 * @param string $inputName
	 * @param string $styleClass
	 * @return AutoComple
	 */
	function AutoComplete($inputName, $styleClass) {
		$this->inputName = $inputName;
		$this->styleClass = $styleClass;
	}
	
	/**
	 * Enter description here...
	 *
	 * @param array $array
	 */
	function setArray($array) {
		$this->array = $array;
	}
	
	/**
	 * Enter description here...
	 *
	 * @return string
	 */
	function render() {
		$str = '';
		
		foreach ($this->array as $value) {
			$str .= "\"" . htmlspecialchars($value, ENT_QUOTES) . "\", ";	
		}		 
		
		if (strlen($str) > 0) {
			$str = substr($str, 0, -2);
		}
		
		return "
<div id=\"" . $this->inputName. "update\" class = \"" . $this->styleClass . "\"></div>
<script type=\"text/javascript\" language=\"javascript\">
// <![CDATA[
	new Autocompleter.Local('" . $this->inputName . "', '" . $this->inputName . "update', 
		new Array(" . $str . ")  );
// ]]>
</script>
";	//{choices: 50}
	}
	
}


?>