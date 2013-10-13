<?php

class FormCheckbox extends FormElement {
			
	/**
	 * Render FormInput into string
	 *
	 * @return String
	 */
	function render() {
		$strChecked = $this->value == 1 ? 'checked' : '';
		
		return "<input type=\"checkbox\" id=\"" . $this->name . "\" name=\"" . $this->name . "\" value=\"1\" " . $strChecked . 
			" " .  $this->renderParams() . ">";		
	}
}

?>