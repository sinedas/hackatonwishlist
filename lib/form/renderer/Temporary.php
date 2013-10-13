<?php
function renderForm2(&$form, $info = '') {
		$str = "
		<form action=\"" . $form->action . "\" method=\"post\">
		<fieldset>
		<legend>" . $form->desc . "</legend>
		<table cellspacing='0' cellpadding='0' border='0' align='top'><tr align='top'><td width=\"450\">
			<table align='top'>
		";
		
		$count = 0;		
		foreach ($form->elements as $value) {
		  	if (!is_a($value, 'FormSubmit') && !is_a($value, 'FormButton') && !is_a($value, 'FormHidden')) {
		  		if (!is_a($value, 'Heading')) {		  	
					$str .= "				
					<tr>
						<td width=\"130px\">" . $value->desc . "</td>
						<td width=\"\320px\">
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
			
			$count ++;
			if ($count == 11) {
				$str .= "</table></td><td width=\"450\" valign='top'><table align='top'>";
			}
		}
	
		$str .= "</table></td></tr></table>";
		
		$str .= 
		"<div id='family'><b><br/>Ðeimos nariai</b><br/>
			<span style='width: 220px'>Vardas</span>
			<span style='width: 220px'>Pavardë</span>
			<span style='width: 220px'>Asmens kodas</span>
			<span style='width: 220px'>Gyminystë</span>
			<span style='width: 220px'>Iðskirta</span>			
		</div>";
		
		foreach ($form->elements as $value) {
			if (is_a($value, 'FormSubmit') || is_a($value, 'FormButton') || is_a($value, 'FormHidden')) {
				$str .= $value->render() . " &nbsp;";
			}  
		}
		
		$str .= $info;
		
		$str .= "
		</fieldset>
		</form>";
		
		return $str;
	}
?>