<?php

class FormUpload extends FormElement {
			
	/**
	 * Render FormUpload into string
	 *
	 * @return String
	 */
	function render() {
		return "<input type=\"file\" id=\"" . $this->name . "\" name=\"" . $this->name . "\" value=\"" . 
			$this->renderValue() . "\"" . $this->renderParams() . ">";		
	}
}

?>