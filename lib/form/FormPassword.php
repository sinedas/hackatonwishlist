<?php

class FormPassword extends FormElement {
			
	/**	
	 *
	 * @return String
	 */
	function render() {
		return "<input type=\"password\" name=\"" . $this->name . "\" value=\"" . 
			$this->renderValue() . "\"" . $this->renderParams() . ">";		
	}
}

?>