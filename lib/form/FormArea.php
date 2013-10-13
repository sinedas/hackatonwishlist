<?php

class FormArea extends FormElement {
			
	/**
	 * Render FormInput into string
	 *
	 * @return String
	 */
	function render() {
		return "<textarea id=\"" . $this->name . "\" name=\"" . $this->name . "\" " . $this->renderParams() . ">" .
				$this->renderValue() . "</textarea>";		
	}
}

?>