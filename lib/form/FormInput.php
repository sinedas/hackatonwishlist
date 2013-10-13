<?php

class FormInput extends FormElement {
			
	/**
	 * Render FormInput into string
	 *
	 * @return String
	 */
	function render() {
		return "<input type=\"text\" id=\"" . $this->name . "\" name=\"" . $this->name . "\" value=\"" . 
			$this->renderValue() . "\"" . $this->renderParams() . ">";		
	}
}

?>