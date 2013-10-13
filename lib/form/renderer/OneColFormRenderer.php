<?php

class OneColFormRenderer {
	
	/**
	 * Enter description here...
	 *
	 * @var Form
	 */
	var $form;
	
	/**
	 * Enter description here...
	 *
	 * @param Form $form
	 * @return FormRenderer
	 */
	function OneColFormRenderer(&$form) {
		$this->form = $form;
	}
	
	/**
	 * Enter description here...
	 *
	 * @return string
	 */
	function render() {
		$str = "
		<form action=\"" . $this->form->action . "\" method=\"post\" "; 
		
		foreach ($this->form->params as $key => $value) {
			$str .= " " . $key . "=\"" . $value . "\"";
		}
		
		$str .= ">
		<fieldset>
		<legend>" . $this->form->desc . "</legend>
		<table>";
		
		foreach ($this->form->elements as $value) {
		  	if (!is_a($value, 'FormSubmit') && !is_a($value, 'FormButton') && !is_a($value, 'FormHidden')) {
		  		if (!is_a($value, 'Heading')) {		  	
					$str .= "				
					<tr>
						<td width=\"200px\">" . $value->desc . "</td>
						<td >
							" . $value->render() . "					
							<label style=\"color: red\">" . $value->errorMessage . "</label>
						</td>
					</tr>
				";
		  		} else {
		  			$str .= "
		  			<tr>
		  				<td colspan='3'><span><b>" . $value->desc . "</b></span></td>
		  			</tr>";
		  		}
			}
		}
	
		$str .= "</table></br>";
		
		foreach ($this->form->elements as $value) {
			if (is_a($value, 'FormSubmit') || is_a($value, 'FormButton') || is_a($value, 'FormHidden')) {
				$str .= $value->render() . " &nbsp;";
			}  
		}
		
		$str .= "
		</fieldset>
		</form>";
		
		return $str;
	}
	
}

?>