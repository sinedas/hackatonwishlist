<?php

require_once('./lib/smarty/Smarty.class.php'); 

class View {
  
  	var $smarty;
  	
  	function View() {
  	  	$this->smarty = new Smarty();	
		$this->smarty->compile_check = true;
		$this->smarty->debugging = false;  		
	    $this->smarty->template_dir = 'app/views/';
		$this->smarty->compile_dir = 'app/compile_dir/';
		$this->smarty->plugins_dir[] = 'app/helpers/';
	}
	
	function &getSmartyInstance() {
	  	return $this->smarty;
	}  	
}

?>