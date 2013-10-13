<?php

class FormHidden extends FormElement {

	/**
	 * Enter description here...
	 *
	 * @param string $name
	 * @param string $value
	 * @param string $params
	 * @return FormHidden
	 */
	function FormHidden($name, $value, $params = array()) 
	{		
		$this->name = $name;
		$this->value = $value;
		$this->params = $params;		
	}
	
	/**
	 * Render FormHidden into string
	 *
	 * @return String
	 */
	function render() {
		return "<input type=\"hidden\" id=\"" . $this->name . "\" name=\"" . $this->name . "\" value=\"" . 
			$this->renderValue() . "\"" . $this->renderParams() . ">";		
	}
}

?>