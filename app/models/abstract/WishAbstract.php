<?php

require_once('DataObjectParent.php');

class WishAbstract extends DataObjectParent {

	function WishAbstract($fields=null) {
		parent::DataObjectParent($fields);
		$this->tableName = 'wish';
		$this->className = 'Wish';
		$this->primaryKey = 'id';
		$this->columns = array('id', 'user', 'data', 'likes', 'dislikes', 'head', 'smile', 'eyes', 'colour', 'hear'  );
	}

	function getId() {
		return $this->data['id'];
	}

	function setId($var) {
		$this->data['id'] = $var;
		$this->changedFields[] = 'id';
	}
    
    function getData() {
        return $this->data['data'];
    }

    function setData($var) {
        $this->data['data'] = $var;
        $this->changedFields[] = 'data';
    }

    function getUser() {
        return $this->data['user'];
    }

    function setUser($var) {
        $this->data['user'] = $var;
        $this->changedFields[] = 'user';
    }

    function getLikes() {
        return $this->data['likes'];
    }

    function setLikes($var) {
        $this->data['likes'] = $var;
        $this->changedFields[] = 'likes';
    }

    function getDislikes() {
        return $this->data['dislikes'];
    }

    function setDislikes($var) {
        $this->data['dislikes'] = $var;
        $this->changedFields[] = 'dislikes';
    }

    function getHead() {
        return $this->data['head'];
    }

    function setHead($var) {
        $this->data['head'] = $var;
        $this->changedFields[] = 'head';
    }

    function getSmile() {
        return $this->data['smile'];
    }

    function setSmile($var) {
        $this->data['smile'] = $var;
        $this->changedFields[] = 'smile';
    }

    function getEyes() {
        return $this->data['eyes'];
    }

    function setEyes($var) {
        $this->data['eyes'] = $var;
        $this->changedFields[] = 'eyes';
    }

    function getColour() {
        return $this->data['colour'];
    }

    function setColor($var) {
        $this->data['colour'] = $var;
        $this->changedFields[] = 'colour';
    }

    function getHear() {
        return $this->data['hear'];
    }

    function setHear($var) {
        $this->data['hear'] = $var;
        $this->changedFields[] = 'hear';
    }




}

?>