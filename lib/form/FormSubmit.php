<?php

class FormSubmit extends FormElement {
	
	function FormSubmit($name, $value, $params = array()) 
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
		return "<input type=\"submit\" name=\"" . $this->name . "\" value=\"" . $this->value . "\"" . $this->renderParams() . ">";		
	}
}

?>