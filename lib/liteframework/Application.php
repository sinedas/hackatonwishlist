<?php

require_once('Router.php');
require_once('Controller.php');

class Application {
  
	var $instance;
	
	var $controllerName;
	
	var $actionName;
	
	var $params;	
	
	var $path;

	/**
	 * Gets singleton application
	 *
	 * @static 
	 * @return Application
	 */
	function &getInstance() {
		static $instance;		
	  	if (!isset($instance)) {
		    $instance = new Application();		    	    
		}		
		return $instance;
	} 
	
	function Application() {
	 	$router = &Router::getInstance();
	  	
	  	$this->controllerName = $router->getController();
	  	$this->actionName = $router->getAction();
	  	$this->params = $router->getParams(); 	  	
	}
		
	function setAppPath($path) {
	  	$this->path = $path;
		set_include_path(get_include_path() . PATH_SEPARATOR . $path);
	  	set_include_path(get_include_path() . PATH_SEPARATOR . $path . '/controllers');
		set_include_path(get_include_path() . PATH_SEPARATOR . $path . '/models');
		set_include_path(get_include_path() . PATH_SEPARATOR . $path . '/helpers');
	}

	function setLibPath($path) {	  	
		set_include_path(get_include_path() . PATH_SEPARATOR . $path);	  	
	}
	
	/**
	 * Runs controllers action.	 
	 */
	function run() {	  	
		require_once(ucfirst($this->controllerName).'Controller.php');		
		$controllerClass = ucfirst($this->controllerName).'Controller';
		$controller = new $controllerClass;
		
		$controller->preAction();		
		call_user_func(array(&$controller, $this->actionName));
		$controller->postAction();
				
		$tplFile = $this->controllerName.'/'.$this->actionName.'.tpl';
		
		if (!empty($controller->layout)) {			
			if ($controller->viewType != 'noview') {
				if (!empty($controller->viewTemplate)) {
					$tplFile = $this->controllerName.'/'.$controller->viewTemplate . '.tpl';
				}
				
				$controller->layout->smarty->assign('content', $controller->view->smarty->fetch($tplFile));		
			}			
		
			$controller->layout->smarty->display('layout/main.tpl');			
		} else if (!empty($controller->view)) {		  
			if (!empty($controller->viewTemplate)) {
				$tplFile = $this->controllerName.'/'.$controller->viewTemplate . '.tpl';
			}
			
			$controller->view->smarty->display($tplFile);
		} 
	}	  
	
	function processPost() {
	  	if (!empty($_POST))	{
		    foreach ($_POST as $key => $value) {
			  	$_POST[$key] = trim($value);
			}
			
			if (get_magic_quotes_gpc()) {				
				foreach ($_POST as $key => $value) {
				  	$_POST[$key] = stripslashes($value);
				}
			}
		}
	}
}

?>