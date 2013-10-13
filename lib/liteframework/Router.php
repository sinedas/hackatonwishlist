<?php

class Router {
  
	var $instance;
	
	var $controller;
	
	var $action;
	
	var $params;
	
	function &getInstance() {
	  	if (empty($instance)) {
		    $instance = new Router();
		}
		return $instance;
	}
	
	function Router() {	  
		$arr = split('/', $_SERVER['QUERY_STRING']);
		
		$this->controller = !empty($arr[0]) ? $arr[0] : 'index';
		$this->action = !empty($arr[1]) ? $arr[1] : 'index';

		for ($i = 2; $i < count($arr); $i += 2) {
			if (!empty($arr[$i + 1])) {
		  		$this->params[$arr[$i]] = $arr[$i + 1];
			} else if (!empty($this->params[$arr[$i]])) {
				$this->params[$arr[$i]] = null;
			}
		}		
	}	  
	
	function getController() {
	  	return $this->controller;
	}
	
	function getAction() {
	  	return $this->action;
	}
	
	function getParams() {
	  	return $this->params;
	}
}

?>