<?php

require_once('form/validator/ValidatorAbstract.php');
require_once('form/validator/ValidatorRequired.php');
require_once('form/validator/ValidatorDate.php');
require_once('form/validator/ValidatorPersonCode.php');
require_once('form/validator/ValidatorCodeOrDate.php');
require_once('form/validator/ValidatorInt.php');
require_once('form/validator/ValidatorNum.php');
require_once('form/validator/ValidatorTime.php');

require_once('form/FormElement.php');


class Form {
	
	/**
	 * Enter description here...
	 *
	 * @var string
	 */
	var $action;
	
	/**
	 * Enter description here...
	 *
	 * @var string
	 */
	var $method = 'post';
	
	var $desc;
	
	var $elements = array();
	
	/**
	 * Enter description here...
	 *
	 * @var array
	 */
	var $params = array();
		
	/**
	 * Enter description here...
	 *
	 * @param string $action
	 * @return Form
	 */
	function Form($action, $desc, $params = array()) {
		$this->action = $action;
		$this->desc = $desc;
		$this->params = $params;
	}
	
	/**
	 * Enter description here...
	 *
	 * @param string $desc
	 * @param string $name
	 * @param string $value
	 * @param array $params
	 * @return FormInput
	 */
	function &addInput($desc, $name, $value = '', $params = array()) {
	  	require_once('form/FormInput.php');
	  
		$input = new FormInput($desc, $name, $value, $params);
		$this->elements[$name] = &$input; 	
		return $input;
	}
	
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $desc
	 * @param unknown_type $name
	 * @param unknown_type $value
	 * @param unknown_type $params
	 * @return FormArea
	 */
	function &addArea($desc, $name, $value = '', $params = array()) {
	  	require_once('form/FormArea.php');
	  
		$area = new FormArea($desc, $name, $value, $params);
		$this->elements[$name] = &$area; 	
		return $input;
	}
	
	/**
	 * Enter description here...
	 *
	 * @param string $desc
	 * @param string $name
	 * @param string $value
	 * @param array $params
	 * @return FormUpload
	 */
	function &addUpload($desc, $name, $value = '', $params = array()) {
	  	require_once('form/FormUpload.php');
	  
		$upload = new FormUpload($desc, $name, $value, $params);
		$this->elements[$name] = &$upload; 	
		return $input;
	}
	
	/**
	 * Enter description here...
	 *
	 * @param string $desc
	 * @param string $name
	 * @param string $value
	 * @param array $params
	 * @return FormCheckbox
	 */
	function &addCheckbox($desc, $name, $value = '', $params = array()) {
	  	require_once('form/FormCheckbox.php');
	  
		$checkbox = new FormCheckbox($desc, $name, $value, $params);
		$this->elements[$name] = &$checkbox; 	
		return $checkbox;
	}
	
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $name
	 * @param unknown_type $value
	 * @param unknown_type $params
	 * @return FormHidden
	 */
	function &addHidden($name, $value = '', $params = array()) {
	  	require_once('form/FormHidden.php');
	  
		$hidden = new FormHidden($name, $value, $params);
		$this->elements[$name] = &$hidden; 	
		return $hidden;
	}
	
	/**
	 * Enter description here...
	 *
	 * @param string $desc
	 * @param string $name
	 * @param string $value
	 * @param array $params
	 * @return FormPassword
	 */
	function &addPassword($desc, $name, $value = '', $params = array()) {
	  	require_once('form/FormPassword.php');
	  
		$password = new FormPassword($desc, $name, $value, $params);
		$this->elements[$name] = &$password;
		return $password;
	}
	
	/**
	 * Enter description here...
	 *
	 * @param string $name
	 * @param string $value
	 * @param array $params
	 * @return FormSubmit
	 */
	function &addSubmit($name, $value, $params = array()) {
	  	require_once('form/FormSubmit.php');
	  	  
		$submit = new FormSubmit($name, $value, $params);
		$this->elements[$name] = &$submit;
		return $submit;  	
	}
	
	/**
	 * Enter description here...
	 *
	 * @param string $name
	 * @param string $value
	 * @param array $params
	 * @return FormButton
	 */
	function &addButton($name, $value, $params = array()) {
	  	require_once('form/FormButton.php');
	  
		$button = new FormButton($name, $value, $params);
		$this->elements[$name] = &$button;
		return $button;  	
	}
	
	/**
	 * Enter description here...
	 *
	 * @param string $desc
	 * @param string $name
	 * @param array $options
	 * @param string $value
	 * @param array $params
	 * @return FormSelect
	 */
	function &addSelect($desc, $name, $options, $value = '', $params = array()) {
		require_once('form/FormSelect.php');
		
	  	$select = new FormSelect($desc, $name, $options, $value, $params);
	  	$this->elements[$name] = &$select;
	  	return $select;
	}
	
	/**
	 * Enter description here...
	 *
	 * @return boolean
	 */
	function isValid() {
	  	$valid = true;	  	
	  	
	  	foreach ($this->elements as $key => $value) {
	  		if (is_a($value, 'FormElement')) {
				if (!$this->elements[$key]->isValid()) {
					$valid = false;	
				}
	  		}
		}
		
		return $valid;
	}
	
	function load($array) {
		foreach ($this->elements as $key => $value) {				  	
			if (isSet($this->elements[$key]->name)
				&& isSet($array[$this->elements[$key]->name])) {
			  	$this->elements[$key]->value = $array[$this->elements[$key]->name];
			}
		}
	}
	
	function render() {
		require_once('form/renderer/OneColFormRenderer.php');
	  	$renderer = new OneColFormRenderer($this);  
	  	return $renderer->render();
	}
	
}

?>