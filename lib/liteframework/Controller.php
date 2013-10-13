<?php  

/**
 * @abstract
 */
class Controller {
    
    var $layout;
    
    var $view;
    
    var $viewType;
    
    var $params;
    
    var $viewTemplate;
    
	function Controller() {
	  	$router = Router::getInstance();	
	  	$this->params = $router->getParams(); 		  	
	}
		
	function defaultView($viewTemplate = null) {
	  	require_once('View.php');
		$this->view = new View();	
		$this->viewTemplate = $viewTemplate;		
	}
	
	function layoutView($viewType = '', $viewTemplate = '') {
	  	require_once('View.php');
	  	if ($viewType == 'noview') {
	  		$this->layout = new View();		  	  
	  		$this->viewType = 'noview';
	  	} else {
		  	$this->defaultView($viewTemplate);
			$this->layout = new View(); 	 
		}
  	}
  	
  	function getParam($key) {
	    return isSet($this->params[$key]) ? $this->params[$key] : null;
	}
	
	/**
	 * 
	 * @abstract 
	 */
	function preAction() {}
	
	/**
	 * 
	 * @abstract 
	 */
	function postAction() {}


    /**
     * Enter description here...
     *
     * @param string $url
     */
    function actionRedirect($url) {
        header('Location: ' . $url);
        exit();
    }

	 
}

?>