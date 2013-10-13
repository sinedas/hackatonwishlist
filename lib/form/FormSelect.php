<?php

class FormSelect extends FormElement {
	
	function FormSelect($desc, $name, $options, $value = '', $params = array()) 
	{	
	  	$this->desc = $desc;
		$this->name = $name;
		$this->value = $value;
		$this->options = $options;
		$this->params = $params;		
	}
			
	/**
	 * 
	 *
	 * @return String
	 */
	function render() {
		$str = "<select name=\"" . $this->name . "\" id=\"" . $this->name . "\" " . $this->renderParams() . ">";
		
		if (is_array($this->options)) {
			foreach ($this->options as $key => $value) {
			  	$selected = $key == $this->value ? "selected=\"yes\"" : "";
			  	$str .= "<option value=\"" . $key . "\" " . $selected . ">" . htmlspecialchars($value, ENT_QUOTES) ."</option>";
			}
		}
		
		$str .= "</select>";
		return $str;
	}
}

?>