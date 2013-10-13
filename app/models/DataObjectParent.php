<?php

require_once('DataAccess.php');

/**
 * @abstract
 */
class DataObjectParent {
  
	var $exists = false;
	
	var $data = array();
	
	var $changedFields = array();
	
	var $primaryKey;
	
	var $tableName;
	
	var $className;
	
	var $columns = array();
	
	/**
	 * Data Access object
	 *
	 * @var DataAccess
	 */
	var $dao;
	
	function DataObjectParent($fields = null) {		
	    $this->dao = &DataAccess::getInstance(); 
		if($fields) {
			$this->import($fields);
		}
	}
	
	function import($fields = null) {
		foreach($fields as $key=>$val) {
			$this->setValue($key, $val);
		}
	}
	
	function load($array) {
	  	foreach ($this->columns as $val) {
	  	  	if (isSet($array[$val])) {
	  	  	  	if ($this->getValue($val) != $array[$val]) {
	  	  	  	  	$this->changedFields[] = $val; 
					$this->setValue($val, $array[$val]);  	    
				}				
			}
		}
	}
		
	function setValue($key, $val) {
		$this->data[$key] = $val;
	}
		
	function getValue($key) {
		return !empty($this->data[$key]) ? $this->data[$key] : null;
	}
	
	function &getArray() {
		return $this->data;
	}
	
	function clearData() {
		$this->data = array();
		$this->changedFields = array();
		$this->exists = false;
	} 
	
	function getPrimaryKey() {
        return $this->primaryKey;
	}
	
	function getPrimaryKeyValue() {
        return $this->data[$this->primaryKey];
	}
	
	function setPrimaryKeyValue($value) {
        $this->data[$this->primaryKey] = $value;
	}
	
	function getClassName() {
        return $this->className;
	}
	
	function getTableName() {
        return $this->tableName;
	} 
	
	function getExists() {
        return $this->exists;
	}
	
	function setExists($var = true) {
	    $this->exists = $var;
	}
	
	function getChangedFields() {
		// remove duplicate values
        $this->changedFields = array_unique($this->changedFields); 
        return $this->changedFields;
	}
	
	function clearChangedFields() {
        $this->changedFields = array();
	} 	
	
	function save() {
	  	$this->dao->save($this);
	}
	
	function update($primaryKeyValue) {
	  	$this->dao->update($primaryKeyValue, $this);
	}
	
	function delete() {
		$this->dao->delete($this);
	}
	
	function getByPk($value) {
	  	$this->dao->getByPk($this, $value);
	}
	
	function getObject() {
		$this->dao->getObject($this);
	}
}

?>