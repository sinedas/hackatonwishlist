<?php

class DataAccess {
	
	var $logType = '';
	
    function DataAccess() {
    	$config = DataAccessConfig::getInstance();
    	    	$config = DataAccessConfig::getInstance();
    	$params = $config->connParams;
    	
    	//print_r($config);
    	if (!isSet($params['host']) || !isSet($params['user']) || 
    		!isSet($params['password']) || !isSet($params['db'])) {
    		echo '<h3>Klaida: nenurodyti visi prisijungimo prie duombaz�s parametrai.</h3>';			
    		exit();    		
    	}    	
    	
    	if (!mysql_connect($params['host'], $params['user'], $params['password'])) {
    		echo '<h3>' . mysql_error(). '</h3>';			
    		exit();    		
    	}
    	
    	if (!mysql_select_db($params['db'])) {    		
    		echo '<h3>' . mysql_error(). '</h3>';			
    		exit();
    	}
		
		mysql_query('SET NAMES cp1257');
		mysql_query('SET CHARACTER SET cp1257_lithuanian_ci');		
    }

    /**
     * 
     *
     * @return DataAccess
     */
	function &getInstance() {
		static $instance;		
	  	if (!isset($instance)) { 
		    $instance = new DataAccess();	    	    
		}		
		return $instance;
	} 
	
	/**
	 * @static
	 */
	function begin() {
	  	DataAccess::getInstance();
	  	mysql_query('BEGIN');
	}
	
	/**
	 * @static
	 */
	function commit() {
	  	DataAccess::getInstance();
		mysql_query('COMMIT');		
	}
		
	function setLogType($type = null) {		
	  	$this->logType = $type;
	}
	
	function log($sql) {
	  	if ($this->logType == 'show') {
		  	echo $sql."<br>";
		}
	}
	
	function error($sql) {
	  	
	}
	
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $sql
	 * @param unknown_type $key
	 * @return unknown
	 */
	function getData($sql, $key = null) {	  	
	  	$result = mysql_query($sql);
		
		if (!$result) {
		  	trigger_error($sql . ' : ' . __CLASS__ . ' : ' . mysql_error(),  E_USER_ERROR);        
		}
		
		$array = null;
		
		while ($row = mysql_fetch_assoc($result)) {
			if (is_array($key)) {
				$array[$row[$key[0]]][$row[$key[1]]] = $row;
			} else if ($key) {			
				$array[$row[$key]] = $row;
			} else {
				$array[] = $row;
			}			
		}
		
		return $array;
	}
	
	/**
	 * Executes sql query and gent single row result
	 *
	 * @param string $sql
	 * @return false | array
	 */
	function getSingle($sql) {
		$result = mysql_query($sql);
		
		if (!$result) {
		  	trigger_error($sql . ' : ' . __CLASS__ . ' : ' . mysql_error(),  E_USER_ERROR);        
		}
		
		if ($row = mysql_fetch_assoc($result)) {
			return $row;  	
		}
		
		return false;		
	}
	
	function updateQuery($sql) {
		$result = mysql_query($sql);
		
		$access = DataAccess::getInstance();
		$access->log($sql);
		
		if (!$result) {
		  	trigger_error($sql . ' : ' . __CLASS__ . ' : ' . mysql_error(),  E_USER_ERROR);        
		}
	}
		
	/**
	 * 
	 *
	 * @param DataObjectParent $do
	 * @param mixed $value
	 */
	function getByPk(&$do, $value) {				
        $sql = 'SELECT * FROM ' . $do->getTableName() . ' WHERE ' . $do->getPrimaryKey() .' = '.$value;

        $this->log($sql);
        
        $result = mysql_query($sql);        
		if(!$result) {
        	trigger_error($sql . ' : ' . __CLASS__ . ' : ' . mysql_error(),  E_USER_ERROR);        
        }
        
        $row = mysql_fetch_assoc($result);
		if($row) {
			$do->import($row);
		    $do->setExists();
		} else {
		    $do->clearData();
		}
    } 	
    
    /**
     * 
     *
     * @param DataObjectParent $do
     */
    function delete(&$do) {
    	if($do->getExists()) {
    		$sql = 'DELETE FROM ' . $do->getTableName() . ' WHERE ' . $do->getPrimaryKey() . ' = '; 
    		$sql .= $do->getPrimaryKeyValue();
    		
    		$this->log($sql);
    		
    		$result = mysql_query($sql);
    		
    		if (!$result) {
    			trigger_error($sql . ' : ' . __CLASS__ . ' : ' . mysql_error(),  E_USER_ERROR);
    		}
    	}
    }
	
    function update($primaryKeyValue, &$do)  {
	 	 
	}	
	
    
    /**
     * 
     *
     * @param DataObjectParent $do
     */
	function save(&$do) {		
		if($do->getExists()) { 
		  	$changedFiels = $do->getChangedFields();
			
		  	if (count($changedFiels) == 0) {			
            	return;
			} 
			
			$fields = &$do->getArray();
			$sql = 'UPDATE ' . $do->getTableName() . ' SET ';
			
			foreach($fields as $key => $val){            
				if(in_array($key, $changedFiels)) {
					if ($val === null) {
                		$sql .= $key . ' = NULL, ';
					} else {
						$sql .= $key . ' = \'' . mysql_real_escape_string($val) . '\', ';
					}
                } 
			}	  
			
			$sql = substr($sql, 0, -2);
			$sql .= ' WHERE '.$do->getPrimaryKey() . ' = ' . $do->getPrimaryKeyValue();
			
			$this->log($sql);
			
			$result = mysql_query($sql);
			
			if (!$result) {
			  	trigger_error($sql . ' : ' . __CLASS__ . ' : ' . mysql_error(),  E_USER_ERROR);
			}
			
			$do->clearChangedFields(); 			
        } else { 		  	             
            $insertArray = &$do->getArray();
        	
        	$sql = 'INSERT INTO ' . $do->getTableName() . ' (' . implode(', ', array_keys( $insertArray )) . ') VALUES (';
            
            foreach ($insertArray as $val) {
            	$sql .= ' \'' . mysql_real_escape_string($val) . '\', ';								
			}
			
			$sql = substr($sql, 0, -2);
			$sql .= ')';
			
			$this->log($sql);
						
            $result = mysql_query($sql);
			
            if (!$result) {
			  	trigger_error($sql . ' : ' . __CLASS__ . ' : ' . mysql_error(),  E_USER_ERROR);
			} else {
			  	$do->setPrimaryKeyValue(mysql_insert_id());
                $do->setExists();
                $do->clearChangedFields();
			}
        }
    }
    
    /**
     * 
     *
     * @param DataObjectParent $do
     */
    function getObject(&$do) {    	
    	$sql = 'SELECT * FROM ' . $do->getTableName() . ' WHERE ';

    	$searchArray = &$do->getArray();
    	
    	foreach ($searchArray as $key => $value) {
    		if ($value === null) {
    			$sql .= $key . ' IS NULL AND   ';
    		} else {
    			$sql .= $key . ' = \'' . mysql_real_escape_string($value) . '\' AND   ';
    		}
    	}
    	
    	$sql = substr($sql, 0, -6);
    	
    	$sql .= ' LIMIT 1';
    	
        $this->log($sql);
        
        $result = mysql_query($sql);        
		if(!$result) {
        	trigger_error($sql . ' : ' . __CLASS__ . ' : ' . mysql_error(),  E_USER_ERROR);        
        }
        
        $row = mysql_fetch_assoc($result);
		if($row) {
			$do->import($row);
			$do->clearChangedFields();
		    $do->setExists();
		} else {
		    $do->clearData();
		}
    }
}

$da = &DataAccess::getInstance();
//$da->setLogType('show');

?>