<?php

class FormButton extends FormElement {
	
	function FormButton($name, $value, $params = array()) 
	{	
		$this->name = $name;
		$this->value = $value;
		$this->params = $params;		
	}
			
	/**
	 * 
	 *
	 * @return String
	 */
	function render() {
		return "<input type=\"button\" name=\"" . $this->name . "\" value=\"" . $this->value . "\"" . $this->renderParams() . ">";		
	}
}

?>