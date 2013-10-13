<?php

class Heading  {
		
	var $desc;
	
	function Heading($desc) {
		$this->desc = $desc;
	}
	
	function render() {
		return "<b>" . $this->desc . "</b>";		
	}
}

?>