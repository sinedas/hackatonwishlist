<?php

class DataAccessConfig {
	
	var $connParams;
	
	function DataAccessConfig() {
	
	}
	
    /**
     * Enter description here...
     *
     * @return DataAccessConfig
     */
    function &getInstance() {
		static $instance = array();				
	  	if (!isset($instance[0])) { 
		    $instance[0] = new DataAccessConfig();
		} 	
		return $instance[0];
	}

	/**
	 * Enter description here...
	 *
	 * @param array $connParams
	 */
	function setParams($connParams) {
		$this->connParams = $connParams;		
	}
}

?>